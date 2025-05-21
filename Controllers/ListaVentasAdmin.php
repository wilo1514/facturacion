<?php
class ListaVentasAdmin extends Controller
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
        $verificar = $this->model->verificarPermiso($id_usuario, 'lista_ventas_admin');
        if (!empty($verificar)) {
            $this->views->getView($this, "index");
        }
    }
    public function listar()
    {
        $data = $this->model->getVentas();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div> 
            <button class="btn btn-warning" onclick="btnAnularV(' . $data[$i]['id'] . ')"><i class="fas fa-ban"></i></button>
            <button class="btn btn-danger" onclick="btnPdfVentaAd(' . $data[$i]['id_venta'] . ')"><i class="fas fa-file"></i></button>
            <div/>';

        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function anular($id)
    {
        $id_venta = $this->model->id_venta($id);
        $cant = $this->model->canItem($id_venta['idventa']);
        $numero_items = count($cant);
        $cantact = $this->model->canProd($id_venta['prod']);
        $cantreg = $cantact['cantact'] + $id_venta['cant'];
        if ($numero_items <= 1) {
            $this->model->eliminarLista($id_venta['idventa']);
        }
        $this->model->sumarCant($cantreg, $id_venta['prod']);
        $data = $this->model->anularV($id);
        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "error al eliminar caja";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


}