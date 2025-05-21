<?php
class ListaComprasAdmin extends Controller
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
        $verificar = $this->model->verificarPermiso($id_usuario, 'lista_compras_admin');
        if (!empty($verificar)) {
            $this->views->getView($this, "index");
        }
    }
    public function listar()
    {

        $data = $this->model->getCompras();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div> 
            <button class="btn btn-warning" onclick="btnAnularC(' . $data[$i]['id'] . ')"><i class="fas fa-ban"></i></button>
            <button class="btn btn-danger" onclick="btnPdfCompra(' . $data[$i]['id_compra'] . ')"><i class="fas fa-file"></i></button>
            <div/>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function anular($id)
    {
        $id_compra = $this->model->id_compra($id);
        $cant = $this->model->canItem($id_compra['idcompra']);
        $numero_items = count($cant);
        $cantact = $this->model->canProd($id_compra['prod']);
        $cantreg = $cantact['cantact'] - $id_compra['cant'];
        if ($numero_items <= 1) {
            $this->model->eliminarLista($id_compra['idcompra']);
        }
        $this->model->restarCant($cantreg, $id_compra['prod']);
        $data = $this->model->anularC($id);
        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "error al eliminar caja";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}