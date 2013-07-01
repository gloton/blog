<!DOCTYPE HTML>
<html lang= "es">
<head>
<?php 
/* $_GET["pos"] es la variable que indica el numero de registro inicial, desde donde se mostraran los registros y su valor es asignado a la variable $inicio
 * $inicio es el numero de registro inicial, desde donde se mostraran los registros
 * $getPost almacena un array con los post o noticias
 * $c esa variable se refiere a la categoria
 * */
include_once '../../includes/constantes.inc.php';
include_once '../../class/class.php';
$objTrabajo = new Trabajo();
$categorias = $objTrabajo->get_categorias();
$getPost = $objTrabajo->get_post_por_id();

?>
<meta charset= "utf-8">
<title><?php echo $getPost[0]["titulo"];?></title>
<link rel="stylesheet" type="text/css" href="../../css/reset.css" />
<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<link rel="stylesheet" href="../../js/jqueryui/css/jquery-ui.css" />
<script src="../../js/jquery/jquery-1.8.2.js"></script>
<script src="../../js/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="../../js/tiny_mce/tiny_mce.js"></script>
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
#leftcolumn div.post form div.fechaDetail {
	height: 40px;
}
html body div#wrapper div#leftcolumn div.post form div.fechaDetail input#editDate.hasDatepicker {
    display: block;
    float: left;
    margin: 5px 0 0;
}
#leftcolumn div.post form div.fechaDetail img.ui-datepicker-trigger {
	padding-top: 2px;
}
/*side right*/

</style>

<!-- inicio tinymce -->
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "textareas",
			theme : "advanced",
			width : "665",
			height : "300",
			plugins : "imgsurfer,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
	
			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "imgsurfer,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
	
			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",
	
			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
	
			// Style formats
			style_formats : [
				{title : 'Bold text', inline : 'b'},
				{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
				{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
				{title : 'Example 1', inline : 'span', classes : 'example1'},
				{title : 'Example 2', inline : 'span', classes : 'example2'},
				{title : 'Table styles'},
				{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
			],
	
			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	</script>
<!-- fin tinymce -->
<!-- inicio datePicker -->
	<script type="text/javascript">
	$(function() {
		$( "#editDate" ).datepicker({
			showOn: "button",
            buttonImage: "../images/calendario.png",
            buttonImageOnly: true,
			dateFormat: "yy-mm-dd",
			currentText: 'Hoy',
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			weekHeader: 'Sm'			
		});
	});
	</script>
<!-- fin datePicker -->
</head>
<body role="application">
<!-- Begin Wrapper -->
<div id="wrapper">
	<!-- Begin Left Column -->
	<div id="leftcolumn">
		<div class="post" style="background-color: red; height: auto;">
			<form name="frmEdit" action="processModificar.php" method="post">
				<!-- inicio detalle del post -->
				<h3><input name="editTitle" type="text" value="<?php echo $getPost[0]["titulo"];?>" style="width: 664px;" /></h3>
				<div class="fechaDetail">
					<input name="editDate" id="editDate" type="text" value="<?php echo $getPost[0]["fecha"];?>"/>
				</div>
				<div class="detailPost">
					<textarea name="editAreaDetalle" rows="500" cols="30">
						<?php echo $getPost[0]["detalle"];?>
					</textarea>
				</div>
				<div class="categoria">
					<?php 
					//consulta la tabla categorias
					$categoriaElegida = $objTrabajo->categoryChosen($getPost[0]["id_categoria"]);
					$lista_categorias = $objTrabajo->get_categorias();
					//echo  print_r($categoriaElegida);
					//Array ( [0] => Array ( [categoria] => MySql ) ) 1
					//echo $categoriaElegida[0]["categoria"];
					//echo $categoriaElegida[0]["id_categoria"];
					?>
					<!-- inicio mostrar categoria dinamicamente -->
					<?php 
					$sql_categorias = "SELECT * FROM supervisores";
					$result_supervisores = mysql_query($sql_supervisores, Conectar::con());
					?>  
					<label>Categoria Asignada : </label>
					<select name="categoria_asignada">
					<?php 
					foreach($lista_categorias as $llave => $valor){
					?>
						<option value="<?=$valor['id_categoria'];?>" <?php if ($valor['id_categoria']==$categoriaElegida[0]["id_categoria"]) echo "selected";?>><?=$valor['categoria'];?></option>
					<?php 
					}
					?>		
					</select>
					<!-- inicio mostrar categoria dinamicamente -->					  				
				</div>
				<input name="editId" type="hidden" value="<?=$_GET["id"];?>" />
				<input type="submit" value="enviar" />
			</form>
			<div class="clearfix"></div>
			<!-- fin detalle del post -->
		</div>
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
		
	</div>
</div><!-- End Wrapper -->
</body>
</html>