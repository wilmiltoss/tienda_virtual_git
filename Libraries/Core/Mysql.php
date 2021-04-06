<?php 

	/**
	 Heredamos de la clase conexion.php
	 */
	class Mysql extends Conexion
	{
		private $conexion;
		private $strquery;
		private $arrValues;
		
		function __construct()
		{
			$this->conexion = new Conexion();
			$this->conexion = $this->conexion->connect();     
		}

		//Metodo para Insertar registros
		public function insert(string $query, array $arrValues)//array debe ser
		{
			//asignamos las variables a ejecutar
			$this->strquery   = $query;
			$this->arrVAlues  = $arrValues;

			$insert = $this->conexion->prepare($this->strquery );
			$resInsert = $insert->execute($this->arrVAlues);

			if($resInsert)
			{
				$lastInsert =  $this->conexion->lastInsertId();//obtenemos el ultimo id insertado
			}else{

				$lastInsert = 0;//si no se almancena tendra el valor a 0
			}
			return $lastInsert;		
		}

		//Metodo para Buscar un registro
		public function select(string $query)
		{
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute();
			$data = $result->fetch(PDO::FETCH_ASSOC);//fetc obtener solo un registro
			return $data;
			return $data;
		}

		//metodo devolver todos los registros
		public function select_all(string $query)
		{
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute();
			$data = $result->fetchall(PDO::FETCH_ASSOC);//fetchall obtener mas de un registro
			return $data;
		}


		//metodo para actualizar registro
		public function update(string $query, array $arrValues)
		{
			$this->strquery = $query;
			$this->arrVAlues = $arrValues;

			$update = $this->conexion->prepare($this->strquery);
			$resExecute = $update->execute($this->arrVAlues);
			return $resExecute;
		}

			//metodo eliminar un registro
		public function delete(string $query)
		{
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$del = $result->execute();
			return $del;
		}






	}


 ?>