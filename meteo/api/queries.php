<?php
 
class db{

	private $servername = "fghjfghjfgjh.gironaskymap.com";
	private $username = "sdsds";
	private $password = "sdsdsd";
	private $dbName = "dfghdfghdj";
	public $conn;
	public function __construct(){

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function sql($q) {
        $res = $this->conn->query($q);  
        return $res;    
    }
    
    
}



$d = new db();

$query = "SELECT data, temperatura FROM mesura, temperatura where mesura.id = temperatura.mesura";
$res = $d->sql($query);

//print_r($res);
?>
