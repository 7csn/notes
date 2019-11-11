# 11 方法method
方法重载

    type A struct {
        Name string
    }
    type B int
    func main() {
        a := A{}
        a.Print()
        fmt.PrintIn(a.Name)
        var b B
        b.Print()
    }
    func (a A) Print() {
        a.Name = 'aaa'
        fmt.PrintIn('A')
    }
    func (b *B) Print() {
        fmt.PrintIn('B')
    }
    