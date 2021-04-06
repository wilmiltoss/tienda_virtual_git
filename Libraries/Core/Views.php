<?php 

	class Views //A3 en data
	{
		function getView($controllers, $view,$data="")//data vacio por las acaciones que no hay datos p/ enviar a la vista
		{
			$controllers = get_class($controllers);
			if ($controllers == "Home") {
				$view = "Views/".$view.".php";
			}else{

				$view = "Views/".$controllers."/".$view.".php";
			}

			require_once($view);


		}
	}

 ?>