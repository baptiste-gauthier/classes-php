<?php

    class User {
        private $id ; 
        public $login ; 
        public $password ; 
        public $email ; 
        public $firstname ; 
        public $lastname ; 

        public function register() {
            $db = mysqli_connect("localhost","root","","classes") ; 

            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }

            $requete = "INSERT INTO utilisateurs(login,password,email,firstname,lastname) 
                            VALUES ('$this->login', '$this->password', '$this->email', '$this->firstname','$this->lastname'
            );";

            $query = mysqli_query($db,$requete) ; 

            var_dump($query); 
            var_dump($requete) ; 

            echo 'utilisateur ajouté ! ' ; 

            $sql = "SELECT * FROM utilisateurs" ;
            $exec = mysqli_query($db,$sql) ; 

            $result = mysqli_fetch_all($exec) ; 
            var_dump($result) ;

            return $result ; 

            //  Partie PDO 

            // $connexion = new PDO("mysql:host=localhost;dbname=classes",'root','') ; 
            // $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

            // $requete = $connexion->prepare("INSERT INTO utilisateurs(login,password,email,firstname,lastname ) VALUES ('$this->login', '$this->password', '$this->email', '$this->firstname','$this->lastname')");   
            // $requete->execute();
            
        }
    }

    $user1 = new User() ; 
    $user1->login = "bapt" ;
    $user1->password = "mdp" ;
    $user1->email = "baptiste.gauthier@laplateforme.io" ;
    $user1->firstname = "Baptiste" ;
    $user1->lastname = "GAUTHIER" ;

    $user2 = new User() ; 
    $user2->login = "JOJO" ;
    $user2->password = "pass" ;
    $user2->email = "jojo@gmail.com" ;
    $user2->firstname = "Giorno" ;
    $user2->lastname = "GIOVANNA" ;

    $user2->register(); 


?>