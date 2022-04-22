<?php

//$_POST['var_idbanner'] = '' ? ' echo 2 ' : exit() ;

if ($_POST['var_idbanner']== '')
	exit();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Horarios y Salones para estudiantes de Licenciatura</title>
<link href="estilos_horario.css" rel="stylesheet" type="text/css">
<!-- <link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">  -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-98305470-1', 'auto');
  ga('send', 'pageview');

</script>

</head>

<body>
<div id="contenido">
 
<?php
if(!($link = mysql_connect("http://192.168.64.2", "virtual_user", "5t&yw2And13"))) {
    die("Error: No se pudo conectar");
	exit();
}

if(!mysql_select_db("apoyo_virtual", $link)) {
    die("Error: No existe la base de datos");
	exit();
} 

$consulta_materias = 'SELECT COUNT(id) materias FROM horarios_lic WHERE documento="'.$_POST['var_idbanner'].'"';
$resultado_materias = mysql_query($consulta_materias, $link); 
$valores = mysql_fetch_assoc($resultado_materias);
$valores_materias = $valores['materias'];


$consulta_estudiantecurso = 'SELECT * FROM horarios_lic WHERE codBanner='.$_POST['var_idbanner'].'';
$resultado_estudiantecurso = mysql_query($consulta_estudiantecurso, $link); 
// echo $consulta_estudiantecurso . "<br />";
// exit();

if($valores_materias==0) {
	echo "<p> &nbsp; </p><p> &nbsp; </p><p> &nbsp; </p><p> &nbsp; </p>";
	echo "<p style='clear: left; text-align: center; color: #00374C; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 32px;'> No se ha encontrado información para el estudiante solicitado";
	exit();
}
?>
 <p style="clear: left; text-align: left; color: #00374C; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 32px;"> Información de horarios para el estudiante con ID- Banner:  <?php echo $_POST['var_idbanner'];  
?>
<p> &nbsp; </p>
 <table width="100%	" border=1 cellspacing=0 cellpadding=3 bordercolor="#00374C">
  <tr bgcolor="#00A8D4">
    <th width="200"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Curso </p></th>
    <th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Semestre</p></th>
    <th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Grupo</p></th>
    <th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Docente</p></th>
    <th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Sede</p></th>
	<th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Salón</p></th>
	<th scope="col"><p style="clear: center; text-align: center; color: #FFFFFF; font-family: century_gothic; font-weight: bold; font-size: 16px; padding-top: 5px; padding-bottom: 5px;">Horario</p></th>
  </tr>

<?php  
while($inscripcion = mysql_fetch_assoc($resultado_estudiantecurso)) { 
?>
  <tr>
    <td><p style="clear: left; text-align: left; color: #00374C; font-family:  century_gothic;  font-weight: bold; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo utf8_encode($inscripcion['curso']) . " - "  . $inscripcion['codMateria'];  ?></p></td>
    <td><p style="clear: left; text-align: center; color: #00374C; font-family: century_gothic; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo $inscripcion['semestre'] ?></td>
    <td><p style="clear: left; text-align: center; color: #00374C; font-family: century_gothic; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo $inscripcion['grupo'] ?></td>
    <td><p style="clear: left; text-align: left; color: #00374C; font-family: century_gothic; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo utf8_encode($inscripcion['docente']) ?></td>
	<td><p style="clear: left; text-align: left; color: #00374C; font-family: century_gothic; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo $inscripcion['sede'] ?></td>
	<td><p style="clear: left; text-align: left; color: #00374C; font-family: century_gothic; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo $inscripcion['salon'] ?></td>
	<td><p style="clear: left; text-align: left; color: #00374C; font-family: century_gothic; font-size: 12px; padding-top: 2px; padding-bottom: 2px;"><?php echo $inscripcion['horario'] ?></td>
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
