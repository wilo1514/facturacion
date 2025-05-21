<?php
class Productos extends Controller
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
        $verificar = $this->model->verificarPermiso($id_usuario, 'productos');
        if (!empty($verificar)) {
            $data['presentaciones'] = $this->model->getPresentaciones();
            $data['categorias'] = $this->model->getCategorias();
            $this->views->getView($this, "index", $data);
        }
    }
    public function listar()
    {

        $data = $this->model->getProductos();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarPro(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarPro(' . $data[$i]['id'] . ');"><i class="fas fa-trash"></i></button>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarPro(' . $data[$i]['id'] . ');">Activar</button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        $ncomercial = $_POST['ncomercial'];
        $ngenerico = $_POST['ngenerico'];
        $laboratorio = $_POST['laboratorio'];
        $iva = $_POST['iva'];
        $presentacion = $_POST['presentacion'];
        $categoria = $_POST['categoria'];
        $precio_venta = $_POST['precio_venta'];
        if (empty($codigo) || empty($ncomercial) || empty($ngenerico) || empty($laboratorio)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id == "") {
                $data = $this->model->registrarProducto($codigo, $ncomercial, $ngenerico, $laboratorio, $precio_venta, $presentacion, $categoria, $iva);
                if ($data == "ok") {
                    $msg = "si";
                } elseif ($data == "existe") {
                    $msg = "El Producto ya existe";
                } else {
                    $msg = "error al registrar Producto";
                }
            } else {
                $data = $this->model->modificarProducto($codigo, $ncomercial, $ngenerico, $laboratorio, $precio_venta, $presentacion, $categoria, $iva, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "error al modificar el Producto";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editarPro($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionPro(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "error al eliminar el Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionPro(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "error al reingresar el Producto";
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

