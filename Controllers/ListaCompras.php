<?php
class ListaCompras extends Controller
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

        $id_usuario = $_SESSION['id_usuario'];
        $data = $this->model->getCompras($id_usuario);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div> 
            <button class="btn btn-danger" onclick="btnPdfCompra(' . $data[$i]['id_compra'] . ')"><i class="fas fa-file"></i></button>
            <div/>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}