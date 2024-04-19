<?php
$codigoOt =0;
// valores predeterminados
$Id_cabpre="";
$Numeir="";
$NumeirCliente=""; 
$Cod_cliente="";
$cc_razo="";
$Cod_producto="";
$in_arti="";
$c_numitm="";
$Modelo="";
$Serie_producto="";
$Built_year="";
$Refrigerant="";
$PtiDate="";
$Equipment="";
$Ambient="";
$SetPoint="";
$Fecha_ingreso="";
$Moneda="";
$mone="";
$Tipo_cambio="";
$Tip_operacion="";
$Sub_dolares=0.00; 
$Sub_dolaresT=0.00;
$Sub_dolaresR=0.00;
$Total_Dolares=0.00;
$Total_DolaresT=0.00;
$Total_DolaresR=0.00;
$SimboloMoneda="";
$IgvD=0.00;
$IgvDT=0.00;
$IgvDR=0.00;
$CampoA="";
$CampoB="";
$CampoC="";
$CampoD="";
$ObjetoDisable="";
$btnPrincipal="";
$Divocultar="";
//evalua la varable op para saber si debe crear (1) o editar(2)
if(isset($_REQUEST['op'])){
	$op=$_REQUEST['op'];
	switch ($op){
		case 1: //agregar
			$Id_cabpre="";
			$Numeir="";
			$NumeirCliente="";
			$Cod_cliente="";
			$cc_razo="";
			$Cod_producto="";
			$in_arti="";
			$c_numitm="";
			$Modelo="";
			$Serie_producto="";
			$Built_year="";
			$Refrigerant="";
			$PtiDate="";
			$Equipment="";
			$Ambient="";
			$SetPoint="";
			$Fecha_ingreso="";
			$Moneda="";
			$mone="";
			$Tipo_cambio="";
			$Tip_operacion="";
			$Sub_soles="";
			$Sub_dolares=0.00;
			$Sub_dolaresT=0.00;
			$Sub_dolaresR=0.00;
			$Total_Dolares=0.00;
			$Total_DolaresT=0.00;
			$Total_DolaresR=0.00;
			$SimboloMoneda="";
			$IgvD=0.00;
			$IgvDT=0.00;
			$IgvDR=0.00;
			$CampoA="";
			$CampoB="";
			$CampoC="";
			$CampoD="";
			$ObjetoDisable="";
			$btnPrincipal="Grabar";
			$Divocultar="";
		break;
		case  2 or 3 or 4://editar //consultar
		 //print "<script>alert('$Id_cabpre')</script>";
		 foreach($this->model->EstimadosSeleccionarxId($_REQUEST['IdCab']) as $PresupuestoCab):
				$Id_cabpre=$PresupuestoCab->Id_cabpre;			
				$Numeir=$PresupuestoCab->Numeir; 
				$NumeirCliente=($PresupuestoCab->Numeir." - ".$PresupuestoCab->cc_razo);
				$Cod_cliente=$PresupuestoCab->Cod_cliente;
				$cc_razo=$PresupuestoCab->cc_razo;
				$Cod_producto=$PresupuestoCab->Cod_producto;
				$in_arti=$PresupuestoCab->in_arti;
				$c_numitm=$PresupuestoCab->c_numitm;
				$Modelo=$PresupuestoCab->Modelo;
				$Serie_producto=$PresupuestoCab->Serie_producto;
				$Built_year=$PresupuestoCab->Built_year;
				$Refrigerant=$PresupuestoCab->Refrigerant;
				$PtiDate=$PresupuestoCab->PtiDate;
				$Equipment=$PresupuestoCab->Equipment;
				$Ambient=$PresupuestoCab->Ambient;
				$SetPoint=$PresupuestoCab->SetPoint;
				$Fecha_ingreso=$PresupuestoCab->Fecha_ingreso;
				$Moneda=$PresupuestoCab->Moneda;
				$mone=$PresupuestoCab->mone;
				$Tipo_cambio=$PresupuestoCab->Tipo_cambio;
				$Tip_operacion=$PresupuestoCab->Tip_operacion;
				$Sub_soles=$PresupuestoCab->Sub_Soles;
				$Sub_dolares=$PresupuestoCab->Sub_Dolares;
				$Total_soles=$PresupuestoCab->Total_soles;
				$Total_Dolares=$PresupuestoCab->Total_Dolares;
				$IgvS=$PresupuestoCab->IgvS;
				$IgvD=$PresupuestoCab->IgvD;
				$CampoA=$PresupuestoCab->CampoA;
				$CampoB=$PresupuestoCab->CampoB;
				$CampoC=$PresupuestoCab->CampoC;
				$CampoD=$PresupuestoCab->CampoD;
				$ObjetoDisable=""; 
				$btnPrincipal="Actualizar"; 
				$Divocultar="";
				if($op==3){
					$Divocultar="";
					$ObjetoDisable='disabled="disabled"';
					$btnPrincipal="Grabar"; 
				}
				if($op==4){
					$Divocultar="style=display:none";
					$ObjetoDisable='disabled="disabled"';
					$btnPrincipal="Grabar"; 
				}
		 endforeach; 
		break;

	}
	
}

?>
<style>
 #mdialTamanio{
      width: 60% !important;
    }
</style>
<div class="modal fade" id="my_modalagregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="AgregarConcepto" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="exampleModalLabel"> Agregar Nuevo Concepto Presupuesto</h5>
                </div>
                <div class="modal-body">
					<div class="alert alert-primary" role="alert" id="mensaje2" style="display:none">
						</div>
					<div class="form-group">
                        <label class="control-label col-xs-4">Codigo</label>
                        <div class="col-xs-8">
                           <input type="text" class="form-control" id="codigo" name="codigo"  placeholder="AUTOGENERADO" readonly/>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-xs-4">Descripcion</label>
                        <div class="col-xs-8">
                           <input type="text" class="form-control" id="descripcion" name="descripcion"  placeholder="Descripcion" required />
                        </div>
                    </div>  
					<div class="form-group">
                        <label class="control-label col-xs-4">Precio</label>
                        <div class="col-xs-8">
                           <input type="text" class="form-control" id="precio" name="precio"  placeholder="precio"  required />
                        </div>
                    </div> 
					<div class="form-group">
                        <label class="control-label col-xs-4">Part Number</label>
                        <div class="col-xs-8">
                           <input type="text" class="form-control" id="partNumber" name="partNumber"  placeholder="Part Number"  required />
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-xs-4">Replace</label>
                        <div class="col-xs-8">
                           <input type="text" class="form-control" id="replace" name="replace"  placeholder="Replace"  required />
                        </div>
                    </div>
 					<div class="form-group">
                        <label class="control-label col-xs-4">Horas hombre</label>
                        <div class="col-xs-8">
                           <input type="text" class="form-control" id="hh" name="hh"  placeholder="Replace" value="0"  required />
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-xs-4">Unidad de Medida</label>
                        <div class="col-xs-8">
							<?php //echo var_dump($data) ;?>
							<?php $ListaUnidadMedida=json_decode($data['ListaUnidadMedida']) ;?>

						   <select name="medida" id="medida" class="select2 form-control">
									<option value="SELECCIONE">SELECCIONE</option>  
									<?php foreach($ListaUnidadMedida as $unid):	 ?>                                               
									<option value="<?php echo $unid->TU_CODI; ?>"> <?php echo $unid->TU_DESC; ?> </option>
									<?php  endforeach;	 ?>            
							</select>
                        </div>
                    </div>
 					<div class="form-group">
                        <label class="control-label col-xs-4">Tipo</label>
                        <div class="col-xs-8">
						   <select class="select2 form-control" name="tipo" id="tipo" > 
								<option value="SELECCIONE">SELECCIONE</option>
								<option value="1">Repuesto</option>
								<option value="2">Tarea a Realizar</option>						
							</select>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-xs-4">Estado</label>
                        <div class="col-xs-8">
                           <select class="select2 form-control" name="tip_mm" id="tip_mm" > 
								<option value="SELECCIONE">SELECCIONE</option>
								<option value="1">Activo</option>
								<option value="4">Inactivo</option>						
							</select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" >Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalCodigos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document" id="mdialTamanio">
        <div class="modal-content">
            <form id="AgregarConcepto" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="exampleModalLabel"> Ver Codigos Disponibles</h5>
                </div>
                <div class="modal-body">
				<div class="box-body table-responsive no-padding">
					<table  id="detalle-codigos" class="table table-bordered table-striped" >
					  <thead>
						<th bgcolor="#999999"><div align="center"><b>Codigo</b></div></td>
						<th bgcolor="#999999"><div align="center"><b>Descripcion</b></div></td>
						<th bgcolor="#999999">DUA</td>
						<th bgcolor="#999999"><div align="center"><b>Serie</b></div></td>
						<th bgcolor="#999999"><div align="center"><b>Maquina Asignada</b></div></td>
						<th bgcolor="#999999"><strong>Condicion Almacen</strong></td>
						<th bgcolor="#999999"></td>
					  </thead>
					  <tbody>
					  </tbody>

					</table>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
<form class="form-horizontal"  action="?c=ot02&a=crearOrdenTrabajo" method="post" id="FrmEstimados1" name="FrmEstimados1">
<input type="hidden" name="udni" id="udni" value="<?=$_REQUEST['udni']?>">
	<div class="modal modal-success fade" id="modal-success">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mensaje Sistema</h4>
				</div>
				<div class="modal-body">
					<p>Seguro de Grabar Informacion</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No</button>
					<input type="submit" class="btn btn-outline"  id="btsubmit" value="Si Guardar"/>
				</div>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	<div class="modal modal-danger fade" id="modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mensaje Sistema</h4>
              </div>
              <div class="modal-body">
                <div id="mensaje"></div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btn1" class="btn btn-outline btn-danger" data-dismiss="modal">Aceptar</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<div class="container-fluid listado-facturas-container">
	<div class="panel panel-default">
			<div class="panel-heading">Accion</div>
				<div class="panel-body">
					<div class="row" <?php echo $Divocultar ?> >
						<div class="col-sm-2">
						

							<button type="button" class="btn btn-block btn-success" onclick="validar()" <?php echo $ObjetoDisable?>></i> <?php echo $btnPrincipal?></button> 
						</div>
						<div class="col-sm-2">
							<a href="../../intranet">
							<button type="button" class="btn btn-block btn-danger"></i> Regresar</button>  
							</a>
						</div>
					</div>					
				</div>
	</div>
    <div class="panel panel-info">
        <div class="panel-heading">Registro de Orden de Trabajo Oka</div>
        <div class="panel-info panel-body">
			<div class="col-lg-4">
				<div class="form-group">
					<label  class="col-lg-4 control-label">Nro Orden Trabajo</label>
					<div class="col-lg-7">
						<input type="text" class="form-control" id="txtCod" name="txtCod" placeholder="AUTOGENERADO" value="<?php echo $Id_cabpre?>" readonly >
					</div>
					<div class="col-lg-1">
					<INPUT type="checkbox" name="miCheckSN" id ="miCheckSN">
					</div>
				</div>
				<div class="form-group">
					<label  class="col-lg-4 control-label">Nro de Reporte</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="txtNroReporte" name="txtNroReporte" placeholder="reporte..." value="<?php echo $Id_cabpre?>" >
					</div>
				</div>

				<div class="form-group">
					<label  class="col-lg-4 control-label">Solicitado por:</label>
					<div class="col-lg-8">
						<?php $ListaSolicitanteOT=json_decode($data['ListaSolicitanteOT']) ;?>
						<select name="txtSolicitadoPor" id="txtSolicitadoPor" class="select2 form-control" <?php echo $ObjetoDisable?>>
									<option value="SELECCIONE">SELECCIONE</option>  
									<?php foreach($ListaSolicitanteOT as $modelo):	 ?>                                               
									<option value="<?php echo $modelo->C_DESITM; ?>"  > <?php echo $modelo->C_DESITM; ?> </option>

									<?php  endforeach;	 ?>            
								  </select>
					</div>
				</div>

				<div class="form-group">
					<label  class="col-lg-4 control-label">Lugar de trabajo</label>
					<div class="col-lg-8">
						<select name="txtLugarTrabajo" id="txtLugarTrabajo" class="select2 form-control" <?php echo $ObjetoDisable?>>
							<option value="Almacen Zgroup">Almacen Zgroup</option>
							<option value="Instalacion Cliente">Instalacion Cliente</option>           
						 </select>
					</div>
				</div>	

					
			</div>

			<div class="col-lg-4">	
			    <div class="form-group">
					<label for="ejemplo_email_3" class="col-lg-4 control-label">Ref. Cotizacion:</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="txtRefCotizacion" name="txtRefCotizacion" placeholder="Ref. Cotizacion" value="<?php echo $Ambient?>" <?php echo $ObjetoDisable?>>
					</div>
				</div>	
				<div class="form-group">
					<label  class="col-lg-4 control-label">Serie de Equipo</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="txtSerieEquipo" name="txtSerieEquipo" value="<?php echo $Built_year?>" placeholder="serie..." <?php echo $ObjetoDisable?>>
					</div>
				</div>	
				<div class="form-group">
				<label  class="col-lg-4 control-label">Supervisado por:</label>
				<div class="col-lg-8">
				<?php $ListaSupervisadoOT=json_decode($data['ListaSupervisadoOT']) ;?>

					<select name="txtSupervisadoPor" id="txtSupervisadoPor" class="select2 form-control" <?php echo $ObjetoDisable?>>
						<option value="SELECCIONE">SELECCIONE</option>  
						<?php foreach($ListaSupervisadoOT as $modelo):	 ?>                                               
						<option value="<?php echo $modelo->C_DESITM; ?>"  <?php echo $modelo->C_DESITM == $codigoOt ? 'selected' : ''; ?>  > <?php echo $modelo->C_DESITM; ?> </option>
						<?php  endforeach;	 ?>            
					</select>
				</div>
			</div>	
				<div class="form-group">
					<label for="ejemplo_email_3" class="col-lg-4 control-label">Referencia Lugar</label>
					<div class="col-lg-8">
					  <input type="text" class="form-control" id="txtReferenciaLugar" name="txtReferenciaLugar" value="<?php echo $Refrigerant?>" placeholder="Opcional ..." <?php echo $ObjetoDisable?>>
					</div>
				</div>	

			</div>


			<div class="col-lg-4">
				<div class="form-group">
					<label for="ejemplo_email_3" class="col-lg-4 control-label">Nro de Guia/OC</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="txtNroGuia" name="txtNroGuia" placeholder="guia..."  <?php echo $ObjetoDisable?>>					
					</div>
				</div>	

				<div class="form-group">
					<label for="ejemplo_email_3" class="col-lg-4 control-label">Nro de Ticket</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="nro_ticket" name="nro_ticket" placeholder="ticket..." value="<?php echo $Ambient?>" <?php echo $ObjetoDisable?>>					
					</div>
				</div>
				
				
				<div class="form-group">
					<label  class="col-lg-4 control-label">Fecha de Entrega</label>
					<div class="col-lg-8">
						<input type="date" class="form-control" id="txtFechaEntrega" name="txtFechaEntrega" placeholder="Fecha Entrega"  value="<?php echo date_format(new DateTime($Fecha_ingreso),"Y-m-d")?>" <?php echo $ObjetoDisable?>>
					</div>
				</div>	
	
				<div class="form-group">
					<label for="ejemplo_email_3" class="col-lg-4 control-label">Usuario</label>
					<div class="col-lg-8">
						<?php 
							$dataUsuario = $this->model->validarUsuario($_GET['udniV']) ; 
							//echo var_dump($dataUsuario);
							//$dataUsuario['usuario']." | ".$dataUsuario['udni']  
						?>
					  <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" value="<?php echo  $dataUsuario->usuario ." | " .$dataUsuario->udni ; ?>" placeholder="admin1" readOnly>
					</div>
				</div>	
	
						
			</div>
		<div class="col-lg-12">	
			<div class="form-group">
					<label for="ejemplo_email_3" class="col-lg-1 control-label">Observacion</label>
					<div class="col-lg-11">
						<input type="text" class="form-control" id="txtObservacion" name="txtObservacion" placeholder="Opcional ..." value="<?php echo $Ambient?>" <?php echo $ObjetoDisable?>>					
					</div>
				</div>	

			</div>

		</div>
	</div>	
	<div class="panel panel-warning">
		<div class="panel-heading">Detalle Trabajo</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-6">
				<div class="form-group">
					<label  class="col-lg-4 control-label">Proveedor</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="txtProveedor" name="txtProveedor" placeholder="Buscar Provedor" value="<?php echo $cc_razo?>" <?php echo $ObjetoDisable?>>
					</div>
				</div>
				<div class="form-group">
					<label  class="col-lg-4 control-label">RUC</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="CC_NRUCP" name="CC_NRUCP" placeholder="Num RUC"  value="<?php echo $NumeirCliente?>" <?php echo $ObjetoDisable?> readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="ejemplo_email_3" class="col-lg-4 control-label">Producto</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="txtProducto" name="txtProducto" value="<?php echo $in_arti?>" placeholder="Buscar Producto" <?php echo $ObjetoDisable?>>
						<input type="hidden" class="form-control" id="IN_CODI" name="IN_CODI" value="<?php echo $Cod_producto?>">
					</div>
				</div>
				<div class="form-group">
					<label for="ejemplo_email_3" class="col-lg-4 control-label">Codigo Equipo</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="txtCodigoEquipo" name="txtCodigoEquipo" value="<?php echo $in_arti?>" placeholder="Buscar Producto" <?php echo $ObjetoDisable?>>
						<input type="hidden" class="form-control" id="txtCodigo2" name="txtCodigo2">
					</div>
				</div>	
				<div class="form-group">
					<label  class="col-lg-4 control-label">Maquina</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="txtMaquina" name="txtMaquina" value="<?php echo $Built_year?>" placeholder="Serie" <?php echo $ObjetoDisable?>>
					</div>
				</div>
				<div class="form-group">
					<label  class="col-lg-4 control-label">Trato Pago</label>
					<div class="col-lg-8">					
						<select name="txtTratoPago" id="txtTratoPago" class="select2 form-control" <?php echo $ObjetoDisable?>>
							<option value="SELECCIONE">SELECCIONE</option>  
							<?php foreach($this->model->ListaFormaPagoM() as $concot):	 ?>                                               
							<option value="<?php echo $concot->c_desitm; ?>"  <?php echo $concot->c_desitm == $ConcOt ? 'selected' : ''; ?>  > <?php echo $concot->c_desitm; ?> </option>
							<?php  endforeach;	 ?>            
					  </select>					
				    </div>
				</div>


				<div class="form-group">
					<label  class="col-lg-4 control-label">Factura Pago </label>
					<div class="col-lg-8">
						<select name="txtFacturaPago" id="txtFacturaPago" class="select2 form-control" <?php echo $ObjetoDisable?>>
							<option value="SELECCIONE">SELECCIONE</option>  
							<?php foreach($this->model->ListaPlazoM() as $concot):	 ?>                                               
							<option value="<?php echo $concot->c_desitm; ?>"  <?php echo $concot->c_desitm == $ConcOt ? 'selected' : ''; ?>  > <?php echo $concot->c_desitm; ?> </option>
							<?php  endforeach;	 ?>            
					  </select>	
					
					</div>
				</div>
													
				</div>
				<div class="col-lg-6">

					<div class="form-group">
						<label for="ejemplo_email_3" class="col-lg-4 control-label">Descripcion Equipo</label>
						<div class="col-lg-8">
							<input type="text" class="form-control" id="txtDescripcionEquipo" name="txtDescripcionEquipo" placeholder="Descripcion Equipo..." >
						</div>
					</div>

					<div class="form-group">
						<label  class="col-lg-4 control-label">Concepto de Trabajo</label>
						<div class="col-lg-8">
							<select name="txtConceptoTrabajo" id="txtConceptoTrabajo" class="select2 form-control" <?php echo $ObjetoDisable?>>
							<option value="OTROS">OTROS</option>  
							<?php foreach($this->ordentrabajo->ListaConceptosOTAsignados() as $concot):	 ?>                                               
							<option value="<?php echo $concot->descripcion; ?>"  <?php echo $concot->codigo == $ConcOt ? 'selected' : ''; ?>  > <?php echo $concot->descripcion; ?> </option>
							<?php  endforeach;	 ?>            
					  </select>
						</div>
					</div>


					<div class="form-group">
						<label for="ejemplo_email_3" class="col-lg-4 control-label">Detalle del Trabajo</label>
						<div class="col-lg-8">
							<input type="text" class="form-control" id="txtDetalleEquipo" name="txtDetalleEquipo" placeholder="Detalle del Trabajo..." >
						</div>
					</div>


					<div class="form-group">
						<label  class="col-lg-4 control-label">Tecnico encargado</label>
						<div class="col-lg-8">
							<select name="txtTecnicoEncargado" id="txtTecnicoEncargado" class="select2 form-control" <?php echo $ObjetoDisable?>>
							<option value="SELECCIONE">SELECCIONE</option>  
							<?php foreach($this->maestro->ListaTecnicoOT() as $tecn):	 ?>                                               
							<option value="<?php echo $tecn->c_desitm; ?>"  <?php echo $tecn->c_desitm == $ConcOt ? 'selected' : ''; ?>  > <?php echo $tecn->c_desitm; ?> </option>
							<?php  endforeach;	 ?>            
					  </select>
						</div>
					</div>

					<div class="form-group">
						<label  class="col-lg-4 control-label">Moneda</label>
						<div class="col-lg-8">
							<select name="txtMoneda" id="txtMoneda" class="select2 form-control" <?php echo $ObjetoDisable?>>
							<option value="0">SOLES</option>  
							<option value="1">DOLARES AMERICANOS</option>  
							<option value="4">EURO MONEDA</option>  
           
					  </select>
						</div>
					</div>



					<div class="form-group">
						<label for="ejemplo_email_3" class="col-lg-4 control-label">Precio</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="txtPrecioDT" name="txtPrecioDT" value="1" placeholder="1"  >
							</div>
					</div>
					<div class="form-group">
						<label for="ejemplo_email_3" class="col-lg-4 control-label">Cantidad</label>
						<div class="col-lg-8">
							 <input type="text" class="form-control" id="txtCantidadT" name="txtCantidadT"  value="1" placeholder="1" >
						</div>
					</div>
					<div class="form-group">
						<label  class="col-lg-4 control-label">Tipo Documento</label>
						<div class="col-lg-8">
							<select name="tdoc" id="tdoc" class="select2 form-control">
							  <option value="FACTURA">FACTURA</option>
							  <option value="REC. HONORARIO">REC. HONORARIO</option>        
							</select>
						</div>
					</div>			
					<div class="form-group">
						<label for="ejemplo_email_3" class="col-lg-4 control-label">.</label>
						<div class="col-lg-8">
							<button type="button" class="btn btn-danger" id="agregar-detalle-ot-btn">Añadir Detalle</button>
										</div>
									</div>					
				</div>
					</div>	
					<div class="row">
						<div class="box-body table-responsive no-padding">
							<table id="detalle-OT" class="table table-bordered table-striped">        
								<thead>
									<tr>
										<th>Proveedor</th>
										<th>Concepto</th>
										<th>Encargado</th>
										<th>Subtotal</th>
										<th>Precio (<?php 
																											 if($op==2 or $op==3 or $op==4) {
																											echo $SimboloMoneda;?>																											
																											<?php 
																											  } else
																											 {?><label class="SimboloMoneda"></label>
																											 <?php }?>
																								)</th>    
										<th>Importe (<?php 
																											 if($op==2 or $op==3 or $op==4) {
																											echo $SimboloMoneda;?>																											
																											<?php 
																											  } else
																											 {?><label class="SimboloMoneda"></label>
																											 <?php }?>
																								)</th>
										<th></th>
									</tr>
								</thead>
								<tbody>	
								<?php
								if($op==2 or $op==3 or $op==4){
									foreach($this->model->PresupuestoSeleccionarxIdDet($Id_cabpre)as $DetallePre):?>
									<tr>
										<td>
											<input type="hidden" class="form-control " name="txtIdConceptoT[]" id="txtIdConceptoT<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->Cod_concepto?>"/>
											<input type="hidden" class="form-control " name="tipoT[]" id="tipoT<?php echo $DetallePre->item-1?>" value="T"/>
											<input type="text" class="form-control text-left" name="txtConceptoT[]" id="txtConceptoT<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->descripcion?>" readonly/>				 
										</td>
										<td>
											<input type="text" class="form-control text-right" name="txtDecripcionAT[]" id="txtDecripcionAT<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->unidad_Medida?>" readonly/>
										</td>
										<td>
											<input type="text" class="form-control text-right" name="txtCantidadT[]" id="txtCantidadT<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->Cantidad?>"  <?php echo $ObjetoDisable?>/>
										</td>										
										<td>
											<input type="text" class="form-control text-right" name="txtPrecioDT[]" id="txtPrecioDT<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->Precio_Dolares?>" <?php echo $ObjetoDisable?>/>
										</td>										
										<td>
											<input type="text" class="form-control text-right" name="det_importeDT[]" id="det_importeDT<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->T_dolares?>"  readonly  />
										</td>
										<td>
											<button class="btn btn-danger btn-sm btn-borrar-detT" type="button"><i class="glyphicon glyphicon-remove"></i></button>
											</td>
									</tr>
								<?php	
									endforeach;	}
								?>
								</tbody>
								<tfoot>
								</tfoot>
							</table>
						</div><!--box-body --> 
					</div><!--box-body --> 
					<div class="row">
						<div class="col-xs-9 pull-right">
							<div class="form-group ">
								<label class="control-label col-xs-8 text-right">Sub-Total (<?php 
																											 if($op==2 or $op==3 or $op==4) {
																											echo $SimboloMoneda;?>																											
																											<?php 
																											  } else
																											 {?><label class="SimboloMoneda"></label>
																											 <?php }?>
																								)</label>										
									<div class="col-xs-3">
										<input type="text" class="form-control text-right" name="sub_importeDT" id="sub_importeDT" value="<?php echo $Sub_dolaresT?>"  readonly/>
									</div>
							</div>
						</div>									
					</div>
				</div>
			</div>

			<div class="panel panel-success">
				<div class="panel-heading">Detalle Insumos y Repuestos a Utilizar</div>
				<div class="panel-body">
					<div class="row">
						<div class="box-body table-responsive no-padding">
							<table id="detalle-Asignaciones" class="table table-bordered table-striped">        
								<thead>
									<tr>
										<th>Codigo</th>
										<th>Producto</th>
										<th>UM</th>
										<th>Tipo </th>    
										<th>Asignado</th>
										<th>Solicitar</th>
										<th></th>
									</tr>
								</thead>
								<tbody>	
								<?php
								if($op==2 or $op==3 or $op==4){
									foreach($this->model->PresupuestoSeleccionarxIdDet($Id_cabpre)as $DetallePre):?>
									<tr>
										<td>
											<input type="hidden" class="form-control " name="txtIdConceptoR[]" id="txtIdConceptoR<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->Cod_concepto?>"/>
											<input type="hidden" class="form-control " name="tipoR[]" id="tipoR<?php echo $DetallePre->item-1?>" value="R"/>
											<input type="text" class="form-control text-left" name="txtConceptoR[]" id="txtConceptoR<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->descripcion?>" readonly/>				 
										</td>
										<td>
											<input type="text" class="form-control text-right" name="txtUnidadMedidaR[]" id="txtUnidadMedidaR<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->unidad_Medida?>" readonly/>
										</td>
										<td>
											<input type="text" class="form-control text-right" name="txtCantidadR[]" id="txtCantidadR<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->Cantidad?>"  <?php echo $ObjetoDisable?>/>
										</td>										
										<td>
											<input type="text" class="form-control text-right" name="txtPrecioDR[]" id="txtPrecioDR<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->Precio_Dolares?>" <?php echo $ObjetoDisable?>/>
										</td>								
										<td>
											<input type="text" class="form-control text-right" name="det_importeDR[]" id="det_importeDR<?php echo $DetallePre->item-1?>" value="<?php echo $DetallePre->T_dolares?>"  readonly  />
										</td>
										<td>
											<button class="btn btn-danger btn-sm btn-borrar-detR" type="button"><i class="glyphicon glyphicon-remove"></i></button>
											</td>
									</tr>
								<?php	
									endforeach;	}
								?>
								</tbody>
								<tfoot>
								</tfoot>
							</table>
						</div><!--box-body --> 
					</div><!--box-body --> 


				</div>
			</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-danger">
				<div class="panel-heading">TOTAL GENERAL</div>
				<div class="panel-body">


					<div class="row">
						<div class="col-xs-9 pull-right">
							<div class="form-group ">
								<label class="control-label col-xs-8 text-right">Total (<?php 
																											 if($op==2 or $op==3 or $op==4) {
																											echo $SimboloMoneda;?>																											
																											<?php 
																											  } else
																											 {?><label class="SimboloMoneda"></label>
																											 <?php }?>
																								)</label>										
								<div class="col-xs-3">
									<input type="text" class="form-control text-right" name="total_importeD" id="total_importeD" value="<?php echo $Total_Dolares?>"  readonly/>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>

<script>

function agregarParametroInsumos(codigo_producto,descripcion_producto,unidad_producto,tipo_producto,cantidad_producto) {
	//console.log("estoy en insumos");
	
		var rowCount = $('#detalle-Asignaciones>tbody >tr').length;
		var index = rowCount;
		//var importe=(Cantidad*Punitario)-Dscto
		
		var fila = `<tr>
		<td>
				<input type="text" class="form-control text-right" name="codigo_producto[]" id="codigo_producto${index}" value="${codigo_producto}" readonly/>
			</td>
			<td>
				<input type="text" class="form-control text-right" name="descripcion_producto[]" id="descripcion_producto${index}" value="${descripcion_producto}" readonly/>
			</td>
			<td>
				<input type="text" class="form-control text-right" name="unidad_producto[]" id="unidad_producto${index}" value="${unidad_producto}" readonly />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="tipo_producto[]" id="tipo_producto${index}" value="${tipo_producto}" readonly/>
			</td>
			<td>
				<input type="text" class="form-control text-right" name="cantidad_producto[]" id="cantidad_producto${index}" value="${cantidad_producto}"  readonly  />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="cantidad_solicitada[]" id="cantidad_solicitada${index}" value="${cantidad_producto}"    />
			</td>
			<td>
				<button class="btn btn-danger btn-sm btn-borrar-detR" type="button"><i class="glyphicon glyphicon-remove"></i></button>
				</td>
		</tr>`;
		//$('#table-det-cotizacion > tbody:last-child').append(fila); 
		$('#detalle-Asignaciones tbody').append(fila); 
		/*
		 calcularTotalesR();
		calcularTotalGeneral();
		$("#txtConceptoR").val('');
		$("#txtIdConceptoR").val('');
		$("#txtUnidadMedidaR").val('');
		$("#txtCantidadR").val('');
		$("#txtPartNumberR").val('');
		$("#txtPrecioDR").val('');
		*/
		

	}


var miCheckbox = document.getElementById('miCheckSN');
  //var msg = document.getElementById('msg');

  //alert('El valor inicial del checkbox es ' + miCheckbox.checked);

  $('#txtConceptoTrabajo').on('select2:select', function (e) {
    var data = e.params.data;
    console.log(data.text);
	//pedir los datos 
	var conceptoOt =data.text ; 

	 $.ajax({
		type: "POST",
		url: '?c=ot01&a=ObtenerIdConceptoOt', //en procesosinv.controller.php
		dataType: "html",
		data: {Moneda:conceptoOt},
		async : false, //espera la respuesta antes de continuar
		success: function(respuesta) {
		  simbolo =  respuesta; //repuesta
		 // console.log(simbolo);

		},
  });
  //console.log(acumulado);
  valor1 = JSON.parse(simbolo);
  // tenemos el id que luego enviaremos a la tabla detalle
  console.log(valor1.id_listaM);
  id_insumo_asignado = valor1.id_listaM;


  $.ajax({
		type: "POST",
		url: '?c=ot01&a=ObtenerInsumosAsignados', //en procesosinv.controller.php
		dataType: "html",
		data: {Moneda:id_insumo_asignado},
		async : false, //espera la respuesta antes de continuar
		success: function(respuesta) {
		  insumosAsignados =  respuesta; //repuesta
		 // console.log(simbolo);

		},
  });
  valor2 = JSON.parse(insumosAsignados);
  //console.log(count(insumosAsignados));

  //console.log(insumosAsignados);

  
  valor2.forEach(permiso => {
       
  console.log(permiso);
  // aqi va la funcion que genera la vista de los insumos
  codigo_producto=permiso.codigo_producto;
  descripcion_producto=permiso.descripcion_producto;
  unidad_producto=permiso.unidad_producto;
  tipo_producto=permiso.tipo_producto;
  cantidad_producto=permiso.cantidad_producto;

  agregarParametroInsumos(codigo_producto,descripcion_producto,unidad_producto,tipo_producto,cantidad_producto);
  
});

});



  dataCheck ="aa";
  miCheckbox.addEventListener('click', function() {
    if(miCheckbox.checked) {
	
		dataCheck = 'El elemento está marcado';
		console.log(dataCheck);
		$("#txtNroReporte").val("S/N");
		$("#txtSerieEquipo").val("S/N");
		$("#txtNroGuia").val("S/N");
		$("#nro_ticket").val("S/N");
		

    } else {
		dataCheck = 'Ahora está desmarcado';
		console.log(dataCheck);
		$("#txtNroReporte").val("");
		$("#txtSerieEquipo").val("");
		$("#txtNroGuia").val("");
		$("#nro_ticket").val("");

    }

  });

//console.log(dataCheck);



function pon_prefijo(codigo,maquina) {
	$("#txtCodigo").val(codigo);
	$("#txtCodigo2").val(codigo);
	$("#txtMaquina").val(maquina);
	$('#myModalCodigos').modal('toggle');
}
  $(function () {
    $('#Presupuestos').DataTable({
		'ordering'    : false,
	})
	$('#marcas').DataTable({
		'ordering'    : false,
	})
    $('#detalle-codigosx').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
 function abrirModal(){
	 var codigo=$("#IN_CODI").val();
	 var msg="";
	var error=false;
	
	 if(codigo==""){
		 msg += "- Seleccionar un tipo de producto</br>";
		error=true;
	 }
	 if (error == true) {
	$("#mensaje").html(msg);
	$('#modal-warning').modal('show');
	return 0;
	}	 
	 else{
		 $('#myModalCodigos').modal('show');
		mostrarCodigos(codigo);
	 }
	 
 }
   function mostrarCodigos(codigo){
		$("#detalle-codigos").dataTable().fnDestroy();	
		var tabla=$('#detalle-codigos').dataTable( {
		  "ajax": {
			"processing": true,
			"url": "?c=ot01&a=BuscarCodigos",
			"oLanguage": {
			"sEmptyTable": "The table is really empty now!"
			},
			"dataTables_empty": "vacio",
			"data": function ( d ) {
				return $.extend( {}, d, {
				"codigo": codigo
			  } );
			},
			/* "error": function(){  
            jQuery("#example").append('<tbody class="grid-error"><tr class="text-center"><th colspan="9">No Hay resultados.</th></tr></tbody>');
            //jQuery("#example").css("display","none");
        } */				
		  }
		});	
  
 }
 
 
    $(document).ready(function(){
		 var stack_modal = {"dir1": "down", "dir2": "right", "push": "top", "modal": true, "overlay_close": true};
		$("#FrmEstimados").keypress(function(e) {//Para deshabilitar el uso de la tecla "Enter"
		if (e.which == 13) {
		return false;
		}
		});
		$("#txtTc").numeric('.');
		$("#txtPrecioDT").numeric('.');
		$("#txtPrecioDR").numeric('.');
		$("#txtCantidadT").numeric('.');			
		$("#txtCantidadR").numeric('.');			
		$(".text").keyup(function(){
		//console.log($(this).val());
		//CalcularTotal();				
	});

/*
	$("#txtConceptoTrabajo").autocomplete({
        dataType: 'JSON',
		minLength :5,
        source: function (request, response) {
            jQuery.ajax({
				url: '?c=ot01&a=BuscarCodigoDispositivo', //en procesosinv.controller.php// url: '?c=inv04&a=BuscarCotiAprobadas',
                type: "post",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { 
                            id: item.c_nserie,
                            value: item.c_nserie,
							c_idequipo: item.c_idequipo,
							c_nserie: item.c_nserie,
							id_equipo_asignado: item.id_equipo_asignado,
							c_codsitalm: item.c_codsitalm,
							in_arti: item.in_arti,

                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
			//console.log(ui.item.id_equipo_asignado);
			if(ui.item.id_equipo_asignado ==  null){
				$("#txtMaquina").val("SIN MÁQUINA");
			}else{
				
				cadenaX=ui.item.id_equipo_asignado;
				console.log(cadenaX);
	            $("#txtMaquina").val(cadenaX.substr(2));			
			}
            //$("#txtMaquina").val(ui.item.id_equipo_asignado);
			$("#txtCodigoEquipo").val(ui.item.c_nserie); 
			$("#txtDescripcionEquipo").val(ui.item.in_arti);    
        }
    })

	*/

	$('#cboMoneda').on('change', function() {
		var SimboloMoneda; //guardara el simbolo obtenido
		var Moneda = $(this).val(); //obtiene el valor seleccioanada
	//alert (Moneda);
	  //petición ajax
	  $.ajax({
		type: "POST",
		url: '?c=ot01&a=MostrarSimboloMoneda', //en procesosinv.controller.php
		dataType: "html",
		data: {Moneda:Moneda},
		async : false, //espera la respuesta antes de continuar
		success: function(respuesta) {
		  SimboloMoneda =  respuesta; //repuesta
		},
  });

  //limpia el input
  $('#SimboloMoneda').html('');
  //agrega la direccion
  if(Moneda=="SELECCIONE")
	{
	$('.SimboloMoneda').html('');	
	}
	else 
	$('.SimboloMoneda').html(SimboloMoneda);
})
 $("#AgregarConcepto").submit(function(e){
	//alert();
	e.preventDefault();
	var datos=new FormData(this);
	$.ajax({
	url: '?c=p10&a=AgregarNota',
	data: datos,				
	processData:false,
	contentType:false,
	type: "post",
	beforeSend:function(){
		$("#mensaje2").html('Espere');
	},
	success: function(mensaje){		
		$('#mensaje2').css('display','block');
		$("#mensaje2").html(mensaje);

			setTimeout(function() {
				$("#mensaje2").fadeOut(1500);
			},3000);
		$('#descripcion').val('');
		$('#precio').val('');
		$('#medida').val('');
		$('#partNumber').val('');
		$('#replace').val('');
		$('#hh').val('0');	
		}
	});
	
	
}); 	
	$("#txtProducto").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
				url: '?c=ot01&a=BuscarProducto', //en procesosinv.controller.php// url: '?c=inv04&a=BuscarCotiAprobadas',
                type: "post",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { 
                            id: item.IN_CODI,
                            value: item.IN_ARTI,
							IN_CODI: item.IN_CODI,
							IN_ARTI: item.IN_ARTI
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            $("#IN_CODI").val(ui.item.IN_CODI);
			$("#txtProducto").val(ui.item.IN_ARTI);

          
        }
    })
	$("#txtProveedor").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
				url: '?c=ot01&a=Buscar_Proveedor', //en procesosinv.controller.php// url: '?c=inv04&a=BuscarCotiAprobadas',
                type: "post",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { 
                            id: item.PR_NRUC,
                            value: item.PR_RAZO,
							PR_NRUC: item.PR_NRUC,
							PR_RAZO: item.PR_RAZO,
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            $("#CC_NRUCP").val(ui.item.PR_NRUC);
			$("#txtProveedor").val(ui.item.PR_RAZO);     
        }
    })

	$("#txtCodigoEquipo").autocomplete({
        dataType: 'JSON',
		minLength :5,
        source: function (request, response) {
            jQuery.ajax({
				url: '?c=ot01&a=BuscarCodigoDispositivo', //en procesosinv.controller.php// url: '?c=inv04&a=BuscarCotiAprobadas',
                type: "post",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { 
                            id: item.c_nserie,
                            value: item.c_nserie,
							c_idequipo: item.c_idequipo,
							c_nserie: item.c_nserie,
							id_equipo_asignado: item.id_equipo_asignado,
							c_codsitalm: item.c_codsitalm,
							in_arti: item.in_arti,

                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
			//console.log(ui.item.id_equipo_asignado);
			if(ui.item.id_equipo_asignado ==  null){
				$("#txtMaquina").val("SIN MÁQUINA");
			}else{
				
				cadenaX=ui.item.id_equipo_asignado;
				console.log(cadenaX);
	            $("#txtMaquina").val(cadenaX.substr(2));			
			}
            //$("#txtMaquina").val(ui.item.id_equipo_asignado);
			$("#txtCodigoEquipo").val(ui.item.c_nserie); 
			$("#txtDescripcionEquipo").val(ui.item.in_arti);    
        }
    })
	
	$("#txtConceptoT").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
				url: '?c=ot01&a=BuscarDetallesT', //en procesosinv.controller.php// url: '?c=inv04&a=BuscarCotiAprobadas',
                type: "post",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { 
                            id: item.id_detallet,
                            value: item.descripcion,
							id_detallet: item.id_detallet,
							descripcion: item.descripcion,
							precio: item.precio
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            $("#txtIdConceptoT").val(ui.item.id_detallet);
			$("#descripcionT").val(ui.item.descripcion);
			$("#txtPrecioDT").val(ui.item.precio);

          
        }
    })
	$("#txtRefCotizacion").autocomplete({
        dataType: 'JSON',
		minLength :4,
        source: function (request, response) {
            jQuery.ajax({
				url: '?c=ot01&a=BuscarCotiA', //en procesosinv.controller.php// url: '?c=inv04&a=BuscarCotiAprobadas',
                type: "post",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { 
                            id: item.c_numped,
                            value: item.c_numped +"|" +item.c_nomcli,
							c_numped: item.c_numped,
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            $("#txtRefCoti").val(ui.item.c_numped);

          
        }
    })


	
	$("#txtTecnico").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
				url: '?c=ot01&a=BuscarTecnico', //en procesosinv.controller.php// url: '?c=inv04&a=BuscarCotiAprobadas',
                type: "post",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { 
                            id: item.C_NUMITM,
                            value: item.C_DESITM,
							C_NUMITM: item.C_NUMITM,
							C_DESITM: item.C_DESITM,
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            $("#txtIdTecnico").val(ui.item.C_NUMITM);
			$("#txtTecnico").val(ui.item.C_DESITM);

          
        }
    })
	$("#txtConceptoR").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
				url: '?c=p05&a=BuscarConceptoR', //en procesosinv.controller.php// url: '?c=inv04&a=BuscarCotiAprobadas',
                type: "post",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { 
                            id: item.id_concepto,
                            value: item.descripcion,
							id_concepto: item.id_concepto,
							descripcion: item.descripcion,
							unidad_Medida: item.unidad_Medida,
							precioD: item.precioD,
							PartNumber: item.PartNumber,
							Replace: item.Replace
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            $("#txtIdConceptoR").val(ui.item.id_concepto);
			$("#descripcionR").val(ui.item.txtConcepto);
			$("#txtUnidadMedidaR").val(ui.item.unidad_Medida);
			$("#txtPrecioDR").val(ui.item.precioD);
			$("#txtPartNumberR").val(ui.item.PartNumber);
			$("#txtReplaceR").val(ui.item.Replace);

          
        }
    })
	

  $("#agregar-detalle-ot-btn").click(function(e){


	var c_rucprov = $("#CC_NRUCP").val();
	var c_nomprov = $("#txtProveedor").val();
	var concepto = $("#txtConceptoTrabajo").val();
	var tdoc = $("#tdoc").val();
	var ndoc = "";
	var fdoc = "";
	var monto = $("#txtPrecioDT").val();
	var n_cant = $("#txtCantidadT").val();
	var n_igvd = 0;
	if(tdoc="FACTURA"){
		n_igvd= parseFloat(monto).toFixed(2)*0.18;
		console.log(monto);
		console.log(n_igvd);

		console.log("no va vamos ya ");

	}
	console.log("vamos ya ");
	console.log(n_igvd);
	//var n_totd = parseFloat(monto).toFixed(2)+parseFloat(n_igvd).toFixed(2);
	console.log(monto);
	var n_totd = parseInt(monto*100)/100+n_igvd;
	console.log(n_totd);
	var montop = monto;
	var c_tecnico = $("#txtTecnicoEncargado").val();

	/*
    var error = false;
    var msg = "";
	if(txtConcepto == '' || txtIdConcepto == ''){
      msg += 'Ingrese un concepto de reparacion valido.<br>';  
	  $("#txtConceptoT").val('');
	  $("#txtConceptoT").focus();
      error = true;
    }
	if(txtPrecioD == '' || txtPrecioD == '0.00' ){
      msg += 'Ingrese un precio Valido.<br>';
      error = true;
	  	$("#txtPrecioDT").val('');
		$("#txtPrecioDT").focus();
    }else{
      txtPrecioD = parseFloat(txtPrecioD);
    }
	if(txtCantidad == '' ||txtCantidad == '0'){
      msg += 'Ingrese Cantidad Valida.<br>';
      error = true;
	  $("#txtCantidadT").val('');
	  $("#txtCantidadT").focus();
    }
	else{
      txtCantidad = parseFloat(txtCantidad);
    }
	if(txtTc == '' ||txtTc == '0'){
      msg += 'Ingrese Tipo de cambio.<br>';
      error = true;
	  $("#txtTc").val('');
	  $("#txtTc").focus();
    }
	else{
      txtTc = parseFloat(txtTc);
    }
	
	if($("#cboIgv option:selected").val()=="SELECCIONE"){	
      msg += 'Seleccione tipo de Operacion <br>';
      error = true;
    }

	if (error == true) {
	$("#mensaje").html(msg);
	$('#modal-warning').modal('show');			
	return 0;
	}else{ 
		agregarParametroTablaT(txtConcepto,txtIdConcepto,txtUnidadMedida,txtCantidad,txtPrecioD,det_importeD);
	}
	*/
	console.log("jajaja entre");
	agregarParametroTablaDetalleOt(c_rucprov,c_nomprov,concepto,tdoc,ndoc,fdoc,monto,n_cant,n_igvd,n_totd,montop,c_tecnico);
	console.log("jajaja entre2");

  });

      $("#agregar-detalle-btnR").click(function(e){
	  //$('#detalle-conceptos tbody').append('<tr class="child"><td>blahblah</td></tr>');
	 //alert($("#txtIdConcepto").val());
	 
    var txtTc = $("#txtTc").val();
    var txtConcepto = $("#txtConceptoR").val();
    var txtIdConcepto = $("#txtIdConceptoR").val();
    var txtCantidad = $("#txtCantidadR").val();
    var txtPrecioD = $("#txtPrecioDR").val();
    var txtUnidadMedida = $("#txtUnidadMedidaR").val();
  
	var det_importeD=parseFloat(txtCantidad*txtPrecioD).toFixed(2);
	
     var error = false;
    var msg = "";
	if(txtConcepto == '' || txtIdConcepto == ''){
      msg += 'Ingrese un concepto de reparacion valido.<br>';
	  
	  $("#txtConceptoTR").val('');
	  $("#txtConceptoTR").focus();
      error = true;
    }

	if(txtPrecioD == '' || txtPrecioD == '0.00' ){
      msg += 'Ingrese un precio Valido.<br>';
      error = true;
	  	$("#txtPrecioDR").val('');
		$("#txtPrecioDR").focus();
    }else{
      txtPrecioD = parseFloat(txtPrecioD);
    }
			
	
	if(txtCantidad == '' ||txtCantidad == '0'){
      msg += 'Ingrese Cantidad Valida.<br>';
      error = true;
	  $("#txtCantidadR").val('');
	  $("#txtCantidadR").focus();
    }
	else{
      txtCantidad = parseFloat(txtCantidad);
    }
	if(txtTc == '' ||txtTc == '0'){
      msg += 'Ingrese Tipo de cambio.<br>';
      error = true;
	  $("#txtTc").val('');
	  $("#txtTc").focus();
    }
	else{
      txtTc = parseFloat(txtTc);
    }
	
	if($("#cboIgv option:selected").val()=="SELECCIONE"){	
      msg += 'Seleccione tipo de Operacion <br>';
      error = true;
    }
	
	
	if (error == true) {
	$("#mensaje").html(msg);
	$('#modal-warning').modal('show');
			
	return 0;

	}else{ 
		agregarParametroTablaR(txtConcepto,txtIdConcepto,txtUnidadMedida,txtCantidad,txtPrecioD,det_importeD);

	}
  });
	
	
	$('body').on('click','.btn-borrar-detT', function(e){
    $(this).parent('td').parent('tr').remove();
    reindexarDetalleT();
    calcularTotalesT();
	calcularTotalGeneral();
  });
  	$('body').on('click','.btn-borrar-detR', function(e){
    $(this).parent('td').parent('tr').remove();
    reindexarDetalleR();
    calcularTotalesR();
	calcularTotalGeneral();
	
  });
    function reindexarDetalleT(){
    var rows = $('#detalle-conceptosT>tbody >tr');
    if(rows.length < 1){
      $("#detalleAgregado").removeAttr('value');
    }
    rows.each(function( index, element ) {
      //$(this).find('td:first').text(index+1);
			$(this).find('.txtIdConceptoT').attr('name', 'txtIdConceptoT[' + index + ']');
			$(this).find('.txtConceptoT').attr('name', 'txtConceptoT[' + index + ']');
			$(this).find('.txtDecripcionAT').attr('name', 'txtDecripcionAT[' + index + ']');
			$(this).find('.txtCantidadT').attr('name', 'txtCantidadT[' + index + ']');
			$(this).find('.txtPrecioDT').attr('name', 'txtPrecioDT[' + index + ']');
			$(this).find('.det_importeDT').attr('name', 'det_importeDT[' + index + ']');
    });
  }
  function reindexarDetalleR(){
    var rows = $('#detalle-conceptosR>tbody >tr');
    if(rows.length < 1){
      $("#detalleAgregado").removeAttr('value');
    }
    rows.each(function( index, element ) {
      //$(this).find('td:first').text(index+1);
			$(this).find('.txtIdConceptoR').attr('name', 'txtIdConceptoR[' + index + ']');
			$(this).find('.txtConceptoR').attr('name', 'txtConceptoR[' + index + ']');
			$(this).find('.txtUnidadMedidaR').attr('name', 'txtUnidadMedidaR[' + index + ']');
			$(this).find('.txtCantidadR').attr('name', 'txtCantidadR[' + index + ']');
			$(this).find('.txtPrecioDR').attr('name', 'txtPrecioDR[' + index + ']');
			$(this).find('.det_importeDR').attr('name', 'det_importeDR[' + index + ']');
    });
  }
  
   function calcularTotalesT(){
	//alert(total_t);
	var subtotalD = 0.0;	
	var totalD = 0.0;
							
    $('input[name^="det_importeDT"]').each(function(index, element){
      var dol = parseFloat($(this).val());
      subtotalD += dol;	      
    });	
	var operacion = $("select[name=cboIgv]").val();
    var igvS;
    var igvD;
    //
    if(operacion == '001'){
      igvD = subtotalD *0.18;
    }else{
      igvD = 0;
    }
	
    $("#tot_igvDT").val(igvD.toFixed(2));
    totalD=subtotalD+igvD
		
	$("#sub_importeDT").val(subtotalD.toFixed(2));
	$("#total_importeDT").val(totalD.toFixed(2));
  }  
   function calcularTotalesR(){
	//alert(total_t);
	var subtotalD = 0.0;	
	var totalD = 0.0;
							
    $('input[name^="det_importeDR"]').each(function(index, element){
      var dol = parseFloat($(this).val());
      subtotalD += dol;	      
    });	
	var operacion = $("select[name=cboIgv]").val();
    var igvS;
    var igvD;
    //
    if(operacion == '001'){
      igvD = subtotalD *0.18;
    }else{
      igvD = 0;
    }
	
    $("#tot_igvDR").val(igvD.toFixed(2));
    totalD=subtotalD+igvD
		
	$("#sub_importeDR").val(subtotalD.toFixed(2));
	$("#total_importeDR").val(totalD.toFixed(2));
  }
   function calcularTotalGeneral(){
	//alert(total_t);
	var subtotalT = 0;	
	var subtotalR =0;		
    var igvT=0;
    var igvR=0;
	var totalT =0;	
	var totalR = 0;	
	
	 subtotalT = $("#sub_importeDT").val();		
	 subtotalR = $("#sub_importeDR").val();		
     igvT=$("#tot_igvDT").val();
     igvR=$("#tot_igvDR").val();
	 totalT = $("#total_importeDT").val();	
	 totalR = $("#total_importeDR").val();	
	
	var subtotal=parseFloat(subtotalT)+parseFloat(subtotalR);
	var igv=parseFloat(igvT)+parseFloat(igvR);
	var total=parseFloat(totalT)+parseFloat(totalR);
    //
    $("#sub_importeD").val(subtotal.toFixed(2));
    $("#tot_igvD").val(igv.toFixed(2));
    $("#total_importeD").val(total.toFixed(2));

  
	}; 
  $('#detalle-conceptosT').on('keyup paste', ':input', function() { 
	$("input[name='txtIdConceptoT[]']").each(function(index, value){
	$txtCantidad = $("#txtCantidadT" + index + "").val();
	$txtPrecioD = $("#txtPrecioDT" + index + "").val();
	if($txtCantidad==0){
		//alert("cantidad no puede ser igual a cero");	
		new PNotify({
			title: 'Error',
			type: "error",
			text: 'la cantidad no puede ser igual a cero',
			nonblock: {
				nonblock: true
			},
			addclass: 'dark',
				styling: 'bootstrap3',

		});	
	}
	if($txtPrecioD==0){
		new PNotify({
			title: 'Error',
			type: "error",
			text: 'costo unitario no puede ser igual a cero',
			nonblock: {
				nonblock: true
			},
			addclass: 'dark',
				styling: 'bootstrap3',

		});	
	}
	});
  
	CalcularImporteT();
   	calcularTotalesT(); 
}); 

  $('#detalle-conceptosR').on('keyup paste', ':input', function() { 
  $("input[name='txtIdConceptoR[]']").each(function(index, value){
	$txtCantidad = $("#txtCantidadR" + index + "").val();
	$txtPrecioD = $("#txtPrecioDR" + index + "").val();
	if($txtCantidad==0){
		//alert("cantidad no puede ser igual a cero");	
		new PNotify({
			title: 'Error',
			type: "error",
			text: 'la cantidad no puede ser igual a cero',
			nonblock: {
				nonblock: true
			},
			addclass: 'dark',
				styling: 'bootstrap3',

		});	
	}
	if($txtPrecioD==0){
		new PNotify({
			title: 'Error',
			type: "error",
			text: 'costo unitario no puede ser igual a cero',
			nonblock: {
				nonblock: true
			},
			addclass: 'dark',
				styling: 'bootstrap3',

		});	
	}
	});
  
	CalcularImporteR();
   	calcularTotalesR(); 
}); 

function show_stack_modal(type) {
    var opts = {
        title: "Over Here",
        text: "Check me out. I'm in a different stack.",
        addclass: "stack-modal",
        stack: stack_modal,
		styling: 'bootstrap3',
    };
    switch (type) {
    case 'error':
        opts.title = "Oh No";
        opts.text = "Watch out for that water tower!";
        opts.type = "error";
        break;
    case 'info':
        opts.title = "Breaking News";
        opts.text = "Have you met Ted?";
        opts.type = "info";
        break;
    case 'success':
        opts.title = "Good News Everyone";
        opts.text = "I've invented a device that bites shiny metal asses.";
        opts.type = "success";
        break;
    }
    new PNotify(opts);
}


 
function CalcularImporteT() {
	$("input[name='txtIdConceptoT[]']").each(function(index, value){
	$txtCantidad = $("#txtCantidadT" + index + "").val();
	$txtPrecioD = $("#txtPrecioDT" + index + "").val();
	$ImporteD = ($txtCantidad * $txtPrecioD);
	$("#det_importeDT" + index + "").val($ImporteD);
	});
}
function CalcularImporteR() {
	$("input[name='txtIdConceptoR[]']").each(function(index, value){
	$txtCantidad = $("#txtCantidadR" + index + "").val();
	$txtPrecioD = $("#txtPrecioDR" + index + "").val();
	$ImporteD = ($txtCantidad * $txtPrecioD);
	        	    $("#det_importeDR" + index + "").val($ImporteD);
	});
	}
 function agregarParametroInsumos(codigo_producto,descripcion_producto,unidad_producto,tipo_producto,cantidad_producto) {
	console.log("estoy en insumos");
	/*
		var rowCount = $('#detalle-Asignaciones>tbody >tr').length;
		var index = rowCount;
		//var importe=(Cantidad*Punitario)-Dscto
		
		var fila = `<tr>
			<td>
				<input type="hidden" class="form-control " name="txtIdConceptoR[]" id="txtIdConceptoR${index}" value="${txtIdConcepto}"/>
			 
			</td>
			<td>
				<input type="text" class="form-control text-right" name="descripcion_producto[]" id="descripcion_producto${index}" value="${descripcion_producto}" readonly/>
			</td>
			<td>
				<input type="text" class="form-control text-right" name="unidad_producto[]" id="unidad_producto${index}" value="${unidad_producto}" />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="tipo_producto[]" id="tipo_producto${index}" value="${tipo_producto}" />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="cantidad_producto[]" id="cantidad_producto${index}" value="${cantidad_producto}"  readonly  />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="cantidad_solicitada[]" id="cantidad_solicitada${index}" value="${cantidad_producto}"  readonly  />
			</td>
			<td>
				<button class="btn btn-danger btn-sm btn-borrar-detR" type="button"><i class="glyphicon glyphicon-remove"></i></button>
				</td>
		</tr>`;
		//$('#table-det-cotizacion > tbody:last-child').append(fila); 
		$('#detalle-Asignaciones tbody').append(fila); 
		/*
		 calcularTotalesR();
		calcularTotalGeneral();
		$("#txtConceptoR").val('');
		$("#txtIdConceptoR").val('');
		$("#txtUnidadMedidaR").val('');
		$("#txtCantidadR").val('');
		$("#txtPartNumberR").val('');
		$("#txtPrecioDR").val('');
		*/
		

	} 		



  function agregarParametroTablaT(txtConcepto,txtIdConcepto,txtUnidadMedida,txtCantidad,txtPrecioD,det_importeD) {
		var rowCount = $('#detalle-conceptosT>tbody >tr').length;
		var index = rowCount;
		//var importe=(Cantidad*Punitario)-Dscto
		
		var fila = `<tr>
			<td>
				<input type="hidden" class="form-control " name="txtIdConceptoT[]" id="txtIdConceptoT${index}" value="${txtIdConcepto}"/>
				<input type="hidden" class="form-control " name="tipoT[]" id="tipoT${index}" value="T"/>
				<input type="text" class="form-control text-left" name="txtConceptoT[]" id="txtConceptoT${index}" value="${txtConcepto}" readonly/>				 
			</td>
			<td>
				<input type="text" class="form-control text-right" name="txtDecripcionAT[]" id="txtDecripcionAT${index}" value="${txtUnidadMedida}" readonly/>
			</td>
			<td>
				<input type="text" class="form-control text-right" name="txtCantidadT[]" id="txtCantidadT${index}" value="${txtCantidad}" />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="txtPrecioDT[]" id="txtPrecioDT${index}" value="${txtPrecioD}" />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="det_importeDT[]" id="det_importeDT${index}" value="${det_importeD}"  readonly  />
			</td>
			<td>
				<button class="btn btn-danger btn-sm btn-borrar-detT" type="button"><i class="glyphicon glyphicon-remove"></i></button>
				</td>
		</tr>`;
		//$('#table-det-cotizacion > tbody:last-child').append(fila); 
		$('#detalle-conceptosT tbody').append(fila); 
		 calcularTotalesT();
		calcularTotalGeneral();
		$("#txtConceptoT").val('');
		$("#txtIdConceptoT").val('');
		$("#txtDecripcionAT").val('');
		$("#txtCantidadT").val('');
		$("#txtPrecioDT").val('');
	} 

	function agregarParametroTablaDetalleOt(c_rucprov,c_nomprov,concepto,tdoc,ndoc,fdoc,monto,n_cant,n_igvd,n_totd,montop,c_tecnico) {
		var rowCount = $('#detalle-OT>tbody >tr').length;
		console.log(rowCount);
		var index = rowCount;
		//var importe=(Cantidad*Punitario)-Dscto
		
		var fila = `<tr>
			<td>
				<input type="hidden" class="form-control " name="c_rucprov[]" id="c_rucprov${index}" value="${c_rucprov}"/>
				<input type="hidden" class="form-control " name="tdoc[]" id="tdoc${index}" value="${tdoc}"/>
				<input type="hidden" class="form-control " name="ndoc[]" id="ndoc${index}" value="${ndoc}"/>
				<input type="hidden" class="form-control " name="fdoc[]" id="fdoc${index}" value="${fdoc}"/>
				<input type="hidden" class="form-control " name="n_igvd[]" id="n_igvd${index}" value="${n_igvd}"/>
				<input type="hidden" class="form-control " name="montop[]" id="montop${index}" value="${montop}"/>

				<input type="text" class="form-control text-left" name="c_nomprov[]" id="c_nomprov${index}" value="${c_nomprov}" readonly/>				 
			</td>
			<td>
				<input type="text" class="form-control text-right" name="concepto[]" id="concepto${index}" value="${concepto}" readonly/>
			</td>

			<td>
				<input type="text" class="form-control text-right" name="c_tecnico[]" id="c_tecnico${index}" value="${c_tecnico}" />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="monto[]" id="monto${index}" value="${monto}" />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="n_cant[]" id="n_cant${index}" value="${n_cant}"    />
			</td>
			<td>
				<input type="text" class="form-control text-right" name="n_totd[]" id="n_totd${index}" value="${n_totd}"  readonly  />
			</td>
			<td>
				<button class="btn btn-danger btn-sm btn-borrar-detT" type="button"><i class="glyphicon glyphicon-remove"></i></button>
				</td>
		</tr>`;
		//$('#table-det-cotizacion > tbody:last-child').append(fila); 
		$('#detalle-OT tbody').append(fila); 
		 calcularTotalesT();
		calcularTotalGeneral();

	$("#CC_NRUCP").val();
	 $("#txtProveedor").val();
	//var concepto = $("#txtConceptoTrabajo").val();
	//var tdoc = $("#tdoc").val();
	//var ndoc = "";
	//var fdoc = "";
	var monto = $("#txtPrecioDT").val("1");
	var n_cant = $("#txtCantidadT").val("1");
	//var n_igvd = 0;

	//var n_totd = parseFloat(monto).toFixed(2)+n_igvd;
	//var montop = monto;
	//var c_tecnico = $("#txtTecnicoEncargado").val();
	} 


    })
	
</script>
<script>
  function validar(){
	// alert("error");
		/*	
 	var msg="";
	var error=false;
	var rowCountT = $('#detalle-conceptosT>tbody >tr').length;
	var rowCountR = $('#detalle-conceptosR>tbody >tr').length;
	var indexT = rowCountT;
	var indexR = rowCountR;
		document.getElementById("FrmEstimados1").submit();

	

	if($("#CC_NRUC").val()==""){		
		msg += "- Ingresar un cliente valido</br>";
		error=true;
	//return 0; //evita que el formulario sea enviado.		
		
	}
	if($("#IN_CODI").val()==""){		
		msg += "- Ingresar un producto correcto</br>";
		error=true;
	//return 0; //evita que el formulario sea enviado.cboMoneda		
		
	}
	if($("#cboMoneda option:selected").val()=="SELECCIONE"){		
		msg += "- Ingresar el tipo de Moneda</br>";
		error=true;
		//return 0;
		//document.FrmPresupuestos.submit();		
	}
	if($("#txtFecha").val()==""){			
		msg += "- Ingresar una fecha</br>";
		error=true;
		//return 0;
		//document.FrmPresupuestos.submit();		
	}	
	if($("#txtTc").val()==""){			
		msg += "- Ingresar el tipo de cambio</br>";
		error=true;
		//return 0;
		//document.FrmPresupuestos.submit();$("#TipoClassProducto option:selected").val();		
	}
	if($("#cboIgv option:selected").val()=="SELECCIONE"){			
		msg += "- Seleccione el tipo de operacion</br>";
		error=true;
		//return 0;
		//document.FrmPresupuestos.submit();		
	}
	if($("#sub_importeD").val()==0){		
		msg += "- Ingresar por lo menos un detalle </br>";
		error=true;
	//return 0; //evita que el formulario sea enviado.		
		
	}
	$("input[name='txtIdConceptoT[]']").each(function(index, value){
		$txtCantidad = $("#txtCantidadT" + index + "").val();
		$txtPrecioD = $("#txtPrecioDT" + index + "").val();
		if($txtCantidad==0){
			msg += "- la cantidad no puede ser igual a cero(Detalle Trabajo) </br>";
			error=true;
		}
		if($txtPrecioD==0){
			msg += "- el costo no puede ser igual a cero(Detalle Trabajo) </br>";
			error=true;
		}
	});
	$("input[name='txtIdConceptoR[]']").each(function(index, value){
		$txtCantidad = $("#txtCantidadR" + index + "").val();
		$txtPrecioD = $("#txtPrecioDR" + index + "").val();
		if($txtCantidad==0){
			msg += "- la cantidad no puede ser igual a cero (Detalle Repuestos) </br>";
			error=true;
		}
		if($txtPrecioD==0){
			msg += "- el costo no puede ser igual a cero (Detalle Repuestos) </br>";
			error=true;
		}
	});
	
	
	if (error == true) {
	$("#mensaje").html(msg);
	$('#modal-warning').modal('show');

	return 0;

	}else 
	{
	$('#modal-success').modal('show'); 
	} 
	*/
	
	if(confirm("Seguro de Grabar Orden De Trabajo ?")){
	//console.log(document.getElementById("FrmEstimados1"));
	document.getElementById("FrmEstimados1").submit();
	 }
  }
</script>
<script src=".\assets\js\jquery.numeric.js"></script>
