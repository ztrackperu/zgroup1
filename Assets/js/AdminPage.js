function alertas(msg, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
}
//noti
noti = document.getElementById("noti");
max = '';
//funcion encargada de hacer peticion a la API
//PROMESAS PARA QUE EL VALOR SALGA DE LA FUNCION
function obtenerNotificaciones() {
    const url = base_url + "AdminPage/ListaNotificaciones";
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    console.log(res);
                    //busqueda cada minuto
                    //almacenar el maximo actual y cuando cambie el maximo actual volver a solicitar los datos
                    noti.innerHTML = res.html;
                    /*
                    for (let i = 0; i < res.length; i++) {
                        let obj = res[i];
                        //console.log(obj)
                        let div = document.createElement('div');
                        div.innerHTML = obj.html;
                        //max = obj.maximo;
                        //console.log(max);
                        noti.appendChild(div);
                    }*/
                    console.log(max);
                    max += res.maximo;
                    console.log(max);
                } else {
                    console.error("Error al obtener datos:", this.status);
                }
            }
        };
        http.onerror = function () {
            console.error("Error de red al realizar la solicitud.");
        };
        http.send();
        return max;
}
document.addEventListener("DOMContentLoaded", function(){
    $(document).ready(function () {
        //registrarRespuesta();
         // Notificaciones cuando se carga el DOM
         console.log(max);
         max1= obtenerNotificaciones();
         console.log(max1);

         // Actualizar notificaciones cada 60 segundos
         //setInterval(obtenerNotificaciones, 5000);
         setTimeout(function(){
            window.location = base_url + "AdminPage";       
        }, 100000);
    });
})

function todos(){
    document.querySelectorAll('.alert').forEach(elemento => {
        elemento.style.display = '';
    });
}

function almacen(){
    // Oculta todos los elementos
    document.querySelectorAll('.alert').forEach(elemento => {
        elemento.style.display = 'none';
    });
    // Muestra solo los elementos con id='almacen'
    document.querySelectorAll('.almacen').forEach(elemento => {
        elemento.style.display = '';
    });
}

function produccion(){
    document.querySelectorAll('.alert').forEach(elemento => {
        elemento.style.display = 'none';
    });
    document.querySelectorAll('.produccion').forEach(elemento => {
        elemento.style.display = '';
    });
}
function compras(){
    document.querySelectorAll('.alert').forEach(elemento => {
        elemento.style.display = 'none';
    });
    document.querySelectorAll('.compras').forEach(elemento => {
        elemento.style.display = '';
    });
}

function otros(){
    document.querySelectorAll('.alert').forEach(elemento => {
        elemento.style.display = 'none';
    });
    document.querySelectorAll('.otros').forEach(elemento => {
        elemento.style.display = '';
    });
}
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
