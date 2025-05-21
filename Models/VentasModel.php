<?php
class VentasModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getClientes()
    {
        $sql = "SELECT * FROM clientes WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getMedicos()
    {
        $sql = "SELECT * FROM medicos WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getProCod(string $codigo)
    {
        $sql = "SELECT * FROM productos WHERE codigo = '$codigo'";
        $data = $this->select($sql);
        return $data;
    }
    public function getProCodNom(string $ncomercial)
    {
        $sql = "SELECT * FROM productos WHERE ncomercial = '$ncomercial'";
        $data = $this->select($sql);
        return $data;
    }
    public function buscarProductoAutocompletar($term)
    {
        $sql = "SELECT ncomercial,ngenerico FROM productos WHERE ncomercial LIKE '%$term%' OR ngenerico LIKE '%$term%'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProductosNombre()
    {
        $sql = "SELECT * FROM productos";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProductos(int $id)
    {
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function registrarDetalle(string $codigo, int $id_producto, int $id_usuario, string $precio, int $cantidad, string $subtotal)
    {
        $sql = "INSERT INTO detven (codigo, id_producto, id_usuario, precio, cantidad, subtotal) VALUES (?,?,?,?,?,?)";
        $datos = array($codigo, $id_producto, $id_usuario, $precio, $cantidad, $subtotal);
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
        $sql = "SELECT  d.*, p.id AS id_pro, p.ngenerico, p.ncomercial, p.cantidad as cant FROM detven d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function calcularVenta(int $id_usuario)
    {
        $sql = "SELECT  subtotal, SUM(subtotal) AS total FROM detven WHERE id_usuario = $id_usuario ";
        $data = $this->select($sql);
        return $data;
    }
    public function deleteDetalle(int $id)
    {
        $sql = "DELETE  FROM detven WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function transferirDetalle(string $codigo, int $id_producto, int $id_usuario, string $precio, int $cantidad, string $descuento, string $subtotal, int $id_venta)
    {
        $sql = "INSERT INTO venta(codigo, id_producto, id_usuario, precio, cantidad,descuento,subtotal,id_venta) VALUES (?,?,?,?,?,?,?,?)";
        $datos = array($codigo, $id_producto, $id_usuario, $precio, $cantidad, $descuento, $subtotal, $id_venta);
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
        $sql = "DELETE  FROM detven WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function restarCant(int $cantidad, int $id)
    {
        $this->id = $id;
        $this->cantidad = $cantidad;
        $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
        $datos = array($this->cantidad, $this->id);
        $data = $this->SAVE($sql, $datos);
        return $data;
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }
    public function getProVenta(int $id_venta, int $id_usuario)
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario, q.id, q.dni, q.nombre, q.telefono, q.direccion, m.id, m.nombre AS mnombre FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario INNER JOIN clientes q ON q.id = l.id_cliente INNER JOIN medicos m ON m.id = l.medico WHERE l.id = $id_venta AND c.id_usuario = $id_usuario";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProVentaAd(int $id_venta)
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario, q.id, q.dni, q.nombre, q.telefono, q.direccion, m.id, m.nombre AS mnombre FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario INNER JOIN clientes q ON q.id = l.id_cliente INNER JOIN medicos m ON m.id = l.medico WHERE l.id = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarVenta(int $id_cliente, string $total, int $medico, string $observacion, string $seguro, string $tarjeta)
    {
        $sql = "INSERT INTO listaventas(id_cliente,total,medico,observacion,seguro,tarjeta) VALUES (?,?,?,?,?,?)";
        $datos = array($id_cliente, $total, $medico, $observacion, $seguro, $tarjeta);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function id_venta()
    {
        $sql = "SELECT MAX(id) AS id FROM listaventas";
        $data = $this->select($sql);
        return $data;
    }
    public function setDescuento(string $desc, string $subtotal, int $id)
    {
        $sql = "UPDATE detven SET descuento =?, subtotal = ? WHERE id =?";
        $datos = array($desc, $subtotal, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function verificarDescuento(int $id)
    {
        $sql = "SELECT * FROM detven WHERE id =$id";
        $data = $this->select($sql);
        return $data;
    }
}