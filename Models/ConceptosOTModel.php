<?php
class ConceptosOTModel extends Query
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
    public function getConceptos()
    {
        //conexion a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function getMaximoConcepto()
    {
        //conexion a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/maximo/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function ListaUnidadMedida()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/ListaUnidadMedida");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function ListaSolicitanteOT()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/ListaSolicitanteOT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function ListaSupervisadoOT()
    {
        //consulta externa 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/ListaSupervisadoOT");
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

    public function accionConcepto($estado, $id)
    {
        echo 'eliminando';
    }

    public function editarConcepto($id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/".$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    public function registrarConcepto($data)
    {
        $ch = curl_init();
        $data =json_encode($data);
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    } 
    public function validarConcepto($data)
    {
        $ch = curl_init();
        $data =json_encode($data);
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/validar/");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }
    //actualizarConcepto
    public function actualizarConcepto($id,$data)
    {
        $ch = curl_init();
        $data =json_encode($data);
        curl_setopt($ch, CURLOPT_URL, urlapi."/concepto_ot/".$id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    } 
    public function buscarAutor($valor)
    {
        $sql = "SELECT id, autor AS text FROM autor WHERE autor LIKE '%" . $valor . "%'  AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;

        #establecer una consulta a conceptos que haga una busqueea regex de los 10 primeros
    }
}