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
            // $this->id = $id ; 
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

            $requete = "INSERT INTO utilisateurs(login,password,email,firstname,lastname) 
                            VALUES ('$this->login', '$this->password', '$this->email', '$this->firstname','$this->lastname'
            );";

            $query = mysqli_query($db,$requete) ; 

            var_dump($query); 
            var_dump($requete) ; 

            echo 'utilisateur ajouté !' ; 

            $sql = "SELECT * FROM utilisateurs ORDER BY id DESC" ;
            $exec = mysqli_query($db,$sql) ; 

            $result = mysqli_fetch_all($exec) ; 
            var_dump($result[0]) ;

            return $result[0] ; 

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
            
            if($query)
            {
                echo 'Bravo vous êtes connecté' ; 

                $resultat = mysqli_fetch_assoc($query) ; 

                var_dump($resultat);
                $_SESSION['login'] = $this->login ; 
                $_SESSION['pass'] = $this->password ; 
                $_SESSION['id'] = $resultat['id'] ; 
                $_SESSION['email'] = $resultat['email'] ; 
                $_SESSION['firstname'] = $resultat['firstname'];
                $_SESSION['lastname'] = $resultat['lastname'] ; 

                return $resultat ; 
            }
            else
            {
                echo 'Erreur' ;
            }

        }

        public function disconnect(){
            session_destroy() ;

            echo 'Vous avez été déconnecté' ; 
        }

        public function delete(){
            session_destroy();

            $db = mysqli_connect("localhost","root","","classes") ; 

            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }

            $requete = "DELETE FROM `utilisateurs` WHERE login = '$this->login'"; 

            $query = mysqli_query($db,$requete) ;

            var_dump($query) ; 

            echo 'Votre compte à été supprimer' ; 
        }
    }

    $user1 = new User("bapt","mdp","baptiste.gauthier@laplateforme.io","Baptiste","GAUTHIER") ; 

    $user2 = new User("JOJO","pass","jojo@gmail.com","Giorno","Giovanna") ; 

    $user3 = new User("Charmickael" , "intersecret" , "chuck@buymore.com","Chuck" , "BARTOWSKI") ; 


    

    // $user1->register(); 
    // $user2->register(); 
    // $user3->register(); 

    // $user1->connect() ; 

    // $user2->disconnect();

    // $user3->delete(); 


?>