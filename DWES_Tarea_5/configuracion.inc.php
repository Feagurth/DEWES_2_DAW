<?php
require_once('Smarty.class.php');

$html = new smarty;

$html->template_dir = './smarty/templates';
$html->compile_dir = './smarty/templates_c';
$html->config_dir = './smarty/configs';
$html->cache_dir = './smarty/cache';

$serv = "localhost";
$base = "gestion";
$usu = "dwes";
$pas = "abc123.";

