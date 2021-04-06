<?php 
	
	
	class Errors extends Controllers { //heredamos la clase Controllers
		
		public function __construct()
		{
			parent::__construct();//ejecuta el metodo que esta en el controllers  loadModel A1

		}

		public function notFound()
		{
			//invocamos la vista error
			$this->views->getView($this,"error");
		}

	}

	//instancias para mostrar la vista
	$notFound = new Errors();
	$notFound->notFound();
 ?>