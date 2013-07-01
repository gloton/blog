<?php 
require '../../includes/constantes.inc.php';
require '../../class/class.php';
require '../../class/administracion.class.php'; 
?>
<html lang="es">
<head>
<meta charset= "utf-8">
<title> Estructura Basica</title >
<script type="text/javascript">
	function eliminar(id) {
		if (confirm("realmente desea eliminar el registro ")) {
			window.location="eliminar.php?id_noticia="+id;
		}

	}
</script>       
</head>
<body>
<h1>Administración de los articulos</h1>
<?php

$objAdministracion = new administracion();
$noticias = $objAdministracion->getPost();
?>
<table style="width: 950; border-spacing: 0;border-collapse: 0;" border="1">
  <tr>
    <th scope="col">Titulo</th>
    <th scope="col">Categoria</th>
    <th scope="col">Fecha</th>
    <th scope="col">ID</th>
    <th scope="col">Editar</th>
    <th scope="col">Eliminar</th>
  </tr>
<?php
//var_dump($noticias);
foreach($noticias as $nroFila => $contenido){
	/* echo "<br />";
	echo $contenido["titulo"];      */
	if ($paridad == 0) {
		$paridad = 1;
	} else {
		$paridad = 0;
	}
	
	
?>

  <tr class="row<?=$paridad;?>">
    <td><?=$contenido["titulo"];?></td>
    <td><?=$contenido["categoria"];?></td>
    <td><?=$contenido["fecha"];?></td>
    <td><?=$contenido["id_noticia"];?></td>
    <td><a href="modificar.php?id=<?=$contenido["id_noticia"];?>"><img alt="agregar" src="../images/edit.png" /></a></td>
    <td><a href="#" onClick="eliminar(<?=$contenido["id_noticia"];?>);"><img alt="eliminar" src="../images/delete.png" /></a></td>
  </tr>

<?php 
} 

?>
</table>
</body>
</html>
