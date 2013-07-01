<?php 
/*jagl
 * 
 * comence a hacer esta pero la sra kenya me encago otras pegas*/
require '../../includes/constantes.inc.php';
require '../../class/class.php';
require '../../class/administracion.class.php';

$sql="insert into empleados values(
	null,
	'".$_POST["titulo"]."',
	'".$_POST["fecha"]."',
	'".$_POST["categoria"]."',
	'".$_POST["url_img_intro"]."',
	'".$_POST["detalle"]."'								
	)";
mysql_query($sql);	
?>