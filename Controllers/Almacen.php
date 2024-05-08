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
        $data['ListarTareas'] = $this->model->listarTareas();
    
        if($_SESSION['id_usuario']==1){
            $data['obtenerUsuarios'] =  $this->model->allUsuarios();
        }else{
            $data['obtenerUsuarios'] =  $this->model->obtenerUsuarios($_SESSION['usuario']);
        }
        $this->views->getView($this, "solicitudes",$data);
    }
    public function dataTareas(){
        $data = $this->model->listarTareas();
        echo $data;
        die();
    }
    public function listarTareas(){
        date_default_timezone_set('America/Lima');
        $dataJson = $this->model->listarTareas();
        $data = json_decode($dataJson);
        $cards = '';
        /*
        foreach($data as $detalle){
            $solicitud .= $detalle->numSolicitud;
        }
        */
        if($_SESSION['estadoC']==1){
            foreach ($data as $i => $detalle) {  
                $fechaActual = date('Y-m-d H:i:s'); 
                $fecha = isset($detalle->fechaS) ? $detalle->fechaS : '0000-00-00 00:00:00';
                $cnumot = isset($detalle->c_numot) ? $detalle->c_numot : '000000';
                $trabajo = isset($detalle->Trabajo) ? $detalle->Trabajo : 'generico';
        
                $fechaTarea = strtotime($fecha);
                $diferencia = strtotime($fechaActual) -$fechaTarea;
                $diferenciaEnMinutos = $diferencia / 60;
                $alertClass = '';
                if($diferenciaEnMinutos >= 0 && $diferenciaEnMinutos <= 10) {
                    $alertClass = 'alert-success';
                } else if($diferenciaEnMinutos > 10 && $diferenciaEnMinutos <= 30) {
                    $alertClass = 'alert-warning';
                } else if($diferenciaEnMinutos > 30) {
                    $alertClass = 'alert-danger';
                }
        
                $cards .= '<div class="card mb-3 activo">
                    <div class="card-header '.$alertClass.'">
                        Tarea
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">OT: '.$cnumot.'</h5>
                        <p class="card-text">SOLICITUD: '.$detalle->numSolicitud.'</p>
                        <p class="card-text">TRABAJO: '.$trabajo.'</p>
                        <p class="card-text">FECHA: '.$fecha.'</p>
                        <button class="btn btn-primary mb-2" type="button" onclick="atenderTarea()">ATENDER</button>
                        <button class="btn btn-primary mb-2" type="button" onclick="asignacionTarea('.$detalle->numSolicitud.')">ASIGNAR</button>
                    </div>
                </div>';
            }   
        }
        echo $cards;
        die();
    }
    public function asignarTarea(){
        // Recuperar el ID del usuario desde la solicitud POST
        $usuarioD = $_POST['usuarioD'];
        $idSolicitud = $_POST['idSolicitud'];
        /*
        // Obtener las tareas
        $tareas = $this->model->listarTareas();
        //array_push($tareas, "idSolicitud", $idSolicitud, "asignado_a", $usuarioD);

        // Buscar la tarea con el idSolicitud y asignarle el usuarioD
        for ($i = 0; $i < count($tareas); $i++) {
            if ($tareas[$i]['idSolicitud'] == $idSolicitud) {
                $tareas[$i]['asignado_a'] = $usuarioD;
            }
        }
        $_SESSION['tareas'] = $tareas;
        
        return $tareas;
        */
        echo $usuarioD;
        echo $idSolicitud;
    }
}
