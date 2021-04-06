<?php 
	//Convertimos la 1ra letra en mayuscula(para lectura  de las url en el hosting, sensibles a may y min)
	$controller = ucwords($controller);
	//Load --NOS COMUNICAMOS CON LOS CONTROLADORES
	$controllerFile = "Controllers/".$controller.".php";//direccion del controlador
	if (file_exists($controllerFile)) //si existe el controlador
	{
		require_once($controllerFile);
		$controller = new $controller();
		if (method_exists($controller, $method))//si existe el metodo
		{
			$controller->{$method}($params);
		}else{
			//hacemos uso del mensaje error
			require_once("Controllers/Error.php");

		}
	}else{
		require_once("Controllers/Error.php");
	}


 ?>