<?php
require_once('Smarty.class.php');

$html = new Smarty();

$html->template_dir = './smarty/templates';
$html->compile_dir = './smarty/templates_c';
$html->config_dir = './smarty/configs';
$html->cache_dir = './smarty/cache';

$html->registerPlugin("modifier",'base64_encode',  'base64_encode');

$serv = "localhost";
$base = "gestion2";
$usu = "dwes";
$pas = "abc123.";
$emailAdmin = "admin@dominio.es";
$nombreUsuario;