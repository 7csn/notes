# 08 map
- 类似其他语言中的哈希表或字典，以key-value形式存储数据
- key必须是支持==或!=比较运算的类型，不可以是函数、map或slice
- map查找比线性搜索快很多，但比使用索引访问数据的类型慢100倍
- map使用make()创建，支持:=简写方式  
&nbsp;
- make([keyType]valueType, cap)，cap表示容量，可省
- 超出容量自动扩容，尽量提供一个合理初始值
- 使用len()获取元素个数  
&nbsp;
- 键值对不存在时添加，使用delete(map, index)删除某键值对
- 使用for range 对map和slice进行迭代操作

例

    var m1 map[int]string = make(map[int]string)
    m2 := make(map[int]string)
    m3 := map[int]string{"a":1,"b":2}
      
    for i,v := range slice{}
    for i,v := range map{}
    for i := range map{}
    for _,v := range map{}

map是无序的，排序：sort.Ints(map的键切片整型)