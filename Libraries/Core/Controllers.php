<?php

	
	 class Controllers
	 {
	 	//el 1er metodo que se ejecuta en una clase es el metodo constructor	
	 	public function __construct()
	 	{
	 		$this->views = new Views();//colocamos la instancia de la vista
	 		$this->loadModel();
	 	}

	 	public function loadModel() //esto lo llamamos en Home A1
	 	{
	 		$model = get_class($this)."Model";
	 		$routClass = "Models/".$model.".php";//busca el archivo

	 		if(file_exists($routClass)){//si existe el archivo lo requerimos
	 			require_once($routClass);
	 			$this->model = new $model(); //A2
	 		}
	 	}


	 } 



 ?>