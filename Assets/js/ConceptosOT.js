let tblConceptosOT;

function alertas(msg, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
}

document.addEventListener("DOMContentLoaded", function(){
    const language = {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }

    }
    const  buttons = [{
                //Botón para Excel
                extend: 'excel',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<button class="btn btn-success"><i class="fa fa-file-excel-o"></i></button>'
            },
            //Botón para PDF
            {
                extend: 'pdf',
                footer: true,
                title: 'Archivo PDF',
                filename: 'reporte',
                text: '<button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></button>'
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                title: 'Reportes',
                filename: 'Export_File_print',
                text: '<button class="btn btn-info"><i class="fa fa-print"></i></button>'
            }
        ]

    tblConceptosOT = $('#tblConceptosOT').DataTable({
        ajax: {
            url: base_url + "ConceptosOT/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'descripcion'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });

})


function btnEliminarConcepto(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El Concepto no se eliminará de forma permanente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "ConceptosOT/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblConceptosOT.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}


function btntReingresoConcepto(id) {
    Swal.fire({
        title: 'Esta seguro de reincorporar elemento?',
        text: "El Concepto volverá a estar activo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "ConceptosOT/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblConceptosOT.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
function registrarConcepto(e) {
    e.preventDefault();
    const Concepto = document.getElementById("descripcion_concepto");
    if (Concepto.value == "") {
        alertas('El Nombre del Concepto es requerida', 'warning');
    } else {
        const url = base_url + "ConceptosOT/registrar";
        const frm = document.getElementById("frmConceptosOT");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoConcepto").modal("hide");
                frm.reset();
                tblConceptosOT.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
function btnEditarConcepto(id) {
    document.getElementById("title").textContent = "Modificar Concepto";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "ConceptosOT/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            document.getElementById("id").value = res.id;
            
            document.getElementById("codigo_concepto").value = res.codigo;
            document.getElementById("descripcion_concepto").value = res.descripcion;                
            $("#nuevoConcepto").modal("show");
        }
    }
}

function frmConceptosOT() {
    document.getElementById("title").textContent = "Nuevo Concepto";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmConceptosOT").reset();
    const url = base_url + "ConceptosOT/maximo/" ;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            //document.getElementById("id").value = res.id+1;        
            document.getElementById("codigo_concepto").value = res.codigo+1;          
        }
    }
    document.getElementById("id").value = "";
    $("#nuevoConcepto").modal("show");
}