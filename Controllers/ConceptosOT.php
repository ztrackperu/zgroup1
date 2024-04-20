<?php
class ConceptosOT extends Controller
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
        $perm = $this->model->verificarPermisos($id_user, "ConceptosOT");
        if (!$perm && $id_user != 1) {
            // no tines permiso 
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "listar");
    }
    public function crear()
    {
        $data['ListaUnidadMedida'] =  $this->model->ListaUnidadMedida();
        $data['ListaSolicitanteOT'] =  $this->model->ListaSolicitanteOT();
        $data['ListaSupervisadoOT'] =  $this->model->ListaSupervisadoOT();
        $this->views->getView($this, "crear",$data);
    }

    public function listar()
    {
        $data = $this->model->getConceptos();
        $resultado = json_decode($data);
        /*
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';

            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Eliminado</span>';
            }
        }
        */
        foreach($resultado as $item){
            if ($item->estado == 1) {
                $item->estado= "<span class='badge badge-success'>Activo</span>";
                $item->acciones="ok";

            } else {
                $item->estado = "span class='badge badge-danger'>Eliminado</span>";
                $item->acciones="fail";
            }

        }
        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        die();
    }

}
