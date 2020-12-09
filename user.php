<?php
    session_start();

    class User {
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
                $result = mysqli_fetch_assoc($query); 
                var_dump($result) ; 
                echo 'Bravo vous êtes connecté' ; 

                $this->login = $result['login'] ; 
                $this->password = $result['password'] ;
                $this->email = $result['email'] ;
                $this->firstname = $result['firstname'] ;
                $this->lastname = $result['lastname'] ;
                
                return [$this->login, $this->password] ; 

            }
            else
            {
                echo 'Erreur' ;
            }

        }

        public function disconnect(){

            $db = mysqli_connect("localhost","root","","classes") ; 

            unset($this->login) ;
            unset($this->password) ; 
            unset($this->email) ; 
            unset($this->firstname) ;  
            unset($this->lastname) ;  
            unset($this->connexion) ;
            
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
                $this->login = $login ; 
                $this->password = $password ; 
                $this->email = $email ; 
                $this->firstname = $firstname ;
                $this->lastname = $lastname ; 

            }
            else{
                echo 'Erreur' ; 
            }
        }

        pubouc function getAllInfos(){
            return $this
        }

        public function isConnected(){
            $db = mysqli_connect("localhost","root","","classes") ; 

            $requete = "SELECT * FROM utilisateurs " ; 
            $query = mysqli_query($db,$requete) ;

            $result = mysqli_fetch_assoc($query) ; 
            var_dump($result) ; 

            if($this->login == $result['login'])
            {
                echo 'Bravo vous ête connecter'; 
            }
            else
            {
                echo 'erreur' ; 
            }

        }
    }

    $user1 = new User("Batman", "joker", "batman@gmail.com", "Bruce", "Wayne") ; 

    $user2 = new User("JOJO","pass","jojo@gmail.com","Giorno","Giovanna") ; 

    $user3 = new User("Charmickael" , "intersecret" , "chuck@buymore.com","Chuck" , "BARTOWSKI") ; 

    $user4 = new User("Colonel", "cia", "john@casey.fr","John","Casey") ; 


    

    $user1->update("bapt","mdp","baptiste.gauthier@gmail.com","Baptiste","GAUTHIER"); 
    //$user1->update("JOJO", "stand", "giorno@giovanna.fr", "Giorno", "Giovanna");
    //$user1->isConnected(); 
    // $user1->disconnect(); 
    //$user1->isConnected(); 

    $user1->isConnected() ; 

    //$user2->connect();

    // $user3->delete(); 
    //$user1->update("BM", "buymore", "morgan@grimes.fr", "Morgan", "Grims") ; 

?>