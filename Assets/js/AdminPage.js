function alertas(msg, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
}

function createAndAppendDiv(id, contenido, alertClass) {
    let newDiv = document.createElement("div");
    newDiv.classList.add('alert', alertClass, 'alert-dismissible','show');
    newDiv.innerHTML = contenido;
    document.getElementById(id).style.display = 'block';
    document.getElementById(id).appendChild(newDiv);
    console.log(newDiv);
}

//Peticion a controlador
document.addEventListener("DOMContentLoaded", function(){
    setInterval(function(){
        const url = base_url + "AdminPage/notificacionesOT";
        const http = new XMLHttpRequest();
        let fecha = new Date();
        let year = fecha.getFullYear();
        let month = ("0" + (fecha.getMonth() + 1)).slice(-2); 
        let day = ("0" + fecha.getDate()).slice(-2);
        let hours = ("0" + fecha.getHours()).slice(-2);
        let minutes = ("0" + fecha.getMinutes()).slice(-2);
        let seconds = ("0" + fecha.getSeconds()).slice(-2);
        let obtenerFecha = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
        http.open("GET", url, true);
        http.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    const datos = JSON.parse(this.responseText);
                    // Limpia el contenido antes de agregar nuevos divs
                    document.getElementById('errorAlert').innerHTML = '';
                    document.getElementById('warningAlert').innerHTML = '';
                    document.getElementById('successAlert').innerHTML = '';
                    // Itera sobre los datos
                    for(let i = 0; i < datos.length; i++) {
                        let contenido = `Solicitud: ${datos[i].idSolicitud} | ot: ${datos[i].ot} | trabajo: ${datos[i].trabajo} | Fecha: ${datos[i].hora};`;
                        let fechaDatos = new Date(datos[i].hora);
                        let fechaObtener = new Date(obtenerFecha);
                        let diferencia = (fechaObtener - fechaDatos) / (1000 * 60);
                    
                        if(diferencia > 60 && datos[i].estado == 1) {
                            createAndAppendDiv('errorAlert', contenido, 'alert-danger');
                        } else if(diferencia > 30 && datos[i].estado == 1) {
                            createAndAppendDiv('warningAlert', contenido, 'alert-warning');
                        } else if(diferencia <= 10 && datos[i].estado == 1) {
                            createAndAppendDiv('successAlert', contenido, 'alert-success');
                        }
                    }
                } else {
                    console.error("Error al obtener datos:", this.status);
                }
            }
        };
        /*
        --PRIMERA FORMA MOSTRANDO LOS DATOS DEDE LA CONSOLA

        http.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    const datos = JSON.parse(this.responseText);
                    console.log(datos);
                    console.log(obtenerFecha);
                    // Itera sobre los datos
                    for(let i = 0; i < datos.length; i++) {
                        // Comprueba si el estado es 1
                        if(datos[i].estado == 1) {
                            // Muestra el elemento
                            console.log(datos[i]);
                            //alertas("Tienes una OT pendiente", "info");
                        }
                    }
                } else {
                    console.error("Error al obtener datos:", this.status);
                }
            }
        };*/
        http.send();
    }, 5000); // 5 segundos

});

$(document).ready(function () {
        //registrarRespuesta();
        const url = base_url + "AdminPage/validarCamposCorreoYClave";
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    const datos = JSON.parse(this.responseText);
                    console.log(datos);
                    if(datos === true){
                        $('#emailModal').modal('show'); // Muestra el modal
                    }else{
                        $('#emailModal').modal('hide'); // Oculta el modal
                    }
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

function registrarRespuesta() {
    
    const url = base_url + "AdminPage/validarCorreo";
    const frm = document.getElementById("frmRegistrar");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if(res.icono=="success"){
                    $("#emailModal").modal("hide");
                }
                console.log(res);
                frmRegistrar.reset();
                alertas(res.msg, res.icono);
        }
    }
}
