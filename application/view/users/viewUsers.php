<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Default Example <small>Users</small></h2>
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
                            <p class="text-muted font-13 m-b-30">
                                DataTables has most features enabled by default, so all you need to do to use it with
                                your own tables is to call the construction function: <code>$().DataTable();</code>
                            </p>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Document</th>
                                        <th>Names</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Rol</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $value): 
                                    //areglo para preparar los datos del usuario y mostrarlos
                                    $user_data = [
                                    'Document' => $value['Document'],
                                    'Names' => $value['Names'],
                                    'Lastname' => $value['Lastname'],
                                    'Email' => $value['Email'],
                                    'userName' => $value['userName'],
                                    'rolDescription' => $value['rolDescription'],
                                    'statusUser' => $value['statusUser'],
                                    'idUser' => $value['idUser'],
                                    'Phone' => $value['Phone'],
                                    'Address' => $value['Address'],
                                    ];
                                    ?>
                                    <tr>
                                        <td><?php echo $value['Document']; ?></td>
                                        <td><?php echo $value['Names']; ?></td>
                                        <td><?php echo $value['Lastname']; ?></td>
                                        <td><?php echo $value['Email']; ?></td>
                                        <td><?php echo $value['userName']; ?></td>
                                        <td><?php echo $value['rolDescription']; ?></td>
                                        <td>
                                            <?php if($value['statusUser']==1): ?>
                                            <label for="" class="badge badge-pill badge-success">Active</label>
                                            <?php else: ?>
                                            <label for="" class="badge badge-pill badge-danger">Inactive</label>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                                data-target="#modal-edit"
                                                onclick="dataUser(<?php echo htmlspecialchars(json_encode($user_data), ENT_QUOTES, 'UTF-8');?>)"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-warning btn-xs"
                                                onclick="changeStatus('<?php echo $value['idUser']; ?>')"><i
                                                    class="fa fa-refresh" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs"
                                                onclick="deleteUser('<?php echo $value['idUser']; ?>')"><i
                                                    class="fa fa-user-times" aria-hidden="true"></i></button>
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
                            <h4 class="modal-title" id="myModalLabel">Update User</h4>
                            <button type="button" class="close" data-dismiss="modal"><span
                                    aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <form method="post">

                                <input type="text" name="txtIdUser" id="txtIdUser" hidden>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Document <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="txtDocument" name="txtDocument"
                                            class="form-control" placeholder="escribe tu documento">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Names <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="txtNames" required="required" class="form-control"
                                            name="txtNames" placeholder="escribe tu nombre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">Last Name</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="txtLastNames" class="form-control col" type="text" name="txtLastNames"
                                            placeholder="escribe tus apellidos">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">Username</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="txtUsername" class="form-control col" type="text" name="txtUsername"
                                            placeholder="escribe tu Usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="txtEmail" class="form-control col" type="email" name="txtEmail"
                                            placeholder="escribe tu correo electronico" required="required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">Phone</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="txtPhone" class="form-control col" type="text" name="txtPhone"
                                            placeholder="digita tu numero de celular">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">Address</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="txtAddress" class="form-control col" type="text" name="txtAddress"
                                            placeholder="escribe tu direccion">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Password <span
                                            class="required">*</span></label>
                                    <div class="col-md-3 col-sm-3 ">
                                        <input type="password" id="txtPassword" required="required" class="form-control"
                                            name="txtPassword" placeholder="Password">
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