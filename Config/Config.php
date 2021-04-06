<?php 
	
	//define("BASE_URL","http://localhost:8081/tienda_virtual/");
	const BASE_URL = "http://localhost:8081/tienda_virtual";
	//const LIBS = "Libraries/";
	//const VIEWS = "Views/"
	//Variables de conexion a la base de datos
	const DB_HOST = "localhost";
	const DB_NAME = "db_tiendavirtual";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "charset=utf8";

	//Zona Horaria
	date_default_timezone_set('America/Asuncion');

	//Delimitadores decimal y millar Ej. 24,989.00
	const SPD = ",";//muestra el separador de decimales
	const SPM = ".";//muestra el separador de millares

	//Simbolo de moneda
	const SMONEY = "GS";


 ?>