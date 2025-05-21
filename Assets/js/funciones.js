let tblUsuarios, tblListaVentasDiaAd, tblListaVentasMes, tblClientes, tblPresentaciones, tblListaVentasDia, tblCajas, tblListaComprasAdmin, tblListaVentasAdmin, tblProductos, tblProductosFarma, tblListaCompras, tblListaVentas, tblMedicos, tblCategorias, tblCaducados;
document.addEventListener("DOMContentLoaded", function () {
    $('#cliente').select2();
    $('#medico').select2();
    cargarDetalle();
    cargarVenta();
    getUsuario();
    cargarVentaDia();
    cargarVentaMes();
    cargarVentaDiaAd()
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'usuario'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'caja'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    ////////// tabla clientes///////
    tblClientes = $('#tblClientes').DataTable({
        ajax: {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'dni'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'telefono'
            },
            {
                'data': 'direccion'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    ////////// tabla presentaciones///////
    tblPresentaciones = $('#tblPresentaciones').DataTable({
        ajax: {
            url: base_url + "Presentaciones/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    ////////// tabla categorias///////
    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
            url: base_url + "Categorias/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    /////////// tabla cajas /////////////
    tblCajas = $('#tblCajas').DataTable({
        ajax: {
            url: base_url + "Cajas/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'caja'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
    ////////// tabla productos ////////
    tblProductos = $('#tblProductos').DataTable({
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'ncomercial'
            },
            {
                'data': 'ngenerico'
            },
            {
                'data': 'laboratorio'
            },
            {
                'data': 'precio_venta'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'presentacion'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de usuarios',
                filename: 'Reporte de usuarios',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de usuarios',
                filename: 'Reporte de usuarios',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    ////////// tabla productos Admin////////
    tblProductosFarma = $('#tblProductosFarma').DataTable({
        ajax: {
            url: base_url + "ProductosFarma/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'ncomercial'
            },
            {
                'data': 'ngenerico'
            },
            {
                'data': 'laboratorio'
            },
            {
                'data': 'precio_venta'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'presentacion'
            },
            {
                'data': 'categoria'
            }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de usuarios',
                filename: 'Reporte de usuarios',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de usuarios',
                filename: 'Reporte de usuarios',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    ////////// tabla compras ////////
    tblListaCompras = $('#tblListaCompras').DataTable({
        ajax: {
            url: base_url + "ListaCompras/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'ngenerico'
            },
            {
                'data': 'ncomercial'
            },
            {
                'data': 'distribuidora'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'precio'
            },
            {
                'data': 'factura'
            },
            {
                'data': 'fecha_caducidad'
            },
            {
                'data': 'subtotal'
            },
            {
                'data': 'acciones'
            }
        ],
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de Compras',
                filename: 'Reporte de Compras',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de Compras',
                filename: 'Reporte de Compras',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    ////////// tabla compras admin////////
    tblListaComprasAdmin = $('#tblListaComprasAdmin').DataTable({
        ajax: {
            url: base_url + "ListaComprasAdmin/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'usuario'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'ngenerico'
            },
            {
                'data': 'ncomercial'
            },
            {
                'data': 'distribuidora'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'precio'
            },
            {
                'data': 'factura'
            },
            {
                'data': 'fecha_caducidad'
            },
            {
                'data': 'subtotal'
            },
            {
                'data': 'acciones'
            }
        ],
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de Compras',
                filename: 'Reporte de Compras',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de Compras',
                filename: 'Reporte de Compras',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    //////// tabla ventas /////////
    tblListaVentas = $('#tblListaVentas').DataTable({
        ajax: {
            url: base_url + "ListaVentas/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'fecha_venta'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'ngenerico'
            },
            {
                'data': 'ncomercial'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'precio'
            },
            {
                'data': 'nmedico'
            },
            {
                'data': 'ncliente'
            },
            {
                'data': 'seguro'
            },
            {
                'data': 'subtotal'
            },
            {
                'data': 'acciones'
            }
        ],
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    //////// tabla ventas diarias/////////
    tblListaVentasDia = $('#tblListaVentasDia').DataTable({
        ajax: {
            url: base_url + "Cajas/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'fecha_venta'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'ngenerico'
            },
            {
                'data': 'ncomercial'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'precio'
            },
            {
                'data': 'nmedico'
            },
            {
                'data': 'ncliente'
            },
            {
                'data': 'seguro'
            },
            {
                'data': 'subtotal'
            },
            {
                'data': 'acciones'
            }
        ],
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    //////// tabla ventas diarias/////////
    tblListaVentasDiaAd = $('#tblListaVentasDiaAd').DataTable({
        ajax: {
            url: base_url + "CajasDia/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'fecha_apertura'
            },
            {
                'data': 'usuario'
            },
            {
                'data': 'monto_inicial'
            },
            {
                'data': 'subtotal_sin'
            },
            {
                'data': 'subtotal_tarjeta'
            },
            {
                'data': 'total_ventas'
            },
            {
                'data': 'monto_final'
            },
            {
                'data': 'observacion'
            },
            {
                'data': 'acciones'
            }
        ],
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    //////// tabla ventas mensuales/////////
    tblListaVentasMes = $('#tblListaVentasMes').DataTable({
        ajax: {
            url: base_url + "CajasAd/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'usuario'
            },
            {
                'data': 'fecha_venta'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'ngenerico'
            },
            {
                'data': 'ncomercial'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'precio'
            },
            {
                'data': 'nmedico'
            },
            {
                'data': 'ncliente'
            },
            {
                'data': 'seguro'
            },
            {
                'data': 'subtotal'
            },
            {
                'data': 'acciones'
            }
        ],
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    //////// tabla ventas admin /////////
    tblListaVentasAdmin = $('#tblListaVentasAdmin').DataTable({
        ajax: {
            url: base_url + "ListaVentasAdmin/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'usuario'
            },
            {
                'data': 'fecha_venta'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'ngenerico'
            },
            {
                'data': 'ncomercial'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'precio'
            },
            {
                'data': 'nmedico'
            },
            {
                'data': 'ncliente'
            },
            {
                'data': 'seguro'
            },
            {
                'data': 'subtotal'
            },
            {
                'data': 'acciones'
            }
        ],
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de Ventas',
                filename: 'Reporte de Ventas',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    ////////// tabla caducados///////
    tblCaducados = $('#tblCaducados').DataTable({
        ajax: {
            url: base_url + "Caducados/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'ngenerico'
            },
            {
                'data': 'ncomercial'
            },
            {
                'data': 'distribuidora'
            },
            {
                'data': 'cantidad'
            },
            {
                'data': 'factura'
            },
            {
                'data': 'fecha_caducidad'
            },
            {
                'data': 'dias'
            },
            {
                'data': 'acciones'
            }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de usuarios',
                filename: 'Reporte de usuarios',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de usuarios',
                filename: 'Reporte de usuarios',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
    ///////// medicos //////
    tblMedicos = $('#tblMedicos').DataTable({
        ajax: {
            url: base_url + "Medicos/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'dni'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'telefono'
            },
            {
                'data': 'direccion'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ]
    });
})

function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}

function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    if (usuario.value == "" || nombre.value == "" || caja.value == "") {
        Swal.fire({
            position: "top-middle",
            icon: "error",
            title: "Campos obligatorios",
            showConfirmButton: false,
            timer: 2000
        })
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Usuario agregado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    frm.reset();
                    tblUsuarios.ajax.reload();
                    $("#nuevo_usuario").modal("hide");
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Usuario modificado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    tblUsuarios.ajax.reload();
                    $("#nuevo_usuario").modal("hide");
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        }
    }
}

function btnEditarUser(id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Editar";
    const url = base_url + "Usuarios/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("caja").value = res.id_caja;
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
        }
    }
}

function getUsuario() {
    const url = base_url + "Usuarios/nombre";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            const nombreUsuario = res[0].nombre; // Accede al nombre del usuario
            document.getElementById("idusuario").value = nombreUsuario;
        }
    }
}

function btnEliminarUser(id) {
    Swal.fire({
        title: "Esta seguro de eliminar a este usuario?",
        text: "El usuario no se eliminara de forma permanente solo cambiara a estado inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "El usuario ya esta inactivo",
                            icon: "success"
                        })
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblUsuarios.ajax.reload();
                    }
                }
            }

        }
    });
}

function btnReingresarUser(id) {
    const url = base_url + "Usuarios/reingresar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Mensaje",
                    text: "El usuario ya esta activo",
                    icon: "success"
                })
                tblUsuarios.ajax.reload();
            } else {
                Swal.fire({
                    title: "Mensaje",
                    text: "error",
                    icon: "error"
                })
                tblUsuarios.ajax.reload();
            }
        }
    }
}
/////////////////////////////////////////////////////////// fin tabla de usuarios //////////////////////////////////////////////////
function frmClientes() {
    document.getElementById("title").innerHTML = "Nuevo Presentacion";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmClientes").reset();
    $("#nuevo_cliente").modal("show");
    document.getElementById("id").value = "";
}

function registrarClientes(e) {
    e.preventDefault();
    const dni = document.getElementById("dni");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    if (dni.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "") {
        Swal.fire({
            position: "top-middle",
            icon: "error",
            title: "Campos obligatorios",
            showConfirmButton: false,
            timer: 2000
        })
    } else {
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmClientes");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Cliente agregado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    frm.reset();
                    tblClientes.ajax.reload();
                    $("#nuevo_cliente").modal("hide");
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Cliente modificado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    tblClientes.ajax.reload();
                    $("#nuevo_cliente").modal("hide");
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        }
    }
}

function btnEditarCli(id) {
    document.getElementById("title").innerHTML = "Actualizar Cliente";
    document.getElementById("btnAccion").innerHTML = "Editar";
    const url = base_url + "Clientes/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("dni").value = res.dni;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            $("#nuevo_cliente").modal("show");
        }
    }
}

function btnEliminarCli(id) {
    Swal.fire({
        title: "Esta seguro de eliminar a este cliente?",
        text: "El Cliente no se eliminara de forma permanente solo cambiara a estado inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "El Cliente ya esta inactivo",
                            icon: "success"
                        })
                        tblClientes.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblClientes.ajax.reload();
                    }
                }
            }

        }
    });
}

function btnReingresarCli(id) {
    const url = base_url + "Clientes/reingresar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Mensaje",
                    text: "El cliente ya esta activo",
                    icon: "success"
                })
                tblClientes.ajax.reload();
            } else {
                Swal.fire({
                    title: "Mensaje",
                    text: "error",
                    icon: "error"
                })
                tblClientes.ajax.reload();
            }
        }
    }
}
////////////// Presentaciones ///////
function frmPresentaciones() {
    document.getElementById("title").innerHTML = "Nueva Presentacion";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmPresentaciones").reset();
    $("#nuevo_presentacion").modal("show");
    document.getElementById("id").value = "";
}

function registrarPresentaciones(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    if (nombre.value == "") {
        Swal.fire({
            position: "top-middle",
            icon: "error",
            title: "Campos obligatorios",
            showConfirmButton: false,
            timer: 2000
        })
    } else {
        const url = base_url + "Presentaciones/registrar";
        const frm = document.getElementById("frmPresentaciones");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Presentacion agregada con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    frm.reset();
                    tblPresentaciones.ajax.reload();
                    $("#nuevo_presentacion").modal("hide");
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Presentacion modificada con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    tblPresentaciones.ajax.reload();
                    $("#nuevo_presentacion").modal("hide");
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        }
    }
}

function btnEditarPre(id) {
    document.getElementById("title").innerHTML = "Actualizar Presentacion";
    document.getElementById("btnAccion").innerHTML = "Editar";
    const url = base_url + "Presentaciones/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("nombre").value = res.nombre;
            $("#nuevo_presentacion").modal("show");
        }
    }
}

function btnEliminarPre(id) {
    Swal.fire({
        title: "Esta seguro de eliminar a esta presentación?",
        text: "La Presentacion no se eliminara de forma permanente solo cambiara a estado inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Presentaciones/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "El Presentacion ya esta inactiva",
                            icon: "success"
                        })
                        tblPresentaciones.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblPresentaciones.ajax.reload();
                    }
                }
            }
        }
    });
}

function btnReingresarPre(id) {
    const url = base_url + "Presentaciones/reingresar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Mensaje",
                    text: "La presentacion ya esta activa",
                    icon: "success"
                })
                tblPresentaciones.ajax.reload();
            } else {
                Swal.fire({
                    title: "Mensaje",
                    text: "error",
                    icon: "error"
                })
                tblPresentaciones.ajax.reload();
            }
        }
    }
}
////////////// categorias ///////
function frmCategorias() {
    document.getElementById("title").innerHTML = "Nueva Categoria";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmCategorias").reset();
    $("#nuevo_categoria").modal("show");
    document.getElementById("id").value = "";
}

function registrarCategorias(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    if (nombre.value == "") {
        Swal.fire({
            position: "top-middle",
            icon: "error",
            title: "Campos obligatorios",
            showConfirmButton: false,
            timer: 2000
        })
    } else {
        const url = base_url + "Categorias/registrar";
        const frm = document.getElementById("frmCategorias");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Categoria agregada con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    frm.reset();
                    tblCategorias.ajax.reload();
                    $("#nuevo_categoria").modal("hide");
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Categoria modificada con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    tblCategorias.ajax.reload();
                    $("#nuevo_categoria").modal("hide");
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        }
    }
}

function btnEditarCat(id) {
    document.getElementById("title").innerHTML = "Actualizar Categoria";
    document.getElementById("btnAccion").innerHTML = "Editar";
    const url = base_url + "Categorias/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("nombre").value = res.nombre;
            $("#nuevo_categoria").modal("show");
        }
    }
}

function btnEliminarCat(id) {
    Swal.fire({
        title: "Esta seguro de eliminar a esta categoria?",
        text: "La categoria no se eliminara de forma permanente solo cambiara a estado inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categorias/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "El Categoria ya esta inactiva",
                            icon: "success"
                        })
                        tblCategorias.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblCategorias.ajax.reload();
                    }
                }
            }
        }
    });
}

function btnReingresarCat(id) {
    const url = base_url + "Categorias/reingresar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Mensaje",
                    text: "La categoria ya esta activa",
                    icon: "success"
                })
                tblCategorias.ajax.reload();
            } else {
                Swal.fire({
                    title: "Mensaje",
                    text: "error",
                    icon: "error"
                })
                tblCategorias.ajax.reload();
            }
        }
    }
}
////////////// cajas ///////
function frmCajas() {
    document.getElementById("title").innerHTML = "Nueva Caja";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmCajas").reset();
    $("#nuevo_caja").modal("show");
    document.getElementById("id").value = "";
}

function registrarCajas(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    if (nombre.value == "") {
        Swal.fire({
            position: "top-middle",
            icon: "error",
            title: "Campos obligatorios",
            showConfirmButton: false,
            timer: 2000
        })
    } else {
        const url = base_url + "Cajas/registrar";
        const frm = document.getElementById("frmCajas");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Caja agregada con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    frm.reset();
                    tblCategorias.ajax.reload();
                    $("#nuevo_caja").modal("hide");
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Caja modificada con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    tblCajas.ajax.reload();
                    $("#nuevo_caja").modal("hide");
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        }
    }
}

function btnEditarCaja(id) {
    document.getElementById("title").innerHTML = "Actualizar Caja";
    document.getElementById("btnAccion").innerHTML = "Editar";
    const url = base_url + "Cajas/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("nombre").value = res.nombre;
            $("#nuevo_caja").modal("show");
        }
    }
}

function btnEliminarCaja(id) {
    Swal.fire({
        title: "Esta seguro de eliminar a esta caja?",
        text: "La caja no se eliminara de forma permanente solo cambiara a estado inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Cajas/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "El Caja ya esta inactiva",
                            icon: "success"
                        })
                        tblCajas.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblCajas.ajax.reload();
                    }
                }
            }
        }
    });
}

function btnReingresarCaja(id) {
    const url = base_url + "Cajas/reingresar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Mensaje",
                    text: "La caja ya esta activa",
                    icon: "success"
                })
                tblCajas.ajax.reload();
            } else {
                Swal.fire({
                    title: "Mensaje",
                    text: "error",
                    icon: "error"
                })
                tblCajas.ajax.reload();
            }
        }
    }
}
///////////// productos //////////////////
function frmProducto() {
    document.getElementById("title").innerHTML = "Nuevo Producto";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmProducto").reset();
    $("#nuevo_producto").modal("show");
    document.getElementById("id").value = "";
}

function registrarPro(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const ncomercial = document.getElementById("ncomercial");
    const ngenerico = document.getElementById("ngenerico");
    const laboratorio = document.getElementById("laboratorio");
    const presentacion = document.getElementById("presentacion");
    const categoria = document.getElementById("categoria");
    const precio_venta = document.getElementById("precio_venta");
    const iva = document.getElementById("iva");
    if (codigo.value == "" || ngenerico.value == "" || iva.value == "" || ncomercial.value == "" || precio_venta.value == "") {
        Swal.fire({
            position: "top-middle",
            icon: "error",
            title: "Campos obligatorios",
            showConfirmButton: false,
            timer: 2000
        })
    } else {
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProducto");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Producto agregado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    frm.reset();
                    tblProductos.ajax.reload();
                    $("#nuevo_producto").modal("hide");
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Producto modificado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    tblProductos.ajax.reload();
                    $("#nuevo_producto").modal("hide");
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        }
    }
}

function btnEditarPro(id) {
    document.getElementById("title").innerHTML = "Actualizar Producto";
    document.getElementById("btnAccion").innerHTML = "Editar";
    const url = base_url + "Productos/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("ncomercial").value = res.ncomercial;
            document.getElementById("ngenerico").value = res.ngenerico;
            document.getElementById("laboratorio").value = res.laboratorio;
            document.getElementById("presentacion").value = res.id_presentacion;
            document.getElementById("categoria").value = res.id_categoria;
            document.getElementById("iva").value = res.iva;
            document.getElementById("precio_venta").value = res.precio_venta;
            $("#nuevo_producto").modal("show");
        }
    }
}

function btnEliminarPro(id) {
    Swal.fire({
        title: "Esta seguro de eliminar a este producto?",
        text: "El producto no se eliminara de forma permanente solo cambiara a estado inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "El producto ya esta inactivo",
                            icon: "success"
                        })
                        tblProductos.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblProductos.ajax.reload();
                    }
                }
            }

        }
    });
}

function btnReingresarPro(id) {
    const url = base_url + "Productos/reingresar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Mensaje",
                    text: "El producto ya esta activo",
                    icon: "success"
                })
                tblProductos.ajax.reload();
            } else {
                Swal.fire({
                    title: "Mensaje",
                    text: "error",
                    icon: "error"
                })
                tblProductos.ajax.reload();
            }
        }
    }
}
///////// compras //////////

function buscarCodigo(e) {
    e.preventDefault();
    if (e.which == 13) {
        const cod = encodeURIComponent(document.getElementById("codigo").value);
        const url = base_url + "Compras/buscarCodigo/";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res) {
                    document.getElementById("ncomercial").value = res.ncomercial;
                    document.getElementById("ngenerico").value = res.ngenerico;
                    document.getElementById("laboratorio").value = res.laboratorio;
                    document.getElementById("id").value = res.id;
                    const campos = ["precio_compra", "lote", "fecha_caducidad", "distribuidora", "factura", "cantidad"];
                    for (let campo of campos) {
                        if (!document.getElementById(campo).value) {
                            document.getElementById(campo).focus(); // Enfoca en el primer campo vacío
                            break;
                        }
                    }
                    cargarDetalle();
                } else {
                    Swal.fire({
                        title: "Producto no encontrado",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    document.getElementById("codigo").value = '';
                    document.getElementById("codigo").focus();
                    cargarDetalle();
                }
            }
        }
        http.send("cod=" + cod);
    }
}

function calcularPrecio(e) {
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio_compra").value;
    document.getElementById("sub_total").value = precio * cant;
    if (e.which == 13) {
        if (cant > 0) {
            const url = base_url + "Compras/ingresar/";
            const frm = document.getElementById("frmCompra");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == 'ok') {
                        frm.reset();
                        cargarDetalle();
                    }
                }
            }
        }
    }
}

function cargarDetalle() {
    const url = base_url + "Compras/listar/";

    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let html = '';
            res.detalle.forEach(row => {
                html += `<tr>
                <td>${row.id}</td>
                <td>${row.ngenerico}</td>
                <td>${row.ncomercial}</td>
                <td>${row.cantidad}</td>
                <td><input class= "form-control" placeholder="Desc" type="text" onkeyup="calcularDescuentoCompra(event, ${row.id})"></td>
                <td>${row.descuento}</td>
                <td>${row.precio}</td>
                <td>${row.subtotal}</td>
                <td><button class="btn btn-danger" type="button" onclick="deleteDetalle(${row.id})"><i class="fas fa-trash-alt"></i></></td>
                </td>`
            });
            document.getElementById("tblDetalle").innerHTML = html;
            document.getElementById("total").value = res.total_pagar.total;
        }
    }
}

function calcularDescuentoCompra(e, id) {
    e.preventDefault();
    if (e.target.value == '') {
        console.log("vacio");
    } else {
        if (e.which == 13) {

            const url = base_url + "Compras/calcularDescuento/" + id + "/" + e.target.value;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    cargarDetalle();
                }
            }

        }
    }
}

function deleteDetalle(id) {
    const url = base_url + "Compras/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Producto eliminado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                })
                cargarDetalle();
            } else {
                Swal.fire({
                    title: "Producto no se pudo eliminar",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                })
                cargarDetalle();
            }
        }
    }
}


function trasferirData(e) {
    e.preventDefault();
    const url = base_url + "Compras/transferencia/";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res.msg == "ok") {
                Swal.fire({
                    title: "Productos comprados",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                })
                const ruta = base_url + "Compras/generarPdf/" + res.id_compra;
                window.open(ruta);
                cargarDetalle();
            } else {
                Swal.fire({
                    title: "Producto ingresar compra",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                })
                cargarDetalle();
            }
        }
    }
}
////////// ventas ///////////
function buscarVenta(e) {
    e.preventDefault();
    if (e.which == 13) {
        const cod = encodeURIComponent(document.getElementById("codigo").value);
        const url = base_url + "Ventas/buscarCodigo/";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res) {
                    document.getElementById("ncomercial").value = res.ncomercial;
                    document.getElementById("ngenerico").value = res.ngenerico;
                    document.getElementById("precio_venta").value = res.precio_venta;
                    document.getElementById("id").value = res.id;
                    document.getElementById("laboratorio").value = res.laboratorio;
                    document.getElementById("cantidad").focus();
                } else {
                    Swal.fire({
                        title: "Producto no encontrado",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    document.getElementById("codigo").value = '';
                    document.getElementById("codigo").focus();
                }
            }
        }
        http.send("cod=" + cod);
    }
    cargarVenta();
}

function buscarVentaNombre(e, ncomercial) {
    e.preventDefault();
    if (e.which == 13) {
        const nom = encodeURIComponent(ncomercial);
        const url = base_url + "Ventas/buscarCodigoNombre";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res) {
                    document.getElementById("codigo").value = res.codigo;
                    document.getElementById("ncomercial").value = res.ncomercial;
                    document.getElementById("ngenerico").value = res.ngenerico;
                    document.getElementById("precio_venta").value = res.precio_venta;
                    document.getElementById("id").value = res.id;
                    document.getElementById("laboratorio").value = res.laboratorio;
                    document.getElementById("cantidad").focus();
                } else {
                    Swal.fire({
                        title: "Producto no encontrado",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    document.getElementById("codigo").value = '';
                    document.getElementById("codigo").focus();
                }
            }
        }
        http.send("nom=" + nom);
    }
    cargarVenta();
}

function calcularVenta(e) {
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio_venta").value;
    const id = document.getElementById("id").value;
    console.log(id);
    document.getElementById("sub_total").value = precio * cant;
    if (e.which == 13) {
        if (cant > 0) {
            const url = base_url + "Ventas/ingresar/";
            const frm = document.getElementById("frmVenta");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res == 'ok') {
                        frm.reset();
                        cargarVenta();
                    } else {
                        Swal.fire({
                            title: "Producto sin stock",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }
        }
    }
}

function cargarVenta() {
    const url = base_url + "Ventas/listar/";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            res.detalle.forEach(row => {
                html += `<tr>
                <td>${row.id}</td>
                <td>${row.ngenerico}</td>
                <td>${row.ncomercial}</td>
                <td>${row.cantidad}</td>
                <td><input class= "form-control" placeholder="Desc" type="text" onkeyup="calcularDescuento(event, ${row.id})"></td>
                <td>${row.descuento}</td>
                <td>${row.precio}</td>
                <td>${row.subtotal}</td>
                <td><button class="btn btn-danger" type="button" onclick="deleteVenta(${row.id})"><i class="fas fa-trash-alt"></i></></td>
                </td>`
            });
            document.getElementById("tblDetalleVenta").innerHTML = html;
            document.getElementById("totalventa").value = res.total_pagar.total;
        }
    }
}

function calcularDescuento(e, id) {
    e.preventDefault();
    if (e.target.value == '') {
        console.log("vacio");
    } else {
        if (e.which == 13) {

            const url = base_url + "Ventas/calcularDescuento/" + id + "/" + e.target.value;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    cargarVenta();
                }
            }

        }
    }
}

function deleteVenta(id) {
    const url = base_url + "Ventas/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Producto eliminado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                })
                cargarVenta();
            } else {
                Swal.fire({
                    title: "Producto no se pudo eliminar",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                })
                cargarVenta();
            }
        }
    }
}

function trasferirVentaOb(e) {
    e.preventDefault();
    const url = base_url + "Ventas/transferenciavent";
    const frmPrincipal = document.getElementById("frmPrincipal");
    const formDataPrincipal = new FormData(frmPrincipal);
    const frmOtro = document.getElementById("frmSegundo");
    const formDataOtro = new FormData(frmOtro);
    for (var pair of formDataOtro.entries()) {
        formDataPrincipal.append(pair[0], pair[1]);
    }
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(formDataPrincipal);
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            trasferirVenta()
        }
    }
}

function trasferirVenta() {
    const url = base_url + "Ventas/transferencia/";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res.msg == "ok") {
                Swal.fire({
                    title: "Productos vendidos",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                })
                const ruta = base_url + "Ventas/generarPdf/" + res.id_venta;
                window.open(ruta);
                cargarVenta();
            } else {
                Swal.fire({
                    title: "Error al ingresar venta",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                })
                cargarVenta();
            }
        }
    }
}

//////////// Caducados ////////
function btnEliminarCaducado(id) {
    Swal.fire({
        title: "Esta seguro de procesar este producto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Caducados/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "El producto caducado fue procesado",
                            icon: "success"
                        })
                        tblCaducados.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblCaducados.ajax.reload();
                    }
                }
            }
        }
    });
}
/////// permisos //////
function registrarPermisos(e) {
    e.preventDefault();
    const url = base_url + "Usuarios/registrarPermiso";
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Mensaje",
                    text: "Los permisos fueron asignados",
                    icon: "success"
                })
            } else {
                Swal.fire({
                    title: "Mensaje",
                    text: "error al registar permisos",
                    icon: "error"
                })
            }
        }
    }
}
//////////////// medicos //////////////////
function frmMedicos() {
    document.getElementById("title").innerHTML = "Nuevo Medico";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmMedicos").reset();
    $("#nuevo_medico").modal("show");
    document.getElementById("id").value = "";
}

function registrarMedicos(e) {
    e.preventDefault();
    const dni = document.getElementById("dni");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    if (dni.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "") {
        Swal.fire({
            position: "top-middle",
            icon: "error",
            title: "Campos obligatorios",
            showConfirmButton: false,
            timer: 2000
        })
    } else {
        const url = base_url + "Medicos/registrar";
        const frm = document.getElementById("frmMedicos");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Medico agregado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    frm.reset();
                    tblMedicos.ajax.reload();
                    $("#nuevo_medico").modal("hide");
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Medico modificado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    tblMedicos.ajax.reload();
                    $("#nuevo_medico").modal("hide");
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        }
    }
}

function btnEditarMed(id) {
    document.getElementById("title").innerHTML = "Actualizar Medico";
    document.getElementById("btnAccion").innerHTML = "Editar";
    const url = base_url + "Medicos/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("dni").value = res.dni;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            $("#nuevo_medico").modal("show");
        }
    }
}

function btnEliminarMed(id) {
    Swal.fire({
        title: "Esta seguro de eliminar a este medico?",
        text: "El Medico no se eliminara de forma permanente solo cambiara a estado inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medicos/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "El Medico ya esta inactivo",
                            icon: "success"
                        })
                        tblMedicos.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblMedicos.ajax.reload();
                    }
                }
            }

        }
    });
}

function btnReingresarMed(id) {
    const url = base_url + "Medicos/reingresar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Mensaje",
                    text: "El medico ya esta activo",
                    icon: "success"
                })
                tblMedicos.ajax.reload();
            } else {
                Swal.fire({
                    title: "Mensaje",
                    text: "error",
                    icon: "error"
                })
                tblMedicos.ajax.reload();
            }
        }
    }
}
///////// anular compra y venta ///////

function btnAnularC(id) {
    Swal.fire({
        title: "Esta seguro de anular esta compra?",
        text: "La compra se eliminara",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "ListaComprasAdmin/anular/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "La compra ya esta anulada",
                            icon: "success"
                        })
                        tblListaComprasAdmin.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblListaComprasAdmin.ajax.reload();
                    }
                }
            }

        }
    });
}

function btnAnularV(id) {
    Swal.fire({
        title: "Esta seguro de anular esta venta?",
        text: "La venta se eliminara",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "ListaVentasAdmin/anular/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje",
                            text: "La venta ya esta anulada",
                            icon: "success"
                        })
                        tblListaVentasAdmin.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Mensaje",
                            text: "error",
                            icon: "error"
                        })
                        tblListaVentasAdmin.ajax.reload();
                    }
                }
            }

        }
    });
}

function frmProductofarma() {
    document.getElementById("title").innerHTML = "Nuevo Producto";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmProductofarma").reset();
    $("#nuevo_productofarma").modal("show");
    document.getElementById("id").value = "";
}

function registrarProFar(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const ncomercial = document.getElementById("ncomercial");
    const ngenerico = document.getElementById("ngenerico");
    const laboratorio = document.getElementById("laboratorio");
    const presentacion = document.getElementById("presentacion");
    const categoria = document.getElementById("categoria");
    const precio_venta = document.getElementById("precio_venta");
    const iva = document.getElementById("iva");
    if (codigo.value == "" || ngenerico.value == "" || iva.value == "" || ncomercial.value == "" || precio_venta.value == "") {
        Swal.fire({
            position: "top-middle",
            icon: "error",
            title: "Campos obligatorios",
            showConfirmButton: false,
            timer: 2000
        })
    } else {
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProductofarma");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Producto agregado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    frm.reset();
                    tblProductosFarma.ajax.reload();
                    $("#nuevo_productofarma").modal("hide");
                } else if (res == "modificado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Producto modificado con exito",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    tblProductosFarma.ajax.reload();
                    $("#nuevo_productofarma").modal("hide");
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        }
    }
}

function btnPdfVenta(id_venta) {
    const ruta = base_url + "Ventas/generarPdf/" + id_venta;
    window.open(ruta);
}

function btnPdfCompra(id_compra) {
    const ruta = base_url + "Compras/generarPdf/" + id_compra;
    window.open(ruta);
}

function btnPdfVentaAd(id_venta) {
    const ruta = base_url + "Ventas/generarPdfAd/" + id_venta;
    window.open(ruta);
}

function cargarVentaDia() {
    const url = base_url + "Cajas/pagar/";

    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            document.getElementById("totalventadia").value = res.total_pagar.total;
        }
    }
}

function reporteDiario(e) {
    e.preventDefault();
    const url = base_url + "Cajas/transferencia";
    const frm = document.getElementById("frmVentaDia");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    title: "Reporte Generado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                })
                const ruta = base_url + "Cajas/generarPdf/";
                window.open(ruta);
            } else {
                Swal.fire({
                    title: "Error generar reporte",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    }
}

function cargarVentaMes() {
    const url = base_url + "CajasAd/pagar/";

    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.getElementById("totalventames").value = res.total_pagar.total;
        }
    }
}

function reporteMensual(e) {
    e.preventDefault();
    const ruta = base_url + "CajasAd/generarPdf/";
    window.open(ruta);
}

function cargarVentaDiaAd() {
    const url = base_url + "CajasDia/pagar/";

    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.getElementById("totalventadiaAd").value = res.total_pagar.total;
        }
    }
}


function btnPdfReporte(id_usuario, fecha) {
    const partesFecha = fecha.split(' ')[0].split('-');
    const año = partesFecha[0];
    const mes = partesFecha[1];
    const dia = partesFecha[2];
    const fechaFormateada = año + '-' + mes + '-' + dia;
    const fechaCodificada = encodeURIComponent(fechaFormateada);
    const ruta = base_url + "CajasDia/generarPdf/" + id_usuario + "/" + fecha;
    window.open(ruta);
}