<?php 
	
	class Conexion 
	{
		private $conect;
		public function __construct(){
			//concatenamos las variables de conexión
			$connectionString = "mysql:hos=".DB_HOST.";dbname=".DB_NAME.";.DB_CHARSET.";
			try {//utilizamos el PDO
				$this->conect = new PDO($connectionString, DB_USER, DB_PASSWORD);
				$this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//echo "Conexion exitosa";
			} catch (Exception $e) {
				$this->conect = 'Error de conexión';
				echo "ERROR: ". $e->getMessage();
			} 
		}		

		public function connect()
		{
			return $this->conect;
		}

	}


 ?>