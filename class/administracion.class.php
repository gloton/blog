<?php
class administracion {
	private $noticias = array();
	public function getPost () {
		$query = "SELECT * FROM `jorgew7_blog`.`noticias`,`jorgew7_blog`.`categorias` WHERE `jorgew7_blog`.`noticias`.`id_categoria`=`jorgew7_blog`.`categorias`.`id_categoria`;";
		$respPost = mysql_query($query, Conectar::con());
		while ($filaPost = mysql_fetch_array($respPost)) {
			$this->noticias[] = $filaPost;
		}
		return $this->noticias;
	}
}
?>