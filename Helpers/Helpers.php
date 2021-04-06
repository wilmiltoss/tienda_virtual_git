<?php 

	//retorna la url rais del proyecto

	function base_url()
	{
		return BASE_URL; // BASE_URL obtenemos de Config.php
	}

	//Retorna la url desde Assets
	function media()
	{
		return BASE_URL."/Assets";
	}

	//Funciones que llaman para la vista principal
	function headerAdmin($data="")
	{
		$view_header = "Views/Template/header_admin.php";
		require_once ($view_header);
	}

	function footerAdmin($data="")
	{
		$view_footer = "Views/Template/footer_admin.php";
		require_once ($view_footer);
	}

	//Muestra la informacion formateada
	function dep($data)
	{
		$format = print_r('<pre>');
		$format .= print_r($data);
		$format .= print_r('<pre>');
		return $format;
	}

	//funcion que muestra un modals o sea los formularios
	function getModal(String $nameModal, $data)
	{
		$view_modal = "Views/Template/Modals/{$nameModal}.php";//va abrir el modals que enviamos como parametro
		require_once $view_modal;
	}

	//Elimina exceso de espacios entre palabras (limpia cadena) en los formularios
	function strClean($strCadena)
	{
		$string = preg_replace(['/\s+/','/^\s|\s$/'], [' ',''], $strCadena);//Limpia el exceso de espacios entre palabras
		$string = trim($string); //Elimina espacios en blanco al inicio y al final
		$string = stripcslashes($string); //Elimina las \ invertidas
		$string = str_ireplace("<script>","", $string);
		$string = str_ireplace("</script>","", $string);
		$string = str_ireplace("<script src>","", $string);
		$string = str_ireplace("<script type>","", $string);
		$string = str_ireplace("SELECT * FROM","", $string);
		$string = str_ireplace("DELETE FROM","", $string);
		$string = str_ireplace("INSERT INTO","", $string);
		$string = str_ireplace("SELECT COUNT(*) FROM","", $string);
		$string = str_ireplace("DROP TABLE","", $string);
		$string = str_ireplace("OR '1'='1","", $string);
		$string = str_ireplace('OR "1"="1"',"", $string);
		$string = str_ireplace('OR ´1´=´1´',"", $string);
		$string = str_ireplace("is NULL; --","", $string);
		$string = str_ireplace("LIKE '","", $string);
		$string = str_ireplace("LIKE ´","", $string);
		$string = str_ireplace("OR 'a'='a","", $string);
		$string = str_ireplace('OR "a"="a',"", $string);
		$string = str_ireplace("OR ´a´=´a","", $string);
		$string = str_ireplace("OR ´a´=´a","", $string);
		$string = str_ireplace("^","", $string);
		$string = str_ireplace("[","", $string);
		$string = str_ireplace("]","", $string);
		$string = str_ireplace("==","", $string);
		return $string;
	}

	//Genera una contraseña de forma automatica con 10 caracteres.
	function passGenerator($length = 10)
	{
		$pass = "";
		$longitudPass=$length;
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
		$longitudCadena=strlen($cadena);

		for($i=1; $i<=$longitudPass; $i++)
		{
			$pos = rand(0,$longitudCadena-1);
			$pass .= substr($cadena, $pos,1);
		}
		return $pass;
	}

	//Genera un token para manejo de contraseñas
	function token()
	{
		$r1 = bin2hex(random_bytes(10));
		$r2 = bin2hex(random_bytes(10));
		$r3 = bin2hex(random_bytes(10));
		$r4 = bin2hex(random_bytes(10));
		$token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
		return $token;
	}

	//Formato para valores monetarios
	function formatMoney($cantidad)
	{
		$cantidad = number_format($cantidad,2,SPD,SPM);//SPD,SPM variables extraidas de Config.php
		return $cantidad;
	}

	




 ?>