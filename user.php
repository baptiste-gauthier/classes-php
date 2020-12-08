<?php
    session_start();

    class User {
        private $id ; 
        public $login ; 
        public $password ; 
        public $email ; 
        public $firstname ; 
        public $lastname ; 
        public $connexion ; 

        public function __construct($login,$password,$email,$firstname,$lastname){
           
            $this->login = $login ;
            $this->password = $password ; 
            $this->email = $email ; 
            $this->firstname = $firstname ; 
            $this->lastname = $lastname ; 
            $this->connexion = 0 ;
        }

        public function register() {
            $db = mysqli_connect("localhost","root","","classes") ; 

            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }
            
            $requete = "SELECT login FROM utilisateurs WHERE login = '$this->login' ;" ;
            $query = mysqli_query($db,$requete) ;

            var_dump($query) ; 

            if($query->num_rows == 0)
            {
                $requete = "INSERT INTO utilisateurs(login,password,email,firstname,lastname) 
                                VALUES ('$this->login', '$this->password', '$this->email', '$this->firstname','$this->lastname'
                );";
    
                $query = mysqli_query($db,$requete) ; 
    
                var_dump($query); 
                var_dump($requete) ; 
    
                echo 'utilisateur ajouté !' ; 
    
                $result = [$this->login,$this->password,$this->email,$this->firstname,$this->lastname] ; 
                var_dump($result);
                return $result ; 
            }
            else
            {
                echo 'ce login est déjà utiliser' ; 
            }



            //  Partie PDO 

            // $connexion = new PDO("mysql:host=localhost;dbname=classes",'root','') ; 
            // $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

            // $requete = $connexion->prepare("INSERT INTO utilisateurs(login,password,email,firstname,lastname ) VALUES ('$this->login', '$this->password', '$this->email', '$this->firstname','$this->lastname')");   
            // $requete->execute();
            
        }

        public function connect(){
            $db = mysqli_connect("localhost","root","","classes") ; 

            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }

            $requete = "SELECT * FROM utilisateurs 
                            WHERE login = '$this->login' AND password = '$this->password'" ;

            $query = mysqli_query($db,$requete) ;
            var_dump($query) ; 
            
            if($query->num_rows == 1)
            {
                echo 'Bravo vous êtes connecté' ; 
                $this->connexion = 1 ; 
                var_dump($this->connexion) ; 

                return [$this->login, $this->password] ; 

            }
            else
            {
                echo 'Erreur' ;
            }

        }

        public function disconnect(){

            unset($this->login) ;
            unset($this->password) ; 
            unset($this->email) ; 
            unset($this->firstname) ;  
            unset($this->lastname) ;  
            
            echo 'Vous avez été déconnecté' ; 
        }

        public function delete(){

            
            $db = mysqli_connect("localhost","root","","classes") ; 
            
            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }
            
            $requete = "DELETE FROM `utilisateurs` WHERE login = '$this->login'"; 
            
            $query = mysqli_query($db,$requete) ;
            
            var_dump($query) ; 
            
            unset($this->login) ;
            unset($this->password) ; 
            unset($this->email) ; 
            unset($this->firstname) ;  
            unset($this->lastname) ; 

            echo 'Votre compte à été supprimer' ; 
        }

        public function update($login,$password,$email,$firstname,$lastname){
            $db = mysqli_connect("localhost","root","","classes") ; 

            $requete = "UPDATE utilisateurs 
                            SET login = '$login',
                                password = '$password',
                                email = '$email',
                                firstname = '$firstname',
                                lastname = '$lastname'
                                    WHERE login = '$this->login' ;"
            ;

            $query = mysqli_query($db,$requete) ; 
            var_dump($query) ; 

            if($query)
            {
                echo 'Changement effectuer ! ' ; 
            }
            else{
                echo 'Erreur' ; 
            }
        }
    }

    $user1 = new User("bapt", "mdp", "baptiste.gauthier@gmail.com", "Baptiste", "GAUTHIER") ; 

    $user2 = new User("JOJO","pass","jojo@gmail.com","Giorno","Giovanna") ; 

    $user3 = new User("Charmickael" , "intersecret" , "chuck@buymore.com","Chuck" , "BARTOWSKI") ; 

    $user4 = new User("Colonel", "cia", "john@casey.fr","John","Casey") ; 


    

    //$user1->update("bapt","mdp","baptiste.gauthier@gmail.com","Baptiste","GAUTHIER"); 
    $user1->connect(); 
    //$user4->disconnect(); 

    // $user3->connect() ; 

    //$user2->connect();

    // $user3->delete(); 
    //$user1->update("BM", "buymore", "morgan@grimes.fr", "Morgan", "Grims") ; 

?>