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
    //PROBANDO ANDO
    public function cargarTest(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urlapi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);   
        return $res;
    }

}