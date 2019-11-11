## 13 反射reflection

- 反射提高程序灵活性，使interface{}有更大发挥余地
- 反射使用TypeOf和ValueOf函数从接口中获取目标对象的信息
- 反射会将匿名字段作为独立字段
- 用发射修改对象状态，前提是interface.data是settable，即pointer-interface
- 通过反射可以“动态”调用方法


    package main
     
    import (
        "fmt"
        "reflect"
    )

    type User struct {
        Id   int
        Name string
        Age  int
    }

    type Manager struct {
        User
        title string
    }

    func (u User) Hello() {
        fmt.Println("Hello world.")
    }

    func main() {
        u := User{1, "ok", 12}
        // Info(u)
        // Info(&u)
        // m := Manager{User: User{1, "ok", 12}, title: "123"}
        // t := reflect.TypeOf(m)
        // fmt.Println("%#v\n", t.FieldByIndex([]int{0, 1}))
        // Set(&u)
        // fmt.Println(u)
        v := reflect.ValueOf(u)
        mv := v.MethodByName("Test")
        args := []reflect.Value{reflect.ValueOf("joe")}
        fmt.Println(args)
        mv.Call(args)
    }

    func Info(o interface{}) {
        t := reflect.TypeOf(o)
        fmt.Println("Type:", t.Name())

        v := reflect.ValueOf(o)
        fmt.Println("Fields:")

        if k := t.Kind(); k != reflect.Struct {
            fmt.Println("xx")
            return
        }

        for i, l := 0, t.NumField(); i < l; i++ {
            f := t.Field(i)
            val := v.Field(i).Interface()
            fmt.Printf("%6s：%v = %v\n", f.Name, f.Type, val)
        }

        for i, l := 0, t.NumMethod(); i < l; i++ {
            m := t.Method(i)
            fmt.Printf("%6s：%v\n", m.Name, m.Type)
        }
    }

    func Set(o interface{}) {
        v := reflect.ValueOf(o)

        if v.Kind() == reflect.Ptr && !v.Elem().CanSet() {
            fmt.Println("xxx")
        } else {
            v = v.Elem()
        }

        f := v.FieldByName("Name")
        if !f.IsValid() {
            fmt.Println("BAD")
            return
        }
        if f.Kind() == reflect.String {
            f.SetString("BYEBYE")
        }
    }
     
    func (u User) Test(name string) {
        fmt.Println("Hello", name, ", my name is", u.Name)
    }
