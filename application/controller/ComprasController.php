<?php
class ComprasController extends Controller{
    private $modelC;
    //constructor 
    public function __construct(){
        $this -> modelC = $this -> loadModel("mdlCompras");
    }
    
    //metodo para ver todos los productos registrados
    public function viewCompras(){
        //condicional para actualizar
        if(isset($_POST['btnUpdate'])){
            $this->modelC->__SET('articulo', $_POST['txtarticulo']);
            $this->modelC->__SET('cantidad', $_POST['txtcantidad']);
            $this->modelC->__SET('precio_unitario', $_POST['txtprecio_unitario']);
            $this->modelC->__SET('total', $_POST['txttotal']);
            $this->modelC->__SET('id', $_POST['txtid']);
            $update=$this->modelC->updateCompra();
// var_dump($update);
// exit;
            header("Location: ". URL . "ComprasController/viewCompras");
        }
        $Compras=$this->modelC->viewCompras();
        require_once APP."view/_templates/header.php";
        require_once APP."view/Compras/viewCompras.php";
        require_once APP."view/_templates/footer.php";
    }

    public function registerCompras(){
        //validamos si existen los atributos del modelo y los name del formulario
        if(isset($_POST['btnSubmit'])){
            $this->modelC->__SET('articulo', $_POST['txtarticulo']);
            $this->modelC->__SET('cantidad', $_POST['txtcantidad']);
            $this->modelC->__SET('precio_unitario', $_POST['txtprecio_unitario']);
            $this->modelC->__SET('total', $_POST['txttotal']);
            $compra =$this->modelC->registerCompra();
            // var_dump($compra);
            // exit;
            header("Location: ". URL . "ComprasController/registerCompras");
       
            }
                     
            require_once APP."view/_templates/header.php";
            require_once APP."view/Compras/registerCompras.php";
            require_once APP."view/_templates/footer.php";
    }

     //metodo para filtrar o traer los datos por el ID 
     public function dataCompra(){
        //crear la variable para controlar
        $Compra=$_POST['id'];
        echo $Compra;
    }
      //metodo para eliminar
      public function deleteCompra(){
        //crear la variable para controlar
        $delete = $this -> modelC -> deleteCompra($_POST['id']);
        echo 1;
    }

}


?>



            