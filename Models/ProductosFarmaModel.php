<?php
class ProductosFarmaModel extends Query
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
}