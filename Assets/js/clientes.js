function trasferirVenta(e) {
    e.preventDefault();
    const id_cliente = document.getElementById('cliente').value;
    const id_cliente = document.getElementById('cliente').value;
    const id_cliente = document.getElementById('cliente').value;
    const id_cliente = document.getElementById('cliente').value;
    const url = base_url + "Ventas/transferencia/" + id_cliente;
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

function trasferirVenta(e) {
    e.preventDefault();
    const id_cliente = document.getElementById('cliente').value;
    const medico = document.getElementById('medico').value;
    const observacion = encodeURIComponent(document.getElementById('observacion').value);
    const seguro = encodeURIComponent(document.getElementById('seguro').value);
    const url = base_url + "Ventas/transferenciavent";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("si pasa");
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
        const params = "id_cliente=" + id_cliente + "&medico=" + medico + "&observacion=" + observacion + "&seguro=" + seguro;
        http.send(params);
    }
}

function trasferirVenta(e) {
    e.preventDefault();
    const url = base_url + "Ventas/transferenciavent";
    const frm = document.getElementById("frmVenta");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);

        }
    }

}