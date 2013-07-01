<!DOCTYPE HTML>
<html lang= "es">
<head>
<?php 
include_once '../../includes/constantes.inc.php';
include_once '../../class/class.php';
$objTrabajo = new Trabajo();
?>
<meta charset= "utf-8">
<title>Agregar Articulo</title>
<link rel="stylesheet" type="text/css" href="../../css/reset.css" />
<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<link rel="stylesheet" href="../../js/jqueryui/css/jquery-ui.css" />

<script src="../../js/jquery/jquery-1.8.2.js"></script>
<script src="../../js/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="../../js/tiny_mce/tiny_mce.js"></script>
<!-- inicio codigo personalizado de tinymce para plataformagroup -->
<script type="text/javascript" src="../../js/tiny_mce/tiny_mce_plg.js"></script>
<!-- fin codigo personalizado de tinymce para plataformagroup -->

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


<!-- inicio datePicker -->
	<script type="text/javascript">
	$(function() {
		$( "#fecha" ).datepicker({
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
			<form name="frmEdit" action="processAgregar.php" method="post">
				<!-- inicio detalle del post -->
				<h3><input name="titulo" type="text" value="" style="width: 664px;" /></h3>
				<div class="fechaDetail">
					<input name="fecha" id="fecha" type="text" value=""/>
				</div>
				<div class="detailPost">
					<textarea name="detalle" rows="500" cols="30">
					</textarea>
				</div>
				<div class="categoria">
					<?php 
					//consulta la tabla categorias
					$lista_categorias = $objTrabajo->get_categorias();
					//echo  print_r($categoriaElegida);
					//Array ( [0] => Array ( [categoria] => MySql ) ) 1
					//echo $categoriaElegida[0]["categoria"];
					//echo $categoriaElegida[0]["id_categoria"];
					?>
					<!-- inicio mostrar categoria dinamicamente -->
					<label>Categoria Asignada : </label>
					<select name="categoria_asignada">
					<?php 
					foreach($lista_categorias as $llave => $valor){
					?>
						<option value="<?=$valor['id_categoria'];?>"><?=$valor['categoria'];?></option>
					<?php 
					}
					?>		
					</select>
					<!-- inicio mostrar categoria dinamicamente -->					  				
				</div>
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