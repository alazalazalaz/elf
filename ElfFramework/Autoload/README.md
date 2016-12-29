


自动加载类，加载流程如下：
1、确定classMap的内容。classMap内容来源有两个地方，
	第一是系统Elfframework/Autoload/AutoloadClassMap.php这个文件的内容(这个文件包含了框架的民命空间和文件路径的对应关系)
	第二是项目的app/config/classMap.php(子域名为subDomain/config/classMap.php)，这个文件内容需要程序员手动添加，比如新增了一个zip的lib，添加内容为 'app/lib/zip' =>APP_PATH . 'lib/zip.php'。
2、自动加载类根据传入的namespaceClassName去classMap里面匹配，如果有，则加载对应的文件。
3、如果没有，则拼凑一个文件路径(filepath= ROOT_PATH . $namespaceClassName)，判断该文件是否存在，如果有，则加载。
4、如果没有，则返回空，如果此时系统有注册其他的自动加载方法比如smatry会注册一个自动加载方法，则会去执行其他的自动加载方法。
5、如果没有，则报错。