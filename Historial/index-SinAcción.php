<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Historial académico Iberoamericana</title>
<link href="estilos_horario.css" rel="stylesheet" type="text/css">
<!-- <link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">  -->

<script type="text/javascript">
function validar() {
	var documento=document.forms.formulario.documento;

	if(documento.value.length=='') {
		documento.style.borderColor="#808080";
		alert('Apreciado estudiante debes ingresar tu código de estudiante');
		 return false;
	}
	if (documento.value<10000000 || isNaN(documento.value)) {
	  alert("El código de estudiante introducino no es válido: " + documento.value + " \n\nRecuerde que debe ser un número de 9 dígitos que inicia con 1000 o 9000");
	  return false;
	}
	return true;
}
</script>

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
    <!--Formulario - Ingresar datos-->
     <form action="#" method="post" onSubmit="" name="formulario">
         <label>Cód. de Estudiante:</label>
         <input type="text" id="documento" name="var_idbanner" maxlength="9" autocomplete="on" autofocus="autofocus"> 
		 <p>&nbsp;  </p>
		 <button class="boton_buscar" type="submit">Buscar</button> 
    </form>

    
    <!--Boton Buscar-->
    <!--Video-->
    <div class="video">
       <p style="clear: left; text-align: left; color: #00374C; font-family: century_gothic; font-size: 16px; padding-top: 32px;"><br/> Apreciado estudiante, <BR /><BR />
	   En este momento se estan haciendo algunos ajustes en el sistema de consulta, por favor ingresa el 30 de enero a partir de las 4 p.m
.</p>
	   <p style="clear: left; text-align: left; color: #00374C; font-family: century_gothic; font-size: 16px; padding-top: 32px;"> Juntos logramos más.</p> 
    </div>
    
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
