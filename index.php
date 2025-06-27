<?php
define('BASEPATH', true);
require_once __DIR__.'/Config/Config.php';
require_once __DIR__.'/Config/App/autoload.php';

/* ---- Router muy simple ---- */
$ruta   = $_GET['url'] ?? 'Home/index';
$parts  = explode('/', trim($ruta, '/'));

$ctrl   = ucfirst($parts[0] ?: 'Home');
$method = $parts[1]     ?? 'index';
$params = implode(',', array_slice($parts, 2)); // compat. con tu código viejo

$file = __DIR__."/Controllers/{$ctrl}.php";
if (!is_file($file)) {
    http_response_code(404); exit("Controlador $ctrl no existe");
}
require_once $file;

$obj = new $ctrl();
if (!method_exists($obj, $method)) {
    http_response_code(404); exit("Método $method no existe");
}
call_user_func([$obj, $method], $params);
