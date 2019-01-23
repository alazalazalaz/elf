<?php

echo '<pre>';
var_dump($_POST);

echo '<br>';

var_dump(json_decode($_POST['sub_option'], TRUE));

echo '</pre>';