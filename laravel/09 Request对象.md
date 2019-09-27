## 09 Request对象
Request对象上放置着此次请求的全部信息，如：
- 请求方式(get/post)
- 请求参数($_POST,$_FILES)
- 请求路径(域名之后部分)
- 请求cookie等信息  
1. 声明Request

    use Illuminate\Http\Request;
    在路由方法中，声明首个参数为Request类型，即可自动接收。其他参数推后。
2. 基本用法
    ```php
    // 关键路由
    $request->path();
     
    // 路径不含queryString
    $request->url();
     
    // 全路径含queryString
    $request->fullUrl();
     
    // 判断是否关键路由正则
    $request->is($path);
     
    // 获取请求方法
    $request->method();
     
    // 判断是否某请求方法
    $request->isMethod($method);
     
    // 获取POST参数值
    $request->input($name);            // $name参数可通过.进行数组递进
    $request->input($name, $default);  // 无则返回$default
     
    // 获取全部POST数据
    $request->all();
     
    // 获取queryString参数值
    $request->query($name);
    $request->query($name, $default);  // 无则返回$default
     
    // 返回全部queryString数据
    $request->input();
     
    // 获取参数值
    $request->参数名;
       
    // 判断是否有参数
    $request->has($name);
     
    // 判断是否有文件上传
    $request->hasFile($name);
     
    // 获取上传文件信息
    $request->file($name);
     
    // 上传文件到指定目录、文件名
    $request->file($name)->move($dir);
    $request->file($name)->move($dir, $fileName);
    ```