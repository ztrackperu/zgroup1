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
        curl_setopt($ch, CURLOPT_URL, urlapi2."/ot/".$id);
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

    
    public function testJSON()
    {
        $res = [
            "Id" => 28327, 
            "c_numot" => 1000028228, 
            "c_desequipo" => "CONTENEDOR REEFER 40 RH SEGUNDO USO - FF", 
            "unidad" => "ZGRU870118-5", 
            "d_fecdcto" => "07/03/2024", 
            "c_codmon" => 0, 
            "c_treal" => "INSTALACION", 
            "c_asunto" => "ASIGNAR Y DESPACHAR/ 10020240580 - 10020240574/	SEED FOOD SOCIEDAD ANONIMA CERRADA	ALQUILER DE CONTENEDORES REEFER 40RH", 
            "c_supervisa" => "MATUMAY GOMEZ MARIO ALBERTO BARUT", 
            "c_solicita" => "MATUMAY GOMEZ MARIO ALBERTO BARUT", 
            "c_lugartab" => "ALMACEN ZGROUP", 
            "c_ejecuta" => "NAVARRO AYALA, ALBERT JOHANN", 
            "d_fecentrega" => "07/03/2024", 
            "c_usrcrea" => "ACHIPANA", 
            "d_fcrea" => "07/03/2024", 
            "d_fmod" => "08/03/2024", 
            "c_estado" => 1, 
            "c_refcot" => [
                  "numberLong" => "10020240580" 
               ], 
            "c_osb" => "10MTR DE CABLE VULCANIZADO 4X10", 
            "n_swtapr" => 0, 
            "c_nroreporte" => 28631, 
            "c_serieequipo" => "E001031945", 
            "add1" => 0, 
            "add2" => 0, 
            "h_inicio" => "12:35:43", 
            "programado" => 0, 
            "ejecutado" => 0, 
            "nro_guia" => "S/N", 
            "nro_ticket" => "S/N", 
            "DetalleOt" => [
                     [
                        "Id" => 50100, 
                        "c_numot" => 1000028228, 
                        "n_id" => 1, 
                        "c_rucprov" => [
                           "numberLong" => "20521180774" 
                        ], 
                        "c_nomprov" => "ZGROUP S.A.C.", 
                        "concepto" => "INSTALACION ASIGNAR Y DESPACHAR/ 10020240580 - 10020240574/	SEED FOOD SOCIEDAD ANONIMA CERRADA	ALQUILER DE CONTENEDORES REEFER 40RH", 
                        "tdoc" => "FACTURA", 
                        "monto" => 1, 
                        "n_cant" => 1, 
                        "n_igvd" => "0,17", 
                        "n_totd" => "1,18", 
                        "montop" => 1, 
                        "c_tecnico" => "NAVARRO AYALA, ALBERT JOHANN" 
                     ] 
                  ], 
            "Notas" => [
                              [
                                 "NT_NDOC" => "S0026875", 
                                 "NT_TDOC" => "S", 
                                 "NT_TRAN" => 10, 
                                 "NT_REMI" => "¥0010028228", 
                                 "NT_TREM" => "¥", 
                                 "NT_SERIR" => 1, 
                                 "NT_DOCR" => 28228, 
                                 "NT_CCLI" => "CLI00000298", 
                                 "NT_FDOC" => "3/7/2024", 
                                 "NT_ESTA" => 3, 
                                 "NT_TIPO" => "C", 
                                 "NT_FREG" => "3/8/2024", 
                                 "NT_OPER" => "ASISTALMACEN", 
                                 "n_idreg" => 46345, 
                                 "n_id" => 48045, 
                                 "NT_TCAMB" => 0, 
                                 "NT_MONE" => 0, 
                                 "NT_SWOC" => 0, 
                                 "NT_FGUI" => "3/7/2024", 
                                 "NT_CTR" => [
                                    "numberLong" => "20521180774" 
                                 ], 
                                 "NT_GTR" => "¥/0010028228", 
                                 "NT_CLAPC" => "P", 
                                 "NT_GPRV" => "¥0010028228", 
                                 "NT_DATE" => "3/8/2024 10:58", 
                                 "NT_TITRA" => "F", 
                                 "NT_MONEG" => 0, 
                                 "NT_MONTO" => 0, 
                                 "NT_ESTIBA" => 0, 
                                 "c_codcia" => "01", 
                                 "c_codtda" => "000", 
                                 "c_codalm" => 1, 
                                 "c_codalm_d" => "ALMDES", 
                                 "c_NumOT" => 1000028228, 
                                 "NT_RESPO" => "NAVARRO AYALA, ALBERT JOHANN", 
                                 "c_motivo" => "ENTREGA", 
                                 "DetalleNota" => [
                                       [
                                          "NT_NDOC" => "S0026875", 
                                          "NT_TDOC" => "S", 
                                          "NT_CART" => "INDND0906", 
                                          "NT_CUND" => "UND", 
                                          "NT_CANT" => 1, 
                                          "NT_PREC" => 0, 
                                          "NT_COST" => 0, 
                                          "NT_FREG" => "3/8/2024", 
                                          "NT_OPER" => "ASISTALMACEN", 
                                          "n_idreg" => 46345, 
                                          "n_id" => 129262, 
                                          "NT_TMOV" => "C", 
                                          "NT_FLETE" => 0, 
                                          "c_codcia" => "01", 
                                          "c_codtda" => "000", 
                                          "c_codalm" => "000001", 
                                          "c_producto" => "010", 
                                          "n_preciocost" => 0, 
                                          "n_preciovta" => 0 
                                       ], 
                                       [
                                             "NT_NDOC" => "S0026875", 
                                             "NT_TDOC" => "S", 
                                             "NT_CART" => "INDND0885", 
                                             "NT_CUND" => "UND", 
                                             "NT_CANT" => 6, 
                                             "NT_PREC" => 0, 
                                             "NT_COST" => 0, 
                                             "NT_FREG" => "3/8/2024", 
                                             "NT_OPER" => "ASISTALMACEN", 
                                             "n_idreg" => 46345, 
                                             "n_id" => 129263, 
                                             "NT_TMOV" => "C", 
                                             "NT_FLETE" => 0, 
                                             "c_codcia" => "01", 
                                             "c_codtda" => "000", 
                                             "c_codalm" => "000001", 
                                             "c_producto" => "010", 
                                             "n_preciocost" => 0, 
                                             "n_preciovta" => 0 
                                          ], 
                                       [
                                                "NT_NDOC" => "S0026875", 
                                                "NT_TDOC" => "S", 
                                                "NT_CART" => "INDND2936", 
                                                "NT_CUND" => "UND", 
                                                "NT_CANT" => 8, 
                                                "NT_PREC" => 0, 
                                                "NT_COST" => 0, 
                                                "NT_FREG" => "3/8/2024", 
                                                "NT_OPER" => "ASISTALMACEN", 
                                                "n_idreg" => 46345, 
                                                "n_id" => 129264, 
                                                "NT_TMOV" => "C", 
                                                "NT_FLETE" => 0, 
                                                "c_codcia" => "01", 
                                                "c_codtda" => "000", 
                                                "c_codalm" => "000001", 
                                                "c_producto" => "010", 
                                                "n_preciocost" => 0, 
                                                "n_preciovta" => 0 
                                             ], 
                                       [
                                                   "NT_NDOC" => "S0026875", 
                                                   "NT_TDOC" => "S", 
                                                   "NT_CART" => "INDND0210", 
                                                   "NT_CUND" => "UND", 
                                                   "NT_CANT" => 1, 
                                                   "NT_PREC" => 0, 
                                                   "NT_COST" => 0, 
                                                   "NT_FREG" => "3/8/2024", 
                                                   "NT_OPER" => "ASISTALMACEN", 
                                                   "n_idreg" => 46345, 
                                                   "n_id" => 129265, 
                                                   "NT_TMOV" => "C", 
                                                   "NT_FLETE" => 0, 
                                                   "c_codcia" => "01", 
                                                   "c_codtda" => "000", 
                                                   "c_codalm" => "000001", 
                                                   "c_producto" => "010", 
                                                   "n_preciocost" => 0, 
                                                   "n_preciovta" => 0 
                                                ], 
                                       [
                                                      "NT_NDOC" => "S0026875", 
                                                      "NT_TDOC" => "S", 
                                                      "NT_CART" => "RNDND0198", 
                                                      "NT_CUND" => "UND", 
                                                      "NT_CANT" => 1, 
                                                      "NT_PREC" => 0, 
                                                      "NT_COST" => 0, 
                                                      "NT_FREG" => "3/8/2024", 
                                                      "NT_OPER" => "ASISTALMACEN", 
                                                      "n_idreg" => 46345, 
                                                      "n_id" => 129266, 
                                                      "NT_TMOV" => "C", 
                                                      "NT_FLETE" => 0, 
                                                      "c_codcia" => "01", 
                                                      "c_codtda" => "000", 
                                                      "c_codalm" => "000001", 
                                                      "c_producto" => "010", 
                                                      "n_preciocost" => 0, 
                                                      "n_preciovta" => 0 
                                                   ], 
                                       [
                                                         "NT_NDOC" => "S0026875", 
                                                         "NT_TDOC" => "S", 
                                                         "NT_CART" => "RNDND0254", 
                                                         "NT_CUND" => "UND", 
                                                         "NT_CANT" => 1, 
                                                         "NT_PREC" => 0, 
                                                         "NT_COST" => 0, 
                                                         "NT_FREG" => "3/8/2024", 
                                                         "NT_OPER" => "ASISTALMACEN", 
                                                         "n_idreg" => 46345, 
                                                         "n_id" => 129267, 
                                                         "NT_TMOV" => "C", 
                                                         "NT_FLETE" => 0, 
                                                         "c_codcia" => "01", 
                                                         "c_codtda" => "000", 
                                                         "c_codalm" => "000001", 
                                                         "c_producto" => "010", 
                                                         "n_preciocost" => 0, 
                                                         "n_preciovta" => 0 
                                                      ], 
                                       [
                                                            "NT_NDOC" => "S0026875", 
                                                            "NT_TDOC" => "S", 
                                                            "NT_CART" => "INDND1008", 
                                                            "NT_CUND" => "UND", 
                                                            "NT_CANT" => 10, 
                                                            "NT_PREC" => 0, 
                                                            "NT_COST" => 0, 
                                                            "NT_FREG" => "3/8/2024", 
                                                            "NT_OPER" => "ASISTALMACEN", 
                                                            "n_idreg" => 46345, 
                                                            "n_id" => 129268, 
                                                            "NT_TMOV" => "C", 
                                                            "NT_FLETE" => 0, 
                                                            "c_codcia" => "01", 
                                                            "c_codtda" => "000", 
                                                            "c_codalm" => "000001", 
                                                            "c_producto" => "010", 
                                                            "n_preciocost" => 0, 
                                                            "n_preciovta" => 0 
                                                         ] 
                                    ] 
                              ] 
                           ] 
         ];  
        return $res;
    }

    
    
}