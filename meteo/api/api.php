<?php
require_once('core.php');
$c = new retriever();

//Author: Pau Munoz
//Embedded systems meteorological balloon-station control
//min
// PER UN SENSOR
if(isset($_GET['sensor'])){
	$sensor = $_GET['sensor'];
	if(isset($_GET['minval'])){
		if(isset($_GET['data'])){
			$c->minVal($_GET['minval'], $_GET['data'], $sensor);
		}
		else{
			$c->minVal($_GET['minval'],null, $sensor);

		}
	}
	//max
	else if(isset($_GET['maxval'])){
		if(isset($_GET['data'])){
			$c->maxVal($_GET['maxval'], $_GET['data'], $sensor);
		}
		else{
			$c->maxVal($_GET['maxval'], null, $sensor);
		}
	}
	//avg
	else if(isset($_GET['avgval'])){
		if(isset($_GET['data'])){
			$c->getAVG($_GET['avgval'], $_GET['data'], $sensor);
		}
		else{
			$c->getAVG($_GET['avgval'],null, $sensor);
		}
	}
	//dump tables
	else if(isset($_GET['dumptable'])){
		if(isset($_GET['data'])){
			$c->dumpTable($_GET['dumptable'], $_GET['data'], $sensor);
		}
		else{
			$c->dumpTable($_GET['dumptable'], $sensor);
		}
	}
	//get data
	else if(isset($_GET['getdata'])){
		if(isset($_GET['begin'])){
			if(isset($_GET['end'])){
				$c->getData($_GET['begin'], $_GET['end'], $sensor);
			}
			else{
				$c->getData($_GET['begin'], $sensor);
			}
		}
		else if(isset($_GET['end'])){
			$c->getData( null, $_GET['end'], $sensor);	
		}
		else{
			$c->getData($sensor);
		}

	}
	//list dates/values
	else if(isset($_GET['getdates'])){
		if(isset($_GET['count'])){
			$c->getDates(1, $sensor);
		}
		else{
			$c->getDates($sensor);
		}
	}
	else if(isset($_GET['lastval'])){
	
		$c->lastVal($_GET['lastval'], $sensor);
	
	}
}//SENSE SENSOR
else{
	if(isset($_GET['minval'])){
		if(isset($_GET['data'])){
			$c->minVal($_GET['minval'], $_GET['data']);
		}
		else{
			$c->minVal($_GET['minval']);

		}
	}
	//max
	else if(isset($_GET['maxval'])){
		if(isset($_GET['data'])){
			$c->maxVal($_GET['maxval'], $_GET['data']);
		}
		else{
			$c->maxVal($_GET['maxval']);
		}
	}
	//avg
	else if(isset($_GET['avgval'])){
		if(isset($_GET['data'])){
			$c->getAVG($_GET['avgval'], $_GET['data']);
		}
		else{
			$c->getAVG($_GET['avgval']);
		}
	}
	//dump tables
	else if(isset($_GET['dumptable'])){
		if(isset($_GET['data'])){
			$c->dumpTable($_GET['dumptable'], $_GET['data']);
		}
		else{
			$c->dumpTable($_GET['dumptable']);
		}
	}
	//get data
	else if(isset($_GET['getdata'])){
		if(isset($_GET['begin'])){
			if(isset($_GET['end'])){
				$c->getData($_GET['begin'], $_GET['end'],null);
			}
			else{
				$c->getData($_GET['begin'],null,null);
			}
		}
		else if(isset($_GET['end'])){
			$c->getData( null, $_GET['end'],null);	
		}
		else{
			$c->getData();
		}

	}
	//list dates/values
	else if(isset($_GET['getdates'])){
		if(isset($_GET['count'])){
			$c->getDates(1);
		}
		else{
			$c->getDates();
		}
	}
	else if(isset($_GET['lastval'])){
	
		$c->lastVal($_GET['lastval']);
	
	}
}




$c->dumpJson();


?>
