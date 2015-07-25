<?php
//Get values from form

$name = $_POST['name'];
$subject = $_POST['subject'];
//$phone = $_POST['phone'];
//$city = $_POST['city'];
$emailContact = $_POST['email'];
$message = $_POST['message'];
$to   = "pato.barrientos@gmail.com";//
$from     = "no-reply@savkriminaliseracannabis.se";
$text = "";

$sCabeceraTexto = "";
$sAdjuntos = "";

if ($from)$sCabeceras = "From:".$from."\n";
else $sCabeceras = "";
$sCabeceras .= "MIME-version: 1.0\n";

$text .= "

------------------------------------------------------------
Avkriminalisera Cannabis Kontakt Formulär
------------------------------------------------------------
\n\n"."

Name: ".$name."\n\n"."
Email-contact: ".$emailContact."\n\n"."
Message: ".$message;

$conf_cabecera = "From:".$from."\n";
$conf_cabecera .= "MIME-version: 1.0\n";
$conf_msje = "
------------------------------------------------------------
Avkriminalisera Cannabis Kontakt Formulär
------------------------------------------------------------
\n\n
Hej ".$name.", vi fick din förfrågan. Vi kommer att svara inom kort. Tack. 
\n\n
www.avkriminaliseracannabis.se";

//email to system
@mail($to, $subject,$text, $sCabeceras) or die("Unfortunatelly, a server error doesn't allow to send the form, try again later or write straight to info@avkriminaliseracannabis.se");

//email to client
@mail($emailContact, "Kontakt Avkriminaliser Cannabis",$conf_msje, $conf_cabecera); 

//}
 ?>