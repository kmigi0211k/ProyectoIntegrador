<?php
//crear el primer objeto del modelo 
class mdlPeople{
    //atributos
    public $idPerson;
    public $document;
    public $idTypeDocument;
    public $names;
    public $lastname;
    public $phone;
    public $address;
    public $email;
    public $birthDate;
    public $gender;
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
    public function viewPeople(){
        //crear la consulta
        $sql="SELECT * FROM people";
        //preparar la consulta
        $query= $this->db->prepare($sql);
        //ejecutar la consulta
        $query->execute();
        //extraer datos
        $people=$query->fetchAll(PDO::FETCH_ASSOC);
        return $people;
    }
    //metodo para traer todos los tipos de documentos
    public function viewDocumentType(){
        //crear la consulta
        $sql="SELECT * FROM typedocuments";
        //preparar la consulta
        $query= $this->db->prepare($sql);
        //ejecutar la consulta
        $query->execute();
        // extraer datos
        $typedocument=$query->fetchAll(PDO::FETCH_ASSOC);
        return $typedocument;
    }
    //metodo para traer el ultimo id registrado
    public function viewLastId(){
        //crear consulta
        $sql="SELECT MAX(idPerson) AS lastId FROM people";
        //prepara consulta
        $query= $this->db->prepare($sql);
        //ejecutar la consulta
        $query->execute();
        //extraer datos
        $lastId=$query->fetchAll(PDO::FETCH_ASSOC);
        return $lastId;
    }
    //metodo para hacer el registro de personas
    public function registerPeople(){
    //crear la consulta
    $sql="INSERT INTO people (Document, Names, Lastname, Email, Phone, Address, Gender, Birthdate, idTypeDocument)
     VALUES(?,?,?,?,?,?,?,?,?)";
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
    $stm->bindParam(7, $this->gender);
    $stm->bindParam(8, $this->birthDate);
    $stm->bindParam(9, $this->idTypeDocument);
    //enlazar parámetros a una consulta SQL preparada. el número 1 indica el primer parámetro en la consulta SQL que se está preparando, $this->document es el valor que se va a enlazar a ese parámetro.
    //  ejecutar la consulta
    $result=$stm->execute();
    return $result;
    }
}
?>