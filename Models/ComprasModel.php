<?php
class ComprasModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getProCod(string $codigo)
    {
        $sql = "SELECT * FROM productos WHERE codigo = '$codigo'";
        $data = $this->select($sql);
        return $data;
    }
    public function getProductos(int $id)
    {
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function registrarDetalle(string $codigo, int $id_producto, int $id_usuario, string $precio, int $cantidad, string $factura, string $lote, string $fecha_caducidad, string $distribuidora, string $subtotal)
    {
        $sql = "INSERT INTO detalle(codigo, id_producto, id_usuario, precio, cantidad, factura, lote, fecha_caducidad, distribuidora, subtotal) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $datos = array($codigo, $id_producto, $id_usuario, $precio, $cantidad, $factura, $lote, $fecha_caducidad, $distribuidora, $subtotal);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function registrarFecha(string $codigo, string $ngenerico, string $ncomercial, int $cantidad, int $id_compra, int $id_producto, string $fecha_caducidad)
    {
        $sql = "INSERT INTO caducados(codigo,ngenerico,ncomercial,cantidad, id_compra, id_producto, fecha_caducidad) VALUES (?,?,?,?,?,?,?)";
        $datos = array($codigo, $ngenerico, $ncomercial, $cantidad, $id_compra, $id_producto, $fecha_caducidad);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function getDetalle(int $id)
    {
        $sql = "SELECT  d.*, p.id AS id_pro, p.ngenerico, p.ncomercial, p.cantidad as cant FROM detalle d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function calcularCompra(int $id_usuario)
    {
        $sql = "SELECT  subtotal, SUM(subtotal) AS total FROM detalle WHERE id_usuario = $id_usuario ";
        $data = $this->select($sql);
        return $data;
    }
    public function deleteDetalle(int $id)
    {
        $sql = "DELETE  FROM detalle WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function transferirDetalle(string $codigo, int $id_producto, int $id_usuario, string $precio, int $cantidad, string $factura, string $lote, string $fecha_caducidad, string $distribuidora, int $id_compra, string $subtotal)
    {
        $sql = "INSERT INTO compra(codigo, id_producto, id_usuario, precio, cantidad, factura, lote, fecha_caducidad, distribuidora,id_compra,subtotal) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $datos = array($codigo, $id_producto, $id_usuario, $precio, $cantidad, $factura, $lote, $fecha_caducidad, $distribuidora, $id_compra, $subtotal);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function deleteCampos(int $id_usuario)
    {
        $sql = "DELETE  FROM detalle WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function sumarCant(int $cantidad, string $precio, int $id)
    {
        $this->id = $id;
        $this->cantidad = $cantidad;
        $this->precio_venta = $precio;
        $sql = "UPDATE productos SET cantidad = ?, precio_venta =? WHERE id = ?";
        $datos = array($this->cantidad, $this->precio_venta, $this->id);
        $data = $this->SAVE($sql, $datos);
        return $data;
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }
    public function getProCompra(int $id_compra)
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listacompras l  INNER JOIN compra c ON l.id = c.id_compra INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE l.id = $id_compra";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarCompra(int $total)
    {
        $sql = "INSERT INTO listacompras(total) VALUES (?)";
        $datos = array($total);
        $data = $this->save($sql, $datos);
    }
    public function id_compra()
    {
        $sql = "SELECT MAX(id) AS id FROM listacompras";
        $data = $this->select($sql);
        return $data;
    }
    public function setDescuento(string $desc, string $subtotal, int $id)
    {
        $sql = "UPDATE detalle SET descuento =?, subtotal = ? WHERE id =?";
        $datos = array($desc, $subtotal, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function verificarDescuento(int $id)
    {
        $sql = "SELECT * FROM detalle WHERE id =$id";
        $data = $this->select($sql);
        return $data;
    }
}