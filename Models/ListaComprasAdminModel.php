<?php
class ListaComprasAdminModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getCompras()
    {
        $sql = "SELECT  d.*, p.id AS id_pro, p.ngenerico, p.ncomercial, u.id AS id_usuario, u.usuario FROM compra d INNER JOIN productos p ON d.id_producto = p.id INNER JOIN usuarios u ON u.id = d.id_usuario";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function id_compra(int $id)
    {
        $sql = "SELECT id_compra AS idcompra, cantidad AS cant, id_producto AS prod FROM compra WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function canProd(int $id)
    {
        $sql = "SELECT cantidad AS cantact FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function canItem(int $item)
    {
        $sql = "SELECT id FROM compra WHERE id_compra = $item";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function eliminarLista(int $item)
    {
        $sql = "DELETE FROM listacompras WHERE id = ?";
        $datos = array($item);
        $data = $this->save($sql, $datos);
        return $data;
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
    public function anularC(int $id)
    {
        $sql = "DELETE  FROM compra WHERE id = ?";
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