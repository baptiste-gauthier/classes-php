<?php

class Userpdo {
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

            $check_login = $connexion->query("SELECT login FROM utilisateurs WHERE login = '$this->login'") ;
            
            $result = $check_login->fetch(); 
            if($result['login'] != $this->login)
            {
                $requete = $connexion->prepare("INSERT INTO utilisateurs(login,password,email,firstname,lastname ) VALUES (:login, :password, :email, :firstname,:lastname)"); 
                
                $requete->bindParam(':login', $this->login);
                $requete->bindParam(':password', $this->password);
                $requete->bindParam(':email', $this->email);
                $requete->bindParam(':firstname', $this->firstname);
                $requete->bindParam(':lastname', $this->lastname);
        
                $requete->execute();
        
                echo ' Utilisateur ajouté ' ;
            }
            else{
                echo 'login déjà pris' ;
            }


        }

        catch(PDOExeption $e)
        {
            echo 'echec de la connexion : ' .$e->getMessage();
        }
    }

    public function connect($login,$password){
        
        try{

            $connexion = new PDO("mysql:host=localhost;dbname=classes",'root','') ; 
            $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
            
            $requete = $connexion->prepare("SELECT * FROM utilisateurs 
                            WHERE login = :login AND password = :password"
            );

            $requete->bindParam(':login',$login);
            $requete->bindParam(':password',$password);

            $requete->execute();
            
            $result = $requete->fetch(); 

            var_dump($result);


            if($result['login'] == $login && $result['password'] == $password)
            {
                 
                echo 'Bravo vous êtes connecté' ; 

                $this->login = $result['login'] ; 
                $this->password = $result['password'] ;
                $this->email = $result['email'] ;
                $this->firstname = $result['firstname'] ;
                $this->lastname = $result['lastname'] ;
               
                return [$this->login, $this->password,$this->email,$this->firstname,$this->lastname] ;
                
            }

            else
            {
                 echo 'Erreur' ;
            }
        }

         
        catch(PDOExeption $e)
        {
            echo 'echec de la connexion : ' .$e->getMessage();
        }  

    }



}    

$user1 = new Userpdo ("test", "mdp", "test@gmail.com", "toto", "tata"); 

$user1->connect("test","mdp");



?>