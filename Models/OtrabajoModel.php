<?php
class OtrabajoModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function verificarPermisos($id_user, $permiso)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'";
        $existe = $this->select($sql);
        if ($existe != null || $existe != "") {
            $tiene = true;
        }
        return $tiene;
    }
    public function getMovimientos()
    {
        $sql ="SELECT * FROM movimientos";
        $res = $this->selectAll($sql);       
        return $res;
    }
    public function ListaUnidadMedida()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/ListaUnidadMedida/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function ListaSolicitanteOT()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/ListaSolicitanteOT/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function ListaSupervisadoOT()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/ListaSupervisadoOT/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }

    public function cargarOT()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    //PROBANDO ANDO
    public function cargarTest(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    } 
    public function consultarOT($id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi1."/ot/".$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function buscarCotizacion($valor)
    {

        $ch = curl_init();
        $url_a =urlapi."/concepto_ot/buscarCotizacion/".$valor;
        curl_setopt($ch, CURLOPT_URL, $url_a);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function buscarProveedor($valor)
    {

        $ch = curl_init();
        $url_a =urlapi."/concepto_ot/buscarProveedor/".$valor;
        curl_setopt($ch, CURLOPT_URL, $url_a);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }

    public function buscarProductoOT($valor)
    {

        $ch = curl_init();
        $url_a =urlapi."/concepto_ot/buscarProductoOT/".$valor;
        curl_setopt($ch, CURLOPT_URL, $url_a);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }

    public function buscarCodigo($valor)
    {

        $ch = curl_init();
        $url_a =urlapi."/concepto_ot/ExtraerCodigo/".$valor;
        curl_setopt($ch, CURLOPT_URL, $url_a);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    //$data['ListaTecnicoOT'] =  $this->model->ListaTecnicoOT();
    //$data['ListaPlazoM'] =  $this->model->ListaPlazoM();
    //$data['ListaFormaPagoM'] =  $this->model->ListaFormaPagoM();
    
    public function ListaTecnicoOT()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/ListaTecnicoOT/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function ListaPlazoM()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/ListaPlazoM/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function ListaFormaPagoM()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/ListaFormaPagoM/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function buscarCodigoAlquilerVenta($valor)
    {

        $ch = curl_init();
        $url_a =urlapi."/concepto_ot/buscarCodigoAlquilerVenta/".$valor;
        curl_setopt($ch, CURLOPT_URL, $url_a);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function buscarCodigoDisponible($valor)
    {

        $ch = curl_init();
        $url_a =urlapi."/concepto_ot/buscarCodigoDisponible/".$valor;
        curl_setopt($ch, CURLOPT_URL, $url_a);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    //http://161.132.206.104:8000/concepto_ot/StockValidado/122
    public function ConceptoStockValidado($id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/StockValidado/".$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }

    public function validarInsumosOT($data)
    {
        $ch = curl_init();
        $data =json_encode($data);
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/validarInsumoOT/");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function ultimaOT()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/UltimaOT/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    //UltimaSolicitud
    public function UltimaSolicitud()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/UltimaSolicitud/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    //GuardarSolicitud

    public function GuardarSolicitud($data)
    {
        $ch = curl_init();
        $data =json_encode($data);
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/GuardarSolicitud/");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    //GuardarOTGENERAL
    public function GuardarOTGeneral($data)
    {
        $ch = curl_init();
        $data =json_encode($data);
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/GuardarOTGeneral/");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }

    //BuscarSolicitud
    //http://161.132.206.104:8000/concepto_ot/BuscarSolicitud/1000001
    public function BuscarSolicitud($valor)
    {
        $ch = curl_init();
        $url_a =urlapi."/concepto_ot/BuscarSolicitud/".$valor;
        curl_setopt($ch, CURLOPT_URL, $url_a);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    //http://161.132.206.104:8000/concepto_ot/MostrarOT/1001000046
    public function MostrarOT($valor)
    {
        $ch = curl_init();
        $url_a =urlapi."/concepto_ot/MostrarOT/".$valor;
        curl_setopt($ch, CURLOPT_URL, $url_a);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    
    
}