<?php 

		class Dashboard extends Controllers { //heredamos la clase Controllers
		
		public function __construct()
		{
			parent::__construct();//ejecuta el metodo que esta en el controllers  loadModel A1

			//validacion del usuario no logeado
			session_start();
			if (empty($_SESSION['login'])) //si esta vacio
			{
				header('Location: '.base_url().'/login'); //direcciona al frm login
			}

		}

		public function dashboard()
		{
			//invocamos la vista principal 
			//data tiene toda la informacion de nuestra vista
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard - Tienda Virtual";
			$data['page_title'] = "Dashboard - Tienda Virtual";
			$data['page_name']  = "dashboard";
			$this->views->getView($this,"dashboard",$data);//con dashboard llamamos a la vista View/Dashboard/dashboard.php
		}

	}


 ?>