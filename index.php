<?php
// FRONT CONTROLLER
// Общие настройки
// Путь до папки с шаблонами
ini_set('display_errors',1);
error_reporting(E_ALL);
if (version_compare(phpversion(), '7.0.0', '<') == true) { die ('Версия PHP ниже 7.0'); }
session_start();
define('ROOT', dirname(__FILE__));
// Подключение файлов системы
require_once(ROOT.'/components/Autoload.php');
// Вызов Router
$router = new Router();
$router->run();