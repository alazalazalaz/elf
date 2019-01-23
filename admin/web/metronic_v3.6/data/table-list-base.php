<?php
sleep(1);
if ($_POST['page']  > 5) {
	$result = [
		'status'	=> 200,
		'msg'		=> 'dd',
		'data'		=> [
			'list'	=> []
		]
	];
	echo json_encode($result);exit;
}
$result = [
	'status'	=> 200,
	'msg'		=> 'lalala',
	'data'		=> [
		'total_page'	=> 20,
		'list'	=> [
			[
				'id'	=> 1,
				'name'	=> getSfOpt('label')->html(),
				'age'	=> 18,
				'icon'	=> getSfOpt('img')->url('../../img/gun.png')->width('200px')->height('200px')->html(),
				'sex'	=> '男',
				'opt'	=> [
					getSfOpt('edit')->url('http://www.baidu.com')->html(), 
					getSfOpt('del')->url('../../data/ajax_del.data')->html(), 
					getSfOpt('string')->value('sdfsdf')->html()
					]
				
				],
			[
				'id'	=> 2,
				'name'	=> 'peter',
				'age'	=> 18,
				'icon'	=> [
					'type'	=> 'img',
					'url'	=> '../../img/btn.png',
					'width'	=> '100px',
					'height'=> '100px'
				],
				'sex'	=> '男',
				'opt'	=> getSfOpt('del')->url('../../data/ajax_del.data')->html()
			],
			[
				'id'	=> 3,
				'name'	=> 'judy',
				'age'	=> 18,
				'icon'	=> [
					'type'	=> 'img',
					'url'	=> '../../img/sm.jpeg',
					'width'	=> '100px',
					'height'=> '100px'
				],
				'sex'	=> '女',
				'opt'	=> [

				]
			],
		]
	]

];

echo json_encode($result);



//some func

/**
* table list的opt操作
*/
class SfOpt
{
	private $opts = ['btn', 'edit', 'del', 'img', 'string', 'label'];
	public $result = [];

	public function __construct($type){
		if (!in_array($type, $this->opts)) {
			return FALSE;
		}

		$publicAttr = [
			'type'	=> $type,
		];

		switch ($type) {
			case 'btn':
				$data = [
					'value'	=> '普通按钮',
					'icon'	=> 'fa-edit',
					'class' => '',
					'target'=> '_blank',
					'url'	=> '#'
				];
				break;

			case 'edit':
				$data = [
					'value'	=> '编辑',
					'icon'	=> 'fa-edit',
					'class' => 'yellow',
					'target'=> '_blank',
					'url'	=> '#'
				];
				break;

			case 'del':
				$data = [
					'value'	=> '删除',
					'icon'	=> 'fa-trash',
					'class' => 'red',
					'target'=> '_blank',
					'url'	=> '#',
					'submit'=> 'ajax',
					'confirm'	=> '确定删除4？',
				];
				break;

			case 'string':
				$data = [
					'value'	=> 'default string value',
					'class' => ''
				];
				break;

			case 'label':
				$data = [
					'value'	=> 'default label value',
					'class' => 'label-success'
				];
				break;

			case 'img':
				$data = [
					'url' 	=> '#',
					'width'	=> '100px',
					'height'=> '100px'
				];
				break;
		}

		$this->value = array_merge($data, $publicAttr);
	}

	public function html(){
		return $this->value;
	}

	public function value($value){
		$this->value['value'] = $value;
		return $this;
	}

	public function url($url){
		$this->value['url']	= $url;
		return $this;
	}

	public function css($class){
		$this->value['class'] = $class;
		return $this;
	}

	public function icon($icon){
		$this->value['icon'] = $icon;
		return $this;
	}

	public function width($width){
		$this->value['width'] = $width;
		return $this;
	}

	public function height($height){
		$this->value['height'] = $height;
		return $this;
	}

	public function target($target){
		$this->value['target'] = $target;
		return $this;
	}



}

function getSfOpt($type = 'btn'){
	return new SfOpt($type);
}



