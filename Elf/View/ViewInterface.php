<?php
namespace Elf\View;

interface ViewInterface{

	public function set($key, $value);

	public function view($file);

	public function setTemplateDir($path);
}