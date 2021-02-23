<?php
class DBImagen
{

	public $DBConexion;

	function __construct($Conexion)
	{
		$this->DBConexion = $Conexion;
	}

	/**********************************
	Función para guardar la ruta de la
	   Imagen en la base de datos
	**********************************/
	public function uploadImage()
	{
		
	}


	/**********************************
	Función visualizar las imagenes 
	que estan en la ruta guardada en la 
	BD
	**********************************/
	public function viewImages()
	{
		$SQLStatement = $this->DBConexion->prepare("SELECT * FROM noticias");
		$SQLStatement->execute();

		while($img = $SQLStatement->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<tr>
			<td><?php print($img['id']);?></td>
			<td><center><img src="<?php print($img['img']); ?>" width="200"></center></td>
		</tr>
		<?php 
		}
	}

}
?>