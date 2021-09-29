<?php
    class Database{
        private $servername = 'localhost';
        private $username = 'root';
        private $password = '';
        private $dbname = 'signupform';
        public $conn;

        public function __construct(){
            try{
                $string = "mysql:host=".$this->servername.";dbname=".$this->dbname;
                $this->conn = new PDO($string,$this->username,$this->password);
               // echo 'connected';
            }catch(PDOException $e){
                echo 'failed to connect:'.$e->getMessage();
            }
            return $this->conn;
        }
    }
 //$o = new Database();