file:
	Model.php				模型层，所有模型都应该继承该类
	CoreModel.php			模型层核心类

variable:
	适用类：
	Model
	CoreModel

	/**
	 * 数据库配置名称(可以在模型中复写这个变量)
	 * @var string
	 */
	public static $dbConfigName 	= 'default';
	
	/**
	 * 数据库表名前缀(可以在模型中复写这个变量)
	 */
	public static $tablePrefix 		= '';

	/**
	 * 数据库表名(必须在模型中复写这个变量，并且指定值)
	 * @var string
	 */
	public static $tableName 		= '';
	
	/**
	 * 该表的主键(可以在模型中复写这个变量)
	 * @var string
	 */
	public static $pk 				= 'id';

function:
	适用类：
	Model
	CoreModel

	方法：
	use ElfFramework\Model\Model;

	Model::factory($param1, $param2, $param3...);
	作用：
	1、创建一个模型对象(内部是单例实现的)


	Model::findOne($field, $where);
	作用：
	1、根据$where条件查询出一条sql记录
	2、返回包含$field字段的一维数组

	Model::find($field, $where);
	作用：
	1、根据$where条件查询出多条sql记录
	2、返回包含$field字段二维数组

	Model::deleteByPk($id);
	作用：
	1、根据$id删除一条sql记录，$id对应的column名为Model的静态变量$pk($pk默认为id，可以在模型中定义public static $pk = 'xxx'来覆盖)
	2、返回受影响的条目数，如果删除一条不存在的记录，返回0

	Model::delete($where);
	作用：
	1、根据$where条件删除sql记录
	2、返回受影响的条目数，如果删除一条不存在的记录，返回0

	Model::updateByPk($id, $fieldsValue);
	作用：
	1、根据$id修改一条sql记录，修改的字段为$fieldsValue，$id对应的column名为Model的静态变量$pk($pk默认为id，可以在模型中定义public static $pk = 'xxx'来覆盖)
	2、返回受影响的条目数，如果没有记录被修改，返回0

	Model::update($fieldsValue, $where);
	作用：
	1、根据$where条件修改sql记录，修改的字段为$fieldsValue
	2、返回受影响的条目数，如果没有记录被修改，返回0

	/**
	 * 插入一条sql语句，$insertValue为一维数组
	 * @param  一维数组  $fieldsValues eg: $fieldsValues = ['name' => 'xxx', 'pw' => 'xxx'];
	 * @return int       返回最后插入的ID
	 */
	public static function save(array $fieldsValues)


	/**
	 * 同时插入多条数据(这个方法真他么丑)
	 * @param  二维数组 	$multiFieldsValues 
	 * eg:
	 * $multiFieldsValues = [
			['code' => 111, 'name' => 'hi', 'population' => 1],
			['code' => 333, 'name' => 'world', 'population' => 3]
		];
	 *
	 * @return 一维数组 	返回最后插入的ID    
	 */
	public static function saveAll(array $multiFieldsValues)


	Model::count($where);
	作用：
	1、根据$where条件返回对应的sql条目数






这是一个栗子：

$id    = 13;
$field = 'id,name';
$where = ['id >'=> 6];
$fieldsValue = ['name'=>666666, 'population' => 888888];
$insertValue = ['code'=>222, 'name' => 'xiaozhang', 'population' => 100];
$insertValueMulti = [
	['code' => 111, 'name' => 'hi', 'population' => 1],
	['code' => 222, 'name' => 'hello', 'population' => 2],
	['code' => 333, 'name' => 'world', 'population' => 3]
];


$result = Model::factory();
$result = Model::findOne($field, $where);
$result = Model::find($field, $where);
$result = Model::deleteByPk($id);
$result = Model::delete($where);
$result = Model::updateByPk($id, $fieldsValue);
$result = Model::update($fieldsValue, $where);
$result = Model::save($insertValue);
$result = Model::saveAll($insertValueMulti);
$result = Model::count($where);


下面这两个效果相同的栗子可以在任何地方调用：
use ElfFramework\Db\Database;
$result = Database::db('test')
					->select('*')
					->from('country')
					->where(['id >=' => 35])
					->execute()
					->all('id');
$result = Database::db('test')
					->execute('select * from pre_country where id >= :id', [':id' => 35])
					->all('id');
