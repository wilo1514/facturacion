<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("Location:" . base_url);
        }
        parent::__construct();
    }
    public function index()
    {

        $data['cajas'] = $this->model->getCajas();
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_usuario, 'usuarios');
        if (!empty($verificar)) {
            $this->views->getView($this, "index", $data);
        }
    }
    public function listar()
    {

        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-dark" href="' . base_url . 'Usuarios/permisos/' . $data[$i]['id'] . '"><i class="fas fa-key"></i></a>
                <button class="btn btn-primary" type="button" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarUser(' . $data[$i]['id'] . ');"><i class="fas fa-trash"></i></button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarUser(' . $data[$i]['id'] . ');">Activar</button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function nombre()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $data = $this->model->getNombre($id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function registrar()
    {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $caja = $_POST['caja'];
        $id = $_POST['id'];
        $hash = hash("SHA256", $clave);
        if (empty($usuario) || empty($nombre) || empty($caja)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id == "") {
                if ($clave != $confirmar) {
                    $msg = 'las contraseñas no coinciden';
                } else {
                    $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $caja);
                    if ($data == "ok") {
                        $msg = "si";
                    } elseif ($data == "existe") {
                        $msg = "El usuario ya existe";
                    } else {
                        $msg = "error al registrar usuario";
                    }
                }
            } else {
                $data = $this->model->modificarUsuario($usuario, $nombre, $caja, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "error al modificar el usuario";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionUser(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "error al eliminar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "error al reingresar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function permisos($id)
    {
        if (empty($_SESSION['activo'])) {
            header("Location:" . base_url);
        }
        $data['datos'] = $this->model->getPermisos();
        $permisos = $this->model->getDetallePermisos($id);
        $data['asignados'] = array();
        foreach ($permisos as $permiso) {
            $data['asignados'][$permiso['id_permiso']] = true;
        }
        $data['id_usuario'] = $id;
        $this->views->getView($this, "permisos", $data);
    }
    public function registrarPermiso()
    {
        $id_usuario = $_POST['id_usuario'];
        $eliminar = $this->model->eliminarPermisos($id_usuario);
        $msg = '';
        if ($eliminar == "ok") {
            foreach ($_POST['permisos'] as $id_permiso) {
                $msg = $this->model->registrarPermisos($id_usuario, $id_permiso);
            }
            if ($msg == "ok") {
                $msg = "ok";
            } else {
                $msg = "error al registrar permisos";
            }
        } else {
            $msg = "error al eliminar permisos anteriores";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }
    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }

}

