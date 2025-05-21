<?php
class Caducados extends Controller
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
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_usuario, 'caducados');
        if (!empty($verificar)) {
            $this->views->getView($this, "index");
        }
    }
    public function listar()
    {
        $data = $this->model->getCaducados();
        foreach ($data as $key => $item) {
            $dias = $this->model->getDias($item['id']);
            $data[$key]['dias'] = $dias['dias'];
            $data[$key]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="btnEliminarCaducado(' . $item['id'] . ');"><i class="fas fa-trash"></i></button>
            </div>';
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
        $data = $this->model->accionCad($id);
        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "error al eliminar categoria";
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

