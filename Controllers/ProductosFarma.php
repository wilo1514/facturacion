<?php
class ProductosFarma extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("Location:" . base_url);
        }
        $data['presentaciones'] = $this->model->getPresentaciones();
        $data['categorias'] = $this->model->getCategorias();
        $this->views->getView($this, "index", $data);
    }
    public function listar()
    {

        $data = $this->model->getProductos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }
}

