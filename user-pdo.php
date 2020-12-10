<?php

class userpdo {
    private $id ; 
    public $login ; 
    public $password ; 
    public $email ; 
    public $firstname ; 
    public $lastname ; 

    public function __construct($login,$password,$email,$firstname,$lastname){
           
        $this->login = $login ;
        $this->password = $password ; 
        $this->email = $email ; 
        $this->firstname = $firstname ; 
        $this->lastname = $lastname ; 
    }

    public function register(){
        
        try{

        $connexion = new PDO("mysql:host=localhost;dbname=classes",'root','') ; 
        $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        $requete = $connexion->prepare("INSERT INTO utilisateurs(login,password,email,firstname,lastname ) VALUES (:login, :password, :email, :firstname,:lastname)"); 
        
        $requete->bindParam(':login', $this->login);
        $requete->bindParam(':password', $this->password);
        $requete->bindParam(':email', $this->email);
        $requete->bindParam(':firstname', $this->firstname);
        $requete->bindParam(':lastname', $this->lastname);

        $requete->execute();

        echo ' Utilisateur ajouté ' ;

        }
        catch(PDOExeption $e)
        {
            echo 'echec de la connexion : ' .$e->getMessage();
        }
    }

}    

$user1 = new userpdo ("test", "mdp", "test@gmail.com", "toto", "tata"); 

$user1->register();



?>