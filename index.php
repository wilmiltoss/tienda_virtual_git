<?php 

	require_once("Config/Config.php");
	require_once("Helpers/Helpers.php");//punto de enlace entre // home.php y Helpers.php
	//para evitar error inicio index (si no hay url va a home)
	$url =!empty($_GET['url']) ? $_GET['url'] : 'home/home';//extrae del htacess url
	$arrUrl = explode("/", $url);//cuando encuntra el delimitador (/) lo va separar un array
	//traen home cuando no tenga nada
	$controller = $arrUrl[0];
	$method  = $arrUrl[0];

	$params = "";
	
	if (!empty($arrUrl[1])) //si la la posicion 1 array es diferente de vacio
	{
		if($arrUrl[1] != "")
		{
			$method = $arrUrl[1];

		}
	}

	if (!empty($arrUrl[2])) 
	{
		if ($arrUrl[2] != "") 
		{
			for ($i=2; $i <  count($arrUrl); $i++) 
			{ 
				$params .= $arrUrl[$i].',';
			}
			$params = trim($params,',');//trim : remueve la ultima coma de la cadena
	
		}
	}

    //funcion para cargar o llamar a las clases de forma automática
	require_once("Libraries/Core/Autoload.php");

   //Load --NOS COMUNICAMOS CON LOS CONTROLADORES
	require_once("Libraries/Core/Load.php");



 ?>