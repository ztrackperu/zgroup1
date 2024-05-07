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


function asignacionTarea() {
    $('#asignacionTarea').modal('show');
}

function asignarTarea(event) {
    event.preventDefault();
    const usuarioD = $('#usuarioD').val();
    console.log(typeof usuarioD);
    console.log('Valor enviado:', usuarioD);
    $.ajax({
        url: base_url + "Almacen/asignarTarea",
        method: 'POST',
        data: {
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
}
