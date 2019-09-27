## 08 强大的Model
1. 简介
    1. 路径
 
        app
    2. 文件名
    
        xy模型文件名：Xy.php
    3. 命名空间
    
        namespace App;
    4. 继承
    
        use Illuminate\Database\Eloquent\Model;
2. 与表的关系

    表通常复数形式，如msgs表model为./app/Msg.php
3. 自动生成model
    ```shell
    php artisan make:model Msg
    ```
4. 实例化model
    ```php
    $model = new App\Msg();      // 得到msgs表的Model
    $model = App\Msg::find($id); // 静态使用
    ```
5. 增
    ```php
    $msg = new Msg();
    $msg->title = $_POST['title'];
    $msg->content= $_POST['content'];
    $msg->save();
   ```
6. 查(find/first)
    ```php
    // 按ID查
    Msg::find($id);
     
    // 按where条件查
    Msg::where('id', '>', 1)->first();
     
    // 无条件查所有行的title
    Msg::all(['title']);
     
    // 按条件查多行的title
    Msg::where('id', '>', 5)->get(['title']);
   ```
7. 改
    ```php
    $msg = Msg::find($id);
    $msg->title = $_POST['title'];
    $msg->content= $_POST['content'];
    $msg->save();
   ```
8. 删
    ```php
    // 静态删除
    Msg::destroy($id);
     
    // 指定对象删除
    $msg = Msg::find($id);
    $msg->delete();
   ```
9. 复杂查询
    ```php
    // 排序
    Msg::where('id', '>', 2)->orderBy('id', 'desc')->get();
     
    // 限制条目
    Msg::where('id', '>', 2)->orderBy('id', 'desc')->skip(2)->take(1)->get();
    
    // 统计
    Msg::count();
    Msg::avg('id');
    Msg::min('id');
    Msg::max('id');
    Msg::sum('id');
     
    // 分组 DB::raw表示不修饰(默认会当成字段)
    Goods::groupBy('cid')->get('cid', DB::raw('avg(id)'));
      
   // 条件
    OrWhere();
    whereBetween($field, [$min, $max]);
    whereIn($field, $arr);
    whereNotIn($field, $arr);
   ```
10. model约定
    
    1. 表名约定
        默认表名：model名+s
        自定义：Model中指定table属性
        
    2. 主键约定
        默认主键：id
        自定义：Model中指定primaryKey属性
        
    3. 时间戳约定
        默认列(并自动更新)：created_at,updated_at
        取消：Model指定timestamps为false
        