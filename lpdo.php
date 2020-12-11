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

        public function close()
        {
            mysqli_close($this->link);
            echo ' Connexion fermé ';
        }

        public function execute($query)
        {
            mysqli_query($this->link,$query) ;

            echo 'requête executé';

            
        }


    }

    $lpdo1 = new Lpdo();
    $lpdo1->host = "localhost";
    $lpdo1->username = "root";
    $lpdo1->password = "" ;
    $lpdo1->db = "classes";

    var_dump($lpdo1);

    $lpdo1->constructeur();
    $lpdo1->close();


?>