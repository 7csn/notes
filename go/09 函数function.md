# 09 函数function
- Go函数不支持嵌套、重载和默认参数
- 支持特性：无需声明原型、不定长度变参、多返回值、命名返回值参数、匿名函数、闭包
- 定义函数使用关键字func，且左大括号不能另起一行
- 函数也可以作为一种类型使用

参数：

    (a int, b int, c int)
    (a, b, c int)
    (a, b, c ...int)    // 最后一个参数c为数组，包含所有剩余参数
返回值：

    int
    (a, b, c int)   // 返回值变量已申明
    (int, int, int) // 需return 返回值
    
匿名函数：没有函数名

    package main
    import "fmt"
    func main() {
        t := abc(10)(5)
        x := abc(7)
        fmt.Println(t, x(12))
    }
    func abc(x int) func(int) int {
        // 匿名函数闭包
        return func(y int) int {
            return x + y
        }
    }
    // 引用地址&变量名
    // 指针*变量名
    // 传递引用地址，就是一个指针

defer
- 执行放肆类似其他语言中的析构函数，在函数体执行结束后按照调用顺序的相反顺序逐个执行
- 即使函数发生严重错误也会执行
- 支持匿名函数的调用
- 常用语资源清理、文件关闭、解锁以及记录时间等操作
- 通过与匿名函数配合可在return之后修改函数计算结果
- 若函数体内变量作为defer时匿名函数的参数，则在定义defer时即已获得了拷贝，否则是引用地址 
&nbsp;
- Go没有异常机制，但有panic/recover模式来处理错误
- Panic可以在任何地方引发，但recover只有在defer调用的函数中有效

&nbsp;

    func main() {       // 打印顺序a、c、b
        fmt.PrintIn('a')
        defer fmt.PrintIn('b')
        defer fmt.PrintIn('c')
    }
     
    for i := 0; i < 3; i++ {    // 打印的都是3
        defer func() {
            fmt.PrintIn(i)
        }()
    }
    
    function B() {
        // 定义defer，无措时跳过panic
        defer func() {
            if err := recover(); err != nil {
                fmt.PrintIn('recover in b')
            }
        }()
        // 报错终止程序
        panic('panic in b')
    }
    
    