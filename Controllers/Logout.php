<?php 
	/**
	 * 
	 */
	class Logout
	{
		
		public function __construct()
		{
			session_start();//inicializamos la session
			session_unset();//limpiamos
			session_destroy();//destruir
			header('location:'.base_url().'/login');//redireccionamos al frm login
		}
	}

 ?>