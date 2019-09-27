<?php

// 控制反转(Inversion of Control，缩写 IoC)：面向对象的一种设计原则，用以减耦。

// 对象被创建时，由一个调控系统内所有对象的外界实体，将其所依赖的对象的引用传递给它。

// 分为两点：
//  依赖注入(Dependency Injection，简称 DI)，即对象创建时，传入递归创建的依赖对象的引用
//  依赖查找(Dependency Lookup)，依赖对象的类型，由外界调控实体查找确定

// IoC容器：
//  管理对象的生命周期、依赖关系等，使得应用程序的配置和依赖性规范与实际的应用程序代码分离
//  例如，通过配置文件调整应用程序组件间的相互关系，而不用重新修改(并编译)具体的代码

// -----------------------------------------------------------------------------
//  依赖注入案例：User 仅实现写入日志功能，日志的类型由外部传递，无需自己调整
// -----------------------------------------------------------------------------

/**
 * 日志接口
 *
 * Interface Log
 */
interface Log
{
    /**
     * 记录日志
     *
     * @return mixed
     */
    public function write();
}

/**
 * 文件日志类
 *
 * Class DatabaseLog
 */
class FileLog implements Log
{
    /**
     * 记录文件日志
     */
    public function write()
    {
        echo 'file log write<br>';
    }
}

/**
 * 数据库日志类
 *
 * Class DatabaseLog
 */
class DatabaseLog implements Log
{
    /**
     * 记录数据库日志
     */
    public function write()
    {
        echo 'database log write<br>';
    }
}

/**
 * 程序操作类
 *
 * Class User
 */
class User
{
    /**
     * 日志对象
     *
     * @var Log
     */
    protected $log;

    /**
     * 接收一个实现日志接口的对象并缓存
     *
     * User constructor.
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    /**
     * 记录日志
     */
    public function writeLog()
    {
        $this->log->write();
    }
}

// 记录文件日志、数据库日志
(new User(new FileLog))->writeLog();
(new User(new DatabaseLog))->writeLog();

// -----------------------------------------------------------------------------
//  依赖查找案例：创建类型对象之前，确定真实的类型
// -----------------------------------------------------------------------------

/**
 * IoC容器
 *
 * Class Container
 */
class IoC
{
    /**
     * 虚实类型对照表
     *
     * @var array
     */
    protected $concretes = [];

    /**
     * 根据依赖类型创建对象
     *
     * @param $abstract     抽象类型
     * @return object
     * @throws Exception
     */
    public function make($abstract)
    {
        // 获取真实类型
        $concrete = $this->getConcrete($abstract);
        // 指定类型反射
        $reflector = new ReflectionClass($concrete);
        // 可实例化验证
        if (!$reflector->isInstantiable()) {
            throw new Exception("类型[$concrete]不可实例化");
        }
        // 获取构造方法反射
        $constructor = $reflector->getConstructor();
        // 无构造函数创建对象
        if (is_null($constructor)) {
            return $reflector->newInstanceWithoutConstructor();
        }
        // 构造函数参数列表
        $params = [];
        // 遍历构造函数参数反射列表
        foreach ($constructor->getParameters() as $parameter) {
            // 将构造函数参数反射对象转化为具体参数
            $params[] = $this->getDependency($parameter);
        }
        // 注入参数列表，创建对象并返回
        return $reflector->newInstanceArgs($params);
    }

    /**
     * 设置别名
     *
     * @param $abstract 抽象类型
     * @param $concrete 具体类型
     * @return $this
     */
    public function concrete($abstract, $concrete)
    {
        if ($abstract && $concrete && $abstract !== $concrete) {
            $this->concretes[$abstract] = $concrete;
        }
        return $this;
    }

    /**
     * 获取真实类型
     *
     * @param $abstract
     * @return mixed
     */
    protected function getConcrete($abstract)
    {
        return key_exists($abstract, $this->concretes)
            ? $this->getConcrete($this->concretes[$abstract])
            : $abstract;
    }

    /**
     * 将参数反射对象转化为具体对象
     *
     * @param ReflectionParameter $parameter 参数反射对象
     * @return object
     * @throws Exception
     */
    public function getDependency(ReflectionParameter $parameter)
    {
        // 获取参数反射类
        $class = $parameter->getClass();
        // 非对象且无默认值，则抛出异常
        if (is_null($class) && !$parameter->isDefaultValueAvailable()) {
            // 异常信息
            $message = sprintf('%s参数%s无法构成依赖', (function () use ($parameter) {
                // 声明类
                $declaringClass = $parameter->getDeclaringClass();
                // 声明主体信息
                return is_null($declaringClass)
                    ? sprintf('方法%s', $parameter->getDeclaringFunction()->name)
                    : sprintf('对象%s构造方法', $declaringClass->name);
            })(), $parameter->name);
            // 抛出异常
            throw new Exception($message);
        }
        // 根据参数类型创建
        return $this->make($parameter->getClass()->name);
    }
}

// 创建容器、配置日志类型、创建工作者写入日志
(new IoC())
    ->concrete(Log::class, FileLog::class)
    ->make('User')->writeLog();


