<?php

    class Lpdo {
        public $host ;
        public $username;
        public $password;
        public $db;

        public function constructeur()
        {
            $link = mysqli_connect($this->host,$this->username,$this->password,$this->db) ;

            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }

            echo 'Connexion ouverte au serveur mysqli'; 

            return $this->link = $link ;
        }

        public function connect(){
            if(isset($this->link))
            {
                mysqli_close($this->link);
                echo ' Connexion fermé ';
            }

            $link = mysqli_connect($this->host,$this->username,$this->password,$this->db) ;

            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }

            echo 'Connexion ouverte au serveur mysqli'; 

            return $this->link = $link ;
            
        }

        public function close()
        {
            mysqli_close($this->link);
            echo ' Connexion fermé ';
        }

        public function execute($query)
        {
            $requete = mysqli_query($this->link,$query) ;
            $this->query = $query ;
            $result = mysqli_fetch_all($requete);
            $this->result = $result;

            var_dump($this->result);

            return $this->result; 

            echo 'requête executé';
        }

        public function getLastQuery()
        {
            if(isset($this->query))
            {
                var_dump($this->query);
                return $this->query ;
            }
            else{
                return FALSE ; 
            }
        }

        public function getLastResult()
        {
            if(isset($this->result))
            {
                var_dump($this->result);
                return $this->result ;
            }
            else{
                return FALSE ;
            }
        }

        public function getTables()
        {

            $requete = "SHOW TABLES"; 

            $exec = mysqli_query($this->link,$requete) ;

            $resultat = mysqli_fetch_all($exec);

            var_dump($resultat); 

            return $resultat ;

        }

        public function getFields($table)
        {
            $requete = "SELECT * FROM $table";
            $query = mysqli_query($this->link,$requete) ;
            
            $table = mysqli_fetch_all($query) ;

            var_dump($table) ;
        }

    }

    $lpdo1 = new Lpdo();
    $lpdo1->host = "localhost";
    $lpdo1->username = "root";
    $lpdo1->password = "" ;
    $lpdo1->db = "classes";

    var_dump($lpdo1);

    $lpdo1->constructeur();
    // $lpdo1->execute("SELECT * FROM utilisateurs");
    $lpdo1->getFields("utilisateurs");


?>