<?php
class AdminPageModel extends Query{
    protected $id, $nombre, $telefono, $direccion, $correo, $img;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectConfiguracion()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }

    public function verificarPermisos($id_user, $permiso)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'";
        $existe = $this->select($sql);
        if ($existe != null || $existe != "") {
            $tiene = true;
        }
        return $tiene;
    }

    public function validarCamposCorreoYClave($id_user) {
        //$sql = "SELECT * FROM usuarios WHERE id = $id_user AND (email = '' OR pass_email = '')";
        $sql = "SELECT * FROM usuarios WHERE id = $id_user";
        $res = $this->select($sql);
        if (!$res['email'] ||!$res['pass_email']) {
            return true; //  // El usuario tiene los campos correo_usuario y clave_correo vacios
        }else {
        return false; // El usuario tiene los campos correo_usuario o clave_correo llenos
        }
    }
    public function actualizarcorreo($email ,$pass_email,$id){
        $query = "UPDATE usuarios SET email = ? ,pass_email = ?WHERE id = ?";
        $datos= array($email ,$pass_email,$id); 
        $data = $this->save($query, $datos);
        if ($data) {
            $res = "ok";
        }else{
            $res="fail";
        }
        return $res;
    }
    public function insertarRespuesta($id, $correo_usuario, $clave_correo, $usuario_activo)
    {
        


        $query = "UPDATE INTO usuarios(email, pass_email) VALUES (?,?)";
        $datos = array($id, $correo_usuario, $clave_correo, $usuario_activo);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
            $nuevo_estado = 0;
            $estado_anterior = 1; // Reemplaza 'nuevo_estado' con el valor deseado del nuevo estado
            $query_actualizar_estado = "UPDATE formulario SET estado = ? WHERE id = ?";
            $datos_actualizar_estado = array($nuevo_estado, $id); // Reemplaza 'alguna_condicion' con la condición adecuada para actualizar el estado en la otra tabla
            $data_actualizar_estado = $this->save($query_actualizar_estado, $datos_actualizar_estado);

            if ($data_actualizar_estado != 1) {
                // Hubo un error al actualizar el estado en la otra tabla
                $res = "error al actualizar estado en otra_tabla";
            }
        } else {
            $res = "error";
        }

        return $res;
    }

    public function notificacionesOT(){
        
        $arrayNotificaciones = array(
        array(  
            'ot' => 1000128181,
            'trabajo' => "REEFER 20V LUMINARIA",
            'idSolicitud' => 10012,
            'user' =>  "Almacen",
            'estado' => 0,
            'hora' => '2024-05-03 11:47:00'
        ), 
        array(
            'ot' => 1000128432,
            'trabajo' => "REEFER 40V LUMINARIA",
            'idSolicitud' => 10013,
            'user' =>  "Almacen2",
            'estado' => 1,
            'hora' => '2024-05-03 14:30:00'
        ), 
        array(
            'ot' => 1000158741,
            'trabajo' => "REEFER 60V LUMINARIA",
            'idSolicitud' => 10014,
            'user' =>  "Almacen3",
            'estado' => 0,
            'hora' => '2024-05-03 09:30:00'
        ), 
        array(
            'ot' => 1000123781,
            'trabajo' => "REEFER 80V LUMINARIA",
            'idSolicitud' => 10015,
            'user' =>  "Almacen4",
            'estado' => 0,
            'hora' => '2024-05-03 09:32:00'
        ), 
        array(
            'ot' => 1000124516,
            'trabajo' => "REEFER 100V LUMINARIA",
            'idSolicitud' => 10016,
            'user' =>  "Almacen5",
            'estado' => 0,
            'hora' => '2024-05-03 09:35:00'
        ),
        array(
            'ot' => 1000151478,
            'trabajo' => "REEFER 120V LUMINARIA",
            'idSolicitud' => 10017,
            'user' =>  "Almacen6",
            'estado' => 0,
            'hora' => '2024-05-03 14:00:00'
        )


        );

        return $arrayNotificaciones;
    }

}
