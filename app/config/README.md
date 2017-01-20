
config文件夹下面会存在几个配置文件
1、bootstrap.php
2、classMap.php
3、database.php






classMap.php的使用方法：

如果有一些公用的方法或者lib，比如和业务相关的upload, zip, image库等等，需要放在app/lib目录中。
拿新建了一个zip库来举例：

zip.php文件中有使用命名空间的情况：
	情况1：
	zip.php文件内容：
		namespace app\lib;
		class zip
		{
			
		}
	XX控制器中调用zip类：
		namespace app\controller\xx;
		use app\lib\zip;

		new zip();
	classMap.php文件中添加如下内容能让控制器成功调用zip库：
		return [
			//命名空间类 		//该文件的目录
			'app\lib\zip'	=> APP_PATH . 'lib\zip.php'
		];
		！！！或者不添加！！！，也能成功调用，因为zip.php中的命名空间和zip.php的文件目录结构一致，框架会自动实现查找文件，原因详见Elf/autoload/README.md

	情况2：
		zip.php文件内容：
		namespace app\baba\ccc\ttt;
		class zip
		{
			
		}
	XX控制器中调用zip类：
		namespace app\controller\xx;
		use app\baba\ccc\ttt;

		new zip();
	classMap.php文件中！！！必须！！！添加如下才能让控制器成功调用zip库：
		return [
			'app\baba\ccc\ttt\zip'	=> APP_PATH . 'lib\zip.php'
		];
		因为zip.php中的命名空间和zip.php文件目录结构不一致。必须通过classMap来指定加载该文件。

zip.php文件中没有使用命名空间的情况：
		情况3：
		zip.php文件内容：
		class zip
		{
			
		}
	XX控制器中调用zip类：
		namespace app\controller\xx;

		new \zip();		//加个反斜杠表示从\命名空间找该类，因为zip.php没有使用命名空间，zip类不属于任何命名空间，属于\命名空间
	classMap.php文件中！！！必须！！！添加如下才能让控制器成功调用zip库：
		return [
			//命名空间类 		//该文件的目录
			'zip'	=> APP_PATH . 'lib\zip.php'
		];

总结：
1、建议使用情况1并且在classMap.php文件中添加命名空间和文件路径的对应关系。
