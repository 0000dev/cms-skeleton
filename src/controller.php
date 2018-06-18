<?php

class App extends Core 
{	

	public $db;

	public function __construct() 
	{
		$this -> db = new Model(); 
	}

	public function homePage()
	{		

		echo 'home page'; 
			
		// fetching smth from db:
		//$z['list'] = $this -> db -> homePage();
		//print_r($z);

		//$this -> loadView('appHomePage',$z);

		return;
	}

}



?>