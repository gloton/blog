<?php
include_once '../../includes/constantes.inc.php';
include_once '../../class/class.php';

/*
Array
(
    [editTitle] => tincidunt neque inceptos 4
    [editDate] => 2012-10-01
    [editAreaDetalle] => <p><img style=\"float: right;\" src=\"../../../crud-wysiwyg/ima/ejecutivo1.jpg\" alt=\"\" border=\"0\" />Adipiscing mi gravida at platea hendrerit sem suscipit nam interdum venenatis inceptos donec potenti, porttitor felis nec primis urna vulputate aliquam mauris duis felis mi netus ultrices molestie elementum cubilia conubia sociosqu augue eu convallis curabitur velit, nullam phasellus ac sociosqu nunc eros eget cras feugiat, lobortis bibendum libero aliquam ante duis curabitur sodales hac euismod nullam pretium habitant per aliquet mattis nulla arcu aliquet duis mollis, dolor eget interdum scelerisque euismod tempus sollicitudin tincidunt sagittis justo turpis odio leo lacinia vitae praesent quam.</p>
    [editId] => 4
)
 
 */
$sql ="UPDATE `".TBLNOTICIAS."` SET 
		`titulo` = '".$_POST["editTitle"]."', 
		`fecha` = '".$_POST["editDate"]."', 
		`detalle` =  '".$_POST["editAreaDetalle"]."',
		`id_categoria` =  '".$_POST["categoria_asignada"]."'
		 WHERE `".TBLNOTICIAS."`.`id_noticia` =".$_POST["editId"].";";
//mysql_query($sql,Conectar::con()) or die(mysql_error());
if (!mysql_query($sql,Conectar::con())) {
	echo '<script type="text/javascript">alert("No se pudo modificar la noticia");</script>' ;;
} else {
	header('Location: http://jorge.w7.cl/blog/administracion/noticias');
}
?>