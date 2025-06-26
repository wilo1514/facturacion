<?php
/*******************************
 *  FRONT-CONTROLLER PERSONAL  *
 *******************************/

define('BASEPATH', true);               // para que otros archivos lo detecten
require_once __DIR__ . '/Config/Config.php';
require_once __DIR__ . '/Config/App/autoload.php';

/*-------------------------------
| 1) Resolver URL → C/M/Params |
--------------------------------*/
$ruta       = !empty($_GET['url']) ? $_GET['url'] : 'Home/index';
$segmentos  = explode('/', trim($ruta, '/'));

$controller = ucfirst($segmentos[0]);   // «Home»
$metodo     = $segmentos[1] ?? 'index'; // «index»
$parametros = array_slice($segmentos, 2);

/*-------------------------------
| 2) Cargar controlador        |
--------------------------------*/
$archivo = __DIR__ . "/Controllers/{$controller}.php";

if (!file_exists($archivo)) {
    http_response_code(404);
    exit("Controlador <strong>{$controller}</strong> no encontrado");
}

require_once $archivo;
$instance = new $controller();

/*-------------------------------
| 3) Invocar método            |
--------------------------------*/
if (!method_exists($instance, $metodo)) {
    http_response_code(404);
    exit("Método <strong>{$metodo}</strong> no encontrado en {$controller}");
}

call_user_func_array([$instance, $metodo], $parametros);
