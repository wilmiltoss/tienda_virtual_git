<?php 
	
	
	class LoginModel extends Mysql { //heredamos la clase Controllers

		private $intIdUsuario;
		private $strUsuario;
		private $strPassword;
		private $strToken;
		
		public function __construct()
		{
			parent::__construct();//ejecuta el metodo que esta en el controllers  loadModel A1

		}

		public function loginUser(string $usuario, string $password)
		{
			$this->strUsuario = $usuario;
			$this->strPassword = $password;

			$sql = "SELECT idpersona, status FROM persona 
					WHERE email_user = '$this->strUsuario' 
					and password = '$this->strPassword' 
					and status != 0 ";
		
			$request = $this->select($sql);
			return $request;

		}

		//funcion para actualizar session al actualizar usuario
		public function sessionLogin(int $iduser){
			$this->intIdUsuario = $iduser;
			//BUSCAR ROLE
			$sql = "SELECT p.idpersona,
						   p.identificacion,
						   p.nombres,
						   p.apellidos,
						   p.telefono,
						   p.email_user,
						   p.nit,
						   p.nombrefiscal,
						   p.direccionfiscal,
						   r.idrol,r.nombrerol,
						   p.status
				    FROM persona p
				    INNER JOIN rol r ON p.rolid = r.idrol
				    WHERE p.idpersona = $this->intIdUsuario";
		    $request = $this->select($sql);
		    return $request;
		}

	}
 ?>