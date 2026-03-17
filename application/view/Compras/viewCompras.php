<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>COMPRAS <small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <p class="text-muted font-13 m-b-30"><code></code>
                            </p>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Articulo</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Total</th>
                                        <th>Actiones</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($Compras as $value): 
                                    //areglo para preparar los datos del usuario y mostrarlos
                                    $Compras_data = [
                                    'id' => $value['id'],
                                    'articulo' => $value['articulo'],
                                    'cantidad' => $value['cantidad'],
                                    'precio_unitario' => $value['precio_unitario'],
                                    'total' => $value['total'],
                                    ];
                                    ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['articulo']; ?></td>
                                        <td><?php echo $value['cantidad']; ?></td>
                                        <td><?php echo $value['precio_unitario']; ?></td>
                                        <td><?php echo $value['total']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                                data-target="#modal-edit"
                                                onclick="dataCompra(<?php echo htmlspecialchars(json_encode($Compras_data), ENT_QUOTES, 'UTF-8');?>)"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            <!-- <button type="button" class="btn btn-danger btn-xs"
                                                onclick="deleteCompra('<?php echo $value['id']; ?>')"><i
                                                    class="fa fa-user-times" aria-hidden="true"></i></button> -->
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal para editar -->
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal-edit">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"></h4>
                            <button type="button" class="close" data-dismiss="modal"><span
                                    aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <form method="post">

                                <input type="text" name="txtid" id="txtid" hidden>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Articulo <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="txtarticulo" required="required" class="form-control"
                                            name="txtarticulo" placeholder="escribe tu Articulo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">Cantidad</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="txtcantidad" class="form-control col" type="text" name="txtcantidad"
                                            placeholder="escribe la Cantidad">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">precio unitario</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="txtprecio_unitario" class="form-control col" type="text" name="txtprecio_unitario"
                                            placeholder="Escribe el Precio Unitario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">total</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="txttotal" class="form-control col" type="number" name="txttotal"
                                            placeholder="Escribe el total" required="required">
                                    </div>
                                </div>
            
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9 col-sm-9 offset-md-3">
                                        <button type="button" class="btn btn-primary">Cancel</button>
                                        <button class="btn btn-warning" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-info" name="btnUpdate">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>