<?php
include "Views/templates/navbar.php"; 
?>
<!--
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
</div>-->
<!--
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
-->
<form class="form-horizontal"  action="?c=ot02&a=crearOrdenTrabajo" method="post" id="FrmEstimados1" name="FrmEstimados1">
<input type="hidden" name="udni" id="udni" value="">
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
	<div class="container-fluid">
    <div class="card m-3">
        <div class="card-header text-bg-primary">Registro de Orden de Trabajo Oka</div>
		<?php  //var_dump($data) ;?>

        <div class="card-body">
		<div class="form-group">
                <div class="mb-3 row">
                    <label for="nroOrdenTrabajo" class="col-sm-2 col-form-label">Nro Orden Trabajo</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="nroOrdenTrabajo" name="nroOrdenTrabajo" placeholder="AUTOGENERADO" value="" readonly >
						<input type="checkbox" id="checkOrdenTrabajo" name="checkOrdenTrabajo">
                    </div>
                    <label for="refCotizacion" class="col-sm-2 col-form-label">Ref. Cotizacion:</label>
                    <div class="col-sm-2">
						<!--<input type="text" class="form-control" id="refCotizacion" name="refCotizacion" placeholder="Ref. Cotizacion" value="">-->
                        <select name="refCotizacion" id="refCotizacion" class="form-select">
							<option value="">SELECCIONE</option>          
						</select>

                    </div>
					<label for="nroGuiaOC" class="col-sm-2 col-form-label">Nro de Guia/OC</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="nroGuiaOC" name="nroGuiaOC" placeholder="guia..." value="">
                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="nroReporte" class="col-sm-2 col-form-label">Nro de Reporte</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="nroReporte" name="nroReporte" placeholder="reporte..." value="">
                    </div>
                    <label for="serieEquipo" class="col-sm-2 col-form-label">Serie de equipo</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="serieEquipo" name="serieEquipo" placeholder="serie..." value="">
                    </div>
					<label for="nroTicket" class="col-sm-2 col-form-label">Nro de Ticket</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="nroTicket" name="nroTicket" placeholder="ticket..." value="">
                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="solicitadoPor" class="col-sm-2 col-form-label">Solicitado por:</label>
                    <div class="col-sm-2">

                        <?php $ListaSolicitanteOT=json_decode($data['ListaSolicitanteOT']) ;?>
                        <select name="SolicitadoPor" id="SolicitadoPor" class="form-select">
								<option value="SELECCIONE">SELECCIONE</option>  
								<?php foreach($ListaSolicitanteOT as $unid):	 ?>                                               
								<option value="<?php echo $unid->C_DESITM; ?>"> <?php echo $unid->C_DESITM; ?> </option>
								<?php  endforeach;	 ?>            
						</select>
                    </div>
                    <label for="supervisadoPor" class="col-sm-2 col-form-label">Supervisado por:</label>
					<?php $ListaSupervisadoOT=json_decode($data['ListaSupervisadoOT']) ;?>
					<div class="col-sm-2">
						<select name="txtSupervisadoPor" id="txtSupervisadoPor" class="form-select">
								<option value="SELECCIONE">SELECCIONE</option>  
								<?php foreach($ListaSupervisadoOT as $unid):	 ?>                                               
								<option value="<?php echo $unid->C_DESITM; ?>"> <?php echo $unid->C_DESITM; ?> </option>
								<?php  endforeach;	 ?>            
						</select>
					</div>



					<label for="fechaEntrega" class="col-sm-2 col-form-label">Fecha de Entrega</label>
                    <div class="col-sm-2">
						<input type="date" class="form-control" id="txtFechaEntrega" name="txtFechaEntrega" placeholder="Fecha Entrega" value="2024-04-25">
                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="lugarTrabajo" class="col-sm-2 col-form-label">Lugar de trabajo</label>
                    <div class="col-sm-2">
                        <select name="LugarTrabajo" id="LugarTrabajo" class="form-select" <?php echo $ObjetoDisable?>>
							<option value="Almacen Zgroup">Almacen Zgroup</option>
							<option value="Instalacion Cliente">Instalacion Cliente</option>           
						 </select>
                    </div>
                    <label for="lugarTrabajo" class="col-sm-2 col-form-label">Referencia Lugar</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="ReferenciaLugar" name="ReferenciaLugar" placeholder="opcional..." value="">
                    </div>
					<label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="usuario" name="usuario" placeholder="VANESA | 46723322" value="" readonly >
                    </div>
                </div>
            </div>
										
		</div>
		<div class="mb-3 row">	
			<div class="form-group">
					<label for="observacion" class="col-lg-1 control-label">Observacion</label>
					<div class="col-lg-12">
						<input type="text" class="form-control" id="txtObservacion" name="txtObservacion" placeholder="Opcional ..." value="">					
					</div>
				</div>	
			</div>
		</div>
	</div>	
	</div>
	<div class="container-fluid">								
	<div class="card m-3">
		<div class="card-header text-bg-warning">Detalle Trabajo</div>
		<div class="card-body">
		<div class="form-group">
                <div class="mb-3 row">
                    <label for="proveedor2" class="col-sm-2 col-form-label">Proveedor</label>
                    <div class="col-sm-4">
                    <select name="Proveedor" id="Proveedor" class="form-select">
							<!--<option value="">SELECCIONE</option>-->          
					</select>
                    </div>
                    <label for="descripcionEquipo" class="col-sm-2 col-form-label">Descripcion Equipo</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="descripcionEquipo" value="" placeholder="Descripcion Equipo...">
                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="ruc" class="col-sm-2 col-form-label">RUC</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="ruc" value="" placeholder="Num RUC" readonly>
                    </div>
                    <label for="conceptoTrabajo" class="col-sm-2 col-form-label">Concepto de Trabajo</label>
                    <div class="col-sm-4">

                    <select name="ConceptoTrabajo" id="ConceptoTrabajo" class="form-select">
							<option value="">SELECCIONE</option>          
						</select>

                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="producto" class="col-sm-2 col-form-label">Producto</label>
                    <div class="col-sm-4">
                        <select name="Producto" id="Producto" class="form-select">
							<option value="">SELECCIONE</option>          
						</select>
                       <!-- <input type="text" class="form-control" id="producto" value="" placeholder="Buscar Producto">-->
                    </div>
                    <label for="detalleTrabajo" class="col-sm-2 col-form-label">Detalle del Trabajo</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="detalleTrabajo" value="" placeholder="Detalle del Trabajo...">
                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="codigoEquipo" class="col-sm-2 col-form-label">Codigo Equipo</label>
                    <div class="col-sm-3">
                        <select name="codigoEquipo" id="codigoEquipo" class="form-select">
                            <option value="">SELECCIONE</option>          
                        </select>
                    </div>    
                    <div class="col-sm-1">
                        <input type="checkbox" id="checkCodigo" name="checkCodigo">
                    </div>                
                    <label for="tecnicoEncargado" class="col-sm-2 col-form-label">Tecnico Encargado</label>
                    <?php $ListaTecnicoOT=json_decode($data['ListaTecnicoOT']) ;?>
                    <?php //var_dump($ListaTecnicoOT) ;?>
					<div class="col-sm-4">
						<select name="tecnicoEncargado" id="tecnicoEncargado" class="form-select">
								<option value="SELECCIONE">SELECCIONE</option>  
								<?php foreach($ListaTecnicoOT as $unid):	 ?>                                               
								<option value="<?php echo $unid->C_DESITM; ?>"> <?php echo $unid->C_DESITM; ?> </option>
								<?php  endforeach;	 ?>            
						</select>
					</div>
                    
                </div>
				<div class="mb-3 row">
                    <label for="maquina" class="col-sm-2 col-form-label">Maquina</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="maquina" name="maquina" value="" placeholder="Serie">
                    </div>
                    <label for="moneda" class="col-sm-2 col-form-label">Moneda</label>
                    <div class="col-sm-4">
						<select name="txtMoneda" id="txtMoneda" class="form-select">
                            <option value="SELECCIONE">SELECCIONE</option>  
							<option value="SOLES">SOLES</option>
                            <option value="DOLARES">DOLARES</option>
                            <option value="EUROS">EUROS</option>
						</select>
					</div>
                </div>
				<div class="mb-3 row">
                    <label for="tratoPago" class="col-sm-2 col-form-label">Trato Pago</label>
                    <?php $ListaFormaPagoM=json_decode($data['ListaFormaPagoM']) ;?>
                    <?php //var_dump($ListaFormaPagoM) ;?>
					<div class="col-sm-4">
						<select name="tratoPago" id="tratoPago" class="form-select">
								<option value="SELECCIONE">SELECCIONE</option>  
								<?php foreach($ListaFormaPagoM as $unid):	 ?>                                               
								<option value="<?php echo $unid->C_DESITM; ?>"> <?php echo $unid->C_DESITM; ?> </option>
								<?php  endforeach;	 ?>            
						</select>
					</div>

                    <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="precio" value="1">
                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="facturaPago" class="col-sm-2 col-form-label">Factura Pago</label>
                    <?php $ListaPlazoM=json_decode($data['ListaPlazoM']) ;?>
                    <?php //var_dump($ListaPlazoM) ;?>
					<div class="col-sm-4">
						<select name="tratoPago" id="tratoPago" class="form-select">
								<option value="SELECCIONE">SELECCIONE</option>  
								<?php foreach($ListaPlazoM as $unid):	 ?>                                               
								<option value="<?php echo $unid->TP_DESC; ?>"> <?php echo $unid->TP_DESC; ?> </option>
								<?php  endforeach;	 ?>            
						</select>
					</div>
                    <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="cantidad" value="1">
                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="tipoDocumento" class="col-sm-2 col-form-label">Tipo Documento</label>
                    <div class="col-sm-4">
						<select name="txtTipoDocumento" id="txtTipoDocumento" class="form-select">
                            <option value="SELECCIONE">SELECCIONE</option>  
							<option value="FACTURA">FACTURA</option>
                            <option value="RECIBO HONORARIO">RECIBO HONORARIO</option>
						</select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tipoDocumento" class="col-sm-2 col-form-label">Insumos</label>
                    <div class="col-sm-4">
                        <select id="insumosOT" class="js-example-basic-multiple"  name="insumosOT[]" multiple="multiple"  style="width: 100%;" ></select>
                    </div>
                </div>
				<button type="button" class="btn btn-danger" onclick="agregarDetalleTrabajo()">Añadir Detalle</button>

            </div>
		</div>	
        <div class="col-lg-12">
            <table id="myTableInsumoOT" class="table table-striped table-bordered"></table>
        </div>
        <div class="col-lg-12">
            <p id="comparador"><p>   
            <table id="myTableTrabajo" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Proveedor</th>
                        <th>Concepto</th>
                        <th>Encargado</th>
                        <th>Subtotal</th>
                        <th>Precio</th>
                        <th>Importe</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
				
	</div>
			</div>
		<div class="container-fluid">			
		<div class="card m-3">
			<div class="card-header text-bg-success">Detalle Insumos y Repuestos a Utilizar</div>
			<div class="card-body">
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
							
							</tbody>
							<tfoot>
							</tfoot>
						</table>
					</div><!--box-body --> 
				</div><!--box-body --> 
			</div>
		</div>
		</div>
			<div class="container-fluid">
			<div class="card m-3">
				<div class="card-header">Accion</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-2 ">
								<button type="button" class="btn btn-success btn-lg w-100">Grabar</button> 
							</div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-danger btn-lg w-100">Regresar</button>
							</div>
						</div>					
					</div>
			</div>
			</div>
	</div>
	
</div>
</form>

<?php include "Views/templates/footer.php"; ?>
