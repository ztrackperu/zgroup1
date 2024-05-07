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
        echo json_encode($data);
    }
    public function listarTareas(){
        date_default_timezone_set('America/Lima');
        $dataJson = $this->model->listarTareas();
        $data = json_decode($dataJson); 
        //$data1 = json_decode($dataJson);
        //$datas = $data1->c_numot;
        $cards = '';
        if($_SESSION['estadoC']==1){
            //$x = "";
            //foreach($dataJson as $dat){
            //    $x .= $dat->c_numot;
           // }



            for ($i=0; $i < count($data); $i++) {  
                $fechaActual = date('Y-m-d H:i:s'); 

                $fechaTarea = strtotime($data[3]['fechaS']);
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
                        <h5 class="card-title">OT: '.$data[0]['c_numot'].'</h5>
                        <p class="card-text">SOLICITUD: '.$data[1]['numSolicitud'].'</p>
                        <p class="card-text">TRABAJO:</p>
                        <p class="card-text">FECHA: '.$data[3]['fechaS'].'</p>
                        <button class="btn btn-primary mb-2" type="button" onclick="atenderTarea()">ATENDER</button>
                        <button class="btn btn-primary mb-2" type="button" onclick="asignacionTarea('.$data[$i]['numSolicitud'].')">ASIGNAR</button>
                    </div>
                </div>';
                $datos = $data[3]['fechaS'];
            }   
            
        }
        echo cards;
        die();
    }
    public function asignarTarea(){
        // Recuperar el ID del usuario desde la solicitud POST
        $usuarioD = $_POST['usuarioD'];
        $idSolicitud = $_POST['idSolicitud'];
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
    }
}
