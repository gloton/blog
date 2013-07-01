<!DOCTYPE HTML>
<html lang= "es">
<head>
<?php 
/* $_GET["pos"] es la variable que indica el numero de registro inicial, desde donde se mostraran los registros y su valor es asignado a la variable $inicio
 * $inicio es el numero de registro inicial, desde donde se mostraran los registros
 * $getPost almacena un array con los post o noticias
 * $c esa variable se refiere a la categoria
 * */
include_once 'includes/constantes.inc.php';
include_once 'class/class.php';
$objTrabajo = new Trabajo();
$categorias = $objTrabajo->get_categorias();
$getPost = $objTrabajo->get_post_por_id();

?>
<meta charset= "utf-8">
<title><?php echo $getPost[0]["titulo"];?></title>
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<style type="text/css">
/*post*/
.post {
	width: 668px;
	height: 180px;
	background-color: yellow;
	margin: 10px auto;
}
.postSup {
	height: 142px;
	background-color: red;
}
.postInf {
	height: 38px;
	background-color: olive;
}
.introImg {
	width: 218px;
	height: 100%;
	background-color: green;
	float: left;
}
.introText {
	width: 450px;
	height: 100%;
	background-color: fuchsia;
	float: left;
}

/*side right*/

</style>
</head>
<body>
<!-- Begin Wrapper -->
<div id="wrapper">
	<!-- Begin Left Column -->
	<div id="leftcolumn">
		<div class="post" style="background-color: red;">
			<!-- inicio detalle del post -->
			<h3><?php echo $getPost[0]["titulo"];?></h3>
			<div class="fechaDetail"><?php echo $getPost[0]["fecha:cadena"];?></div>
			<div class="detailPost"><?php echo $getPost[0]["detalle"];?></div>
			<div class="descarga"><a href="<?php echo $getPost[0]["descarga"];?>">Descargar</a></div>
			<div class="categoria">Categoria : PHP</div>
			<div class="clearfix"></div>
			<!-- fin detalle del post -->
		</div>
		<!-- en esto estaba poniendo embebido un video, pero creo que no tiene utilidad por ahora
		<div class="detailHtml"><?php echo $getPost[0]["html"];?></div>
		-->
		<!-- inicio comentarios -->
		<h3>Ingresa tu comentario</h3>
		<div class="enviarComentario">
			<form name="form" action="procesa_comentarios.php" method="post">
				<p>
				Nombre: <input name="nom" type="text" />
				</p>
				<p>E-mail: <input name="correo" type="text" /> (no sera publicado)
				</p>
				<p>Sitio web: <input name="web" type="text" /></p>
				<p>Mensaje: <textarea name="mensaje" rows="10" cols="40" cols=""></textarea>
				</p>
				<input name="id_noticia" type="hidden" value="<?php echo $_GET["id"]; //cc lo saco del .htaccess ?>" />
				<p><input type="submit" value="comentar" /></p>
			</form>
		</div>
		<h3>Comentarios</h3>
		<ul id="comentario">
			<?php 
				$comentarios = $objTrabajo->get_comentarios($_GET["id"])
			?>
			<?php 
			for ($i = 0; $i < sizeof($comentarios); $i++) {
			?>
			<li><span class="nameUser"><?php print $comentarios[$i]["nombre"];?></span> dice:
				<div class="commentUser"><?php print $comentarios[$i]["texto"];?></div>
			</li>
			<?php 
			}
			?>
		</ul>			
		<!-- fin comentarios -->		
	</div><!-- End Left Column -->
	<!-- Begin Right Column -->
	<div id="rightcolumn">
		<div class="postModulo">
			<div class="postModuloTitle">
				<h3>Categorias</h3>
			</div>
			<div class="postModuloCategory">
				<ul>
<?php 
				for ($i=0;$i<sizeof($categorias);$i++) {
?>				
					<li><a href="index.php?cat=<?=$categorias[$i]["id_categoria"];?>"><span><?php print $categorias[$i]["categoria"]; ?></span></a></li>
<?php 
				}
?>					
				</ul>
			</div>
			<!-- inicio widget ultimas noticias -->
			<div class="postModuloTitle">
				<h3>Últimas noticiass</h3>
			</div>
			<div class="postModuloCategory">
				<ul>
<?php
				$lastNews = $objTrabajo->get_ultimas_10_noticias();
				for ($i=0;$i<sizeof($lastNews);$i++) {
				$texto=str_replace(" ","-",$lastNews[$i]["titulo"]);
?>				
					<li><a href="<?php echo $texto."-p".$lastNews[$i]["id_noticia"].".html"?>" title="<?= $lastNews[$i]["titulo"]; ?>" ><span><?php echo Trabajo::corta_palabra($lastNews[$i]["titulo"],32) ; ?></span></a></li>
<?php 
				}
?>					
				</ul>
			</div>		
			<!-- fin widget ultimas noticias -->									
		</div>
	</div><!-- End Right Column -->
	<div class="clearfix"></div>
	<div id="footer">
		<div id="paginacion">
			<p>
<?php 
/*Si nos encontramos en la primera pagina, es decir, $inicio es igual a 
 * 0, significa que, no hay ningun post mas que mostrar, 
 * por lo que el texto  "Anterior" no 
 * aparecera linkeable puesto que no hay anteriores publicaciones
 * pero si estamos en una pagina mayor que 0, es decir, hay mas paginas
 * el texto "Anterior" va a aparecer linkeable*/
if ($inicio == 0) {
?>
				<span>Anterior</span>
<?php 
} else {
	$anterior = $inicio - 10;
?>
				<a href="?pos=<?=$anterior ?>&cat=<?=$c ?>" title="Anterior" ><span>Anterior</span></a>
<?php 					
}
?>				
					
| 
<?php 
if (count($getPost) == 10) {
	//es lo mismo que anterior pero este va aumentando 
	//el numero de post a partir del cual se muestra
	//en el caso de que hayan menos de 10 registros
	//no se mostrara linkeado el texto "Siguiente"
	$proximo = $inicio + 10;
?>
				<a href="?pos=<?= $proximo?>&cat=<?=$c?>" title="Siguiente">Siguiente</a>
<?php	
} else {
/*cuando count($getPost) vale distinto de 10, en este caso sera un numero menor que 10
 * es por que ya llego a la ultima pagina*/			
?>
				<span>Siguiente</span></p>
<?php 
}
?>
		</div>
	</div>
</div><!-- End Wrapper -->
</body>
</html>