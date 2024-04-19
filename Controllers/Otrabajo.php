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
        $ot = 1000028210;
        $data['ListaUnidadMedida'] =  $this->model->ListaUnidadMedida();
        $data['ListaSolicitanteOT'] =  $this->model->ListaSolicitanteOT();
        $data['ListaSupervisadoOT'] =  $this->model->ListaSupervisadoOT();
        $data['ListaFormaPagoM'] =  $this->model->ListaFormaPagoM();
        $data['ListaPlazoM'] =  $this->model->ListaPlazoM(); 
        $data['ListaConceptosOT'] =  $this->model->ListaConceptosOT();
        $data['ListaTecnicoOT'] =  $this->model->ListaTecnicoOT(); 
        $data['detaot'] =  $this->model->detaot($ot); 
        $data['notmae'] =  $this->model->notmae($ot); 
        $data['notas']= [];
        foreach(json_decode($data['notmae']) as $item){
            $detNota = $item->NT_NDOC ;      
            $tipoNota =$item->NT_TDOC;
            //echo $detNota;
            //$data['notas'].a $this->model->notmov($detNota);
            $info =$this->model->notmov($detNota);
            //array_push($data['notas'],2);
            foreach(json_decode($info) as $item1){
                array_push($data['notas'],$item1);
            }

        }
        //array_push($data['notas'],2);




        $this->views->getView($this, "crear",$data);
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
