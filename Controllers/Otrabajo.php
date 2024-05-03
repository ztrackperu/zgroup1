<?php

/*DOM PDF*/

require_once "Config/Config.php";
require_once "Config/Helpers.php";
//require_once "vendor/autoload.php";


//use Dompdf\Dompdf;

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
    // GENERAR PDF
    public function generarPDF($param){ 
        

        $numot="";
        $data="";
        if($param!=""){
            $pros = explode("/",$param);
            $numot=procesarNumOT($pros[0]);
            $data = $this->model->consultarOT($numot);
           // ob_start();
            // Carga la vista con los datos
            //$this->views->getView($this, "pdf",$data="");
            // Obtiene el contenido del búfer y lo limpia
            //$htmlContent = ob_get_clean();
            //$htmlContent = $this->crearreporte($data);

            
            // Crea el PDF con Dompdf
            /*
            $dompdf = new Dompdf();
            $dompdf->loadHtml($htmlContent);
            $dompdf->setPaper('A4', 'landscape');
            header('Content-Type: application/pdf');
            $dompdf->render();
            $dompdf->stream($numot.".pdf", ['Attachment' => false]);
            */
            $htmlContent = aspectoPDFoT($data);
            procesarPdf($htmlContent,$numot);
            exit(0);
            //$dompdf->render();
            //$dompdf->stream();
            //$data=json_decode($data);
        }
        //echo json_encode($data, JSON_UNESCAPED_UNICODE);
        //die();

        //$data = $this->model->cargarTest(); 

    }    

    public function crear()
    {
        //$data['ListaUnidadMedida'] =  $this->model->ListaUnidadMedida();
        $data['ListaSolicitanteOT'] =  $this->model->ListaSolicitanteOT();
        $data['ListaSupervisadoOT'] =  $this->model->ListaSupervisadoOT();

        $data['ListaTecnicoOT'] =  $this->model->ListaTecnicoOT();
        $data['ListaPlazoM'] =  $this->model->ListaPlazoM();
        $data['ListaFormaPagoM'] =  $this->model->ListaFormaPagoM();
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
    
    public function consultarOT($param)
    {
        //evaluar el parametro 
        $numot="";
        $data="";
        if($param!=""){
            $pros = explode("/",$param);
            $numot=procesarNumOT($pros[0]);
            $data = $this->model->consultarOT($numot);
            $data=json_decode($data);
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function testEstatica($param)
    {
        //$this->views->getView($this, "test");
        //evaluar el parametro 
        $numot="";
        $data="";
        if($param!=""){
            $pros = explode("/",$param);
            $numot=procesarNumOT($pros[0]);
            $data = $this->model->consultarOT($numot);
            $data=json_decode($data);
        }
        //echo json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->views->getView($this, "pdf",$data);

        
    }
    public function buscarCotizacion($param)
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarCotizacion($valor);
            $resultado = json_decode($data);
            $resultado = $resultado->data;
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function buscarProveedor($param)
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarProveedor($valor);
            $resultado = json_decode($data);
            $resultado = $resultado->data;
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function buscarProductoOT($param)
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarProductoOT($valor);
            $resultado = json_decode($data);
            $resultado = $resultado->data;
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
// esto se usara para devolver la informacion de la API
    public function buscarCodigo($param)
    {
        if ($param!="") {
            //$valor = $_GET['q'];
            $data = $this->model->buscarCodigo($param);
            //$resultado = json_decode($data[0]);
            //$resultado = $resultado->c_idequipo;
            //tratar la informacion de la API
            //echo json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $data;
            die();
        }
    }

    
    public function buscarCodigoAlquilerVenta($param)
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarCodigoAlquilerVenta($valor);
            $resultado = json_decode($data);
            $resultado = $resultado->data;
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    
    public function buscarCodigoDisponible($param)
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarCodigoDisponible($valor);
            $resultado = json_decode($data);
            $resultado = $resultado->data;
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function InsumosConsumir($id){
        $data = $this->model->ConceptoStockValidado($id);
        //var_dump($data);
        $resultado = json_decode($data);
        $resultado = $resultado->data->insumos;
        //aqui debemos tratar la informacion
        if($resultado!=""){
            $i=1;
            foreach($resultado as $item){
                //$cadena =  "('".  strtoupper($item->IN_CODI)."')"   ;
                //$cadena ='"locura"';
                $cadena ='"'.$item->IN_CODI.'"';
                $item->id =$i ; 
                $item->acciones= "<button class='btn btn-danger' type='button' onclick='btnEliminarInsumo(" . $cadena .")'><i class='fa fa-pencil-square-o'></i>X</button>";
                //$item->acciones= "<button class='btn btn-danger' type='button' onclick='btnEliminarInsumo(" . $cadena .")'><i class='fa fa-pencil-square-o'></i>X</button>";
                //.$item->cantidad. va internamente como cantidad 
                //$item->stock ="10";
                $readonly="";
                if($item->stock=="0"){
                    $readonly ='readonly';
                }
                $item->cantidadUsar="<div >
                <input id='insumo_".$item->IN_CODI."' class='form-control' type='text' name='insumo_".$item->IN_CODI."' value='0' style='width: 80px;' " .$readonly." required>
                </div>";
                $i++;
                
            }
        }else{
            $resultado=="";
        }

        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function agregarInsumoOT()
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
        $data = $this->model->validarInsumosOT($objetov);
        $resultado2 = json_decode($data);
        $resultado3 = $resultado2->data;
        //aqui debemos pasar los datos 
        if($resultado3!=""){

            foreach($resultado3 as $item){
                //$cadena =  "('".  strtoupper($item->IN_CODI)."')"   ;
                //$cadena ='"locura"';
                $cadena ='"'.$item->IN_CODI.'"';
                $item->acciones= "<button class='btn btn-danger' type='button' onclick='btnEliminarInsumo(" . $cadena .")'><i class='fa fa-pencil-square-o'></i>X</button>";
                //$item->acciones= "<button class='btn btn-danger' type='button' onclick='btnEliminarInsumo(" . $cadena .")'><i class='fa fa-pencil-square-o'></i>X</button>";
                //.$item->cantidad. va internamente como cantidad 
                //$item->stock ="10";
                $item->cantidad ="-";
                $readonly="";
                $value =1 ;
                if($item->stock=="0"){
                    $readonly ='readonly';
                    $value=0;
                }
                $item->cantidadUsar="<div >
                <input id='insumo_".$item->IN_CODI."' class='form-control' type='text' name='insumo_".$item->IN_CODI."' value='".$value."' style='width: 80px;' " .$readonly." required>
                </div>";

                
            }
        }else{
            $resultado3=="";
        }
        echo json_encode($resultado3, JSON_UNESCAPED_UNICODE);        
        die();
    }
    //preVistaOT
    public function preVistaOT(){

        $datosRecibidos = file_get_contents("php://input");

        $resultado1 = json_decode($datosRecibidos);
        //$resultado = $resultado1->data;
        echo json_encode($resultado1, JSON_UNESCAPED_UNICODE);        
        die();

    }
    
    
   


}
