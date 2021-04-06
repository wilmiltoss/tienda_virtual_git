<?php 

	class HomeModel extends Mysql //heredamos a Mysql
	{
		
		public function __construct()
		{
			parent::__construct();//cargamos el metdo constructor que corresponde a la clase padre Mysql
		}







		//BORRADORES-----------------------------------------------------------------------
		/*public function setUser(string $nombre, int $edad)
		{
			$query_insert = "INSERT INTO usuario (nombre,edad) VALUES (?,?)";
			$arrData  = array($nombre, $edad);
			$request_insert = $this->insert($query_insert,$arrData);//utilizamo el metodo insert descrita Mysql.php
			return $request_insert;
		}
		public function getUser($id)
		{
			$sql = "SELECT * FROM usuario WHERE id = $id ";
			$request = $this->select($sql); //select = invocamos al metodo select que esta ubicado en Mysq.php
			return $request;
		}
		public function updateUser(int $id, string $nombre, int $edad)
		{
			$sql = "UPDATE usuario SET nombre = ?, edad = ? WHERE id = $id ";
			$arrData = array($nombre, $edad);
			$request = $this->update($sql,$arrData);//update = invocamos al metodo update que esta ubicado en Mysq.php
			return $request;
		}
		public function getUsers()
		{
			$sql = "SELECT * FROM usuario ";
			$request = $this->select_all($sql); //select_all = invocamos al metodo select_all que esta ubicado en Mysq.php
			return $request;
		}
		public function delUser($id)
		{
			$sql = "DELETE FROM usuario WHERE id = $id";
			$request = $this->delete($sql); //delete = invocamos al metodo delete que esta ubicado en Mysq.php
			return $request;
		}*/



	}


 ?>