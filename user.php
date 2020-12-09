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

        public function connect($login,$password){
            $db = mysqli_connect("localhost","root","","classes") ; 

            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }

            $requete = "SELECT * FROM utilisateurs 
                            WHERE login = '$login' AND password = '$password'" ;

            $query = mysqli_query($db,$requete) ;
            var_dump($query) ; 
            
            if($query->num_rows == 1)
            {
                $result = mysqli_fetch_assoc($query); 
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

        public function disconnect(){

            $this->login = NULL ;
            $this->password = NULL ; 
            $this->email = NULL ; 
            $this->firstname = NULL ;  
            $this->lastname = NULL ;  
           
            echo 'Vous avez été déconnecté' ; 

            return[$this->login, $this->password,$this->email,$this->firstname,$this->lastname];
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
            
            $this->login = NULL ;
            $this->password = NULL ; 
            $this->email = NULL ; 
            $this->firstname = NULL ;  
            $this->lastname = NULL ; 

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
            $db = mysqli_connect("localhost","root","","classes") ; 

            $requete = "SELECT * FROM utilisateur WHERE login = '$this->login';";
            $query = mysqli_query($db,$query) ;

            $result = mysqli_fetch_assoc($query);

            $this->login = $result['login'];
            $this->password = $result['password'];
            $this->email = $result['email'];
            $this->firstname = $result['firstname'];
            $this->lastname = $result['lastname'];
        }
        
    }

    $user1 = new User("Batman", "joker", "batman@gmail.com", "Bruce", "Wayne") ; 

    $user2 = new User("JOJO","pass","jojo@gmail.com","Giorno","Giovanna") ; 

    $user3 = new User("Carmickael" , "intersecret" , "chuck@buymore.com","Chuck" , "BARTOWSKI") ; 

    $user4 = new User("Colonel", "cia", "john@casey.fr","John","Casey") ; 


    

    //$user1->update("bapt","mdp","baptiste.gauthier@gmail.com","Baptiste","GAUTHIER"); 
    //$user1->update("JOJO", "stand", "giorno@giovanna.fr", "Giorno", "Giovanna");
    //$user1->isConnected(); 
    // $user1->disconnect(); 
    //$user1->isConnected(); 

    //$user1->getAllInfos() ; 

    //$user3->register();
    //$user2->connect("JOJO","pass");
    $user2->disconnect();
    $user2->getLogin();
    $user2->getAllInfos();
    //$user2->getAllInfos();
    

    // $user3->delete(); 
    //$user1->update("BM", "buymore", "morgan@grimes.fr", "Morgan", "Grims") ; 

?>