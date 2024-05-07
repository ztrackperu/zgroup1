<?php
class Almacen extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        // verificacion del permiso 
        $perm = $this->model->verificarPermisos($id_user, "Almacen");
        if (!$perm && $id_user != 1) {
            // no tines permiso 
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    /*public function index()
    {
        $this->views->getView($this, "listar");
    }*/

    public function Solicitudes(){
        if($_SESSION['id_usuario']==1){
            $data['obtenerUsuarios'] =  $this->model->allUsuarios();
        }else{
            $data['obtenerUsuarios'] =  $this->model->obtenerUsuarios($_SESSION['usuario']);
        }
        $this->views->getView($this, "solicitudes",$data);
    }
    public function listarTareas(){
        $data = $this->model->listarTareas();
        $cards = '';
        if($_SESSION['estadoC']==1){
            for ($i=0; $i < count($data); $i++) {  
                $cards .= '<div class="card mb-3 activo">
                    <div class="card-header">
                        Tarea
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">OT: '.$data[$i]['ot'].'</h5>
                        <p class="card-text">SOLICITUD: '.$data[$i]['idSolicitud'].'</p>
                        <p class="card-text">TRABAJO: '.$data[$i]['trabajo'].'</p>
                        <p class="card-text">FECHA: '.$data[$i]['hora'].'</p>
                        <button class="btn btn-primary mb-2" type="button" onclick="atenderTarea()">ATENDER</button>
                        <button class="btn btn-primary mb-2" type="button" onclick="asignacionTarea()">ASIGNAR</button>
                    </div>
                </div>';
            }   
        }else{
            // VALIDAR POR ID
            $cards .='<h2>No tienes tareas asignadas por el momento</h2>';
            /*
            for ($i=0; $i < count($data); $i++) {  
                $cards .= '<div class="card mb-3 activo">
                    <div class="card-header">
                        Tarea
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">OT: '.$data[$i]['ot'].'</h5>
                        <p class="card-text">SOLICITUD: '.$data[$i]['idSolicitud'].'</p>
                        <p class="card-text">TRABAJO: '.$data[$i]['trabajo'].'</p>
                        <p class="card-text">FECHA: '.$data[$i]['hora'].'</p>
                        <button class="btn btn-primary mb-2" type="button" onclick="atenderTarea()">ATENDER</button>
                    </div>
                </div>';
            }   */
        }
        echo $cards;
        die();
    }
    public function asignarTarea(){
        // Recuperar el ID del usuario desde la solicitud POST
        $usuarioD = $_POST['usuarioD'];
    
        // Obtener las tareas
        $tareas = $this->model->listarTareas();

        // Recorrer las tareas hasta encontrar una no asignada
        foreach ($tareas as &$tarea) {
            if ($tarea['asignado_a'] === null) {
                // Asignar la tarea al usuario
                $tarea['asignado_a'] = $usuarioD;

                echo 'Tarea asignada con éxito';
                
                return;
            }
        }

        echo 'No hay tareas disponibles para asignar';
        }
}
