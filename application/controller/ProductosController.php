<?php
class ProductosController extends Controller{
    private $modelP;
    //constructor 
    public function __construct(){
        $this -> modelP = $this -> loadModel("mdlProductos");
    }
    //metodo para ver todos los productos registrados
    public function viewProducts(){
        // Condicional para actualizar
        if(isset($_POST['btnUpdate'])){
            $this->modelP->__SET('Nombre', $_POST['txtNombre']);
            $this->modelP->__SET('Descripcion', $_POST['txtDescripcion']);
            $this->modelP->__SET('Precio', $_POST['txtPrecio']);
            $this->modelP->__SET('Stock', $_POST['txtStock']);
            // Aquí asignamos la fecha y hora actual al campo FechaUltimaModificacion
            $this->modelP->__SET('FechaCreacion', date('Y-m-d H:i:s'));  // Fecha y hora actual
            $this->modelP->__SET('idProducto', $_POST['txtidProducto']);
    
    
            // Llamamos a la función de actualización
            $update = $this->modelP->updateProduct();
            // var_dump($update);
            // exit;
    
            // Redirigir después de la actualización
            header("Location: ". URL . "ProductosController/viewProducts");
        }
    
        // Cargar productos para mostrarlos
        $product = $this->modelP->viewProducts();
    
        // Cargar las vistas
        require_once APP."view/_templates/header.php";
        require_once APP."view/products/viewProducts.php";
        require_once APP."view/_templates/footer.php";
    }
    
    public function registerProduct(){
        //validamos si existen los atributos del modelo y los name del formulario
        if(isset($_POST['btnSubmit'])){
            $this->modelP->__SET('Nombre', $_POST['txtNombre']);
            $this->modelP->__SET('Descripcion', $_POST['txtDescripcion']);
            $this->modelP->__SET('Precio', $_POST['txtPrecio']);
            $this->modelP->__SET('Stock', $_POST['txtStock']);
            $this->modelP->__SET('FechaCreacion', $_POST['txtFechaCreacion']);
            // if($_FILES['txtFoto']['tmp_name'] != null){
            //     $this->modelP->__SET('Imagen', file_get_contents($_FILES['txtFoto']['tmp_name']));
            // }

            $product=$this->modelP->registerProduct();
            // var_dump($product);
            // exit;
                header("Location: ". URL . "ProductosController/viewProducts");
            }
    
                require_once APP."view/_templates/header.php";
                require_once APP."view/products/registerProducts.php";
                require_once APP."view/_templates/footer.php";
            }
            //metodo para filtrar o traer los datos por el ID 
            public function dataProducts(){
                //crear la variable para controlar
                $product=$_POST['id'];
                echo $product;
            }
        
        

}


?>