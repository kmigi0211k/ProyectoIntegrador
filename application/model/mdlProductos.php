<?php
class mdlProductos{
    //atributos
    public $idProducto;
    public $Nombre;
    public $Descripcion;
    public $Precio;
    public $Stock;
    public $FechaCreacion;
    public $db;
    
     //metodo para setear o fijar datos
     public function __SET($attr, $value){
        //instanciar el attr
        $this->$attr = $value;
    }
    //se utiliza para obtener
    public  function __GET($attr){
        //retonar e instanciar
        return $this->$attr;
    }

    //crear el constructor 
    public  function __construct($db){
        $this->db = $db;
        try {
            $this->db=$db;
        }catch(PDOException $e){
            exit("error, connecting Database");
        }
    }
    //metodo para traer productos registradas
    public function viewProducts(){
        //crear la consulta
        $sql="SELECT * FROM productos";
        //preparar la consulta
        $query= $this->db->prepare($sql);
        //ejecutar la consulta
        $query->execute();
        //extraer datos
        $product=$query->fetchAll(PDO::FETCH_ASSOC);
        return $product;
    }

        //metodo para traer los datos o filtrarlos por el id del producto
        public function productId($id){
            //crear la consulta
            $sql = "SELECT * FROM productos WHERE idProducto = ?";

    
            //preparar la consulta y ejecutarla
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(1, $id);
            $query -> execute();
            return $query -> fetch(PDO::FETCH_ASSOC);
        }
    
    
    
        // metodo para eliminar
        public function deleteProduct($id){
            //Crear la consulta
            $sql = "DELETE FROM productos AND idProducto = ?";
    
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(1, $id);
            return $query -> execute();
    
        }
         //metodo para editar
    public function updateProduct(){
        //crear la consulta
        $sql="UPDATE productos SET  Nombre = ?, Descripcion = ?, Precio = ?, Stock = ?, FechaCreacion = ? WHERE idProducto = ?";

        // preparar la consulta
        $stm=$this->db->prepare($sql);
        // ejecutar la consulta
        // bindParam se utiliza para preparar y asociar valores a los parámetros de una consulta SQL, lo que ayuda a prevenir ataques de inyección SQL y permite una ejecución más eficiente de las consultas.
        $stm->bindParam(1, $this->Nombre);
        $stm->bindParam(2, $this->Descripcion);
        $stm->bindParam(3, $this->Precio);
        $stm->bindParam(4, $this->Stock);
        $stm->bindParam(5, $this->FechaCreacion);
        $stm->bindParam(6, $this->idProducto);
        // enlazar parámetros a una consulta SQL preparada. el número 1 indica el primer parámetro en la consulta SQL que se está preparando, $this->document es el valor que se va a enlazar a ese parámetro.
        // ejecutar la consulta
        $result=$stm->execute();
        return $result;
    }
        //metodo para registrar Productos
        public function registerProduct(){
            //crear la consulta
            $sql="INSERT INTO productos (Nombre, Descripcion, Precio,  Stock, FechaCreacion)
             VALUES(?,?,?,?,?)";
    
            //estado del usuario siempre queda activo no hace falta mandarlo desde  el formulari
    
            // preparar la consulta
            $stm=$this->db->prepare($sql);
    
            // ejecutar la consulta
            // bindParam se utiliza para preparar y asociar valores a los parámetros de una consulta SQL, lo que ayuda a prevenir ataques de inyección SQL y permite una ejecución más eficiente de las consultas.
            $stm->bindParam(1, $this->Nombre);
            $stm->bindParam(2, $this->Descripcion);
            $stm->bindParam(3, $this->Precio);
            $stm->bindParam(4, $this->Stock);
            $stm->bindParam(5, $this->FechaCreacion);
            // enlazar parámetros a una consulta SQL preparada. el número 1 indica el primer parámetro en la consulta SQL que se está preparando, $this->document es el valor que se va a enlazar a ese parámetro.
            // ejecutar la consulta
            $result=$stm->execute();
            return $result;
        }

}




?>