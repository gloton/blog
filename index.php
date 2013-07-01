<!DOCTYPE HTML>
<html lang= "es">
<head>
<?php 
/* $_GET["pos"] es la variable que indica el numero de registro inicial, desde donde se mostraran los registros y su valor es asignado a la variable $inicio
 * $inicio es el numero de registro inicial, desde donde se mostraran los registros
 * $datos almacena un array con los post o noticias
 * $c esa variable se refiere a la categoria
 * */
require 'includes/constantes.inc.php';
include_once 'class/class.php';
include_once 'class/fechas.class.php';
$objTrabajo = new Trabajo();
$categorias = $objTrabajo->get_categorias();

?>
<meta charset= "utf-8">
<title>Blog</title>
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
<?php
/*isset evitara que se genere un error al no existir un valor para
$inicio
Este condicional sirve para la paginacion de los post.
Si no se indica la variable pos, entonces mostrara desde el primer 
registro disponible, esto esta indicado por la variable $inicio
*/
	if (isset($_GET["pos"])) {
	//la variable pos se refiere a la posicion
	//si existe la variable pos entonces
		$inicio = $_GET["pos"];
	} else {
	//si no existe la variable la paginacion comenzara de 0
		$inicio = 0;
	}
/*Este condicional maneja o convina esta muestra de post 
 * de acuerdo a la categoria que se haya seleccionado*/
	if (isset($_GET["cat"])) {
		/*la variable pos se refiere a la categoria elegida*/
		$c = $_GET["cat"];
	} else {
		/*si no se ha seleccionado ninguna categoria, puedo indicar 
		 * en esta parte, la categoria que quiero que se muestre
		 * por defecto, asignandole el valor a la variable $c. Y va
		 * a ser esta la categoria que se mostrara por defecto 
		 * en el index*/
		$c = 1;
	}		
	/*esta consulta siempre me almacenara 10 registros iniciando en el registro $inicio
	 * , se almacenan solo 10 registros puesto que es lo que se determina en 
	 * la consulta sql mediante el comando limit 10 en el segundo parametro*/

	/*
		$nroPost cantidad de post que se mostraran por pagina
	*/
	$nroPost = 3;
	$datos = $objTrabajo->get_paginacion_noticias($inicio, $c, $nroPost);
if (count($datos) == 0) {
		if ($inicio != 0) {
			/*si $inicio viene con un valor distinto de 0, significa que
			* al venir $_GET["pos"](la que se le asigna a $inicio)
			* venia con un valor distinto de 0 y por lo tanto
			* habia encontrado post
			* asi que en vez de mostrar el mensaje 
			* print "<p>No hay post asociados a esta categoria</p>";
			* es mas entendible colocar este if que adiciona el 
			* mensaje
			* print "<p>No hay mas post</p>";;
			*/
			print "<p>No hay mas post</p>";;
		} else {
			print "<p>No hay post asociados a esta categoria</p>";
		}
} else {	
	//volcara los post
	for ($i=0;$i<sizeof($datos);$i++) {
?>
  	<div class="post">
  		<div class="postSup">
  			<div class="introImg">
  				<img src="ima/noticias-1.jpg" alt="" width="200" height="130" />
  			</div>
  			<div class="introText">
  				<div class="postTitle">
  					<h2><?= $datos[$i]["titulo"]?></h2>
  				</div>
  				<div class="postDate">
  					<span><?php echo Fechas::diaLetra($datos[$i]["diatexto"])." ".Fechas::invierteFecha($datos[$i]["fecha"]) ?></span>
  				</div>
  				<div class="postCategory">
		  			<?php 
		  				$categoriaElegida = $objTrabajo->categoryChosen($datos[$i]["id_categoria"])
		  			?>
		  			<span><?=$categoriaElegida[0]["categoria"];?></span>
  				</div>
  				<div class="postDetail">
  					<p><?php  echo Trabajo::corta_palabra($datos[$i]["detalle"], 400);?>   						
  					</p>
  				</div>  				  				  				
  			</div>
  		</div>
  		<div class="postInf">
<?php
$texto=str_replace(" ","-",$datos[$i]["titulo"]);
//echo $texto;
?>    		
  			<a href="<?php echo $texto."-p".$datos[$i]["id_noticia"].".html"?>">
  				<span class="postMore">
  					Leer mas...
  				</span>
  			</a>
  			<div id="comentarios">Hay <?php echo $objTrabajo->total_comentarios($datos[$i]["id_noticia"]); ?> comentarios</div>
  		</div>
  	</div>
<?php
	}
	//fin del volcamiento de posts
}	
?>
	</div>
	<!-- End Left Column -->
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
					<li><a href="?cat=<?=$categorias[$i]["id_categoria"];?>"><span><?php print $categorias[$i]["categoria"]; ?></span></a></li>
<?php 
				}
?>					
				</ul>
			</div>			
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
	$anterior = $inicio - $nroPost;
?>
				<a href="?pos=<?=$anterior ?>&cat=<?=$c ?>" title="Anterior" ><span>Anterior</span></a>
<?php 					
}
?>				
					
| 
<?php 
if (count($datos) == $nroPost) {
	//es lo mismo que anterior pero este va aumentando 
	//el numero de post a partir del cual se muestra
	//en el caso de que hayan menos de 10 registros
	//no se mostrara linkeado el texto "Siguiente"
	$proximo = $inicio + $nroPost;
?>
				<a href="?pos=<?= $proximo?>&cat=<?=$c?>" title="Siguiente">Siguiente</a>
<?php	
} else {
/*cuando count($datos) vale distinto de 10, en este caso sera un numero menor que 10
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
