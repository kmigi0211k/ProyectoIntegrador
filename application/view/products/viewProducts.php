<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>PRODUCTOS <small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Productos</th>
                                        <th>Nombres</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Fecha Creacion</th>
                                        <th>Actiones</th>
                                        

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($product as $value): 
                                    $Product_data = [
                                        'idProducto' => $value['idProducto'],
                                        'Nombre' => $value['Nombre'],
                                        'Descripcion' => $value['Descripcion'],
                                        'Precio' => $value['Precio'],
                                        'Stock' => $value['Stock'],
                                        'FechaCreacion' => $value['FechaCreacion'],
                                    ];
                                    ?>
                                    <tr>
                                        <td><?php echo $value['idProducto']; ?></td>
                                        <td><?php echo $value['Nombre']; ?></td>
                                        <td><?php echo $value['Descripcion']; ?></td>
                                        <td><?php echo $value['Precio']; ?></td>
                                        <td><?php echo $value['Stock']; ?></td>
                                        <td><?php echo $value['FechaCreacion']; ?></td>

                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                                data-target="#modal-edit"
                                                onclick="dataProduct(<?php echo htmlspecialchars(json_encode($Product_data), ENT_QUOTES, 'UTF-8'); ?>)">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para editar -->
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal-edit">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Update Products</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <input type="hidden" name="txtidProducto" id="txtidProducto">

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Producto <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" id="txtNombre" required="required" class="form-control" name="txtNombre" placeholder="Nombre del producto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Descripcion</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" id="txtDescripcion" class="form-control" name="txtDescripcion" placeholder="Descripcion del producto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Precio</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="number" id="txtPrecio" class="form-control" name="txtPrecio" placeholder="Precio del producto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Stock</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="number" id="txtStock" class="form-control" name="txtStock" placeholder="Stock del producto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Fecha Creacion</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="date" id="txtFechaCreacion" class="form-control" name="txtFechaCreacion" placeholder="">
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <div class="col-md-9 col-sm-9 offset-md-3">
                                        <button type="button" class="btn btn-primary">Cancel</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button type="submit" class="btn btn-info" name="btnUpdate">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

