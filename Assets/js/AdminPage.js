function alertas(msg, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
}


$(document).ready(function () {
        registrarRespuesta();
        const url = base_url + "AdminPage/validarCamposCorreoYClave";
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    const datos = JSON.parse(this.responseText);
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
                console.log(res);
                frm.reset();
                alertas(res.msg, res.icono);
        }
    }
}
