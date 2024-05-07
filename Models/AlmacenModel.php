<?php
class AlmacenModel extends Query
{
    private $usuario, $nombre, $clave, $id, $estado,$estadoC,$userCrea;
    public function __construct()
    {
        parent::__construct();
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
    public function listarTareas()
    {
        $arrayNotificaciones = array(
            array(  
                'ot' => 1000128181,
                'trabajo' => "REEFER 20V LUMINARIA",
                'idSolicitud' => 10012,
                'user' =>  "Almacen",
                'estado' => 1,
                'asignado_a' =>null,
                'hora' => '2024-05-03 11:47:00'
            ), 
            array(
                'ot' => 1000128432,
                'trabajo' => "REEFER 40V LUMINARIA",
                'idSolicitud' => 10013,
                'user' =>  "Almacen2",
                'estado' => 1,
                'asignado_a' =>null,
                'hora' => '2024-05-03 14:30:00'
            ), 
            array(
                'ot' => 1000158741,
                'trabajo' => "REEFER 60V LUMINARIA",
                'idSolicitud' => 10014,
                'user' =>  "Almacen3",
                'estado' => 1,
                'asignado_a' =>null,
                'hora' => '2024-05-03 09:30:00'
            ), 
            array(
                'ot' => 1000123781,
                'trabajo' => "REEFER 80V LUMINARIA",
                'idSolicitud' => 10015,
                'user' =>  "Almacen4",
                'estado' => 1,
                'asignado_a' =>null,
                'hora' => '2024-05-03 09:32:00'
            ), 
            array(
                'ot' => 1000124516,
                'trabajo' => "REEFER 100V LUMINARIA",
                'idSolicitud' => 10016,
                'user' =>  "Almacen5",
                'estado' => 1,
                'asignado_a' =>null,
                'hora' => '2024-05-03 09:35:00'
            ),
            array(
                'ot' => 1000151478,
                'trabajo' => "REEFER 120V LUMINARIA",
                'idSolicitud' => 10017,
                'user' =>  "Almacen6",
                'estado' => 1,
                'asignado_a' =>null,
                'hora' => '2024-05-03 14:00:00'
            )
            );
            return $arrayNotificaciones;
    }
  
    public function obtenerUsuarios($creador){
        $sql = "SELECT * FROM usuarios WHERE userCrea = '$creador'";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function allUsuarios(){
        $sql = "SELECT * FROM usuarios";
        $data = $this->selectAll($sql);
        return $data;
    }

}