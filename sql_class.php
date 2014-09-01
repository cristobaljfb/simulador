<?php class sql
{
// 	LOCALHOST
	private $localhost = "localhost";
	private $usuario = "root";
	private $password = "";
	private $database = "asignaturas";
	
// 	//HOSTINGER SIMULADOR.URL.PH
// 	private $localhost = "localhost";
// 	private $usuario = "u918487991_ramos";
// 	private $password = "password";
// 	private $database = "u918487991_ramos";
	
	
	public function __construct() {
		$this->conectar ();
	}
	
	public function conectar() {
		if (! isset ( $this->conexion )) {
			$this->conexion = (mysql_connect ( $this->localhost, $this->usuario, $this->password )) or die ( mysql_error () );
			mysql_select_db ( $this->database, $this->conexion ) or die ( mysql_error () );
		}
	}
	
	
	public function generar_data($carrera)
	{
		$query = "SELECT * FROM ramos WHERE nombreMalla = '".$carrera."' ORDER BY nodoId ASC";
		$result = mysql_query($query);
		
		$this_id = 1;
		
		while ($row = mysql_fetch_assoc($result))
		{
			echo "{'id':'".$this_id."', 'codigo':'".$row['codigoNodo']."', 'name':'".$row['nombreNodo']."', 'pre1':'".$row['pre_1']."', 'pre2':'".$row['pre_2']."', 
					'pre3':'".$row['pre_3']."', 'pre4':'".$row['pre_4']."', 'status':'ok', 'col':".$row['semestreMalla'].",	
							'row':".$row['columnaMalla'].",	'size_x': 1,	'size_y': 1},";
			$this_id++;
		}
	}
	
	public function generar_array($carrera)
	{
		$query = "SELECT * FROM ramos WHERE nombreMalla = '".$carrera."' ORDER BY nodoId ASC";
		$result = mysql_query($query);
	
		$this_id = 1;
	
		while ($row = mysql_fetch_assoc($result))
		{
			echo ' "'.$row['codigoNodo'].'" , ';
			$this_id++;
		}
	}

}
