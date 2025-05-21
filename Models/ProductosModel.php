<?php
class ProductosModel extends Query
{
    private $codigo, $ncomercial, $ngenerico, $laboratorio, $distribuidora, $precio_compra, $precio_venta, $id_presentacion, $id_categoria, $lote, $fecha_caducidad, $factura, $iva;
    public function __construct()
    {
        parent::__construct();
    }
    public function getPresentaciones()
    {
        $sql = "SELECT * FROM presentaciones WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProductos()
    {
        $sql = "SELECT p.*, pr.id AS id_presentacion, pr.nombre AS presentacion, c.id AS id_categoria, c.nombre AS categoria FROM productos p INNER JOIN presentaciones pr ON p.id_presentacion = pr.id INNER JOIN categorias c ON p.id_categoria = c.id ";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function registrarProducto(string $codigo, string $ncomercial, string $ngenerico, string $laboratorio, string $precio_venta, int $id_presentacion, int $id_categoria, string $iva)
    {
        $this->codigo = $codigo;
        $this->ncomercial = $ncomercial;
        $this->ngenerico = $ngenerico;
        $this->laboratorio = $laboratorio;
        $this->precio_venta = $precio_venta;
        $this->id_presentacion = $id_presentacion;
        $this->id_categoria = $id_categoria;
        $this->iva = $iva;
        $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO productos(codigo, ncomercial, ngenerico, laboratorio,precio_venta, id_presentacion, id_categoria, iva) VALUES (?,?,?,?,?,?,?,?)";
            $datos = array($this->codigo, $this->ncomercial, $this->ngenerico, $this->laboratorio, $this->precio_venta, $this->id_presentacion, $this->id_categoria, $this->iva);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function modificarProducto(string $codigo, string $ncomercial, string $ngenerico, string $laboratorio, string $precio_venta, int $id_presentacion, int $id_categoria, string $iva, int $id)
    {
        $this->codigo = $codigo;
        $this->ncomercial = $ncomercial;
        $this->ngenerico = $ngenerico;
        $this->laboratorio = $laboratorio;
        $this->precio_venta = $precio_venta;
        $this->id_presentacion = $id_presentacion;
        $this->id_categoria = $id_categoria;
        $this->iva = $iva;
        $this->id = $id;
        $sql = "UPDATE productos SET codigo = ?, ncomercial = ?, ngenerico = ?, laboratorio = ?, precio_venta = ?,id_presentacion = ?, id_categoria = ?, iva = ? WHERE id = ?";
        $datos = array($this->codigo, $this->ncomercial, $this->ngenerico, $this->laboratorio, $this->precio_venta, $this->id_presentacion, $this->id_categoria, $this->iva, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarPro(int $id)
    {
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionPro(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE productos SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->SAVE($sql, $datos);
        return $data;
    }
    public function verificarPermiso(int $id_usuario, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }

}