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

      
      $('#concepto2').select2({
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
    $("#insumosL").select2({
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


// para borrar lo cargado de forma predefinada 
$('.form-control-concepto').on('select2:open', function (e) { 
    $('.form-control-concepto').val(null).trigger('change');
});


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
function registrarConceptoVista(e) {
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
                const res = this.responseText;
                console.log(res)
                // Redirige a otra vista en lugar de ocultar el modal y resetear el formulario
                window.location.href = base_url + "ConceptosOT/";
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



  function formatRepo (repo) {
    if (repo.loading) {
      return repo.text;
    }
  
    var $container = $(
      "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
        "<div class='select2-result-repository__meta'>" +
          "<div class='select2-result-repository__title'></div>" +
          "<div class='select2-result-repository__description'></div>" +
          "<div class='select2-result-repository__statistics'>" +
            "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
            "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
            "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
          "</div>" +
        "</div>" +
      "</div>"
    );
  
    $container.find(".select2-result-repository__title").text(repo.full_name);
    $container.find(".select2-result-repository__description").text(repo.description);
    $container.find(".select2-result-repository__forks").append(repo.forks_count + " Forks");
    $container.find(".select2-result-repository__stargazers").append(repo.stargazers_count + " Stars");
    $container.find(".select2-result-repository__watchers").append(repo.watchers_count + " Watchers");
  
    return $container;
  }
  
  function formatRepoSelection (repo) {
    return repo.full_name || repo.text;
  }

  function tomarInsumos(){
    variable = $('#insumosL').select2('data');
    //console.log(variable);
    var http = new XMLHttpRequest();
    var url = base_url + "ConceptosOT/agregarInsumo";
    //http.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    http.open("POST", url, true);
    http.send(JSON.stringify({data:variable}));
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) { 
        //limpiar select 2
        $('#insumosL').val(null).trigger('change');
        //console.log(JSON.parse(http.responseText));
        resul = JSON.parse(http.responseText);
        var tablaInsumos = $('#myTableInsumo').DataTable();
        contInsumos = tablaInsumos.rows().count();
        if(contInsumos==0){
            tablaInsumos.destroy();
            console.log("esta vacio");
            var table = $('#myTableInsumo').DataTable({
                paging: false,
                searching: true,
                info: false,
                data: resul,
                columns: [
                  { title: "Codigo", data: "IN_CODI" },
                  { title: "Descripcion", data: "IN_ARTI" },
                  { title: "Unidad", data: "IN_UVTA" },
                  { title: "Cantidad", data: "cantidad" },
                  { title: "Eliminar", data: "acciones" }
                ]
              });
            //canti = table.rows().count();
            //console.log(canti);
        }else{
            //aqui debe agregar la data 
            //primero comparar con la ya agregada 
            //tomamos la agregada 
            datosya =[]
            let rows = tablaInsumos.rows(
                //(idx, data) => data.location === 'Edinburgh'
                (idx, data) => datosya.push(data.IN_CODI) 
                //(idx, data) => datosya.push(data) 

            );
            //datos ya contiene la informacion de los que ya existen
            //console.log(datosya)
            //comparamos con los datos que tenemos
            //console.log(resul);
            sinrepetiones=[];
            for(let i=0;i<resul.length;i++){
                let element = resul[i].IN_CODI;
                //console.log(element);
                if(datosya.includes(element)){
                    //console.log(`coincide '${element}'`);
                }else{
                    //console.log(`No coincide '${element}'`);
                    sinrepetiones.push(resul[i]) ;
                }
            }
            console.log("hay data");
            //aqui se guardan los elementos listo pa ser agregados 
            console.log(sinrepetiones);
            for(let i=0;i<sinrepetiones.length;i++){
                tablaInsumos.row.add(
                    //{ tamano: tamano, nombre: nombre }
                    {
                        IN_CODI: sinrepetiones[i].IN_CODI,
                        IN_ARTI: sinrepetiones[i].IN_ARTI,
                        IN_UVTA: sinrepetiones[i].IN_UVTA,
                        cantidad: sinrepetiones[i].cantidad,
                        acciones: sinrepetiones[i].acciones, 
                    }
                
                ).draw(false);
            }
        }
        

        }
    }
}
