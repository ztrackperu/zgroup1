document.addEventListener("DOMContentLoaded", function(){
    $.ajax({
        url: base_url + "Almacen/listarTareas",
        type: 'GET',
        success: function(response) {
            $('#tarjeta').html(response);
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
});
//ABRE MODAL
function asignacionTarea(numSolicitud) {
    const http = new XMLHttpRequest();
    const url = base_url+'Almacen/dataTareas';
    http.open("GET", url);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const data = JSON.parse(this.responseText);
            //console.log(data);
            $('#asignacionTarea').modal('show');
            let input = document.getElementById('solicitud');
            input.value = numSolicitud;
        }
    }
}
//FUNCION ASIGNAR TAREA
function asignarTarea(event) {
    event.preventDefault();
    const idSolicitud = $('#solicitud').val();
    const usuarioD = $('#usuarioD').val();
    console.log(typeof usuarioD);
    console.log('Valor enviado:', idSolicitud);
    console.log('Valor enviado:', usuarioD);
    $.ajax({
        url: base_url + "Almacen/asignarTarea",
        method: 'POST',
        data: {
            idSolicitud: idSolicitud,
            usuarioD: usuarioD
        },
        success: function(response) {
            console.log(response);
            $('#asignacionTarea').modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
    });
}

function atenderTarea() {
    console.log('Atendiendo tarea...');
    const http = new XMLHttpRequest();
    const url = base_url+'Almacen/dataTareas';
    http.open("GET", url);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const data = JSON.parse(this.responseText);
            console.log(data);  // Imprime el objeto data en la consola
            $('#atenderTarea').modal('show');
            let input = document.getElementById('numSolicitud');
            input.value = numSolicitud;
        }
    }
}