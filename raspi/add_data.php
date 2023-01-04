<?php
class engine{
	public $link='';
	function __construct($datasensor){
		$this->connect();
		$this->storeInDB($datasensor);
	}
	function connect(){
		$this->link = mysqli_connect('localhost','root','') or die('Cannot connect to the DB');
		mysqli_select_db($this->link,'thermalcamera') or die('Cannot select the DB');
	}
	
	function storeInDB($datasensor){
		$query = "insert into engine set datasensor='".$datasensor."'";
		$result = mysqli_query($this->link,$query) or die('Errant query: '.$query);
	}
	
}
if($_GET['datasensor'] != ''){
	$engine=new engine($_GET['datasensor']);
}

?>
