<?php 
include_once '../../includes/constantes.inc.php';
include_once '../../class/class.php';

$sql="insert into ".TBLNOTICIAS." values(
	null,
	'".$_POST["titulo"]."',
	'".$_POST["detalle"]."',
	'',			
	'',
	'".$_POST["fecha"]."',
	'../images/blog/default.jpg',
	'',
	'".$_POST["categoria_asignada"]."'								
	)";
mysql_query($sql,Conectar::con()) or die(mysql_error());
echo '<script type="text/javascript">alert("Su articulo fue agregado con existo");</script>' ;
?>