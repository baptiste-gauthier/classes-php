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

    public function disconnect(){

        $this->login = NULL ;
        $this->password = NULL ; 
        $this->email = NULL ; 
        $this->firstname = NULL ;  
        $this->lastname = NULL ;  
       
        echo 'Vous avez été déconnecté' ; 

        return[$this->login, $this->password,$this->email,$this->firstname,$this->lastname];
    }

    public function update($login,$password,$email,$firstname,$lastname){

        $connexion = new PDO("mysql:host=localhost;dbname=classes",'root','') ; 
        $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        $requete = $connexion->prepare("UPDATE utilisateurs 
        SET login = :login,
            password = :password,
            email = :email,
            firstname = :firstname,
            lastname = :lastname
                WHERE login = :thislogin " 
        );

        $requete->bindParam(':login', $login);
        $requete->bindParam(':password', $password);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':firstname', $firstname);
        $requete->bindParam(':lastname', $lastname);
        $requete->bindParam(':thislogin', $this->login);

        if($requete->execute())
        {
            echo 'Changement effectuer ! ' ; 
            $this->login = $login ; 
            $this->password = $password ; 
            $this->email = $email ; 
            $this->firstname = $firstname ;
            $this->lastname = $lastname ;  

        }
        else 
        {
            echo 'Erreur' ;
        }

    }

    public function delete(){
        try{
            $connexion = new PDO("mysql:host=localhost;dbname=classes",'root','') ; 
            $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

            $requete = $connexion->prepare("DELETE FROM `utilisateurs` WHERE login = :login ") ;
            $requete->bindParam(':login', $this->login) ;

            if($requete->execute())
            {
                echo 'Données effacées'; 
            }
            else{
                echo 'Erreur';
            }
            
        }
        catch(PDOExeption $e)
        {
            echo 'Erreur : ' .$e->getMessage() ;
        }


    }

    public function getAllInfos(){
        $allinfos = [$this->login,$this->password,$this->email,$this->firstname,$this->lastname] ; 
        var_dump($allinfos) ; 
        return $allinfos ;
    }

    public function isConnected(){
            
        if($this->login != NULL && $this->password != NULL)
        {
            echo 'Utilisateur connecté'; 
            return TRUE ;
        }
        else
        {
            echo 'erreur' ; 
            return FALSE ;
        }

    }

    public function getLogin(){
        var_dump($this->login);
        return $this->login ;
    }

    public function getEmail(){
        var_dump($this->email);
        return $this->email ;
    }

    public function getFirstname(){
        var_dump($this->firstname);
        return $this->firstname ;
    }

    public function getLastname(){
        var_dump($this->lastname);
        return $this->lastname ;
    }

    public function refresh(){
        $connexion = new PDO("mysql:host=localhost;dbname=classes",'root','') ; 
        $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        $requete = $connexion->prepare("SELECT * FROM `utilisateurs` WHERE login = :login ") ;
        $requete->bindParam(':login', $this->login) ;

        $requete->execute(); 

        $result = $requete->fetch();
        var_dump($result);

        $this->login = $result['login'];
        $this->password = $result['password'];
        $this->email = $result['email'];
        $this->firstname = $result['firstname'];
        $this->lastname = $result['lastname'];

        return [$this->login,$this->password,$this->email,$this->firstname,$this->lastname] ;

    }
}    

$user1 = new Userpdo ("Zoro", "katana", "zoro@pirate.fr", "Roronoa", "Zoro"); 

$user2 = new Userpdo ("Vermin" , "police" , "regis@mentos.fr", "Mentos", "Régis");

$user2->refresh();







?>