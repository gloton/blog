<?php 
include_once '../../includes/constantes.inc.php';
include_once '../../class/class.php';
	
$sql = "DELETE FROM `".TBLNOTICIAS."` WHERE `id_noticia` = ".$_GET["id_noticia"]."";
mysql_query($sql,Conectar::con()) or die(mysql_error());	
?>