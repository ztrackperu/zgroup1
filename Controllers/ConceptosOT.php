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

    public function crearOT(){
        $this->views->getView($this, "crear");
    }

    public function listar()
    {
        $data = $this->model->getConceptos();
        $resultado = json_decode($data);
        $resultado = $resultado->data;
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
                $item->acciones="<div>
                <button class='btn btn-primary' type='button' onclick='btntReingresoConcepto(" . $item->id . ");'><i class='fa fa-pencil-square-o'></i>R</button>           
                </div>";
            }
        }
     

        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id)
    {
        //pasar un objeto con campoestado :0
        $objeto =[
            "estado" =>0
        ];
        $data = $this->model->actualizarConcepto($id,$objeto);
        $resultado = json_decode($data);
        $resultado = $resultado->data;
        if($resultado=="ok"){
            $msg = array('msg' => 'Concepto Eliminado', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al Actualizar Concepto', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id)
    {
        //pasar un objeto con campoestado :0
        $objeto =[
            "estado" =>1
        ];
        $data = $this->model->actualizarConcepto($id,$objeto);
        $resultado = json_decode($data);
        $resultado = $resultado->data;
        if($resultado=="ok"){
            $msg = array('msg' => 'Concepto Reincorporado', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al Reincorporar Concepto', 'icono' => 'error');
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
        $descripcion_concepto = strClean($_POST['descripcion_concepto']);
        $codigo_concepto = strClean($_POST['codigo_concepto']);
        $id = strClean($_POST['id']);
        if ($id == "") {
            #construir el objeto
            $objetov =[
                "descripcion" =>$descripcion_concepto
            ];
            $objeto =[
                "id" =>intval($codigo_concepto-1000),
                "codigo" =>intval($codigo_concepto),
                "descripcion" =>$descripcion_concepto,
                "estado" =>1
            ];
            #validar que no haya duplicado
            $data = $this->model->validarConcepto($objetov);
            $resultado = json_decode($data);
            $resultado = $resultado->data;
            if($resultado=="ok"){
                #Procedo a guardar
                $data = $this->model->registrarConcepto($objeto);
                $resultado = json_decode($data);
                $resultado = $resultado->data;
                if($resultado=="ok"){
                    $msg = array('msg' => 'Concepto registrado', 'icono' => 'success');
                }else{
                    $msg = array('msg' => 'Error al Registar Concepto', 'icono' => 'error');
                }

                $msg = array('msg' => 'Concepto registrado', 'icono' => 'success');
            }else{
                $msg = array('msg' => 'El Concepto ya existe', 'icono' => 'warning');
            }

        }else{
            $objetoA =[
                "descripcion" =>$descripcion_concepto,
            ];
            //pedir el objeto que hace referencia a ese id 
            $val = $this->model->editarConcepto($id);
            $resultado = json_decode($val);
            $comparador = $resultado->data->descripcion;
            if($comparador==$descripcion_concepto){
                $msg = array('msg' => 'No haz realizado ninguna modificacion', 'icono' => 'error');
            }else{
                $data = $this->model->validarConcepto($objetoA);
                $resultado = json_decode($data);
                $resultado = $resultado->data;
                if($resultado=="ok"){
                    $data = $this->model->actualizarConcepto($id,$objetoA);
                    $resultado = json_decode($data);
                    $resultado = $resultado->data;
                    if($resultado=="ok"){
                        $msg = array('msg' => 'Concepto Actualizado', 'icono' => 'success');
                    }else{
                        $msg = array('msg' => 'Error al Actualizar Concepto', 'icono' => 'error');
                    }

                }else{
                    $msg = array('msg' => 'concepto ya existe', 'icono' => 'error');
                }

            }
        } 
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);

        die();
    }
    public function maximo( )
    {
        $data = $this->model->getMaximoConcepto();
        $resultado = json_decode($data);
        $resultado = $resultado->data;
        $resultado =[
            "id" =>$resultado->id,
            "codigo" =>$resultado->codigo
        ];
        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        die();
    }

}
