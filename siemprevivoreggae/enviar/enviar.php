<?php
//Almacenando los valores recibidos

$valida_archivos = false;
$artista = $_POST['artista'];
$sAsunto = "Inscripcion Banda: ".$artista;
$link = $_POST['link'];
$ciudad = $_POST['ciudad'];
$contacto = $_POST['contacto'];
$representante = $_POST['representante'];
$mensaje = $_POST['mensaje'];
$sPara   = "contacto@siemprevivoreggae.cl, desensign@siemprevivoreggae.cl";//
$sDe     = "concurso@siemprevivoreggae.cl";
$sTexto = "";

$bHayFicheros = 0;
$sCabeceraTexto = "";
$sAdjuntos = "";

if ($sDe)$sCabeceras = "From:".$sDe."\n";
else $sCabeceras = "";
$sCabeceras .= "MIME-version: 1.0\n";

$sTexto .= "

------------------------------------------------------------
Concurso de bandas Siempre Vivo 2014
------------------------------------------------------------
\n\n"."

Artista: ".$artista."\n\n"."
Link cancion: ".$link."\n\n"."
Ciudad: ".$ciudad."\n\n"."
Email de contacto: ".$contacto."\n\n"."
Representante: ".$representante."\n\n"."
Informacion adicional: ".$mensaje." ";


if ($bHayFicheros == 0)
{
$bHayFicheros = 1;
$sCabeceras .= "Content-type: multipart/mixed;";
$sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";

$sCabeceraTexto = "----_Separador-de-mensajes_--\n";
$sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n";
$sCabeceraTexto .= "Content-transfer-encoding: 8BIT\n";

$sTexto = $sCabeceraTexto.$sTexto;
}
//$tamano_foto = $_FILES['adjunto']['size']/1024;//size in KBs
//$tamano_cancion = $_FILES['cancion']['size']/1024;//size in KBs
if ($_FILES['adjunto']['size'] > 0 /* && $_FILES['cancion']['size'] > 0 */)	
{
$valida_archivos = true;

/*$sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n";
$sAdjuntos .= "Content-type: ".$_FILES['cancion']['type'].";name=\"".$_FILES['cancion']['name']."\"\n";;
$sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
$sAdjuntos .= "Content-disposition: attachment;filename=\"".$_FILES['cancion']['name']."\"\n\n";

$oFichero = fopen($_FILES['cancion']["tmp_name"], 'r');
$sContenido = fread($oFichero, filesize($_FILES['cancion']["tmp_name"]));
$sAdjuntos .= chunk_split(base64_encode($sContenido));
fclose($oFichero);
*/
$sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n";
$sAdjuntos .= "Content-type: ".$_FILES['adjunto']['type'].";name=\"".$_FILES['adjunto']['name']."\"\n";;
$sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
$sAdjuntos .= "Content-disposition: attachment;filename=\"".$_FILES['adjunto']['name']."\"\n\n";

$oFichero = fopen($_FILES['adjunto']["tmp_name"], 'r');
$sContenido = fread($oFichero, filesize($_FILES['adjunto']["tmp_name"]));
$sAdjuntos .= chunk_split(base64_encode($sContenido));
fclose($oFichero);
}

if ($bHayFicheros)
$sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n";


$conf_cabecera = "From:".$sDe."\n";
$conf_cabecera .= "MIME-version: 1.0\n";
$conf_msje = "
------------------------------------------------------------
Concurso de bandas Siempre Vivo 2014
------------------------------------------------------------
\n\n
Felicitaciones ".$artista.", ya están inscritos en nuestro concurso! Atentos a nuestras redes para ver la lista de las bandas seleccionadas.
La lista de seleccionados se publicarán el día 28 de abril. 
\n\n
www.siemprevivoreggae.cl
\n
www.facebook.com/svrgoodvibes";

//if($valida_archivos){
@mail($sPara, $sAsunto,$sTexto, $sCabeceras) or die("Desafortunadamente, una falla en el servidor impide el envio de tu inscripcion.");
	//if (mail($sPara, $sAsunto,$sTexto, $sCabeceras) ) {
	//		?><p>TEST<?php
	//		echo "&estatus=ok&"; 
	//		?></p><?php
	//	} else { 
	////		echo "&estatus=error&"; 
		//	?></p><?php
		//}  
	//}	
@mail($contacto, "Confirmacion Concurso SVR",$conf_msje, $conf_cabecera); 

//}
 ?>