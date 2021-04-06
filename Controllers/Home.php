<?php 
	
	
	class Home extends Controllers { //heredamos la clase Controllers
		
		public function __construct()
		{
			parent::__construct();//ejecuta el metodo que esta en el controllers  loadModel A1

		}

		public function home()
		{
			//invocamos la vista principal 
			//data tiene toda la informacion de nuestra vista
			$data['page_id'] = 1;
			$data['page_tag'] = "Home";
			$data['page_title'] = "Página principal";
			$data['page_name']  = "home";
			$data['page_content'] = "lorem ipsum";
			$this->views->getView($this,"home",$data);//contiene todos los parametros de nuestra vista  A3 en data osea llamamos a la vista View/home
		}









		//BORRADORES-----------------------------------------------------------------------
				//aca empieza a invocarse el CRUD
		/*public function insertar()
		{
			$data = $this->model->setUser("roque", 18);	//data hace referencia a model->setUser
			$data = $this->model->setUser("juan", 28);
			print_r($data);
		}
		public function verusuario($id)
		{
			$data = $this->model->getUser($id);//invocamos la funcion getUser ubicado en homeModel.php
			print_r($data);
		}
		public function actualizar()
		{
			$data = $this->model->updateUser(1,"Roberto",28);//invocamos la funcion updateuser ubicado en homeModel.php
			print_r($data);
		}
		public function verusuarios() //verusuarios es lo que va entre barras del navegador
		{
			$data = $this->model->getUsers();//invocamos la funcion getUsers ubicado en homeModel.php
			print_r($data);
		}
		public function eliminarUsuario($id) //eliminarUsuario es lo que va entre barras del navegador
		{
			$data = $this->model->delUser($id);//invocamos la funcion delUsers ubicado en homeModel.php
			print_r($data);
		}*/







	

	}
 ?>