<?php
class Otrabajo extends Controller
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
        $perm = $this->model->verificarPermisos($id_user, "Movimientos");
        if (!$perm && $id_user != 1) {
            // no tines permiso 
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function crear()
    {
        $data['ListaUnidadMedida'] =  $this->model->ListaUnidadMedida();
        $data['ListaSolicitanteOT'] =  $this->model->ListaSolicitanteOT();
        $data['ListaSupervisadoOT'] =  $this->model->ListaSupervisadoOT();
        $this->views->getView($this, "crear",$data);
    }

    public function test()
    {
        $this->views->getView($this, "test");
    }

    
    public function testCorreo()
    {
        $datosRecibidos = file_get_contents("php://input");
        
        //echo json_decode($datosRecibidos) ;
        echo $datosRecibidos ;

        
    }

    

    public function listar()
    {
        $data = $this->model->getMovimientos();

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';

            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Eliminado</span>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}
