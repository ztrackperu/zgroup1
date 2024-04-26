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

        $data = $this->model->getMaximoConcepto();
        $resultado = json_decode($data);
        $resultado = $resultado->data;
        $resultado =[
            "id" =>$resultado->id,
            "codigo" =>$resultado->codigo
        ];
        $this->views->getView($this, "crear",$resultado);
     
    }

    public function listar()
    {
        $data = $this->model->getConceptos();
        $resultado = json_decode($data);
        $resultado = $resultado->data;
        
        foreach($resultado as $item){
            //enlazar a vista desde controlador php
            //<div class='col-lg-4'><a class='dropdown-item' style='background-color: red;color:white' href='".base_url."ConceptosOT/Asignar/".$item->id."'>A</a></div>
            if ($item->estado == 1) {
                $item->estado= "<span class='badge badge-success'>Activo</span>";
                $item->acciones="<div class='row' style='width: 140px;'>
                    <div class='col-lg-4'>
                    <button class='btn btn-dark' onclick='btnEditarConcepto(" . $item->id . ")'><i class='fa fa-key'></i>M</button></div><div class='col-lg-4'>
                    <button class='btn btn-primary' type='button' onclick='btnEliminarConcepto(" . $item->id . ");'><i class='fa fa-pencil-square-o'></i>E</button></div>
                    <div class='col-lg-4'><button class='btn btn-success' type='button' onclick='btnAsignarInsumoConcepto(" . $item->id . ");'><i class='fa fa-pencil-square-o'></i>A</button></div>
                    </div>
                    ";
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

    public function Asignar($data)
    {
        if($data==""){
            $data="ok";
        }else{
            $data = $this->model->editarConcepto($data);
 
        }
        //$data = $this->model->editarConcepto($data);

        //pedir con metodo get la data 
        /*
        $data = $this->model->getMaximoConcepto();
        $resultado = json_decode($data);
        $resultado = $resultado->data;
        $resultado =[
            "id" =>$resultado->id,
            "codigo" =>$resultado->codigo
        ];
        */
        $resultado =" estoy en asignar";
        //echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        //die();
        $this->views->getView($this, "asignar",$data);  
    }
    public function buscarConcepto()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarConcepto($valor);
            $resultado = json_decode($data);
            $resultado = $resultado->data;
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function buscarInsumos()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarInsumos($valor);
            $resultado = json_decode($data);
            $resultado = $resultado->data;
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function agregarInsumo()
    {
        //recibir json desde js
        $datosRecibidos = file_get_contents("php://input");
        //$resultado = $_POST['data'];
        //echo json_encode($datosRecibidos, JSON_UNESCAPED_UNICODE);
        $resultado1 = json_decode($datosRecibidos);
        $resultado = $resultado1->data;
        //creo un objeto
        $objetov =[
            "data" =>$resultado
        ];
        $data = $this->model->validarInsumos($objetov);
        $resultado2 = json_decode($data);
        $resultado3 = $resultado2->data;
        //aqui debemos pasar los datos 
        foreach($resultado3 as $item){
            //$cadena =  "('".  strtoupper($item->IN_CODI)."')"   ;
            //$cadena ='"locura"';
            $cadena ='"'.$item->IN_CODI.'"';
            $item->acciones= "<button class='btn btn-danger' type='button' onclick='btnEliminarInsumo(" . $cadena .")'><i class='fa fa-pencil-square-o'></i>X</button>";
            //$item->acciones= "<button class='btn btn-danger' type='button' onclick='btnEliminarInsumo(" . $cadena .")'><i class='fa fa-pencil-square-o'></i>X</button>";
            
            $item->cantidad="<div >
            <input id='insumo_".$item->IN_CODI."' class='form-control' type='text' name='insumo_".$item->IN_CODI."' value=1 style='width: 80px;'required>
            </div>";
            
        }
        echo json_encode($resultado3, JSON_UNESCAPED_UNICODE);        
        die();
    }
    public function registrarAsignacion()
    { 
        //forma de recibir un json desde js     
        $datosRecibidos = file_get_contents("php://input");
        //$resultado = $_POST['data'];
        //echo json_encode($datosRecibidos, JSON_UNESCAPED_UNICODE);
        $resultado1 = json_decode($datosRecibidos);
        $resultado = $resultado1->data;
        $id = $resultado1->id-1000;
        $objetov =[
            "insumos" =>$resultado
        ];
        $data = $this->model->actualizarConcepto($id,$objetov);


        $resultado2 = json_decode($data);
        $resultado3 = $resultado2->data;
        if($resultado3=="ok"){
            //nos vamos al inicio
            //$this->views->getView($this, "index");  
            //die();
            $msg = array('msg' => 'Asignacion exitosa ', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Verifica las cantidades a asignar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);        
        die();
    }  

    public function nuevaSeleccion($id){
        $data = $this->model->editarConcepto($id);
        $resultado = json_decode($data);
        $resultado = $resultado->data->insumos;
        //aqui debemos tratar la informacion
        if($resultado!=""){
            foreach($resultado as $item){
                //$cadena =  "('".  strtoupper($item->IN_CODI)."')"   ;
                //$cadena ='"locura"';
                $cadena ='"'.$item->IN_CODI.'"';
                $item->acciones= "<button class='btn btn-danger' type='button' onclick='btnEliminarInsumo(" . $cadena .")'><i class='fa fa-pencil-square-o'></i>X</button>";
                //$item->acciones= "<button class='btn btn-danger' type='button' onclick='btnEliminarInsumo(" . $cadena .")'><i class='fa fa-pencil-square-o'></i>X</button>";
                
                $item->cantidad="<div >
                <input id='insumo_".$item->IN_CODI."' class='form-control' type='text' name='insumo_".$item->IN_CODI."' value=".$item->cantidad." style='width: 80px;'required>
                </div>";
                
            }
        }else{
            $resultado=="";
        }

        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        die();
    }
    //http://161.132.206.104:8000/concepto_ot/ConceptoPeriodo/
    public function ConceptoPeriodo( )
    {
        $datosRecibidos = file_get_contents("php://input");
        $resultado1 = json_decode($datosRecibidos);
        $objetov =[
            "descripcion" =>$resultado1->concepto
        ];
         //echo var_dump($resultado1->concepto) ;
        //echo var_dump($objetov);
        $data = $this->model->ConceptoPeriodo($objetov);
        //echo $resultado[0]->total[0]->total;
        //echo $data;
        $resultado = json_decode($data);
        /*
        $resultado = $resultado->data;
        $resultado =[
            "id" =>$resultado->id,
            "codigo" =>$resultado->codigo
        ];
        */
        //echo var_dump($resultado[0]->total[0]->total);
        
        $periodo = ["2015","2016","2017","2018","2019","2020","2021","2022","2023","2024"];
        //echo "oli";
        $total = [$resultado[0]->total[0]->total];
        if(empty($resultado[0]->A2015[0]->A2015)){
            $dat1 =0;
        }else{
            $dat1 =$resultado[0]->A2015[0]->A2015;
        }
        if(empty($resultado[0]->A2016[0]->A2016)){
            $dat2 =0;
        }else{$dat2 =$resultado[0]->A2016[0]->A2016;}
        if(empty($resultado[0]->A2017[0]->A2017)){$dat3 =0;}else{$dat3 =$resultado[0]->A2017[0]->A2017;}
        if(empty($resultado[0]->A2018[0]->A2018)){$dat4 =0;}else{$dat4 =$resultado[0]->A2018[0]->A2018;}
        if(empty($resultado[0]->A2019[0]->A2019)){$dat5 =0;}else{$dat5 =$resultado[0]->A2019[0]->A2019;}
        if(empty($resultado[0]->A2020[0]->A2020)){$dat6 =0;}else{$dat6 =$resultado[0]->A2020[0]->A2020;}
        if(empty($resultado[0]->A2021[0]->A2021)){$dat7 =0;}else{$dat7 =$resultado[0]->A2021[0]->A2021;}
        if(empty($resultado[0]->A2022[0]->A2022)){$dat8 =0;}else{$dat8 =$resultado[0]->A2022[0]->A2022;}
        if(empty($resultado[0]->A2023[0]->A2023)){$dat9 =0;}else{$dat9 =$resultado[0]->A2023[0]->A2023;}
        if(empty($resultado[0]->A2024[0]->A2024)){$dat10 =0;}else{$dat10 =$resultado[0]->A2024[0]->A2024;}     
        $data = [
            $dat1,$dat2,$dat3,$dat4, $dat5,$dat6,$dat7,$dat8, $dat9,$dat10
        ];
        $objetoT = [
            "periodo"=>$periodo ,
            "data"=>$data ,
            "total"=>$total
        ];
        /*
        $data = [
            //$resultado[0]->total[0]->total,
            if(empty($resultado[0]->A2015[0]->A2015){0}else{$resultado[0]->A2015[0]->A2015},
            $resultado[0]->A2016[0]->A2016,
            $resultado[0]->A2017[0]->A2017,
            $resultado[0]->A2018[0]->A2018,
            $resultado[0]->A2019[0]->A2019,
            $resultado[0]->A2020[0]->A2020,
            $resultado[0]->A2021[0]->A2021,
            $resultado[0]->A2022[0]->A2022,
            $resultado[0]->A2023[0]->A2023,
            $resultado[0]->A2024[0]->A2024
        ];
        $objetov =[
            $resultado[0]->total[0],
            $resultado[0]->A2015[0],
            $resultado[0]->A2016[0],
            $resultado[0]->A2017[0],
            $resultado[0]->A2018[0],
            $resultado[0]->A2019[0],
            $resultado[0]->A2020[0],
            $resultado[0]->A2021[0],
            $resultado[0]->A2022[0],
            $resultado[0]->A2023[0],
            $resultado[0]->A2024[0]

        ];
        */
        
        
        //echo var_dump($resultado[0]);
        echo json_encode($objetoT, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function Analisis( )
    {
        //echo "oli analisis";
        $this->views->getView($this, "analisis");

    }
}
