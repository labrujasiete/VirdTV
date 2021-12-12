<?php
ob_start();
date_default_timezone_set("America/Los_Angeles");
session_start();
class db{
    
    private $host       = "localhost";
    private $dbname     = "vird";
    private $username   = "root";
    private $password   = "";
    protected $con;
    
    
    
    public function __construct(){
        
        try{
            $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            //echo "success";
        }catch(Exception $e){
            echo "Database Connection Error" . $e->getMessage();
//            echo "<script>alert('Database Connection Error');</script>";
        }
    }// END __construct
    
}// END Class db


?>