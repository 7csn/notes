## 07 blade模板
1. 数据传递

    数据以数组形式作为第二参数传入view(); 
2. 普通变量

    {{$var}}
3. if/else
    ```html
    @if (表达式)
    ...
    @elseif (表达式)
    ...
    @else
    ...
    @endif
    ```
4. unless(除非，和if相反)
    ```html
    @unless (表达式)
    ...
    @endunless
    ```
5. for循环
    ```html
    @for ($i=0; $i<$n; $i++)
    ...
    @endfor
    ```
6. foreach循环
    ```html
    @foreach ($arr as $k => $v)
    ...
    @endforeach
    ```
7. forelse(循环是否为空)
    ```html
    @forelse ($arr as $u)
    ...
    @empty
    ...
    @endforelse
    ```
8. 模板包含
    ```html
    @include(新模板);   
    ```
9. 模板继承
    
    父模板(parent)：
    ```html
    不变内容
    @section('change')
    change内容，change是标记
    @show
    不变内容
    ```
    
    子模板：
    ```html
    @extends('parent');
    @section('change')
    子模板自写方法，可以在这里调用父类方法：@parent
    @endsection
    ```
10. 避免防XSS实体转义
    
    模板自动防XSS攻击，如果不需要实体转义，可以：  
    ```html
    {{$var}} --> {{!!$var!!}} 
    ```
11. 不解析标签
    
    如果想输出{{$var}}，可以前置@，该变量即不会被解析  
    ```html
    {{$var}} --> @{{$var}}
    ```