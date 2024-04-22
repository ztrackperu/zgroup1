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
    /*
    public function crear()
    {
        $data['ListaUnidadMedida'] =  $this->model->ListaUnidadMedida();
        $data['ListaSolicitanteOT'] =  $this->model->ListaSolicitanteOT();
        $data['ListaSupervisadoOT'] =  $this->model->ListaSupervisadoOT();
        $this->views->getView($this, "crear",$data);
    }*/

    public function crearOT(){
        $this->views->getView($this, "crear");
    }

    public function listar()
    {
        $data = $this->model->getConceptos();
        $resultado = json_decode($data);
        $resultado = $resultado->data;
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
                $item->acciones="<div>
                    <button class='btn btn-dark' onclick='btnEditarConcepto(" . $item->id . ")'><i class='fa fa-key'></i>M</button>
                    <button class='btn btn-primary' type='button' onclick='btnEliminarConcepto(" . $item->id . ");'><i class='fa fa-pencil-square-o'></i>E</button>
                    <button class='btn btn-danger' type='button' onclick='btnAsignarConcepto(" . $item->id . ");'><i class='fa fa-trash-o'></i>A</button>
                    </div>";
            } else {
                $item->estado = "<span class='badge badge-danger'>Eliminado</span>";
            }
        }
     

        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar( $id)
    {
        $data = $this->model->accionConcepto(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Concepto dado de baja', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar( $id)
    {
        $data = $this->model->editarConcepto($id);
        $resultado = json_decode($data);
        $resultado = $resultado->data;
        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $conceptoOT = strClean($_POST['codigo_concepto']);
        $id = strClean($_POST['id']);

 
            if ($id == "") {
                $data = $this->model->registrarConcepto($conceptoOT);
                if ($data == "ok") {
                    $msg = array('msg' => 'Permiso registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'El Permiso ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            }else{
                $data = $this->model->modificarConcepto($conceptoOT,$id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Permiso modificado', 'icono' => 'success');
                }else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);

        die();
    }

}
