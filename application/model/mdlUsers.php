<!-- modelo de usuario donde se heredan  los metodos de la clase padre -->
<?php
//HU-14 Roles 
//hay que crear primero la herencia si es necesaria
require_once("mdlPeople.php");

//crear la clase con la herencia
    //traer  los metodos get y set de la clase padre
class mdlUsers extends mdlPeople{
    //crear atributos
    private $idUser;
    private $username;
    private $password;
    private $statusUser;
    private $idRol;

    //traer  los metodos get y set de la clase padre
    //solo se traen los metodos costruc set y get cuando no tiene herencia
    public function __SET($attr, $value){
        //instanciar el attr
        $this->$attr = $value;
    }
    public  function __GET($attr){
        //retonar e instanciar
        return $this->$attr;
    }

    //metodo para validar el ingreso 
    public function validateUser(){
        //crear consulta  para validar el ingreso
        $sql = "SELECT P.Document, P.Names, P.Lastname, U.idUser, U.userName, U.PASSWORD, R.rolDescription 
        FROM people AS P INNER JOIN typedocuments AS TD ON P.idTypeDocument = TD.idTypeDocument 
        INNER JOIN users AS U ON P.idPerson = U.idPerson INNER JOIN roles AS R ON U.idRol = R.idRol
        WHERE U.userName = ? AND U.PASSWORD = ? AND R.idRol = 1";

        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->username);
        $stm->bindParam(2, $this->password);
        $stm->execute();
        //respuesta donde se trae todo lo asocicado
        $user=$stm->fetch(PDO::FETCH_ASSOC);
        //retornar el resultado
        return $user;
    }
    //metodo para ver los datos de los usuarios registrados 
     //metodo para traer personas registradas
     public function viewUsers(){
        //crear la consulta
        $sql="SELECT P.idPerson, P.Document, P.Names, P.Lastname, P.Email, P.Phone, P.Address, P.Gender, P.Birthdate,
         U.idUser, U.userName, U.statusUser, R.rolDescription FROM people AS P
        INNER JOIN users AS U ON P.idPerson = U.idPerson INNER JOIN roles AS R ON U.idRol = R.idRol";
        //preparar la consulta
        $stm= $this->db->prepare($sql);
        //ejecutar la consulta
        $stm->execute();
        //extraer datos
        $user=$stm->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
    

    public function viewRoles(){
        //crear la consulta
        $sql="SELECT * FROM roles";
        // Preparar la consulta
        $stm = $this->db->prepare($sql);
    
        // Ejecutar la consulta
        $stm->execute();
    
        // Retornar los roles
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }
    //metodo para registrar usuarios
    public function registerUser(){
        //crear la consulta
        $sql="INSERT INTO users (userName, PASSWORD, statusUser, idPerson, idRol)
         VALUES(?,?,?,?,?)";

        //estado del usuario siempre queda activo no hace falta mandarlo desde  el formulario
         $statusUser=1;

        // preparar la consulta
        $stm=$this->db->prepare($sql);

        // ejecutar la consulta
        // bindParam se utiliza para preparar y asociar valores a los parámetros de una consulta SQL, lo que ayuda a prevenir ataques de inyección SQL y permite una ejecución más eficiente de las consultas.
        $stm->bindParam(1, $this->username);
        $stm->bindParam(2, $this->password);
        $stm->bindParam(3, $statusUser);
        $stm->bindParam(4, $this->idPerson);
        $stm->bindParam(5, $this->idRol);
        // enlazar parámetros a una consulta SQL preparada. el número 1 indica el primer parámetro en la consulta SQL que se está preparando, $this->document es el valor que se va a enlazar a ese parámetro.
        // ejecutar la consulta
        $result=$stm->execute();
        return $result;
    }

    //metodo para traer los datos o filtrarlos por el id del usuario
    public function userId($id){
        //crear la consulta
        $sql = "SELECT P.*, U.*, R.*, TD.* FROM people AS P INNER JOIN typedocuments AS TD ON P.idTypeDocument = TD.idTypeDocument INNER JOIN users AS U ON P.idPerson = U.idPerson INNER JOIN roles AS R ON U.idRol = R.idRol WHERE U.idUser = ? LIMIT 1;";

        //preparar la consulta y ejecutarla
        $query = $this -> db -> prepare($sql);
        $query -> bindParam(1, $id);
        $query -> execute();
        return $query -> fetch(PDO::FETCH_ASSOC);
    }

    //metodo para cambiar estado
    public function changeStatus($id){
        //Crear la consulta
        $sql = "UPDATE users SET statusUser = (CASE WHEN statusUser = 1 THEN 0 ELSE 1 END) WHERE idUser = ?";

        $query = $this -> db -> prepare($sql);
        $query -> bindParam(1, $id);
        return $query -> execute();

    }

    // metodo para eliminar
    public function deleteUser($id){
        //Crear la consulta
        $sql = "DELETE U, P FROM users AS U INNER JOIN people AS P WHERE P.idPerson = U.idPerson AND U.idUser = ?";

        $query = $this -> db -> prepare($sql);
        $query -> bindParam(1, $id);
        return $query -> execute();

    }

    //metodo para editar
    public function updateUser(){
        //crear la consulta
        $sql="UPDATE people AS P INNER JOIN users AS U ON P.idPerson = U.idPerson SET P.Document = ?, P.Names = ?, P.Lastname = ?, P.Email = ?, P.Phone = ?, P.Address = ?, U.userName = ?, U.PASSWORD = ? WHERE U.idUser = ?";

        // preparar la consulta
        $stm=$this->db->prepare($sql);
        // ejecutar la consulta
        // bindParam se utiliza para preparar y asociar valores a los parámetros de una consulta SQL, lo que ayuda a prevenir ataques de inyección SQL y permite una ejecución más eficiente de las consultas.
        $stm->bindParam(1, $this->document);
        $stm->bindParam(2, $this->names);
        $stm->bindParam(3, $this->lastname);
        $stm->bindParam(4, $this->email);
        $stm->bindParam(5, $this->phone);
        $stm->bindParam(6, $this->address);
        $stm->bindParam(7, $this->username);
        $stm->bindParam(8, $this->password);
        $stm->bindParam(9, $this->idUser);
        // enlazar parámetros a una consulta SQL preparada. el número 1 indica el primer parámetro en la consulta SQL que se está preparando, $this->document es el valor que se va a enlazar a ese parámetro.
        // ejecutar la consulta
        $result=$stm->execute();
        return $result;
    }

}
?>