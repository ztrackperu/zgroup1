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

async function fila(id){
    id1=id-1000;
    datafila =[];
    let response = $.get(base_url + "ConceptosOT/nuevaSeleccion/" + id1, (data, status) => {    
    });
    return response;
}

$('#Proveedor').on('change', function (e) {
    variable = $('#Proveedor').select2('data');
    document.getElementById("ruc").value = variable[0].id;
    console.log(variable);
  });
  
$('#ConceptoTrabajo').on('change', function (e) {
        variable = $('#ConceptoTrabajo').select2('data');
        console.log(variable);

        id2 = variable[0].id;
        id1=id2-1000;
        datafila =[];
        let res1 = $.get(base_url + "ConceptosOT/nuevaSeleccion/" + id1, function(data, status) {
            let res = JSON.parse(data);
            console.log(res);
            
        });
        
        res = JSON.parse(res1);
        console.log(res);
        tablaInsumosOT.destroy();
        console.log("esta vacio");
        tablaInsumosOT = $('#myTableInsumoOT').DataTable({
            paging: false,
            searching: true,
            info: false,
            data: res,
            columns: [
            { title: "Codigo", data: "IN_CODI" },
            { title: "Descripcion", data: "IN_ARTI" },
            { title: "Unidad", data: "IN_UVTA" },
            { title: "Cantidad", data: "cantidad" },
            { title: "Eliminar", data: "acciones" }
            ]
        });   
  });


  $("#checkCodigo").change(function() {
        if (this.checked) {
            alert('Seleccionado');
            urlC = base_url +'Otrabajo/buscarCodigoAlquilerVenta';
        }else{
            alert('NO ESTA Seleccionado');
            urlC = base_url +'Otrabajo/buscarCodigoDisponible';
        }
        $('#codigoEquipo').select2({
            //primero validar si se selecciono el checkbox checkCodigo
            placeholder: 'Buscar Codigo Equipo',
            minimumInputLength: 5,
            delay: 250,
            ajax: {
                url: urlC,
                dataType: 'json',
                //delay: 250, 
                data: function (params) {  
                    console.log(params);        
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }    
        });  

    });

    $('#codigoEquipo').on('change', function (e) {
        // obtenemos el valor y consultamos a la API
        variable = $('#codigoEquipo').select2('data');
        codBuscar= variable[0].text;
        console.log(codBuscar);
        let response = $.get(base_url + "Otrabajo/buscarCodigo/" + codBuscar, (data, status) => {
            data1 = JSON.parse(data);
            console.log(data1[0]);
            //aqui asignamos y autocompletamos los campos 
            descripcionEquipoI ="S/N" ;
            maquinaI = "SIN MÁQUINA";
            if(data1[0].codigo.length!=0){
                maquinaI = data1[0].codigo[0].id_equipo_asignado;
            }
            if(data1[0].des.length!=0){
                descripcionEquipoI = data1[0].des[0].IN_ARTI;
            }
            document.getElementById("descripcionEquipo").value = descripcionEquipoI;
            document.getElementById("maquina").value = maquinaI;
            
        });
        //let userData = await response.json();

      });




document.addEventListener("DOMContentLoaded", function(){
    // hacemos un select a los datos que vienen del controlador 
    $('#tecnicoEncargado').select2();
    $('#txtSupervisadoPor').select2();
    $('#SolicitadoPor').select2();


    $('#codigoEquipo').select2({
        //primero validar si se selecciono el checkbox checkCodigo
        placeholder: 'Buscar Codigo Equipo',
        minimumInputLength: 5,
        delay: 250,
        ajax: {
            url: base_url+'Otrabajo/buscarCodigoDisponible',
            dataType: 'json',
            //delay: 250, 
            data: function (params) {  
                console.log(params);        
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }    
    });  



    tablaInsumosOT = $('#myTableInsumo').DataTable(
        {
            retrieve: true,
            paging: false,
            paging: false,
            searching: false,
            info: false,
            
        });
    $("#insumosOT").select2({
        //language:"es",
        closeOnSelect: false,
        //placeholder: 'Buscar Concepto',
        minimumInputLength: 3,
        //allowClear: true,
        //delay: 250,
        ajax: {
            url: base_url + 'ConceptosOT/buscarInsumos',
            dataType: 'json',
            //delay: 250, 
            data: function (params) {
                
                console.log(params);        
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#ConceptoTrabajo').select2({
        //language:"es",
        //closeOnSelect: false,
        placeholder: 'Buscar Concepto',
        minimumInputLength: 2,
        //allowClear: true,
        delay: 250,
        ajax: {
            url: base_url + 'ConceptosOT/buscarConcepto',
            dataType: 'json',
            //delay: 250, 
            data: function (params) {
                
                console.log(params);        
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
  
    $('#refCotizacion').select2({
        placeholder: 'Buscar Cotizacion',
        minimumInputLength: 3,
        //delay: 250,
        ajax: {
            url: base_url + 'Otrabajo/buscarCotizacion',
            dataType: 'json',
            //delay: 250, 
            data: function (params) {
                
                console.log(params);        
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }    
    });
    $('#Proveedor').select2({
        placeholder: 'Buscar Proveedor',
        minimumInputLength: 3,
        delay: 250,
        ajax: {
            url:  base_url+ 'Otrabajo/buscarProveedor',
            dataType: 'json',
            //delay: 250, 
            data: function (params) {
                
                console.log(params);        
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                console.log(data);
                return {
                    results: data
                };
            },
            cache: true
        }    
    });
    $('#Producto').select2({
        placeholder: 'Buscar Producto',
        minimumInputLength: 4,
        delay: 250,
        ajax: {
            url: base_url + 'Otrabajo/buscarProductoOT',
            dataType: 'json',
            //delay: 250, 
            data: function (params) {
                
                console.log(params);        
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }    
    });

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
                //console.log(this.responseText);    
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

    $('#añadirDetalleTrabajo').click(function() {
        if ($('#nroOrdenTrabajo').val() === '' ||
        $('#ruc').val() === '' ||
        $('#Proveedor').val() === null ||
        $('#ConceptoTrabajo').val() === null ||
        $('#tecnicoEncargado').val() === null ||
        $('#txtTipoDocumento').val() === 'SELECCIONE' ||
        $('#precio').val() === '' ||
        $('#cantidad').val() === '' ||
        $('#txtTipoDocumento').val() === 'SELECCIONE') {
        // Muestra una alerta si alguno de los campos está vacío
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Por favor, completa todos los campos antes de añadir un detalle.',
        });
        } else {
            var nroOrdenTrabajo = $('#nroOrdenTrabajo').val();
            var ruc = $('#ruc').val(); 
            var proveedor = $('#Proveedor').select2('data')[0].text;        
            var trabajo_realizado = $('#ConceptoTrabajo').select2('data')[0].text;        
            var tecnico_trabajo = $('#tecnicoEncargado').val();
            var tipoDcto = $('#txtTipoDocumento').val();
            var precio = $('#precio').val();
            var cantidad = $('#cantidad').val();
            var igv = $('#igv').val();
            // Condición para calcular subTotal en función de tipoDcto
            if (tipoDcto === 'FACTURA') {
                igv = (precio * cantidad * 0.18).toFixed(2); 
            } else if (tipoDcto === 'RECIBO HONORARIO') {
                igv = 0;
            }
            console.log(trabajo_realizado);
            var newRow = $('<tr/>').append(
                $('<td/>').append(
                    $('<input/>').addClass('form-control').val(nroOrdenTrabajo).attr('readonly', true),
                ),
                $('<td/>').append(
                    $('<input/>').addClass('form-control').val(ruc).attr('readonly', true),
                ),
                $('<td/>').append(
                    $('<input/>').addClass('form-control').val(proveedor),
                ),
                $('<td/>').append(
                    $('<input/>').addClass('form-control').val(trabajo_realizado,),
                ),
                $('<td/>').append(
                    $('<input/>').addClass('form-control').val(tecnico_trabajo),
                ),
                $('<td/>').append(
                    $('<input/>').addClass('form-control').val(tipoDcto),
                ),
                $('<td/>').append(
                    $('<input/>').addClass('form-control').val(precio),
                ),
                $('<td/>').append(
                    $('<input/>').addClass('form-control').val(cantidad),
                ),
                $('<td/>').append(
                    $('<input/>').addClass('form-control').val(igv),
                ),
                $('<td/>').append(
                    $('<button/>').addClass('btn btn-danger').text('Eliminar').click(function() {
                    $(this).parent().parent().remove();
                    })
            ));
            $('#myTableTrabajo tbody').append(newRow);
            // Limpia los campos de entrada
            $('#ConceptoTrabajo').empty();
            $('#ruc').val('');
            $('#Proveedor').empty().val(null).trigger('change');
            //$('#Proveedor').prop('selectedIndex', 0).trigger('change');
            //$('#selectName option').remove(); // clear all values 
            //$('#tecnicoEncargado').val('SELECCIONE').trigger('change');
            $('#tecnicoEncargado').select2("val","").trigger('change');
            $('#txtTipoDocumento').val('SELECCIONE');
            $('#precio').val('');
            $('#cantidad').val('');
            $('#igv').val('');
            
       
        }
        
       

    });

});

document.getElementById('checkOrdenTrabajo').addEventListener('change', function() {
    if(this.checked) {
        document.getElementById('nroReporte').value = "S/N";
        document.getElementById('serieEquipo').value = "S/N";
        document.getElementById('nroGuiaOC').value = "S/N";
        document.getElementById('nroTicket').value = "S/N";
    } else {
        document.getElementById('nroReporte').value = "";
        document.getElementById('serieEquipo').value = "";
        document.getElementById('nroGuiaOC').value = "";
        document.getElementById('nroTicket').value = "";
    }
});
/*
function agregarDetalleTrabajo(){
        var nroOrdenTrabajo = $('#nroOrdenTrabajo').val();
        var ruc = $('#ruc').val(); 
        var proveedor = $('#Proveedor').select2('data')[0].text;        
        var trabajo_realizado = $('#ConceptoTrabajo').select2('data')[0].text;        
        var tecnico_trabajo = $('#tecnicoEncargado').val(); 
        var tipoDcto = $('#txtTipoDocumento').val();
        var precio = $('#precio').val();
        var cantidad = $('#cantidad').val();
        var igv = $('#igv').val();
        // Condición para calcular subTotal en función de tipoDcto
        if (tipoDcto === 'FACTURA') {
            igv = precio * cantidad * 0.18; 
        } else if (tipoDcto === 'RECIBO HONORARIO') {
            igv = 0;
        }
        var newRow = $('<tr/>').append(
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(nroOrdenTrabajo).attr('readonly', true),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(ruc).attr('readonly', true),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(proveedor),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(trabajo_realizado,),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(tecnico_trabajo),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(tipoDcto),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(precio),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(cantidad),
            ),
            $('<td/>').append(
                $('<input/>').addClass('form-control').val(igv),
            ),
            $('<td/>').append(
                $('<button/>').addClass('btn btn-danger').text('Eliminar').click(function() {
                $(this).parent().parent().remove();
                })
        ));
        $('#myTableTrabajo tbody').append(newRow);
        // Limpia los campos de entrada
        $('#nroOrdenTrabajo').val('');
        $('#ruc').val('');
        $('#Proveedor').val(null).trigger('change');
        $('#ConceptoTrabajo').val(null).trigger('change');
        $('#tecnicoEncargado').val('');
        $('#txtTipoDocumento').val('');
        $('#precio').val('');
        $('#cantidad').val('');
        $('#igv').val('');
}
*/


function limpiarDetalle(){
    $('#nroOrdenTrabajo').val('');
    $('#ruc').val('');
    $('#Proveedor').val(null).trigger('change');
    $('#ConceptoTrabajo').empty().val(null).trigger('change');
    $('#tecnicoEncargado').val('');
    
    $('#txtTipoDocumento').val('SELECCIONE');
    $('#precio').val('');
    $('#cantidad').val('');
    $('#igv').val('');
    
}