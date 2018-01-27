<?php
require_once('queries.php');
class retriever{
	//->valor maxim , minim i promig de: temperatura, humitat, llum, altitud, presio
	//->tots els valors de: temperatura, humitat, llum, atltitud, presio llistats
	//   Per defecte es llisten tots els de la taula, es pot filtrar per dia
	//->llistem totes les dates (dies) de les quals tenim mesures
	//   podem obtenir via 'group by' el nombre de mesures preses per dia
	//-> podem obtenir un dump de tota la base de dades en format JSON 
	//   tambe podem obtenir el dump de totes les mesures entre dues dates particulars, a partir d'una o fins a una
	private $d;
	public $jsonArray;
	
	public function __construct(){
		$this->d = new db();	
	}
	public function lastVal($name, $sensor=null){ //posibilitat de filtrar per sensors
		$query = "";
		if($name != null){
			if($sensor == null){
				if ($name == "temperatura"){
					$query = "SELECT max(temperatura.int) as num, data, temperatura, modelSensor FROM mesura, temperatura where mesura.id = temperatura.mesura";
				}
				else if($name == "llum"){
					$query = "SELECT max(llum.int) as num, data, visible, modelSensor FROM mesura, llum where mesura.id = llum.mesura";		
				}
				else if($name == "presio"){
					$query = "SELECT max(barometre.id) as num, data, presio, modelSensor FROM mesura, barometre where mesura.id = barometre.mesura";		
				}
				else if($name == "humitat"){
					$query = "SELECT max(humitat.id) as num, data, humitat, modelSensor FROM mesura, humitat where mesura.id = humitat.mesura";		
				}
				else if($name == "altitud"){
					$query = "SELECT max(altitud.id) as num, data, altitud, modelSensor FROM mesura, barometre where mesura.id = humitat.mesura";		
				}
			}
			else{
				if ($name == "temperatura"){
					$query = "SELECT max(temperatura.int) as num, data, temperatura, modelSensor FROM mesura, temperatura where mesura.id = temperatura.mesura and mesura.sensor=".$sensor."";
				}
				else if($name == "llum"){
					$query = "SELECT max(llum.int) as num, data, visible, modelSensor FROM mesura, llum where mesura.id = llum.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "presio"){
					$query = "SELECT max(barometre.id) as num, data, presio, modelSensor FROM mesura, barometre where mesura.id = barometre.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "humitat"){
					$query = "SELECT max(humitat.id) as num, data, humitat, modelSensor FROM mesura, humitat where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "altitud"){
					$query = "SELECT max(altitud.id) as num, data, altitud, modelSensor FROM mesura, barometre where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
			}
		}
		
		$res = $this->d->sql($query);
		
		
		$this->jsonArray = array();
		
		if ($res->num_rows > 0) {
			//Converting the results into an associative array
			while($row = $res->fetch_assoc()) {
				$jsonArrayItem = array();
				$jsonArrayItem['num'] = $row['num'];
				$jsonArrayItem['data'] = $row['data'];
				$jsonArrayItem['modelSensor'] = $row['modelSensor'];
				if ($name == "temperatura"){
					$jsonArrayItem['temp'] = $row['temperatura'];
				}
				else if($name == "llum"){
					$jsonArrayItem['llum'] = $row['visible'];
				}
				else if($name == "presio"){
					$jsonArrayItem['pres'] = $row['presio'];
				}
				else if($name == "humitat"){
					$jsonArrayItem['hum'] = $row['humitat'];
				}
				else if($name == "altitud"){
					$jsonArrayItem['alt'] = $row['altitud'];
				}
				//append the above created object into the main array.
				array_push($this->jsonArray, $jsonArrayItem);
			}
		}	
	}
	//obtenir valor minim, $name = temperatura, humitat, altitud, llum, presio
	//data opcional, dia del qual volem obtenir minim
	public function minVal($name, $data=null, $sensor=null){
		$query = "";
		if($sensor==null){
			if ($data == null){
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, MIN(temperatura) as min , data FROM mesura, temperatura where mesura.id = temperatura.mesura";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, MIN(spectre+infrared+visible) as min, data FROM mesura, llum where mesura.id = llum.mesura";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, MIN(presio) as min, data FROM mesura, barometre where mesura.id = barometre.mesura";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, MIN(humitat) as min, data FROM mesura, humitat where mesura.id = humitat.mesura";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, MIN(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura";		
				}
			}
			else{
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, MIN(temperatura) as min , data FROM mesura, temperatura where mesura.id = temperatura.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, MIN(spectre+infrared+visible) as min, data FROM mesura, llum where mesura.id = llum.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, MIN(presio) as min, data FROM mesura, barometre where mesura.id = barometre.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, MIN(humitat) as min, data FROM mesura, humitat where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, MIN(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
			}
		}
		else{
			if ($data == null){
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, MIN(temperatura) as min , data FROM mesura, temperatura where mesura.id = temperatura.mesura and mesura.sensor=".$sensor."";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, MIN(spectre+infrared+visible) as min, data FROM mesura, llum where mesura.id = llum.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, MIN(presio) as min, data FROM mesura, barometre where mesura.id = barometre.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, MIN(humitat) as min, data FROM mesura, humitat where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, MIN(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
			}
			else{
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, MIN(temperatura) as min , data FROM mesura, temperatura where mesura.id = temperatura.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, MIN(spectre+infrared+visible) as min, data FROM mesura, llum where mesura.id = llum.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, MIN(presio) as min, data FROM mesura, barometre where mesura.id = barometre.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, MIN(humitat) as min, data FROM mesura, humitat where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, MIN(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
			}
		}
		$res = $this->d->sql($query);
		
		$this->jsonArray = array();
		if ($res->num_rows > 0) {
			//Converting the results into an associative array
			while($row = $res->fetch_assoc()) {
				$jsonArrayItem = array();
				$jsonArrayItem['modelSensor'] = $row['modelSensor'];
				$jsonArrayItem['min'] = $row['min'];
				$jsonArrayItem['data'] = $row['data'];
				
				//append the above created object into the main array.
				array_push($this->jsonArray, $jsonArrayItem);
			}
		}
	}
	//obtenir valor maxim de la mesura (name): temperatura, humitat, llum, presio, altitud
	//podem obtenir maxim d'una data
	public function maxVal($name, $data=null, $sensor=null){
		$query = "";
		if($sensor==null){
			if ($data == null){
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, MAX(temperatura) as max , data FROM mesura, temperatura where mesura.id = temperatura.mesura";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, MAX(spectre+infrared+visible) as max, data FROM mesura, llum where mesura.id = llum.mesura";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, MAX(presio) as max, data FROM mesura, barometre where mesura.id = barometre.mesura";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, MAX(humitat) as max, data FROM mesura, humitat where mesura.id = humitat.mesura";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, MAX(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura";		
				}
			}
			else{
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, MAX(temperatura) as max , data FROM mesura, temperatura where mesura.id = temperatura.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, MAX(spectre+infrared+visible) as max, data FROM mesura, llum where mesura.id = llum.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, MAX(presio) as max, data FROM mesura, barometre where mesura.id = barometre.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, MAX(humitat) as max, data FROM mesura, humitat where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, MAX(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura  and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
			}
		}
		else{
				if ($data == null){
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, MAX(temperatura) as max , data FROM mesura, temperatura where mesura.id = temperatura.mesura and mesura.sensor=".$sensor."";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, MAX(spectre+infrared+visible) as max, data FROM mesura, llum where mesura.id = llum.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, MAX(presio) as max, data FROM mesura, barometre where mesura.id = barometre.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, MAX(humitat) as max, data FROM mesura, humitat where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, MAX(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
			}
			else{
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, MAX(temperatura) as max , data FROM mesura, temperatura where mesura.id = temperatura.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, MAX(spectre+infrared+visible) as max, data FROM mesura, llum where mesura.id = llum.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, MAX(presio) as max, data FROM mesura, barometre where mesura.id = barometre.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, MAX(humitat) as max, data FROM mesura, humitat where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, MAX(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura  and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
			}
		}
		$res = $this->d->sql($query);
		
		$this->jsonArray = array();
		if ($res->num_rows > 0) {
			//Converting the results into an associative array
			while($row = $res->fetch_assoc()) {
				$jsonArrayItem = array();
				$jsonArrayItem['modelSensor'] = $row['modelSensor'];
				$jsonArrayItem['max'] = $row['max'];
				$jsonArrayItem['data'] = $row['data'];
				
				//append the above created object into the main array.
				array_push($this->jsonArray, $jsonArrayItem);
			}
		}
	}
	//obtenir tota la informacio d'una taula: temperatura, llum, presio, humitat, altitud
	public function dumpTable($name, $data = null, $sensor=null){
		$query = "";
		if($sensor == null){
			if($date == null){
				if ($name == "temperatura"){
					$query = "SELECT data, temperatura FROM mesura, temperatura where mesura.id = temperatura.mesura";
				}
				else if($name == "llum"){
					$query = "SELECT data, visible as llum FROM mesura, llum where mesura.id = llum.mesura";		
				}
				else if($name == "presio"){
					$query = "SELECT data, presio , data FROM mesura, barometre where mesura.id = barometre.mesura";		
				}
				else if($name == "humitat"){
					$query = "SELECT data, humitat FROM mesura, humitat where mesura.id = humitat.mesura";		
				}
				else if($name == "altitud"){
					$query = "SELECT data, altitud FROM mesura, barometre where mesura.id = humitat.mesura";		
				}
			}
			else{
				if ($name == "temperatura"){
					$query = "SELECT data, temperatura FROM mesura, temperatura where mesura.id = temperatura.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:00'";
				}
				else if($name == "llum"){
					$query = "SELECT data, visible as llum FROM mesura, llum where mesura.id = llum.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "presio"){
					$query = "SELECT data, presio , data FROM mesura, barometre where mesura.id = barometre.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "humitat"){
					$query = "SELECT data, humitat FROM mesura, humitat where mesura.id = humitat.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "altitud"){
					$query = "SELECT data, altitud FROM mesura, barometre where mesura.id = humitat.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:000'";		
				}
			}
		}
		else{
			if($date == null){
				if ($name == "temperatura"){
					$query = "SELECT data, temperatura FROM mesura, temperatura where mesura.id = temperatura.mesura and mesura.sensor=".$sensor."";
				}
				else if($name == "llum"){
					$query = "SELECT data, visible as llum FROM mesura, llum where mesura.id = llum.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "presio"){
					$query = "SELECT data, presio , data FROM mesura, barometre where mesura.id = barometre.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "humitat"){
					$query = "SELECT data, humitat FROM mesura, humitat where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "altitud"){
					$query = "SELECT data, altitud FROM mesura, barometre where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
			}
			else{
				if ($name == "temperatura"){
					$query = "SELECT data, temperatura FROM mesura, temperatura where mesura.id = temperatura.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";
				}
				else if($name == "llum"){
					$query = "SELECT data, visible as llum FROM mesura, llum where mesura.id = llum.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "presio"){
					$query = "SELECT data, presio , data FROM mesura, barometre where mesura.id = barometre.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "humitat"){
					$query = "SELECT data, humitat FROM mesura, humitat where mesura.id = humitat.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "altitud"){
					$query = "SELECT data, altitud FROM mesura, barometre where mesura.id = humitat.mesura and data >='".$data." 00:00:00' AND data <'".$data." 23:59:000' and mesura.sensor=".$sensor."";		
				}
			}
		}
		$res = $this->d->sql($query);
		
		
		$this->jsonArray = array();
		
		if ($res->num_rows > 0) {
			//Converting the results into an associative array
			while($row = $res->fetch_assoc()) {
				$jsonArrayItem = array();
				$jsonArrayItem['data'] = $row['data'];
				if ($name == "temperatura"){
					$jsonArrayItem['temp'] = $row['temperatura'];
				}
				else if($name == "llum"){
					$jsonArrayItem['llum'] = $row['llum'];
				}
				else if($name == "presio"){
					$jsonArrayItem['presio'] = $row['presio'];
				}
				else if($name == "humitat"){
					$jsonArrayItem['humitat'] = $row['humitat'];
				}
				else if($name == "altitud"){
					$jsonArrayItem['altitud'] = $row['altitud'];
				}
				//append the above created object into the main array.
				array_push($this->jsonArray, $jsonArrayItem);
			}
		}	
	}
	
	
	//obtenir el promig
	public function getAVG($name, $data=null, $sensor=null){
		$query = "";
		if($sensor==null){
			if ($data == null){
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, AVG(temperatura) as min , data FROM mesura, temperatura where mesura.id = temperatura.mesura";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, AVG(spectre+infrared+visible) as min, data FROM mesura, llum where mesura.id = llum.mesura";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, AVG(presio) as min, data FROM mesura, barometre where mesura.id = barometre.mesura";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, AVG(humitat) as min, data FROM mesura, humitat where mesura.id = humitat.mesura";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, AVG(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura";		
				}
			}
			else{
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, AVG(temperatura) as min , data FROM mesura, temperatura where mesura.id = temperatura.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, AVG(spectre+infrared+visible) as min, data FROM mesura, llum where mesura.id = llum.mesura  and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, AVG(presio) as min, data FROM mesura, barometre where mesura.id = barometre.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, AVG(humitat) as min, data FROM mesura, humitat where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, AVG(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00'";		
				}
			}
		}
		else{
			if ($data == null){
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, AVG(temperatura) as min , data FROM mesura, temperatura where mesura.id = temperatura.mesura and mesura.sensor=".$sensor."";
					
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, AVG(spectre+infrared+visible) as min, data FROM mesura, llum where mesura.id = llum.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, AVG(presio) as min, data FROM mesura, barometre where mesura.id = barometre.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, AVG(humitat) as min, data FROM mesura, humitat where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, AVG(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura and mesura.sensor=".$sensor."";		
				}
			}
			else{
				if ($name == "temperatura"){
					$query = "SELECT modelSensor, AVG(temperatura) as min , data FROM mesura, temperatura where mesura.id = temperatura.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";
				}
				else if($name == "llum"){
					$query = "SELECT modelSensor, AVG(spectre+infrared+visible) as min, data FROM mesura, llum where mesura.id = llum.mesura  and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "presio"){
					$query = "SELECT modelSensor, AVG(presio) as min, data FROM mesura, barometre where mesura.id = barometre.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "humitat"){
					$query = "SELECT modelSensor, AVG(humitat) as min, data FROM mesura, humitat where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
				else if($name == "altitud"){
					$query = "SELECT modelSensor, AVG(altitud) as max, data FROM mesura, barometre where mesura.id = humitat.mesura and data >= '".$data." 00:00:00' AND data <'".$data." 23:59:00' and mesura.sensor=".$sensor."";		
				}
			}
		}
		$res = $this->d->sql($query);
		
		$this->jsonArray = array();
		if ($res->num_rows > 0) {
			//Converting the results into an associative array
			while($row = $res->fetch_assoc()) {
				$jsonArrayItem = array();
				$jsonArrayItem['modelSensor'] = $row['modelSensor'];
				$jsonArrayItem['avg'] = $row['min'];
				$jsonArrayItem['data'] = $row['data'];
				
				//append the above created object into the main array.
				array_push($this->jsonArray, $jsonArrayItem);
			}
		}
	}
	//dump de tota la BD en JSON
	//podem fer dump entre dates, a partir d'una o fins una altra
	function getData($begin = null, $end = null, $sensor=null){
		if($sensor!=null){
			if($begin == null && $end == null){
				$query = "select lloc, data, sensor, temperatura, humitat, spectre, infrared, visible, presio, altitud, nivellmar from mesura, barometre, humitat, llum, temperatura where mesura.id = barometre.mesura and mesura.id = humitat.mesura and mesura.id = llum.mesura and mesura.id = temperatura.mesura and mesura.sensor=".$sensor."";
			
			}
			else if($begin != null and $end == null){
	
				$query = "select lloc, data, sensor, temperatura, humitat, spectre, infrared, visible, presio, altitud, nivellmar from mesura, barometre, humitat, llum, temperatura where mesura.id = barometre.mesura and mesura.id = humitat.mesura and mesura.id = llum.mesura and mesura.id = temperatura.mesura";
				$query =$query . " and data >='".$begin."' and mesura.sensor=".$sensor."";
			}
			else if($begin == null and $end !=null){
				$query = "select lloc, data, sensor, temperatura, humitat, spectre, infrared, visible, presio, altitud, nivellmar from mesura, barometre, humitat, llum, temperatura where mesura.id = barometre.mesura and mesura.id = humitat.mesura and mesura.id = llum.mesura and mesura.id = temperatura.mesura";
				$query =$query . " AND data <'".$end."' and mesura.sensor=".$sensor."";
			}
			else if($begin != null and $end != null){
				$query = "select lloc, data, sensor, temperatura, humitat, spectre, infrared, visible, presio, altitud, nivellmar from mesura, barometre, humitat, llum, temperatura where mesura.id = barometre.mesura and mesura.id = humitat.mesura and mesura.id = llum.mesura and mesura.id = temperatura.mesura";
				$query =$query . " and data >='".$begin."'  AND data <'".$end."' and mesura.sensor=".$sensor."";
			}
		}
		else{
			if($begin == null && $end == null){
				$query = "select lloc, data, sensor, temperatura, humitat, spectre, infrared, visible, presio, altitud, nivellmar from mesura, barometre, humitat, llum, temperatura where mesura.id = barometre.mesura and mesura.id = humitat.mesura and mesura.id = llum.mesura and mesura.id = temperatura.mesura ";
			 
			}
			else if($begin != null and $end == null){
	
				$query = "select lloc, data, sensor, temperatura, humitat, spectre, infrared, visible, presio, altitud, nivellmar from mesura, barometre, humitat, llum, temperatura where mesura.id = barometre.mesura and mesura.id = humitat.mesura and mesura.id = llum.mesura and mesura.id = temperatura.mesura";
				$query =$query . " and data >='".$begin."' ";
			}
			else if($begin == null and $end !=null){
				$query = "select lloc, data, sensor, temperatura, humitat, spectre, infrared, visible, presio, altitud, nivellmar from mesura, barometre, humitat, llum, temperatura where mesura.id = barometre.mesura and mesura.id = humitat.mesura and mesura.id = llum.mesura and mesura.id = temperatura.mesura";
				$query =$query . " AND data <'".$end."' ";
			}
			else if($begin != null and $end != null){
				$query = "select lloc, data, sensor, temperatura, humitat, spectre, infrared, visible, presio, altitud, nivellmar from mesura, barometre, humitat, llum, temperatura where mesura.id = barometre.mesura and mesura.id = humitat.mesura and mesura.id = llum.mesura and mesura.id = temperatura.mesura";
				$query =$query . " and data >='".$begin."'  AND data <'".$end."'";
			}
		}
		$res = $this->d->sql($query);
		
		$this->jsonArray = array();
		
		if ($res->num_rows > 0) {
			//Converting the results into an associative array
			while($row = $res->fetch_assoc()) {
				$jsonArrayItem = array();
				
				$jsonArrayItem['lloc'] = $row['lloc'];
				$jsonArrayItem['data'] = $row['data'];
				$jsonArrayItem['sensor'] = $row['sensor'];
				$jsonArrayItem['temperatura'] = $row['temperatura'];
				$jsonArrayItem['humitat'] = $row['humitat'];
				$jsonArrayItem['spectre'] = $row['spectre'];
				$jsonArrayItem['infrared'] = $row['infrared'];
				$jsonArrayItem['visible'] = $row['visible'];
				$jsonArrayItem['presio'] = $row['presio'];
				$jsonArrayItem['altitud'] = $row['altitud'];
				$jsonArrayItem['nivellmar'] = $row['nivellmar'];
			
				//append the above created object into the main array.
				array_push($this->jsonArray, $jsonArrayItem);
			}
		}
	}
	//llistem totes les dates (dies) dels que tenim mesura
	//amb count==1 podem fer un group by i veure num de mesures per dia
	function getDates($count = null, $sensor=null){
		if($sensor==null){
			if($count == null){
				$query = "select DISTINCT date(data) as datar from mesura ";
			}
			else{
				$query = "select DISTINCT date(data) as datar, count(id) as conta from mesura group by datar ";
			}
		}
		else{
			if($count == null){
				$query = "select DISTINCT date(data) as datar from mesura where sensor=".$sensor."";
			}
			else{
				$query = "select DISTINCT date(data) as datar, count(id) as conta from mesura where sensor=".$sensor." group by datar ";
			}
		}
		$res = $this->d->sql($query);
		
		$this->jsonArray = array();
		
		if ($res->num_rows > 0) {
			//Converting the results into an associative array
			while($row = $res->fetch_assoc()) {
				$jsonArrayItem = array();
				$jsonArrayItem['data'] = $row['datar'];
				if($count != null){
					$jsonArrayItem['values'] = $row['conta'];
				}
			
				//append the above created object into the main array.
				array_push($this->jsonArray, $jsonArrayItem);
			}
		}
	}
	
	
	//les dades guardades, obtenim el JSON i l'enviem per HTTP{S}
	public function dumpJson(){
		//set the response content type as JSON
		header('Content-type: application/json');
		//output the return value of json encode using the echo function. 
		echo json_encode($this->jsonArray);
	}
	
	
    
    
}


// 2017-12-18 02:44:26
//$c = new retriever();

//$c->getData("2017-12-18 02:44:26");

//$c->dumpJson();

?>
