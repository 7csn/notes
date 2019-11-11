## 14 并发concurrency

- Go所谓的的高并发，从源码上看，goroutine只是由官方实现的超级"线程池"而已。
- 高并发根本：每个实例4-5K的栈内存占用和由于实现机制而大幅度减少的创建和销毁开销。
- 并发主要由切换时间片来实现"同行"运行，在并行则是直接利用多核实现多线程的运行，但Go可以设置使用核数，以发挥多核计算机的能力。
- Goroutine 奉行通过通信共享内存，而非共享内存来通信。

Channel
- Channel 是 goroutine 沟通的桥梁，大都是阻塞同步的
- 通过 make 创建，close 关闭
- Channel 是引用类型
- 可以使用 for range 来迭代不断操作 Channel
- 可以设置单向或双向通道
- 可以设置缓存大小，在未被填满前不会发生阻塞
- 有缓存异步，无缓存同步阻塞

Select
- 可处理一个或多个channel的发送与接收
- 同时有多个可用的channel时按随机顺序处理
- 可用空的select来阻塞main函数
- 可设置超时



		package main

		import (
			"fmt"
			"runtime"
			"sync"
			"time"
		)

		func main() {
			// Test2()
			// Test()
			// time.Sleep(2 * time.Second)
			c := make(chan bool)
			select {
			case v := <-c:
				fmt.Println(v)
			case <-time.After(3 * time.Second):
				fmt.Println("timeout")
			}

		}

		func Test3() {
			c1, c2 := make(chan int), make(chan string)
			o := make(chan bool)
			go func() {
				for {
					select {
					case v, ok := <-c1:
						if !ok {
							o <- true
							break
						}
						fmt.Println("c1", v)
					case v, ok := <-c2:
						if !ok {
							o <- true
							break
						}
						fmt.Println("c2", v)
					}
				}
			}()

			c1 <- 1
			c2 <- "hi"
			c1 <- 3
			c2 <- "hello"

			close(c1)
		}

		func Test2() {
			runtime.GOMAXPROCS(runtime.NumCPU())
			wg := sync.WaitGroup{}
			wg.Add(10)
			n := 10
			for i := 0; i < n; i++ {
				go Go2(&wg, i)
			}
			wg.Wait()
		}

		func Go2(wg *sync.WaitGroup, index int) {
			a := 0
			for i := 0; i < 10000; i++ {
				a += i
			}
			fmt.Println(index, a)
			wg.Done()
		}

		func Test() {
			runtime.GOMAXPROCS(runtime.NumCPU())
			c := make(chan bool, 10)
			n := 10
			for i := 0; i < n; i++ {
				go Go(c, i)
			}
			for i := 0; i < n; i++ {
				<-c
			}
		}

		func Go(c chan bool, index int) {
			a := 0
			for i := 0; i < 10000; i++ {
				a += i
			}
			fmt.Println(index, a)
			c <- true
		}
