<?php

//$_POST['var_idbanner'] = '' ? ' echo 2 ' : exit() ;
//echo "asdad:" . $_POST['var_idbanner'];
//print_r($_POST['var_idbanner']);

if ($_POST['var_idbanner']== ''){
	print_r($_POST['var_idbanner']);
	exit();
}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Historial académico Iberoamericana</title>
<link href="estilos_horario.css" rel="stylesheet" type="text/css">
<!-- <link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">  -->



</head>

<body>
<div id="contenido">
 
<?php


	$user="root";
	$pass="";
	$server="localhost";
	$db="planeacion_2017_oct";
	$link = new mysqli($server,$user,$pass,$db);

	if(!($link)) {
		die("Error: No se pudo conectar");
		exit();
	}



	$consulta_homologante = 'SELECT hs.nombreEst, h.programa, h.homologante, h.observacion, h.marca_ingreso FROM homologantes h INNER JOIN homologaciones hs ON h.homologante=hs.codBanner WHERE h.homologante='.$_POST['var_idbanner'].'';
	$resultado_homologante =$link->query($consulta_homologante) ; 

	$filas_homologante = $resultado_homologante->fetch_assoc();




	if($filas_homologante==0) {
		echo "<p> &nbsp; </p><p> &nbsp; </p><p> &nbsp; </p><p> &nbsp; </p>";
		echo "<p style='clear: left; text-align: center; color: #00374C; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 32px;'> No se ha encontrado información para el estudiante solicitado";
		exit();
	}  
	else 
	{
		$homologante = $resultado_homologante->fetch_assoc();
		$id_homologante=$filas_homologante['homologante'];
		$programa=$filas_homologante['programa'];
		
		$omg_homologantes = $filas_homologante ['observacion'];
	
		$nombre_programa = $programa=='lee' ? "Licenciatura en Educación Especial" : "Licenciatura en Pedagogía Infantíl";
		$nombre_homologante=$filas_homologante['nombreEst'];
		$periodo = $filas_homologante['marca_ingreso'];

		$periodo_limpio =  explode("_", $periodo);

		echo "<p> &nbsp; </p><p style='clear: left; text-align: left; color: #00374C; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 32px;'> Historial académico de: <br />" .  utf8_encode($nombre_homologante). " identificado con Código de estudiante: " . $id_homologante ."<br/>Programa " . $nombre_programa  . " - Periodo: " . $periodo_limpio[0] . "</p> <p style='clear: left; text-align: left; color: #00374C; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 32px;'>Recuerde que la información suministrada por este sistema es de carácter informativo.</p>";
		
		if($omg_homologantes == "OMG-retencion"){
			echo "<p style='clear: left; text-align: left; color: #ff0000; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 32px;'> Apreciado estudiante, el pago de su perioro actual aún no se ve reflejado, si ya realizo el pago, comuniquese con el área de servicio al estudiante. Por esta razon no tiene materias programadas en este momento";
		} elseif($omg_homologantes == "OMG-inactivo" || $omg_homologantes == "inactivo-banner"){
			echo " <p style='clear: left; text-align: left; color: #ff0000; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 32px;'>Apreciado Estudiante, usted no se encuentra matriculado en el periodo actual, comuniquese con el área de servicio al estudiante. Por esta razon no tiene materias programadas en este momento";
		}	
	}

	//HOMOLOGACIONES
	$contador_homologadas=0;
	$arr_materias_homologadas = array();
	$consulta_homologaciones = 'select distinct codMateria from homologaciones where codBanner = '.$_POST['var_idbanner'].' AND codprograma="'. $programa . '"';
	
	$resultado_homologaciones = $link->query($consulta_homologaciones);


	while($materias_homologadas =  $resultado_homologaciones->fetch_assoc()) {
		
	
		$codmateria= $materias_homologadas['codMateria'];
		
		$arr_materias_homologadas[$contador_homologadas]= $codmateria;
		$contador_homologadas++;
	}
	//print_r($codmateria);
	//print_r($arr_materias_homologadas);
	//print_r($contador_homologadas);
	//MATERIAS POR VER
	$contador_porver=0;
	$arr_materias_porver = array();
	$cosulta_porver = 'select distinct codMateria from materias_porver where codBanner = '.$_POST['var_idbanner'].'';
	$resultado_porver = $link->query($cosulta_porver);

	while($materias_porver = $resultado_porver->fetch_assoc()) {
		$codmateria= $materias_porver['codMateria'];
		$arr_materias_porver[$contador_porver]= $codmateria;
		$contador_porver++;	
	}
	//var_dump($arr_materias_homologadas);
	//PLANEACIÓN 
	$contador_planeadas=0;
	$arr_materias_planeadas = array();
	$consulta_planeacion = 'select distinct codMateria from planeacion where codBanner = '.$_POST['var_idbanner'].'';
	$resultado_planeacion = $link->query($consulta_planeacion);
	while($materias_planeadas = $resultado_planeacion->fetch_assoc()) {
		$codmateria= $materias_planeadas['codMateria'];
		$arr_materias_planeadas[$contador_planeadas]= $codmateria;
		$contador_planeadas++;
	}


?>
<p>&nbsp;  </p>
 <table width="100%	" border=1 cellspacing=0 cellpadding=3 bordercolor="#00374C">
  <tr bgcolor="#00A8D4">
    <th width="300"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;"> Materia </p></th>
    <th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Código</p></th>
    <th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Semestre</p></th>
    <th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Cursada y Aprobada</p></th>
    <th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Materia Por ver</p></th>
	<th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Programada en periodo actual</p></th>
  </tr>

<?php  
//var_dump($arr_materias_porver);
//$cont=0;

$consulta_base = 'SELECT * FROM base_acdemica WHERE codprograma="'.$programa.'" ORDER BY semestre, ciclo ASC ';
$resultado_baseprograma = $link->query($consulta_base); 
//echo $consulta_base . "<br />";
// exit(); 

while($base = $resultado_baseprograma->fetch_assoc()) { 
$mat_base = $base ['curso'];
$semestre_base = $base['semestre'];
$tipoSem=$semestre_base%2;
$tipoSem= $tipoSem==1 ? "#FFFFFF" : "#EEEEEE";

$nombre_programa = $programa=='lee' ? "Licenciatura en Educación Especial" : "Licenciatura en Pedagogía Infantíl";

$codMateria_base = $base['codigoCurso'];

if(in_array($codMateria_base, $arr_materias_homologadas)){
	//echo $cont .  " SiEstá: " . $codMateria_base ;
	$materia_homologaciones = "OK";
} else {
	//$cont=$cont+1;
	//echo $cont .  " NoEstá: " . $codMateria_base ;
	$materia_homologaciones = "";
}

if(in_array($codMateria_base, $arr_materias_porver)) {
	//$cont=$cont+1;
	//echo $cont .  " SiEstá: " . $codMateria_base;
	$materia_porver = "Pendiente";
} else {
	//$cont=$cont+1;
	//echo $cont .  " NoEstá: " . $codMateria_base ;
	$materia_porver = "";
}

if(in_array($codMateria_base, $arr_materias_planeadas) && $omg_homologantes=='OMG') {
	$materia_planeacion = "Matriculada";
} else {
	$materia_planeacion = "";
}

?>
  <tr>
    <td bgcolor="<?php echo $tipoSem; ?>"><p style="clear: left; text-align: left; color: #00374C; font-family:  century_gothic;  font-weight: bold; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo utf8_encode($mat_base)?></p></td>
    <td bgcolor="<?php echo $tipoSem; ?>"><p style="clear: left; text-align: center; color: #00374C; font-family: century_gothic; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo utf8_encode($codMateria_base)?></td>
    <td bgcolor="<?php echo $tipoSem; ?>"><p style="clear: left; text-align: center; color: #00374C; font-family: century_gothic; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo utf8_encode($semestre_base)?></td>
    <td bgcolor="<?php echo $tipoSem; ?>"><p style="clear: left; text-align: center; color: #00374C; font-family: century_gothic; font-size: 14px; padding-top: 2px; padding-bottom: 2px;"><?php echo utf8_encode($materia_homologaciones) ?></td>
	<td bgcolor="<?php echo $tipoSem; ?>"><p style="clear: left; text-align: center; color: red; font-family: century_gothic; font-size: 16px; padding-top: 2px; padding-bottom: 2px;"><?php echo utf8_encode($materia_porver) ?></td>
	<td bgcolor="<?php echo $tipoSem; ?>"><p style="clear: left; text-align: center; color: blue; font-family: century_gothic; font-size: 16px; padding-top: 2px; padding-bottom: 2px;"><?php echo utf8_encode($materia_planeacion) ?></td>
  </tr>


<?php 
}
?>
</table>
 
    
    
    <!--Texto Indicativo-->
      <div id="indicacion2">
    	<p>Si tienes dudas o comentarios comunícate con nuestra línea de atención al estudiante: +57 (1) 5897550 o a través del correo electrónico servicioalestudiante@iberoamericana.edu.co. 
        <br>
        <br>Si te encuentras en Bogotá, puedes acercarte a nuestro Centro de Atención al Estudiante en la Calle 67 N 5-27.</p> 
		
    <!--Redes Sociales-->		
        <div id="redes">
            <p>Siguenos en:</p>
            <br>
                <ul>       
					<li id="red1"><a href="" target="_blank"><img src="imagenes/b_youtube.png" width="35" height="35"></a></li>       
					<li id="red2"><a href="" target="_blank"><img src="imagenes/b_instagram.png" width="35" height="35"></a></li>    
					<li id="red3"><a href="" target="_blank"><img src="imagenes/b_twitter.png" width="35" height="35"></a></li>
					<li id="red4"><a href="" target="_blank"><img src="imagenes/b_facebook.png" width="35" height="35"></a></li>
                </ul>
        </div>
    
    <!--Copyright-->    
      <div id="copy">
    	<p> P.J. No. 0428 del 28 de Enero de 1982 - MEN VIGILADA MINEDUCACIÓN Copyright © 2016</p> 
    </div>    
</div>
</body>
</html>
