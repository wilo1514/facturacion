<?php
class CaducadosModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getCaducados()
    {
        $sql = "SELECT c.*, v.id_producto, v.distribuidora, v.id_compra, v.factura  FROM caducados c INNER JOIN compra v ON v.id_compra = c.id_compra AND v.id_producto = c.id_producto WHERE DATEDIFF(c.fecha_caducidad, CURDATE()) <= 150";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDias($id)
    {
        $this->id = $id;
        $sql = "SELECT DATEDIFF(fecha_caducidad, fecha_actual) AS dias FROM caducados WHERE id = '$this->id'";
        $data = $this->select($sql);
        return $data;
    }
    public function accionCad(int $id)
    {
        $sql = "DELETE  FROM caducados WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function verificarPermiso(int $id_usuario, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }

}