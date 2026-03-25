<?php
//crear el objeto y heredar
// HU #9 Gestión de Usuarios
class userController extends controller{
    //atributos
    private $modelU;

    //el controlador requiere del constructor
    public function __construct(){
        //instanciar los modelos que se lleguen a necesitar
        $this->modelU = $this->loadModel("mdlUsers");   
    }

    public function index(){

        if(isset($_POST['btnLogin'])){

          
            if(empty($_POST['txtUsername']) || empty($_POST['txtPassword'])){
                $_SESSION['alert'] = "Swal.fire({
                    icon: 'error',
                    title: 'Campos vacíos'
                })";
                require_once APP."view/users/login.php";
                return;
            }

            $this->modelU->__SET('username', $_POST['txtUsername']);
            $this->modelU->__SET('password', $_POST['txtPassword']);

            $validate = $this->modelU->validateUser();

            if($validate){
                $_SESSION['SESSION_START'] = true;

                $_SESSION['Names']=$validate['Names'];
                $_SESSION['idUser']=$validate['idUser'];

                header("Location:".URL."userController/main");
            } else {
                $_SESSION['alert'] = "Swal.fire({
                    icon: 'error',
                    title: 'Credenciales incorrectas'
                })";
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

        if(isset($_POST['btnUpdate'])){

         
            if(empty($_POST['txtNames']) || empty($_POST['txtEmail'])){
                $_SESSION['alert'] = "Swal.fire({
                    icon: 'error',
                    title: 'Campos obligatorios'
                })";
                header("Location: ". URL . "userController/viewUsers");
                return;
            }

            $this->modelU->__SET('document', $_POST['txtDocument']);
            $this->modelU->__SET('names', $_POST['txtNames']);
            $this->modelU->__SET('lastname', $_POST['txtLastNames']);
            $this->modelU->__SET('phone', $_POST['txtPhone']);
            $this->modelU->__SET('email', $_POST['txtEmail']);
            $this->modelU->__SET('address', $_POST['txtAddress']);
            $this->modelU->__SET('username', $_POST['txtUsername']);
            $this->modelU->__SET('password', $_POST['txtPassword']); // 🔧 corregido
            $this->modelU->__SET('idUser', $_POST['txtIdUser']);

            $update = $this->modelU->updateUser();

    
            $_SESSION['alert'] = "Swal.fire({
                icon: 'success',
                title: 'Usuario actualizado correctamente'
            })";

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

            if($people == true){
                $lastId=$this->modelU->viewLastId();
                $lastIdValue=null;

                foreach($lastId as $value){
                    $lastIdValue=$value['lastId'];
                }

                $this->modelU->__SET('idPerson', $lastIdValue);
                $this->modelU->__SET('username', $_POST['txtUsername']);
                $this->modelU->__SET('password', $_POST['txtPassword']);
                $this->modelU->__SET('idRol', $_POST['selRol']);

                $this->modelU->registerUser();

                header("Location: ". URL . "userController/viewUsers");
            }
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
        $user=$_POST['id'];
        echo $user;
    }

    //metodo para cambiar el estado
    public function changeStatus(){
        $this->modelU->changeStatus($_POST['id']);
        echo 1;
    }

    //metodo para eliminar
    public function deleteUser(){
        $this->modelU->deleteUser($_POST['id']);
        echo 1;
    }
}
?>