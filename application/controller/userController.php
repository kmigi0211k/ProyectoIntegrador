<?php
//crear el objeto y heredar
class userController extends controller{
    //atributos
    private $modelU;

    //el controlador requiere del constructor
    public function __construct(){
        //isntanciar los modelos que se lleguen a necesitar
     $this-> modelU = $this->loadModel("mdlUsers");   
    }
    public function index(){
        $error = false;
        if(isset($_POST['btnLogin'])){
            $this ->modelU->__SET('username', $_POST['txtUsername']);
            $this ->modelU->__SET('password', $_POST['txtPassword']);
            //vamos a crear un arreglo que luego se llenara con los datos del usuario 
            $_POST=[];

            $validate =$this->modelU->validateUser();

            //condicional para usar el sweetalert
            if($validate == true){
                $_SESSION['alert'] = "Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Done',
                showConfirmButton: false,
                timer: 1500})";

                if($validate==true){
                    // var_dump($validate);
                    // exit;
                    //activamos la sesion
                    $_SESSION['SESSION_START'] = true;
                    $error=false;
    
                    $_SESSION ['Names']=$validate ['Names'];
                    $_SESSION ['idUser']=$validate ['idUser'];
                    $_SESSION ['LastName']=$validate ['LastName'];
                    $_SESSION ['Document']=$validate ['Document'];
                    $_SESSION ['userName']=$validate ['userName'];
                    $_SESSION ['Description']=$validate ['Description'];
    
                    header("Location:".URL."userController/main");
                }else{
                    $error=true;
                }
    
            }
        }
        require_once APP."view/users/login.php";
    }

    //metodo para el admin 
    public function main(){
        require_once APP."view/_templates/header.php";
        require_once APP."view/users/main.php";
        require_once APP."view/_templates/footer.php";
    }

    //metodo para ver todos los usuarios registrados
    public function viewUsers(){
        //condicional para actualizar
        if(isset($_POST['btnUpdate'])){
            $this->modelU->__SET('document', $_POST['txtDocument']);
            $this->modelU->__SET('names', $_POST['txtNames']);
            $this->modelU->__SET('lastname', $_POST['txtLastNames']);
            $this->modelU->__SET('phone', $_POST['txtPhone']);
            $this->modelU->__SET('email', $_POST['txtEmail']);
            $this->modelU->__SET('address', $_POST['txtAddress']);
            $this->modelU->__SET('username', $_POST['txtUsername']);
            $this->modelU->__SET('password', $_POST['txtpassword']);
            $this->modelU->__SET('idUser', $_POST['txtIdUser']);

            $update=$this->modelU->updateUser();

                header("Location: ". URL . "userController/viewUsers");
            }
        $users=$this->modelU->viewUsers();
        $roles=$this->modelU->viewRoles();
        require_once APP."view/_templates/header.php";
        require_once APP."view/users/viewUsers.php";
        require_once APP."view/_templates/footer.php";

    }

    //metodo para registrar usuarios
    public function registerUser(){
        //validamos si existen los atributos del modelo y los name del formulario
        if(isset($_POST['btnSubmit'])){
            $this->modelU->__SET('idTypeDocument', $_POST['selDocument']);
            $this->modelU->__SET('document', $_POST['txtDocument']);
            $this->modelU->__SET('names', $_POST['txtNames']);
            $this->modelU->__SET('lastname', $_POST['txtLastNames']);
            $this->modelU->__SET('birthDate', $_POST['txtBirthDate']);
            $this->modelU->__SET('phone', $_POST['txtPhone']);
            $this->modelU->__SET('email', $_POST['txtEmail']);
            $this->modelU->__SET('address', $_POST['txtAddress']);
            $this->modelU->__SET('gender', $_POST['txtGender']);


            $people=$this->modelU->registerPeople();
            //mandar registro
            if($people== true){
                $lastId=$this->modelU->viewLastId();
                $lastIdValue=null;
                    foreach($lastId as $value){
                        $lastIdValue=$value['lastId'];
                    }
                }
                $this->modelU ->__SET('idPerson', $lastIdValue);
                $this->modelU->__SET('username', $_POST['txtUsername']);
                $this->modelU->__SET('password', $_POST['txtPassword']);
                $this->modelU->__SET('idRol', $_POST['selRol']);

                $user =$this->modelU->registerUser();
                header("Location: ". URL . "userController/viewUsers");
            }
                $roles=$this->modelU->viewRoles();
                $documentType=$this->modelU->viewDocumentType();
                require_once APP."view/_templates/header.php";
                require_once APP."view/users/registerUser.php";
                require_once APP."view/_templates/footer.php";
            }

            //metodo para cerrar sesion
            public function logOut(){
                if(isset($_SESSION['SESSION_START'])){
                    session_destroy();

                }
                header("Location:" . URL . "home/index");
            }
            //metodo para filtrar o traer los datos por el ID 
            public function dataUser(){
                //crear la variable para controlar
                $user=$_POST['id'];
                echo $user;
            }
            //metodo para cambiar el estado
            public function changeStatus(){
                //crear la variable para controlar
                $status = $this -> modelU -> changeStatus($_POST['id']);
                echo 1;
            }

            //metodo para eliminar
            public function deleteUser(){
                //crear la variable para controlar
                $delete = $this -> modelU -> deleteUser($_POST['id']);
                echo 1;
            }
        }
    ?>