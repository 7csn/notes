# 10 结构struct
- Go中的struct，类似php中的class
- struct没有继承

&nbsp;
    
    type xxx struct{
        Sex int
    }

    type person struct {
        xxx     // 相当于继承xxx，意同：xxx xxx，前xxx为属性名，后xxx为上述结构别名
        Name string
        Age int
        abc struct {
            a string
            b int
        }
    }
    
    func main() {
        // & 取地址
        a := &person{
            Name : 'joe'    // 初始化信息
            xxx: xxx{Sex:0}
        }
        a.Age = 19
        a.abc.a = 'a'
        a.abc.b = 132
        
        b := struct {
            Name string
            Age int
        }{
            Name: 'joe'
            Age: 19
        }
        fmt.PrintIn(a, b)
    }
    
不同名称的struct的实例属于不同类型，不能比较