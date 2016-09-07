<?php
namespace ElfFramework\View;

interface ViewInterface{

	public function set($key, $value);

	public function view($file);
}