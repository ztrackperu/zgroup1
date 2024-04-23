let tblMovimientos;

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
})

$(document).ready(function() {    
    $('#añadir').click(function() {
        var nroOrden = $('#nrOrdenInput').val(); 
        var ruc = $('#rucInput').val(); 
        var proveedor = $('#proveedorInput').val(); 
        var trabajo = $('#trabajoInput').val();
        var tecnico = $('#tecnicoInput').val();
        var tipoDsc = $('#tipoDscInput').val();
        var montoUnitario = $('#montoUnitarioInput').val();
        var cantidadDcto = $('#cantDctoInput').val();
        var igvDsc = $('#igvDscInput').val();
        var totalDcto = $('#totalDctoInput').val();
        var montoUnt = $('#montoUntPactadoInput').val();

        var newRow = $('<tr/>').append(
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(nroOrden).attr('readonly', true),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(ruc).attr('readonly', true),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(proveedor),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(trabajo),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(tecnico),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(tipoDsc),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(montoUnitario),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(cantidadDcto),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(igvDsc),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(totalDcto),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(montoUnt),
            ),
            $('<td/>').append(
                $('<button/>').addClass('btn btn-danger').text('Eliminar').click(function() {
                $(this).parent().parent().remove();
                })
        ));
        $('#agregarDetalle tbody').append(newRow);

        });
        $('#busquedaInput').click(function() {
            //var num = $('#busqueda').val();
            var respuesta = $('#busqueda').val();

            var url = base_url+'Otrabajo/consultarOT/'+respuesta;
            //var url = 'http://192.168.1.166:7000/ot/' + respuesta;
            //var url = 'http://192.168.1.166:8000/testOT/' + respuesta;
            // Antes de hacer la nueva búsqueda, borra los valores de los inputs

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response1) {
                    const response = JSON.parse(response1);

                    console.log(response);
                    $('#nrOrdenInput').val(response.c_numot);
                    $('#trabajoInput').val(response.c_asunto);
                    response.DetalleOt.forEach(function(detalle) {
                        $('#rucInput').val(detalle.c_rucprov);
                        $('#proveedorInput').val(detalle.c_nomprov);
                        $('#tecnicoInput').val(detalle.c_tecnico);
                        $('#tipoDscInput').val(detalle.tdoc);
                        $('#montoUnitarioInput').val(detalle.monto);
                        $('#cantDctoInput').val(detalle.n_cant);
                        $('#igvDscInput').val(detalle.n_igvd);
                        $('#totalDctoInput').val(detalle.n_totd);
                        $('#montoUntPactadoInput').val(detalle.montop);
                        var newRow = $('<tr/>').append(
                            $('<td/>').text(response.c_numot),
                            $('<td/>').text(detalle.c_rucprov),
                            $('<td/>').text(detalle.c_nomprov),
                            $('<td/>').text(response.c_asunto),
                            $('<td/>').text(detalle.c_tecnico),
                            $('<td/>').text(detalle.tdoc),
                            $('<td/>').text(detalle.monto),
                            $('<td/>').text(detalle.n_cant),
                            $('<td/>').text(detalle.n_igvd),
                            $('<td/>').text(detalle.n_totd),
                            $('<td/>').text(detalle.montop),
                            $('<td/>').append(
                                $('<button/>').addClass('btn btn-danger').text('Eliminar').click(function() {
                                $(this).parent().parent().remove();
                            }))
                        );
                        $('#cargarDetalle tbody').append(newRow);
                      
                    });
                    response.NotaSalida.forEach(function(nota) {
                        nota.NotaSalidaDetalle.forEach(function(detalleNota){
                             detalleNota.detaoc.forEach(function(detaoc){
                                detaoc.moneda.forEach(function(moneda){
                                var monedaText = moneda.c_codmon === "1" ? "dolares" : "soles";
                                var calculoPTIGV = ((detaoc.n_preprd*detalleNota.NT_CANT*0.18)+ (detaoc.n_preprd*detalleNota.NT_CANT)).toFixed(2);
                                var calculoPU = detaoc.n_preprd;
                                var calculoPT = ((detaoc.n_preprd*detalleNota.NT_CANT)).toFixed(2);
                                var newRow2 = $('<tr/>').append(
                                     $('<td/>').text(nota.NT_NDOC),
                                     $('<td/>').text(detalleNota.NT_CART),
                                     $('<td/>').text(detaoc.c_desprd),
                                     $('<td/>').text(monedaText),
                                     $('<td/>').text(detalleNota.NT_CANT),
                                     $('<td/>').text(detalleNota.NT_CUND),
                                     $('<td/>').text(calculoPU),
                                     $('<td/>').text(calculoPT),
                                     $('<td/>').text(calculoPTIGV),
                                     $('<td/>').text(nota.NT_RESPO),
                                     $('<td/>').text(nota.NT_FDOC),
                                     $('<td/>').text(nota.c_motivo)
                                 );
                                 $('#añadirDetalleInsumo tbody').append(newRow2);
                                });
                             });
                         });
                     });
                },
                error: function(jqXHR,textStatus, errorThrown) {
                    console.error(jqXHR,textStatus, errorThrown);
                }
            }); 
    });     

    $('#enviarInput').click(function() {
        var nodo = document.getElementById('cargarDetalle');
        var nodo1 = nodo.outerHTML;
        //sector1 = toString(document.getElementById('cargarDetalle').innerHTML);
        //sector1 = document.getElementById('cargarDetalle');



        var data1 = {
            nroOrdenInput: $('#nrOrdenInput').val(),
            rucInput: $('#rucInput').val(),
            proveedorInput: $('#proveedorInput').val(),
            trabajoInput: $('#trabajoInput').val(),
            tecnicoInput: $('#tecnicoInput').val(),
            tipoDscInput: $('#tipoDscInput').val(),
            montoUnitarioInput: $('#montoUnitarioInput').val(),
            cantidadDctoInput: $('#cantDctoInput').val(),
            igvDscInput: $('#igvDscInput').val(),
            totalDctoInput: $('#totalDctoInput').val(),
            montoUntInput: $('#montoUntPactadoInput').val(),
            sector :nodo1
        };
        //console.log(nodo+"sector");
        var datad =nodo +"comodines";
        console.log(datad);
        //console.log(sector1);
        $.ajax({
            url: base_url + "Otrabajo/testCorreo",
            type: 'POST',
            dataType:'json',
            contentType: "application/json",
            data: JSON.stringify(data1),
            success: function(response) {
                console.log(response);
            },
        });
        
    });
    $('#btnReporte').click(function() {

        var num = $('#busqueda').val();
        const http = new XMLHttpRequest();
        const url = base_url+'Otrabajo/generarPDF/'+num;
        http.open("GET", url);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //const res = JSON.parse(this.responseText);
                console.log(this.responseText);    
                //debe salir el pdf
                /*
                if (res.icono == 'success') {
                    document.getElementById('msg_error').innerHTML = `<span class="badge badge-primary">Disponible: ${res.cantidad}</span>`;
                }else{
                    alertas(res.msg, res.icono);
                    return false;
                }
                */
            }
        }


    });

});



