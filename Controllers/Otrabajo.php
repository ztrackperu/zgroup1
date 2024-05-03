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
        //$resultado1 = $resultado1->detalleOT;


        $str = '<h1 class="text-center"> Nro OT - PREVIO  | Ref. Cotizacion '. $resultado1->refCotizacion.'</h1>' .'<div class="container-fluid" style="border: 1px solid #cecece;">'. '<br/><div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Nro de Guia/OC</label>' .
        '<div class="col-sm-4">' .
            $resultado1->nroGuiaOC .
        '</div>' .
        '<label for="" class="col-sm-2 col-form-label">Nro de Reporte</label>' .
        '<div class="col-sm-4">' .
            $resultado1->nroReporte .
        '</div>' .
        '</div>' .
        '<div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Serie de Equipo</label>' .
        '<div class="col-sm-4">' .
            $resultado1->serieEquipo .
        '</div>' .
        '<label for="" class="col-sm-2 col-form-label">Nro de Ticket</label>' .
        '<div class="col-sm-4">' .
            $resultado1->nroTicket .
        '</div>' .
        '</div>' .
        '<div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Solicitado por</label>' .
        '<div class="col-sm-4">' .
            $resultado1->SolicitadoPor .
        '</div>' .
        '<label for="" class="col-sm-2 col-form-label">Supervisado por</label>' .
        '<div class="col-sm-4">' .
            $resultado1->txtSupervisadoPor .
        '</div>' .
        '</div>' .
        '<div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Codigo Equipo</label>' .
        '<div class="col-sm-4">' .
            $resultado1->codigoEquipo .
        '</div>' .
        '<label for="" class="col-sm-2 col-form-label">Usuario</label>' .
        '<div class="col-sm-4">' .
            $resultado1->usuario .
        '</div>' .
        '</div>' .
        '<div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Lugar Trabajo</label>' .
        '<div class="col-sm-4">' .
            $resultado1->lugarTrabajo .
        '</div>' .
        '<label for="" class="col-sm-2 col-form-label">Descripcion Equipo</label>' .
        '<div class="col-sm-4">' .
            $resultado1->descripcionEquipo .
        '</div>' .
        '</div>'.
        '</div></br>'. '<h2 class="text-center">Detalle de OT :</h2>' .'<table class="table table-bordered table-responsive m-3 p-3">' .
        '<thead class="thead-dark">' .
          '<tr>' .
            '<th scope="col">N° Orden de Trabajo</th>' .
            '<th scope="col">RUC</th>' .
            '<th scope="col">Proveedor</th>' .
            '<th scope="col">Trabajo Realizado</th>' .
            '<th scope="col">Tecnico Encargado</th>' .
            '<th scope="col">Documento</th>' .
            '<th scope="col">Monto Unitario</th>' .
            '<th scope="col">Cantidad </th>' .
            '<th scope="col">IGV</th>' .
            '<th scope="col">Subtotal</th>' .
        
          '</tr>' .
        '</thead>' .
        '<tbody>' ;
        $detalleOT = $resultado1->detalleOT;
        foreach($detalleOT as $det){
            $str .=
            '<tr>' .
              '<td>'. '-</td>' .
              '<td>'. $det->Ruc .'</th>' .
              '<td>'. $det->Proveedor .'</td>' .
              '<td>'. $det->Trabajo.'</td>' .
              '<td>'. $det->Tecnico.'</td>' .
              '<td>'. $det->Documento.'</td>' .
              '<td>'. $det->Monto.'</td>' .
              '<td>'. $det->Cantidad .'</td>' .
              '<td>'. $det->Igv.'</td>' .
              '<td>'. $det->Subtotal.'</td>' .
           
            '</tr>' ;

        }
        $str .=
        '</tbody>' .
      '</table>';
      //añadir los insumos establecidos

      $str.='<h2 class="text-center">Insumos/Herramientas Considerados :</h2>' .'<table class="table table-bordered  m-3 p-3 t-3">' .
      '<thead class="thead-dark">' .
        '<tr>' .
          '<th scope="col">Codigo</th>' .
          '<th scope="col">Descripcion</th>' .
          '<th scope="col">Medida</th>' .
          '<th scope="col">Stock</th>' .
          '<th scope="col">Solicitada</th>' .
        '</tr>' .
      '</thead>' .
      '<tbody>' ;
      $solicitud= $resultado1->solicitud;
    if(count($solicitud)!=0){   
        foreach($solicitud as $det){
            $str .=
            '<tr>' .
                '<td>'. $det->IN_CODI .'</th>' .
                '<td>'. $det->IN_ARTI .'</td>' .
                '<td>'. $det->IN_UVTA.'</td>' .
                '<td>'. $det->stock.'</td>' .
                '<td>'. $det->cantidadUsar.'</td>' .        
            '</tr>' ;

        }
    }else{
        $str .='<tr><h3 class="text-center">Sin datos asigandos</h3>' .'</tr>' ;
    }
      $str .=
      '</tbody>' .
    '</table>';


        $res =array(
            "data"=>$str
        );
        //$resultado = $resultado1->data;
        //echo json_encode($resultado1, JSON_UNESCAPED_UNICODE);   
        echo json_encode($res, JSON_UNESCAPED_UNICODE);        
     
        die();

    }
    //registrarOT
    public function registrarOT(){
        $datosRecibidos = file_get_contents("php://input");
        $resultado1 = json_decode($datosRecibidos);
        $solicitud =$resultado1->solicitud;
        //echo json_encode($resultado1, JSON_UNESCAPED_UNICODE);
        //echo json_encode($solicitud, JSON_UNESCAPED_UNICODE);  
        //consultar ultima OT
        //el inicio 
        //1001 000 001
        //concepto_ot/UltimaOT/    ultimaOT
        $data = $this->model->ultimaOT();
        $resultado = json_decode($data);
        //asi obtengo la ultima ot creada
        $ultimaOT = $resultado[0]->c_numot;
        if($ultimaOT<1001000001){
            $numOT = 1001000001;
        }else{
            $numOT = $ultimaOT+1;
        }

        $data1 = $this->model->UltimaSolicitud();
        $resultado1 = json_decode($data1);
        //asi obtengo la ultima ot creada
        $UltimaSolicitud = $resultado1[0]->solicitud_id;
        $numSolicitud = $UltimaSolicitud+1;
        
        //crear objeto a agregar en solicitud

        $objetoSolicitud =[
            "c_numot" =>$numOT,
            "numSolicitud"=>$numSolicitud,
            "estadoS"=>1,
            "fechaS"=>date("Y-m-d H:i:s"),
            "solicitud"=>$solicitud,
        ];
        //enviar a guardar
        $data2 = $this->model->GuardarSolicitud($objetoSolicitud);
        
        echo json_encode($objetoSolicitud, JSON_UNESCAPED_UNICODE);   
        die();

    }
    //Solicitud
    public function Solicitud($param){
        //evaluar el parametro 
        $numot="";
        $data="";
        if($param!=""){
            $pros = explode("/",$param);
            $numS=$pros[0];
            $data = $this->model->BuscarSolicitud($numS);
            $data=json_decode($data);
            $resultado = $data->data;
        }
        //echo json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->views->getView($this, "solicitud",$resultado);
    
    }
    
   


}

/*


{
    "_id": {
      "$oid": "662ab344999f7adfc92b90f4"
    },
    "Id": 28388,
    "c_numot": 1000028288,
    "c_desequipo": "CAJA ISOTERMICA 40 RH SEGUNDO USO",
    "unidad": "ZGRU874730-8",
    "d_fecdcto": "09/03/2024",
    "c_codmon": 0,
    "c_treal": "INSTALACIONES OTROS",
    "c_asunto": "INSTALACION DE LUMINARIAS, CIRCULINA Y CORTINAS CAJA ISOTERMICA 40 RH SEGUNDO USO  ZGRU874730-8",
    "c_supervisa": "MATUMAY GOMEZ MARIO ALBERTO BARUT",
    "c_solicita": "MATUMAY GOMEZ MARIO ALBERTO BARUT",
    "c_lugartab": "ALMACEN ZGROUP",
    "c_ejecuta": "NIMA GONZA DARWIN ALEXANDER",
    "d_fecentrega": "09/03/2024",
    "c_usrcrea": "ACHIPANA",
    "d_fcrea": "09/03/2024",
    "c_estado": 1,
    "c_refcot": {
      "$numberLong": "10020240771"
    },
    "n_swtapr": 0,
    "c_nroreporte": 28679,
    "c_serieequipo": "S/N",
    "add1": 0,
    "add2": 0,
    "h_inicio": "11:52:14",
    "programado": 0,
    "ejecutado": 0,
    "nro_guia": "S/N",
    "nro_ticket": "S/N",
    "DetalleOt": [
      {
        "Id": 50172,
        "c_numot": 1000028288,
        "n_id": 1,
        "c_rucprov": {
          "$numberLong": "20521180774"
        },
        "c_nomprov": "ZGROUP S.A.C.",
        "concepto": "INSTALACIONES OTROS INSTALACION DE LUMINARIAS, CIRCULINA Y CORTINAS CAJA ISOTERMICA 40 RH SEGUNDO USO  ZGRU874730-8",
        "tdoc": "FACTURA",
        "monto": 1,
        "n_cant": 1,
        "n_igvd": "0,17",
        "n_totd": "1,18",
        "montop": 1,
        "c_tecnico": "NIMA GONZA DARWIN ALEXANDER"
      }
    ],
    "Notas": []
  }

  */