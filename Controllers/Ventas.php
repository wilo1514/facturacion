<?php
class Ventas extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['cliente'] = $this->model->getClientes();
        $data['medico'] = $this->model->getMedicos();
        $this->views->getView($this, "index", $data);
    }
    public function buscarCodigoNombreAutocompletar()
    {
        $term = $_GET['term'];
        $data = $this->model->buscarProductoAutocompletar($term);
        echo json_encode($data);
        die();
    }
    public function buscarCodigo()
    {
        $cod = urldecode($_POST['cod']);
        $data = $this->model->getProCod($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscarCodigoNombre()
    {
        $nom = urldecode($_POST['nom']); // Decodificar el parámetro recibido
        $data = $this->model->getProCodNom($nom);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresar()
    {
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $cant = $datos['cantidad'];
        $codigo = $datos['codigo'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $subtotal = $precio * $cantidad;
        if ($cant >= $cantidad) {
            $data = $this->model->registrarDetalle($codigo, $id_producto, $id_usuario, $precio, $cantidad, $subtotal);
        } else {
            $data = "no";
        }
        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "Error al registrar producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalle($id_usuario);
        $data['total_pagar'] = $this->model->calcularVenta($id_usuario);
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => "Error al obtener los detalles"], JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function delete($id)
    {
        $data = $this->model->deleteDetalle($id);
        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "error al eliminar detalle";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function transferenciavent()
    {
        $id_cliente = $_POST['id_cliente'];
        $medico = $_POST['medico'];
        $observacion = $_POST['observacion'];
        $seguro = $_POST['seguro'];
        $tarjeta = $_POST['tarjeta'];
        $id_usuario = $_SESSION['id_usuario'];
        $total = $this->model->calcularVenta($id_usuario);
        $comp = $this->model->registrarVenta($id_cliente, $total['total'], $medico, $observacion, $seguro, $tarjeta);
        if ($comp == "1") {
            $msg = array('msg' => 'ok');
        } else {
            $msg = "error al transferir data";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function transferencia()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $detalle = $this->model->getDetalle($id_usuario);
        $id_venta = $this->model->id_venta();
        foreach ($detalle as $row) {
            $codigo = $row['codigo'];
            $estado = $row['estado'];
            $id_producto = $row['id_producto'];
            $descuento = $row['descuento'];
            $id_usuario = $_SESSION['id_usuario'];
            $precio = $row['precio'];
            $cantidad = $row['cantidad'];
            $subtotal = $row['subtotal'];
            $datos = $this->model->getProductos($id_producto);
            $cantidad_producto = $datos['cantidad'];
            $registroCant = $cantidad_producto - $cantidad;
            $this->model->restarCant($registroCant, $id_producto);
            $data = $this->model->transferirDetalle($codigo, $id_producto, $id_usuario, $precio, $cantidad, $descuento, $subtotal, $id_venta['id']);
            $this->model->deleteCampos($id_usuario);
        }
        if ($data == "ok") {
            $msg = array('msg' => 'ok', 'id_venta' => $id_venta['id']);
        } else {
            $msg = "error al transferir data";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function calcularDescuento($datos)
    {
        $array = explode(",", $datos);
        $id = $array[0];
        $desc = $array[1];
        if (empty($id) || empty($desc)) {
            $msg = 'no hay descuento asignado';
        } else {
            $descuento_actual = $this->model->verificarDescuento($id);
            $descactual = $descuento_actual['subtotal'] * $descuento_actual['descuento'];
            $descin = $descuento_actual['subtotal'] * ($desc / 100);
            $descuento_total = $descuento_actual['descuento'] + $descin;
            $subtotal = $descuento_actual['subtotal'] - $descuento_total;
            $data = $this->model->setDescuento($descuento_total, $subtotal, $id);
            if ($data == 1) {
                $msg = 'ok';
            } else {
                $msg = 'error al calcular descuento';
            }
        }
        return $msg;
    }
    public function generarPdf($id_venta)
    {
        $id_usuario = $_SESSION['id_usuario'];
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProVenta($id_venta, $id_usuario);
        $maxCaracteresPorLinea = 60;
        $textoObservacion = utf8_decode($productos[0]['observacion']);
        $lineasObservacion = str_split($textoObservacion, $maxCaracteresPorLinea);
        $alturaContenido = 0;
        $alturaContenido += 20; // Altura de la imagen
        $alturaContenido += 30; // Altura de la información de la empresa
        $alturaContenido += 5 * 5; // Altura de la información del cliente (5 líneas)
        $alturaContenido += 5 * count($productos); // Altura de la tabla de productos (una fila por cada producto)
        $alturaContenido += 20; // Altura del total a pagar
        $alturaContenido += (5 * count($lineasObservacion)); // Altura de la observación (una línea por cada línea de texto)
        $alturaContenido += 10; // Altura de espacio adicional
        $alturaContenido += 5 * 2; // Altura de la información del médico y el producto por seguro (2 líneas)
        $ancho = 76; // Ancho en mm
        $altura = $alturaContenido; // Altura calculada

        require('Libraries/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', array($ancho, 297)); // Sumamos 10 para evitar que se corte el contenido
        $pdf->AddPage();
        $pdf->SetMargins(3, 3, 3);
        $pdf->SetTitle('Reporte de Compras');
        $pdf->Image(base_url . 'Assets/img/Logoclinica.png', 7, 7, 40);
        $pdf->Ln(20);

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Dir: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($empresa['direccion']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'RUC/Ci: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($empresa['ruc']), 0, 1, '');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Telf: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($empresa['telefono']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Usuario: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['usuario']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 5, 'Fecha: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['fecha']), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(30, 5, 'Cliente: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['nombre']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(30, 5, 'RUC/Ci: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['dni']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(30, 5, 'Telefono: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['telefono']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(30, 5, 'Direccion: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['direccion']), 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $ancho_pagina = 76;
        $ancho_celda = $ancho_pagina / 6;
        $pdf->Cell($ancho_celda, 5, 'Cant ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'P/Uni. ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'S.Total ', 0, 0, 'L');
        $pdf->Cell($ancho_celda * 2, 5, 'N. Comer ', 0, 1, 'L');

        $total = 0.00;

        foreach ($productos as $row) {
            $total += $row['subtotal'];
            $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
            $pdf->Cell(($ancho_celda / 2), 5, utf8_decode($row['cantidad']), 0, 0, 'L');
            $pdf->SetX($pdf->GetX() + ($ancho_celda / 2)); // Establecer la posición X para la siguiente celda
            $pdf->Cell($ancho_celda, 5, utf8_decode($row['precio']), 0, 0, 'L');
            $pdf->SetX($pdf->GetX() + ($ancho_celda / 6)); // Establecer la posición X para la siguiente celda
            $pdf->Cell($ancho_celda, 5, utf8_decode($row['subtotal']), 0, 0, 'L');
            $pdf->SetX($pdf->GetX() + ($ancho_celda / 7)); // Establecer la posición X para la siguiente celda
            $pdf->Cell($ancho_celda, 5, utf8_decode(substr($row['ncomercial'], 0, 15)), 0, 1, 'L');
        }

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(25, 5, 'Total a pagar: ', 0, 1, 'R');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Observacion: ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9);
        foreach ($lineasObservacion as $linea) {
            $pdf->Cell(110, 5, utf8_decode($linea), 0, 1, 'L');
        }

        // Medico y Producto por Seguro
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Medico: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, utf8_decode($productos[0]['mnombre']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(45, 5, 'Producto por IESS: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, utf8_decode($productos[0]['seguro']), 0, 1, 'L');
        $pdf->Output();

    }
    public function generarPdfAd($id_venta)
    {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProVentaAd($id_venta);
        $maxCaracteresPorLinea = 60;
        $textoObservacion = utf8_decode($productos[0]['observacion']);
        $lineasObservacion = str_split($textoObservacion, $maxCaracteresPorLinea);
        $alturaContenido = 0;
        $alturaContenido += 20; // Altura de la imagen
        $alturaContenido += 30; // Altura de la información de la empresa
        $alturaContenido += 5 * 5; // Altura de la información del cliente (5 líneas)
        $alturaContenido += 5 * count($productos); // Altura de la tabla de productos (una fila por cada producto)
        $alturaContenido += 20; // Altura del total a pagar
        $alturaContenido += (5 * count($lineasObservacion)); // Altura de la observación (una línea por cada línea de texto)
        $alturaContenido += 10; // Altura de espacio adicional
        $alturaContenido += 5 * 2; // Altura de la información del médico y el producto por seguro (2 líneas)
        $ancho = 76; // Ancho en mm
        $altura = $alturaContenido; // Altura calculada

        require('Libraries/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', array($ancho, 297)); // Sumamos 10 para evitar que se corte el contenido
        $pdf->AddPage();
        $pdf->SetMargins(3, 3, 3);
        $pdf->SetTitle('Reporte de Compras');
        $pdf->Image(base_url . 'Assets/img/Logoclinica.png', 7, 7, 40);
        $pdf->Ln(20);

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Dir: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($empresa['direccion']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'RUC/Ci: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($empresa['ruc']), 0, 1, '');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Telf: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($empresa['telefono']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Usuario: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['usuario']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 5, 'Fecha: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['fecha']), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(30, 5, 'Cliente: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['nombre']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(30, 5, 'RUC/Ci: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['dni']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(30, 5, 'Telefono: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['telefono']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(30, 5, 'Direccion: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['direccion']), 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $ancho_pagina = 76;
        $ancho_celda = $ancho_pagina / 6;
        $pdf->Cell($ancho_celda, 5, 'Cant ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'P/Uni. ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'S.Total ', 0, 0, 'L');
        $pdf->Cell($ancho_celda * 2, 5, 'N. Comer ', 0, 1, 'L');

        $total = 0.00;

        foreach ($productos as $row) {
            $total += $row['subtotal'];
            $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
            $pdf->Cell(($ancho_celda / 2), 5, utf8_decode($row['cantidad']), 0, 0, 'L');
            $pdf->SetX($pdf->GetX() + ($ancho_celda / 2)); // Establecer la posición X para la siguiente celda
            $pdf->Cell($ancho_celda, 5, utf8_decode($row['precio']), 0, 0, 'L');
            $pdf->SetX($pdf->GetX() + ($ancho_celda / 6)); // Establecer la posición X para la siguiente celda
            $pdf->Cell($ancho_celda, 5, utf8_decode($row['subtotal']), 0, 0, 'L');
            $pdf->SetX($pdf->GetX() + ($ancho_celda / 7)); // Establecer la posición X para la siguiente celda
            $pdf->Cell($ancho_celda, 5, utf8_decode(substr($row['ncomercial'], 0, 15)), 0, 1, 'L');
        }

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(25, 5, 'Total a pagar: ', 0, 1, 'R');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Observacion: ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9);
        foreach ($lineasObservacion as $linea) {
            $pdf->Cell(110, 5, utf8_decode($linea), 0, 1, 'L');
        }

        // Medico y Producto por Seguro
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Medico: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, utf8_decode($productos[0]['mnombre']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(45, 5, 'Producto por IESS: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, utf8_decode($productos[0]['seguro']), 0, 1, 'L');
        $pdf->Output();

    }


}
