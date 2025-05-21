<?php
class Administracion extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("Location: " . base_url);
        }
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['clientes'] = $this->model->getDatos('clientes');
        $data['productos'] = $this->model->getDatos('productos');
        $this->views->getView($this, "index", $data);
    }

    public function validar()
    {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "los campos estan vacios";
        } else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;
                $msg = "ok";
            } else {
                $msg = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }
}

