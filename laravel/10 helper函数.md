## 10 laravel函数
laravel提供了系列好用的函数，分为以下几类：
- 数组函数
- 字符串函数
- 路径函数
- URL函数
- 杂项函数

1. 数组

    ```php
    array_collapse($arr);   // 多维数组降一维返回
    ```
2. 字符串

    ```php
    str_limit($str, $len);  // 取字符串前$len位，并添加省略号
    str_random($len);       // 生成$len位随机字符串
    e($html);               // 实体转义
    ```
3. 路径

    ```php
    app_path();     // 返回当前项目app目录的绝对路径，加参数表后续
    base_path();    // 返回当前项目的绝对路径，加参数表后续
    config_path();              // 返回项目配置文件目录
    public_path();              // 返回项目公共文件目录
    ```
4. URL函数

    ```php
    url($route, $queryArr);     // 返回规范路由
    action('XxController@reg', $queryArr); // 配合路由器，生成规范路由
    back();         // 上一页
    ```
5. 杂项

    ```php
    bcrypt($pwd);   // 加密密码
    config();       // 读取配置，支持.数组递进，支持默认值返回
    request();      // 返回request对象，传参获取参数值，支持默认值
    ```

