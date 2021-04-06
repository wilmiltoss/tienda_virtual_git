<?php 

	class RolesModel extends Mysql //heredamos a Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;
		
		public function __construct()
		{
			parent::__construct();//cargamos el metdo constructor que corresponde a la clase padre Mysql
		}


		public function selectRoles()
		{
			//EXTRAEMOS LOS ROLES
			$sql = "SELECT * FROM rol WHERE status !=0";
			$request = $this->select_all($sql); //select_all hereda de Mysql.php
			return $request;
		}


		public function selectRol(int $idrol)
		{
			//EXTRAEMOS el rol
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM rol WHERE idrol = $this->intIdrol";
			$request = $this->select($sql); //select hereda de Mysql.php
			return $request;
		}

		public function insertRol(string $rol, string $descripcion, int $status){

			$return = "";
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM rol WHERE nombrerol = '{$this->strRol}' ";
			$request = $this->select_all($sql);

			//Si no hay registros, lo insertamos			
			if (empty($request)) 
			{
				$query_insert = "INSERT INTO rol (nombrerol,descripcion,status) VALUES (?,?,?) ";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
				$request_insert = $this->insert($query_insert,$arrData);
				$return = $request_insert;

			}else{
				$return = "exist";
			}

			return $return;
		}

		//ACTUALIZA ROL
		public function updateRol(int $idrol, string $rol, string $descripcion, int $status){
			$this->intIdrol = $idrol;
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM rol WHERE nombrerol = '$this->strRol' AND idrol != $this->intIdrol";
			$request = $this->select_all($sql);

			if (empty($request)) //Si esta vacio, lo actualiza
			{
				$sql = "UPDATE rol SET nombrerol = ?, descripcion = ?, status = ? WHERE idrol = $this->intIdrol ";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{//sino envia exist
				$request = "exist";
			}

			return $request;
        }

        //ELIMINA ROL
        public function deleteRol (int $idrol)
        {
        	$this->intIdrol = $idrol;
        	$sql = "SELECT * FROM persona WHERE rolid = $this->intIdrol";
        	$request = $this->select_all($sql);
        	if (empty($request)) 
        	{
        		$sql = "UPDATE rol SET status = ? WHERE idrol = $this->intIdrol ";
        		$arrData = array(0);//seteamos el status en 0
        		$request = $this->update($sql,$arrData);
        		if($request)
        		{
        			$request = 'ok';
        		}else{
        			$request = 'error';
        		}
        	}else{
        		$request = 'exist';
        	}
        	return $request;//retorna el valor para enviarlo
        }
    }


 ?>