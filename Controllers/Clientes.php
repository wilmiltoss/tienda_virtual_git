<?php 
   
	//Paso 1
	class Clientes extends Controllers { //heredamos la clase Controllers
		
		public function __construct()
		{
			parent::__construct();//ejecuta el metodo que esta en el controllers  loadModel A1
			//validacion del usuario no logeado
			session_start();
			if (empty($_SESSION['login'])) //si esta vacio
			{
				header('Location: '.base_url().'/login'); //direcciona al frm login
			}
			//getPermisos(3);

		}

		public function Clientes ()
		{
			//invocamos la vista principal 
			//data tiene toda la informacion de nuestra vista

		/*	if (empty($_SESSION['permisosMod']['r'])) {//si no tiene permiso p/ ver los usuarios
				header("Location:".base_url().'/dashboard');//redireciona a dashboard
			}*/
			$data['page_tag'] = "Usuarios";
			$data['page_title'] = "CLIENTES <small>Tienda Virtual</small>";
			$data['page_name']  = "clientes";
			$data['page_functions_js']  = "functions_clientes.js";
			$this->views->getView($this,"clientes",$data);//contiene todos los parametros de nuestra vista  A3 en data osea llamamos a la vista View/home
		}

	}

 ?>