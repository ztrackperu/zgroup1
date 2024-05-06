$(document).ready(function() {
    const url = base_url + "Almacen/listarTareas";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                const datos = JSON.parse(this.responseText);
                console.log(datos);
            } else {
                console.error("Error al obtener datos:", this.status);
            }
        }
    };
    http.onerror = function () {
        console.error("Error de red al realizar la solicitud.");
    };
    http.send();
});

function asignacionTarea(){
    $('#asignacionTarea').modal('show');
}

function asignacionEstadoC(){
    $('#asignacionEstadoC').modal('show');
}

