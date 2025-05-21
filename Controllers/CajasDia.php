<?php
class CajasDia extends Controller
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
        $data = $this->model->getVentas();
        for ($i = 0; $i < count($data); $i++) {
            $fecha = date('Y-m-d', strtotime($data[$i]['fecha_apertura']));
            $data[$i]['acciones'] = '<div><button class="btn btn-danger" onclick="btnPdfReporte(' . $data[$i]['id_usuario'] . ', \'' . $fecha . '\')"><i class="fas fa-file"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function pagar()
    {
        $data['total_pagar'] = $this->model->calcularVenta();
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => "Error al obtener los detalles"], JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function generarPdf($datocompleto)
    {
        $datos_separados = explode(',', $datocompleto);
        $id_usuario = $datos_separados[0];
        $fecha = $datos_separados[1];
        $empresa = $this->model->getEmpresa();
        $datos = $this->model->getdatos($id_usuario, $fecha);
        $iess = $this->model->getIess($id_usuario, $fecha);
        $productos = $this->model->getProVenta($id_usuario, $fecha);
        $productosiess = $this->model->getProVentaIess($id_usuario, $fecha);
        $maxCaracteresPorLinea = 60;
        $textoObservacion = utf8_decode($datos[0]['observacion']);
        $lineasObservacion = str_split($textoObservacion, $maxCaracteresPorLinea);

        require('Libraries/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', array(210, 297)); // Sumamos 10 para evitar que se corte el contenido
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5, 5);
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
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Fecha: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($productos[0]['fecha_venta']), 0, 1, 'L');
        $pdf->Ln(5);


        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Productos a contado', 0, 0, 'L');
        $pdf->Ln(4);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $ancho_pagina = 210;
        $ancho_celda = $ancho_pagina / 6;
        $pdf->Cell($ancho_celda, 5, 'Cant ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'P/Uni. ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'S.Total ', 0, 0, 'L');
        $pdf->Cell($ancho_celda * 2, 5, 'N. Comer ', 0, 1, 'L');
        $pdf->Ln(4);

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
        $pdf->Cell(18, 5, 'Total en productos a contado ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($datos[0]['subtotal_sin']), 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Productos con tarjeta', 0, 0, 'L');
        $pdf->Ln(4);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $ancho_pagina = 210;
        $ancho_celda = $ancho_pagina / 6;
        $pdf->Cell($ancho_celda, 5, 'Cant ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'P/Uni. ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'S.Total ', 0, 0, 'L');
        $pdf->Cell($ancho_celda * 2, 5, 'N. Comer ', 0, 1, 'L');
        $pdf->Ln(4);

        foreach ($productosiess as $row) {
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
        $pdf->Cell(18, 5, 'Total con tarjeta: ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($datos[0]['subtotal_tarjeta']), 0, 1, 'L');

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(25, 5, 'Total en ventas: ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, number_format($total, 2, '.', ','), 0, 1, 'L');

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Dinero inicial en caja: ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($datos[0]['monto_inicial']), 0, 1, 'L');



        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Dinero final en caja: ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
        $pdf->Cell(20, 5, utf8_decode($datos[0]['monto_final']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Observacion: ', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 9);
        foreach ($lineasObservacion as $linea) {
            $pdf->Cell(110, 5, utf8_decode($linea), 0, 1, 'L');
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12); // Modificar el tamaño de fuente a 9
        $pdf->Cell(18, 5, 'Productos entregados al iess', 0, 0, 'L');
        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 9); // Modificar el tamaño de fuente a 9
        $ancho_pagina = 210;
        $ancho_celda = $ancho_pagina / 6;
        $pdf->Cell($ancho_celda, 5, 'Cant ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'P/Uni. ', 0, 0, 'L');
        $pdf->Cell($ancho_celda, 5, 'S.Total ', 0, 0, 'L');
        $pdf->Cell($ancho_celda * 2, 5, 'N. Comer ', 0, 1, 'L');
        $pdf->Ln(4);

        foreach ($iess as $row) {
            $pdf->SetFont('Arial', '', 9); // Modificar el tamaño de fuente a 9
            $pdf->Cell(($ancho_celda / 2), 5, utf8_decode($row['cantidad']), 0, 0, 'L');
            $pdf->SetX($pdf->GetX() + ($ancho_celda / 2)); // Establecer la posición X para la siguiente celda
            $pdf->Cell($ancho_celda, 5, utf8_decode($row['precio']), 0, 0, 'L');
            $pdf->SetX($pdf->GetX() + ($ancho_celda / 6)); // Establecer la posición X para la siguiente celda
            $pdf->Cell($ancho_celda, 5, utf8_decode($row['subtotal']), 0, 0, 'L');
            $pdf->SetX($pdf->GetX() + ($ancho_celda / 7)); // Establecer la posición X para la siguiente celda
            $pdf->Cell($ancho_celda, 5, utf8_decode(substr($row['ncomercial'], 0, 15)), 0, 1, 'L');
        }
        $pdf->Output();

    }

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }
}

