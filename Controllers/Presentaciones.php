<?php
class Presentaciones extends Controller
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
        $this->views->getView($this, "index");
    }
    public function listar()
    {

        $data = $this->model->getPresentaciones();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarPre(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarPre(' . $data[$i]['id'] . ');"><i class="fas fa-trash"></i></button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarPre(' . $data[$i]['id'] . ');">Activar</button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $nombre = $_POST['nombre'];
        $id = $_POST['id'];
        if (empty($nombre)) {
            $msg = "El nombre es obigatorio";
        } else {
            if ($id == "") {
                $data = $this->model->registrarPresentacion($nombre);
                if ($data == "ok") {
                    $msg = "si";
                } elseif ($data == "existe") {
                    $msg = "La presentación ya existe";
                } else {
                    $msg = "error al registrar presentación";
                }
            } else {
                $data = $this->model->modificarPresentacion($nombre, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "error al modificar el presentación";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editarPre($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionPre(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "error al eliminar el presentación";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionPre(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "error al reingresar el presentación";
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

