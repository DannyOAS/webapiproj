<?php
// Database connection settings
class db{
    // Properties
    private $dbhost = 'localhost:8889';
    private $dbuser = 'root';
    private $dbpass = 'root';
    private $dbname = 'web_api_db';
    private $port = 8889;

    // Connect
    public function connect(){
        $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname;port=$this->port";
        $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}