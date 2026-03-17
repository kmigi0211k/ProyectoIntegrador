<?php
class mdlCompras{
    //atributos
    public $articulo;
    public $cantidad;
    public $precio_unitario;
    public $total;
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
    //metodo para traer personas registradas
    public function viewCompras(){
        //crear la consulta
        $sql="SELECT * FROM compras";
        //preparar la consulta
        $query= $this->db->prepare($sql);
        //ejecutar la consulta
        $query->execute();
        //extraer datos
        $people=$query->fetchAll(PDO::FETCH_ASSOC);
        return $people;
    }

        //metodo para traer los datos o filtrarlos por el id de la compra
        public function CompraId($id){
            //crear la consulta
            $sql = "SELECT * FROM compras WHERE id = ?";
    
            //preparar la consulta y ejecutarla
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(1, $id);
            $query -> execute();
            return $query -> fetch(PDO::FETCH_ASSOC);
        }

         //metodo para editar
        public function updateCompra(){
        //crear la consulta
        $sql="UPDATE compras SET  articulo = ?, cantidad = ?, precio_unitario = ?, total = ?  WHERE id = ?";

        // preparar la consulta
        $stm=$this->db->prepare($sql);
        // ejecutar la consulta
        // bindParam se utiliza para preparar y asociar valores a los parámetros de una consulta SQL, lo que ayuda a prevenir ataques de inyección SQL y permite una ejecución más eficiente de las consultas.
        $stm->bindParam(1, $this->articulo);
        $stm->bindParam(2, $this->cantidad);
        $stm->bindParam(3, $this->precio_unitario);
        $stm->bindParam(4, $this->total);
        $stm->bindParam(5, $this->id);
        // enlazar parámetros a una consulta SQL preparada. el número 1 indica el primer parámetro en la consulta SQL que se está preparando, $this->document es el valor que se va a enlazar a ese parámetro.
        // ejecutar la consulta
        $result=$stm->execute();
        return $result;
    }
        //metodo para registrar Productos
        public function registerCompra(){
            //crear la consulta
            $sql="INSERT INTO compras (articulo, cantidad, precio_unitario, total)
             VALUES(?,?,?,?)";
    
            //estado del usuario siempre queda activo no hace falta mandarlo desde  el formulari
    
            // preparar la consulta
            $stm=$this->db->prepare($sql);
    
            // ejecutar la consulta
            // bindParam se utiliza para preparar y asociar valores a los parámetros de una consulta SQL, lo que ayuda a prevenir ataques de inyección SQL y permite una ejecución más eficiente de las consultas.
            $stm->bindParam(1, $this->articulo);
            $stm->bindParam(2, $this->cantidad);
            $stm->bindParam(3, $this->precio_unitario);
            $stm->bindParam(4, $this->total);
            // enlazar parámetros a una consulta SQL preparada. el número 1 indica el primer parámetro en la consulta SQL que se está preparando, $this->document es el valor que se va a enlazar a ese parámetro.
            // ejecutar la consulta
            $result=$stm->execute();
            return $result;
        }

         // metodo para eliminar
    public function deleteCompra($id){
        //Crear la consulta
        $sql = "DELETE FROM compras (articulo, cantidad, precio_unitario, total) VALUES(?,?,?,?)";

        $query = $this -> db -> prepare($sql);
        $query -> bindParam(1, $id);
        return $query -> execute();

    }

}

?>