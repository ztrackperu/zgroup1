<?php include "Views/templates/navbar.php"; ?>
<p></p>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Stock de Inventario</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tblStock">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Codigo</th> 
                                <th>Articulo</th>
                                <th>PartNumber</th>
                                <th>Serie</th> 
                                <th>Marca</th>
                                <th>Condicion</th>
                                <th>Medida</th> 
                                <th>Sock</th>
                                <th>Familia</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "Views/templates/footer.php"; ?>