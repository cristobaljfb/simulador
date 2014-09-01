<?php if(!isset($_SESSION)){
	session_start();
}?>
<?php 

if(isset($_REQUEST['enviar']))
{
	$_SESSION['carrera'] = $_REQUEST['carrera_select'];
}
if(isset($_SESSION['carrera'])){
	$carrera=$_SESSION['carrera'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="ISO-8859-1">
<title>Malla UAI</title>

<!-- CSS: gridster -->
<link rel="stylesheet" type="text/css"
	href="css/jquery.gridster.min.css">

<!-- CSS: Main File -->
<link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>
	<h3 class="page-title">Malla UAI</h3>


	<form name="" method="POST">
		<select name="carrera_select">
			<option value='DERECHO'>Derecho</option>
			<option value='DISENO'>Diseño</option>
			<option value='INGENIERIA CIVIL'>Ingeniería Civil</option>
			<option value='INGENIERIA COMERCIAL - LICENCIATURA EN ECONOMIA'>
				Ingeniería Comercial - Licenciatura en Economía</option>
			<option value='INGENIERIA COMERCIAL - PLAN COMUN'>Ingeniería
				Comercial - Plan Común</option>
			<option value='INGENIERIA COMERCIAL LCS'>Ingeniería Comercial - LCS</option>
			<option value='PERIODISMO'>Periodismo</option>
		</select> <input type="submit" name="enviar">
	</form>

	<h3>
		Malla Actual:
		<?php echo $_SESSION['carrera'];?>
	</h3>

	<div class="gridster">
		<ul>
		</ul>
	</div>


	<!-- JavaScript: ÄµQuery -->
	<script src="js/jquery-1.11.1.min.js"></script>

	<!-- JavaScript: gridster -->
	<script src="js/jquery.gridster.min.js"></script>

	<!-- JavaScript: Functions -->
	<script>
			var gridster;

			subjectsData = [
				
			<?php  include_once 'sql_class.php';
			$sql = new sql();
			$sql->generar_data($carrera);  ?>
			]
     		
     		arregloNames = [	<?php  include_once 'sql_class.php';
			$sql = new sql();
			$sql->generar_array($carrera);  ?>];

			function setId(s){
				for(var i=0;i<s.length;i++){
					s[i]['id'] = i+1;
				}
			}
     
			function printPositions(s){
			
				console.log('Posiciones DespuÃ©s del Movimiento:');

				$.each(s, function(count) {
					
					console.log('Reviso Widget: ' + subjectsData[count]['name'])
		        	console.log('Col: ' + this.col)
		        	console.log('Prerrequisitos:')
		       
		        	// Si el prerrequisito 1 está definido, entra en el if.
					if(subjectsData[count]['pre1']!=''){
						//Se crea la variable preIndex1
						var preIndex1 = (arregloNames.indexOf(subjectsData[count]['pre1']))
						console.log('Pre1 Name: ' + subjectsData[preIndex1]['name'])
						// console.log('Pre1 Id: ' + subjectsData[preIndex1]['id'])
						console.log('Pre1 Col: ' + s[preIndex1].col)
						if(subjectsData[preIndex1]['status']=='error' || (this.col<=s[preIndex1].col))
						{
							subjectsData[count]['status']='error'
						}
						else 
						{
							subjectsData[count]['status']='ok'
						}

						if(subjectsData[count]['pre2']!=''){
							var preIndex2 = (arregloNames.indexOf(subjectsData[count]['pre2']))
							console.log('Pre2 Name: ' + subjectsData[preIndex2]['name'])
							// console.log('Pre2 Id: ' + subjectsData[preIndex2]['id'])
							console.log('Pre2 Col: ' + s[preIndex2].col)
							if(subjectsData[preIndex2]['status']=='error' || (this.col<=s[preIndex2].col || subjectsData[count]['status']=='error'))
						    {
							subjectsData[count]['status']='error'
							}
							else 
							{
								subjectsData[count]['status']='ok'
							}

							if(subjectsData[count]['pre3']!=''){
								var preIndex3 = (arregloNames.indexOf(subjectsData[count]['pre3']))
								console.log('Pre3 Name: ' + subjectsData[preIndex2]['name'])
								// console.log('Pre2 Id: ' + subjectsData[preIndex2]['id'])
								console.log('Pre3 Col: ' + s[preIndex3].col)
								if(subjectsData[preIndex3]['status']=='error' || (this.col<=s[preIndex3].col || subjectsData[count]['status']=='error'))
							    {
								subjectsData[count]['status']='error'
								}
								else 
								{
									subjectsData[count]['status']='ok'
								}

							}
						}
					}

					else{
						console.log('Ninguno')
					}

		        });
				console.log(JSON.stringify(subjectsData))
			}			

			$(function(){

				gridster = $(".gridster > ul").gridster({
					widget_margins: [10, 10],
					widget_base_dimensions: [120, 90],
					min_cols: 8,
					max_cols: 10,
					draggable:{
						//CUANDO DEJA DE DIBUJAR, SE LLAMA A LA FUNCION validate()
						stop:validate
					}
					
				}).data('gridster');

				
				// SE LLENA LA MALLA CON LOS DATOS DE CADA RAMO.
				
				  $.each(subjectsData, function(i) {
		        	if(typeof subjectsData[i]!='undefined'){
		            	gridster.add_widget(
		            		'<li class="ok">'+this.name+'</li>', this.size_x, this.size_y, this.col, this.row );
		        	}
		        });
				
				function validate(){
					//SE OBTIENE LA SERIALIZACION DE LA MALLA
					s = gridster.serialize();
					//A CADA OBJETO SE LE ENTREGA UN ID.
					setId(s);
					// SE IMPRIMEN LAS POSIOCIONES DE CADA OBJETO EN LA CONSOLA Y SE VALIDA SI TIENE ALGUN PRERQUISITO.
					printPositions(s);

					// SE BORRAN TODOS LOS OBJETOS QUE SE HABIAN DIBUJADO.
	        		gridster.remove_all_widgets();
					// SE VUELVE A DIBUJAR TODOS LOS OBJETOS CON LOS NUEVO PARAMETROS DE S.
					$.each(s, function(i) {
			        	if(typeof subjectsData[i]!='undefined'){
			            	gridster.add_widget(
			            		'<li class="'+subjectsData[i]['status']+'">'+
			            		subjectsData[i]['name']+
			            		'</li>',
			            		1, 1, this.col, this.row
			            	);
			        	}
			        });

				}

			});


		</script>

</body>
</html>
