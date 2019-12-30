# 12 接口interface

    type Connecter interface {
        Connect()
    }
    type USB interface {
        Name() string
        Connecter
    }
    type PhoneConnecter struct {
        name string
    }
    func (pc PhoneConnecter) Name() string {
        return pc.name
    }
    func (pc PhoneConnecter) Connect() {
        fmt.PrintIn("Connect:", pc.name)
        return pc.name
    }
    func main() {
        a := PhoneConnecter{"PhoneConnecter"}
        a.Connect()
        Disconnect(a)
    }
    func Disconnect(usb interface{}) {
        // usb.(PhoneConnecter)判断usb是否PhoneConnecter类型
        switch v:= usb.(type) {
            case PhoneConnecter:
                fmt.PrintIn("Disconnected:", v.name)
            default:
                fmt.PrintIn("unknow decive.")
        }
    }
    
### 接口
- 一个或多个方法签名的集合
- 将对象赋值给接口，接口存储的是指向对象复制品的指针，既无法修改复制品状态，也无法获取指针
- 只有当接口存储的类型和对象都为nil时，接口才等于nil
