<?php include "Views/templates/navbar.php";  ?>
<?php //var_dump($data);
//echo $data->numOT;
?>

<?php $resultado=json_encode($data);
//echo $resultado;
$resultado1=json_decode($resultado);
//$resultado1=json_decode($data);
?>

<?php 
//$resultado2=json_decode($resultado1);
//echo $resultado1->c_numot;
?>
<?php

$str = '<br/><div class="container"><h1 class="text-center"> Nro OT - '. $resultado1->c_numot.' | Ref. Cotizacion '. $resultado1->c_refcot.'</h1>' .'<div class="container-fluid" style="border: 1px solid #cecece;">'. '<br/><div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Nro de Guia/OC</label>' .
        '<div class="col-sm-4">' .$resultado1->nro_guia.'</div>' .
        '<label for="" class="col-sm-2 col-form-label">Nro de Reporte</label>' .
        '<div class="col-sm-4">' .$resultado1->c_numeroReporte.'</div>' .
        '</div>' .
        '<div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Serie de Equipo</label>' .
        '<div class="col-sm-4">' .$resultado1->c_serieEquipo.'</div>' .
        '<label for="" class="col-sm-2 col-form-label">Nro de Ticket</label>' .
        '<div class="col-sm-4">' .$resultado1->nro_ticket.'</div>' .
        '</div>' .
        '<div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Solicitado por</label>' .
        '<div class="col-sm-4">' .$resultado1->c_solicita.'</div>' .
        '<label for="" class="col-sm-2 col-form-label">Supervisado por</label>' .
        '<div class="col-sm-4">' .$resultado1->c_supervisa.'</div>' .
        '</div>' .
        '<div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Codigo Equipo</label>' .
        '<div class="col-sm-4">' .$resultado1->unidad.'</div>' .
        '<label for="" class="col-sm-2 col-form-label">Usuario</label>' .
        '<div class="col-sm-4">' .$resultado1->c_usrcrea.'</div>' .
        '</div>' .
        '<div class="mb-3 row">' .
        '<label for="" class="col-sm-2 col-form-label">Lugar Trabajo</label>' .
        '<div class="col-sm-4">'.$resultado1->c_lugartab.'</div>' .
        '<label for="" class="col-sm-2 col-form-label">Descripcion Equipo</label>' .
        '<div class="col-sm-4">'.$resultado1->c_desequipo.'</div>' .
        '</div>'.
        '</div></br>'. '<h2 class="text-center">Detalle de OT :</h2>' .'<table class="table table-bordered  m-3 p-3 t-3">' .
        '<thead class="thead-dark">' .
          '<tr>'.
            '<th scope="col">#</th>'.
            '<th scope="col">N° Orden de Trabajo</th>'.
            '<th scope="col">RUC</th>'.
            '<th scope="col">Proveedor</th>'.
            '<th scope="col">Trabajo Realizado</th>'.
            '<th scope="col">Tecnico Encargado</th>'.
            '<th scope="col">Documento</th>'.
            '<th scope="col">Monto Unitario</th>'.
            '<th scope="col">Cantidad </th>'.
            '<th scope="col">IGV</th>'.
            '<th scope="col">Subtotal</th>'.
          '</tr>' .
        '</thead>' .
        '<tbody>' ;
        $DetalleOT = $resultado1->DetalleOT;
        foreach($DetalleOT as $det){
            $str .=
            '<tr>' .
              '<td>'.$det->n_id.'</td>'.
              '<td>'.$det->c_numot.'</td>'.
              '<td>'.$det->c_rucprov.'</th>'.
              '<td>'.$det->c_nomprov.'</td>'.
              '<td>'.$det->concepto.'</td>'.
              '<td>'.$det->c_tecnico.'</td>'.
              '<td>'.$det->tdoc.'</td>'.
              '<td>'.$det->monto.'</td>'.
              '<td>'.$det->n_cant .'</td>'.
              '<td>'.$det->n_igvd.'</td>'.
              '<td>'.$det->n_totd.'</td>'.   
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
      $solicitud= $resultado1->solicitudes[0]->solicitud;
    if(count($solicitud)!=0){   
        foreach($solicitud as $det){
            $str .=
            '<tr>' .
                '<td>'.$det->IN_CODI.'</th>' .
                '<td>'.$det->IN_ARTI.'</td>' .
                '<td>'.$det->IN_UVTA.'</td>' .
                '<td>'.$det->stock.'</td>' .
                '<td>'.$det->cantidadUsar.'</td>' .        
            '</tr>' ;
        }
    }else{
        $str .='<tr><h3 class="text-center">Sin datos asigandos</h3>' .'</tr>' ;
    }
      $str .=
      '</tbody>' .
    '</table></div>';
echo $str ;
?>

<?php include "Views/templates/footer.php"; ?>