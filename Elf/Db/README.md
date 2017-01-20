这篇readme主要介绍如何用框架的方法拼凑、执行、debug一条sql。


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
公用方法：
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

1、获取sql链式操作句柄

方法1
(任意地方调用均可)
use Elf\Db\Database;
$sql = Database::db('test')			//这个test表示的是database.php文件里面key为test的配置，配置里面决定了库名和表前缀

方法2
(只有在继承了Model的模型层才能调用)
use Elf\Model;
$sql = $this->db('test')			//这个test表示的是database.php文件里面key为test的配置，配置里面决定了库名和表前缀


2、链式操作的公用方法

->setPrefix()		//设置表前缀
->getPrefix()		//获取表前缀
->debug()			//(只用于调试)打印出执行的sql和参数，必须在之后调用execute()方法此方法才能生效
->getSql()			//(只用于调试)获取链式操作生成的sql
->getParam()		//(只用于调试)获取链式操作生成的param
->getType()			//(只用于调试)获取链式操作的sql类型
->execute()			//执行链式操作，每个链式操作必须调用，并且写在链式操作的最后。





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
chapter one
SELECT语句
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

函数：
select(...)						eg:->select('id, name') or ->select('id', ['name' => 'aliasName']) or ->select('c.id', 'c.name'...)
from($tableName)				eg:->from(biao1) or ->from(['biao1' => 'aliasTableName'])
where([])						使用方法详见下面chapter other1的介绍
order($string)					eg:->order('id, name')
group($string)					eg:->order('id, name')
having([])						同where
limit($limit, $index = '')		eg:->limit(10, 2) 从下标为2开始取10条数据，既第3条(含)开始，和原生sql的limit效果一样
limitPage($limit, $page)		eg:->limitPage(10, 2)取第2页的数据10条，也就是从下标为10*2开始，既第21条(含)开始
leftJoin($tablaName)			eg:->from(biao1) or ->from(['biao1' => 'aliasTableName'])
rightJoin($tablaName)			同上
innerJoin($tablaName) 			同上
join($tableName) 等价于 innerJoin
on([])							同where

返回值:
下面两个方法必须在execute()函数后调用,必须选择一个调用来控制返回值
all($string = '')				eg:->all('id') 返回查询的所有结果并以id作为key的关联数组，如果不传参则返回常规数组
one()							eg:->one()	返回查询的第一条数据，一维数组


栗子one-1
$result = Database::db('test')
					->debug()
					->select('c.id', ['c.name' => 'n'], ['c.population' => 'po'], 's.search')
					->from(['country' => 'c'])
					->leftJoin(['country_search' => 's'])->on(['c.id' => 's.id'])
					->where(['c.id <' => 35])
					->order('po')
					->execute()
					->all();

生成的sql:
SELECT c.id,c.name AS n,c.population AS po,s.search FROM pre_country AS c LEFT JOIN pre_country_search AS s ON c.id = s.id WHERE c.id < :c_id0 ORDER BY po

生成的param:
Array
(
    [0] => Array
        (
            [column] => :c_id0
            [value] => 35
        )

)






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
chapter two
INSERT语句
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

函数：
insert($tableName)				eg:->from(biao1) or ->from(['biao1' => 'aliasTableName'])
values([])						eg:->values(['name' => 'xxx', 'population' => 'xxx'.......]) 参数是个一维关联数组
onUpdate([])					同where

返回值：
最后插入的ID


栗子two-1
INSERT INTO pre_country (id,name,population) values (1, 'aaa', 2);

$result = Database::db('test')
					->insert('country')
					->values(['id' => 1, 'name' => 'aaa', 'population' => 2])
					->execute();
返回最后插入的id

栗子two-2
INSERT INTO pre_country (id,name,population) values (1, 'aaa', 2) ON DUPLICATE KEY UPDATE aaa='bbbc';

$result = Database::db('test')
					->insert('country')
					->values(['id' => 1, 'name' => 'aaa', 'population' => 2])
					->onUpdate(['name' => 'bbbc'])
					->execute();
返回最后插入的id

多条插入详见model的README.md中的saveAll()方法(Elf/Model/README.md)






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
chapter three
UPDATE语句
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

函数：
update($tableName)				eg:->from(biao1) or ->from(['biao1' => 'aliasTableName'])
set([]) 						eg:->values(['name' => 'xxx', 'population' => 'xxx'.......]) 参数是个一维关联数组
where([])
limit($limit)					eg:->limit(1)
updateAll($tableName)			因为框架中有判断调用update()函数时，必须加where()条件来防止更新全表，所以如果要更新全表可以使用updateAll()函数而不需要加where条件


返回值：
更新的条目数.
注意：如果被update语句执行成功，但是表中没有字段被修改，返回0

$result = self::db(static::$dbConfigName)
						->update(static::$tableName)
						->set($fieldsValues)
						->where($where)
						->execute();





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
chapter four
DELETE语句
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

函数：
delete()
from($tableName)
where([])
limit($limit)					eg:->limit(1)
deleteAll()						因为框架中有判断调用delete()函数时，必须加where()条件来防止删除全表，所以如果要删除全表可以使用deleteAll()函数而不需要加where条件

返回值：
被修改的条目数


栗子four-1
$result = Database::db('test')
					->debug()
					->delete()
					->from('country')
					->where(['id >' => 8])
					->limit(1)
					->execute();






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
chapter five
使用预处理后的sql语句，注意列名的label不能重复!(label是指:a、:b这些prepare后的列名标签)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

栗子five-1
$result = Database::db('test')
					->execute('select * from biao1 where id>:id', [':id' => '1'])
					->all();
栗子five-2
$result = Database::db('test')
					->execute('update pre_biao1 set name=:name where id>:id0 or id=:id1', [':name' => 'xxx', ':id0' => 1, ':id1' => 2]);






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
chapter six
使用原生sql语句
注意：不建议使用此方法，容易被sql注入
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


栗子six-1
$result = Database::db('test')
					->execute('select * from biao1 where id>1')
					->all();

栗子six-2
$result = Database::db('test')
					->execute('update pre_biao1 set name='xxx' where id> 1');






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
chapter other1
where()函数中参数的使用方法
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

以下情况被视为一个'因子'，
eg1: 	a=1
eg2:	b like 2
eg3:	c !=3
eg4:	d between 10 and 100
eg5:	e in 1,2,3
eg6:	(a=1 and b=2)			//有括号的可以把括号内的整体看做一个大因子，其中and就是这个大因子的连接符，同理or语句
eg7:	(a=1 or b=2)
eg8:	(a=1 or (b=2 and c=3))...依次可以无限递归嵌套下去。。。

填写因子时，直接用key value，如果该因子有OR链接，则为or =>[因子1，因子2]
如上面的因子转换如下：

eg1:
->where([
		'id' => 1
		])

eg2:
->where([
		'b like' => 2
		])

eg3:
->where([
		'c !=' => 3
		])

eg4:
->where([
		'd between ' => [10, 100]
		])

eg5:
->where([
		'e in' => [1, 2, 3]
		])

eg6:
->where([
	'and'=> [
		'a' => 1,
		'b' => 2
	]
])
或者省去and连接符
->where([
	[
		'a' => 1,
		'b' => 2
	]
])
还可以进一步省去最外面的中括号
->where([
	'a' => 1,
	'b' => 2
])

eg7:
'or'=> [
	'a'	=> 1,
	'b' => 2
]

eg8:
'or'=> [
	'a' => 1,
	'and' => [
		'b' => 2,
		'c' => 3
	]
]
或者省去and链接符
'or'=> [
	'a' => 1,
	[
		'b' => 2,
		'c' => 3
	]
]


栗子：
select * from biao1 where a=1 AND b=2 OR c=3;			//这类语句的where条件有歧义，必须指定小括号的位置
歧义1:select * from biao1 where (a=1 AND b=2) OR c=3; 	//(a=1 AND b=2)被当做一个大因子，写大因子时，先写大因子的连接符，再写里面的小因子

->where(
	[
		'or'	=> [
			'c' => 3,
			'and' => ['a' => 1, 'b' => 2]
		]
	]
);
或者省略掉and连接符(or的连接符不能省略)
->where(
	[
		'or'	=> [
			'c' => 3,
			['a' => 1, 'b' => 2]
		]
	]
);
歧义2同理：select * from biao1 where a=1 AND (b=2 OR c=3); //(b=2 OR c=3)被当做一个大因子



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
书写where的常规方法：
1、准备好需要写的sql语句。
	比如 select * from biao1 where (a=1 AND b=2) OR c=3;

2、看where条件中是否有大因子
	比如 select * from biao1 where (a=1 AND b=2) OR c=3;的最大因子是((a=1 AND b=2) OR c=3) 链接符是OR

3、如果有大因子，先写大因子的连接符，再写大因子里面的小因子，重复步骤2
4、如果没有，则直接书写key => value
5、因子连接符为and的，可以直接省略掉。
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

where最终版：
eg2-1:
->where([
		'a like' => '%333%%',
		'b between'=> [10,100],
		'c ' => 4,
		'd <=' => 'adsfasdfasdfasdfasdfsdf'
	]);

sql:
a like :a AND b between :b_start and :b_end AND c  = :c  AND d <= :d

param:
array (size=5)
  0 => 
    array (size=2)
      'column' => string ':a' (length=2)
      'value' => string '%333%%' (length=6)
  1 => 
    array (size=2)
      'column' => string ':b_start' (length=8)
      'value' => int 10
  2 => 
    array (size=2)
      'column' => string ':b_end' (length=6)
      'value' => int 100
  3 => 
    array (size=2)
      'column' => string ':c ' (length=3)
      'value' => int 4
  4 => 
    array (size=2)
      'column' => string ':d' (length=2)
      'value' => string 'adsfasdfasdfasdfasdfsdf' (length=23)




eg2-2:
->where([
		'a' => 2343,
		'b' => 33
	]);

sql:
a = :a AND b = :b

param:
array (size=2)
  0 => 
    array (size=2)
      'column' => string ':a' (length=2)
      'value' => int 2343
  1 => 
    array (size=2)
      'column' => string ':b' (length=2)
      'value' => int 33




eg2-3:
->where([
		'a' => 2343,
		'or'=> [
			'b' => 3,
			'c' => 3
		]
	]);

sql:
a = :a AND (b = :b OR c = :c)

param:
array (size=3)
  0 => 
    array (size=2)
      'column' => string ':a' (length=2)
      'value' => int 2343
  1 => 
    array (size=2)
      'column' => string ':b' (length=2)
      'value' => int 3
  2 => 
    array (size=2)
      'column' => string ':c' (length=2)
      'value' => int 3




eg2-4:
->where([
		'or' => [
			'and' => [
				'a' => 234,
				'b' => 3
			],
			'c' => 3
		]
	]);
或者省去and连接符
->where([
		'or' => [
			[
				'a' => 234,
				'b' => 3
			],
			'c' => 3
		]
	]);


sql:
((a = :a AND b = :b) OR c = :c)

param:
array (size=3)
  0 => 
    array (size=2)
      'column' => string ':a' (length=2)
      'value' => int 234
  1 => 
    array (size=2)
      'column' => string ':b' (length=2)
      'value' => int 3
  2 => 
    array (size=2)
      'column' => string ':c' (length=2)
      'value' => int 3

或者用这种方式(这种方式需要开发者确定label(label是指:a、:b这些prepare后的列名标签)不能重复)：
->where('(a=:a and b=:b) or c=:c')
->bindValue([':a' => 234, ':b' => 3, ':c' => 3]);

sql:
((a = :a AND b = :b) OR c = :c)

param:
array (size=2)
  0 => 
    array (size=2)
      'column' => string ':a' (length=2)
      'value' => int 234
  1 => 
    array (size=2)
      'column' => string ':b' (length=2)
      'value' => int 3
  2 => 
    array (size=2)
      'column' => string ':c' (length=2)
      'value' => int 3


