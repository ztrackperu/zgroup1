<?php include "Views/templates/navbar.php";  ?>
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
                    <label for="nroOrdenTrabajo" class="col-sm-2 col-form-label">Nro Orden Trabajo (*)</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="nroOrdenTrabajo" name="nroOrdenTrabajo" placeholder="AUTOGENERADO" value="" readonly >
						<input type="checkbox" id="checkOrdenTrabajo" name="checkOrdenTrabajo">
                    </div>
                    <label for="refCotizacion" class="col-sm-2 col-form-label">Ref. Cotizacion (*)</label>
                    <div class="col-sm-2">
						<!--<input type="text" class="form-control" id="refCotizacion" name="refCotizacion" placeholder="Ref. Cotizacion" value="">-->
                        <select name="refCotizacion" id="refCotizacion" class="form-select">
							<option value="">SELECCIONE</option>          
						</select>
                    </div>
					<label for="nroGuiaOC" class="col-sm-2 col-form-label">Nro de Guia/OC (*)</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="nroGuiaOC" name="nroGuiaOC" placeholder="guia..." value="">
                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="nroReporte" class="col-sm-2 col-form-label">Nro de Reporte (*)</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="nroReporte" name="nroReporte" placeholder="reporte..." value="">
                    </div>
                    <label for="serieEquipo" class="col-sm-2 col-form-label">Serie de equipo (*)</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="serieEquipo" name="serieEquipo" placeholder="serie..." value="">
                    </div>
					<label for="nroTicket" class="col-sm-2 col-form-label">Nro de Ticket (*)</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="nroTicket" name="nroTicket" placeholder="ticket..." value="">
                    </div>
                </div>
				<div class="mb-3 row">
                    <label for="solicitadoPor" class="col-sm-2 col-form-label">Solicitado por (*)</label>
                    <div class="col-sm-2">

                        <?php $ListaSolicitanteOT=json_decode($data['ListaSolicitanteOT']) ;?>
                        <select name="SolicitadoPor" id="SolicitadoPor" class="form-select">
								<option value="SELECCIONE">SELECCIONE</option>  
								<?php foreach($ListaSolicitanteOT as $unid):	 ?>                                               
								<option value="<?php echo $unid->C_DESITM; ?>"> <?php echo $unid->C_DESITM; ?> </option>
								<?php  endforeach;	 ?>            
						</select>
                    </div>
                    <label for="supervisadoPor" class="col-sm-2 col-form-label">Supervisado por (*)</label>
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
						<input type="text" class="form-control" id="usuario" name="usuario" placeholder="VANESA | 46723322" value="VANESA | 46723322" readonly >
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
                <label for="facturaPago" class="col-sm-2 col-form-label">Factura Pago</label>
                <?php $ListaPlazoM=json_decode($data['ListaPlazoM']) ;?>
                <?php //var_dump($ListaPlazoM) ;?>
                <div class="col-sm-4">
                    <select name="facturaPago" id="facturaPago" class="form-select">
                            <option value="SELECCIONE">SELECCIONE</option>  
                            <?php foreach($ListaPlazoM as $unid):	 ?>                                               
                            <option value="<?php echo $unid->TP_DESC; ?>"> <?php echo $unid->TP_DESC; ?> </option>
                            <?php  endforeach;	 ?>            
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="codigoEquipo" class="col-sm-2 col-form-label">Codigo Equipo (*)</label>
                <div class="col-sm-3">
                    <select name="codigoEquipo" id="codigoEquipo" class="form-select">
                        <option value="">SELECCIONE</option>          
                    </select>
                </div>    
                <div class="col-sm-1">
                    <input type="checkbox" id="checkCodigo" name="checkCodigo">
                </div> 
                <label for="producto" class="col-sm-2 col-form-label">Producto (*)</label>
                <div class="col-sm-4">
                    <select name="Producto" id="Producto" class="form-select">
                        <option value="">SELECCIONE</option>          
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="maquina" class="col-sm-2 col-form-label">Maquina (*)</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="maquina" name="maquina" value="" placeholder="Serie">
                </div>
                <label for="descripcionEquipo" class="col-sm-2 col-form-label">Descripcion Equipo (*)</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="descripcionEquipo" value="" placeholder="Descripcion Equipo...">
                </div>      
            </div>
            <div class="mb-3 row">
                <label for="proveedor2" class="col-sm-2 col-form-label">Proveedor (*) </label>
                <div class="col-sm-4">
                    <select name="Proveedor" id="Proveedor" class="form-select"></select>
                </div>
                <label for="moneda" class="col-sm-2 col-form-label">Moneda (*) </label>
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
                <label for="ruc" class="col-sm-2 col-form-label">RUC (*)</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ruc" value="" placeholder="Num RUC" readonly>
                </div>
                <label  class="col-sm-2 col-form-label">Tecnico Encargado (*)</label>
                <?php $ListaTecnicoOT=json_decode($data['ListaTecnicoOT']) ;?>
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
                <label for="proveedor2" class="col-sm-2 col-form-label">Concepto Trabajo (*) </label>
                <div class="col-sm-4">
                    <select name="ConceptoTrabajo" id="ConceptoTrabajo" class="form-select"></select>
                </div>
                <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="precio" value="1">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="detalleTrabajo" class="col-sm-2 col-form-label">Detalle del Trabajo (*)</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="detalleTrabajo" value="" placeholder="Detalle del Trabajo...">
                </div>
                <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="cantidad" value="1">
                </div>
            </div>
            <div class="mb-3 row">
            <label for="tipoDocumento" class="col-sm-2 col-form-label">Tipo Documento (*)</label>
                    <div class="col-sm-4">
						<select name="txtTipoDocumento" id="txtTipoDocumento" class="form-select">
                            <option value="SELECCIONE">SELECCIONE</option>  
							<option value="FACTURA">FACTURA</option>
                            <option value="RECIBO HONORARIO">RECIBO HONORARIO</option>
						</select>
                    </div>
            </div>
			<button type="button" class="btn btn-danger" onclick="agregarDetalleTrabajo1()">Añadir Detalle</button>
            </div>
		</div>	
		<div class="col-lg-12">
			<div class="card m-3">
				<div class="card-header text-bg-success">Detalle del Trabajo</div>
				<div class="card-body">
					<div class="row">
						<div class="box-body table-responsive no-padding">
							<table id="myTableDetalleTrabajo" class="table table-striped table-bordered"></table>
						</div><!--box-body --> 
					</div><!--box-body --> 
				</div>
			</div>
		</div>


				
	</div>
			</div>
<div class="card m-3">
    <div class="card-header text-bg-success">
        <div class="row">
            <div class="col-lg-3">
                <h2>Adicionar insumos : </h2>
            </div>
            <div class="col-lg-7">
                <select id="insumosOT" class="js-example-basic-multiple"  name="insumosOT[]" multiple="multiple"  style="width: 100%;" ></select>
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-danger" onclick="agregarInsumosOT()">Añadir Insumos</button>
            </div>
        </div>
    </div>
</div>

                      

	<div class="container-fluid">	
		<div class="card m-3">
			<div class="card-header text-bg-success">Detalle Insumos y Repuestos a Utilizar</div>
			<div class="card-body">
				<div class="row">
					<div class="box-body table-responsive no-padding">
                        <table id="myTableInsumoOT1" class="table table-striped table-bordered"></table>
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
								<button type="button" class="btn btn-success btn-lg w-100" onclick="procesarOT()">PROCESAR OT</button> 
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


<div id="vistapreviaOT" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Vista Previa OT</h5>
                <button class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmConceptosOT">
                    <div class="form-group">
                    <div id="htmlextra"></div>

                    <button class="btn btn-primary" type="button" onclick="registrarOTVALIDA(event);"
                        id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/templates/footer.php"; ?>
