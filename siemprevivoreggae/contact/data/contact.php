<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);
/*
 * SimpleModal Contact Form
 * http://simplemodal.com
 *
 * Copyright (c) 2013 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 */

date_default_timezone_set('America/Los_Angeles');

// User settings
$to = "desensign@siemprevivoreggae.cl";
$subject = "Concurso Siempre Vivo Reggae";

// Include extra form fields and/or submitter data?
// false = do not include
$extra = array(
	"form_subject"	=> true,
	"form_cc"		=> true,
	"ip"			=> true,
	"user_agent"	=> true
);

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "<div style='display:none'>
	<div class='contact-top'></div>
	<div class='contact-content'>
		<h1 class='contact-title'>Concurso SVR2013:</h1>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<form id='concurso' action='' method='post' enctype='multipart/form-data' style='display:none'>
			<label for='artist-name'>*Artista:</label>
			<input type='text' id='artist-name' class='contact-input' name='artist-name' tabindex='1001' />
			<label for='song'>*Canción (link soundcloud):</label>
			<input type='text' id='song' class='contact-input' name='song' tabindex='1002' />
			<label for='picture'>*Foto:</label>
			<input type='hidden' name='MAX_FILE_SIZE' value='1000000' />
			<input type='file' name='picture' id='picture' />
			<label for='city'>*Ciudad:</label>
			<input type='text' id='city' class='contact-input' name='city' tabindex='1004' />
			<label for='contact-email'>*Email contacto:</label>
			<input type='text' id='contact-email' class='contact-input' name='contact-email' tabindex='1005' />
			<label for='contact-name'>*Representante:</label>
			<input type='text' id='contact-name' class='contact-input' name='contact-name' tabindex='1006' />
			<br/>";

	


	$output .= "
			<label>&nbsp;</label>
			<button type='submit' class='contact-send contact-button' tabindex='1007'>Send</button>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1008'>Cancel</button>
			<br/>
			<input type='hidden' name='token' value='" . smcf_token($to) . "'/>
		</form>
	</div>
	<div class='contact-bottom'>siemprevivoreggae.cl</div>
</div>";

	echo $output;
	
}
else if ($action == "send") {

	// Send the email
	$artistname = isset($_POST["artist-name"]) ? $_POST["artist-name"] : "";
	$song = isset($_POST["song"]) ? $_POST["song"] : "";
	//$picture = isset($_POST["picture"]) ? $_POST["picture"] : $picture;
	$city = isset($_POST["city"]) ? $_POST["city"] : "";
	$contactemail = isset($_POST["contact-email"]) ? $_POST["contact-email"] : "";
	$contactename = isset($_POST["contact-name"]) ? $_POST["contact-name"] : "";
	$token = isset($_POST["token"]) ? $_POST["token"] : "";
	//echo "post: ".$picture['type']."\n\n";
	echo "files: ".$_FILES['picture']['name']."\n\n";
	echo "files tmp: ".$_FILES['picture']['tmp_name']."\n\n"; 
	echo "base: ".basename($_FILES['picture']['name'])."\n\n"; 
	print_r($_FILES);
	 

	// make sure the token matches
	if ($token === smcf_token($to)) {
		smcf_send($artistname, $song, $picture, $city, $contactemail, $contactename);
		echo "Your message was successfully sent.";
	}
	else {
		echo "Unfortunately, your message could not be verified.";
	}
}

function smcf_token($s) {
	return md5("smcf-" . $s . date("WY"));
}

// Validate and send email
function smcf_send($artistname, $song, $picture, $city, $contactemail, $contactename) {
	global $to, $extra;
	$subject = "Registro Concurso Siempre Vivo";
	$message = "";

	// Filter and validate fields
	$artistname = smcf_filter($artistname);
	$contactemail = smcf_filter($contactemail);
	$contactename = smcf_filter($contactename);
	if (!smcf_validate_email($contactemail)) {
		$subject .= " - invalid email";
		$message .= "\n\nBad email: $contactemail";
		$contactemail = $to;
		$cc = 0; // do not CC "sender"
	}

	//Get the uploaded file information
	//$name_of_uploaded_file = basename($_FILES['picture']['name']);
	$name_of_uploaded_file = $_FILES['picture']['name'];
	
	//get the file extension of the file
	$type_of_uploaded_file = substr($name_of_uploaded_file, strrpos($name_of_uploaded_file, '.') + 1);
 
	$size_of_uploaded_file = $_FILES['picture']['size']/1024;//size in KBs
	//echo "nombre: ".$name_of_uploaded_file."\n\n";
	//echo "tipo: ".$type_of_uploaded_file."\n\n";
	//echo "size: ".$size_of_uploaded_file."\n\n";

	//Settings
	$max_allowed_file_size = 1000; // size in KB
	$allowed_extensions = array("jpg", "jpeg", "gif", "bmp", "png");
	 
	//Validations
	if($size_of_uploaded_file > $max_allowed_file_size )
	{
	  $errors .= "\n Tamano del archivo debe ser menor a: $max_allowed_file_size KB";
	}
	 
	//------ Validate the file extension -----
	$allowed_ext = false;
	for($i=0; $i<sizeof($allowed_extensions); $i++)
	{
	  if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
	  {
	    $allowed_ext = true;
	  }
	}
	 
	if(!$allowed_ext)
	{
	  $errors .= "\n El formato del archivo no es valido. ".
	  " Solo estos formatos son validos: ".implode(',',$allowed_extensions);
	}

	if ($_FILES['picture']['error'] == UPLOAD_ERR_OK               //checks for errors
      && is_uploaded_file($_FILES['picture']['tmp_name'])) { //checks that file is uploaded
	  	$file = fopen($_FILES['picture']['tmp_name'],'rb');
		$data = fread($file,$size_of_uploaded_file);
		fclose($file);
	}

	




	// Add additional info to the message
	if ($extra["ip"]) {
		$message .= "\n\nIP: " . $_SERVER["REMOTE_ADDR"];
	}
	if ($extra["user_agent"]) {
		$message .= "\n\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
	}

	// Set and wordwrap message body
	$body = "From: $artistname\n\n";
	$body .= "Mensaje: $message\n\n";
	$body .= "Artista: $artistname\n\n";
	$body .= "Cancion: $song\n\n";
	$body .= "Ciudad: $city\n\n";
	$body .= "Email contacto: $contactemail\n\n";
	$body .= "Nombre contacto: $contactename\n\n";
	$body = wordwrap($body, 70);

	// Build header
	$headers = "From: $contactemail\n";
	if ($cc == 1) {
		$headers .= "Cc: pato.barrientos@gmail.com\n";
	}
	$headers .= "X-Mailer: PHP/SimpleModalContactForm";

	// UTF-8
	if (function_exists('mb_encode_mimeheader')) {
		$subject = mb_encode_mimeheader($subject, "UTF-8", "B", "\n");
	}
	else {
		// you need to enable mb_encode_mimeheader or risk 
		// getting emails that are not UTF-8 encoded
	}
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: multipart/mixed; charset=utf-8\n";
	$headers .= "Content-Transfer-Encoding: 8bit\n";
	$data = chunk_split(base64_encode($data));
	$body .= "Content-Type: {$type_of_uploaded_file};\n" .
			" name=\"{$name_of_uploaded_file}\"\n" .
			"Content-Transfer-Encoding: base64\n\n" .
			$data . "\n\n";


	// Send email
	@mail($to, $subject, $body, $headers) or 
		die("Unfortunately, a server issue prevented delivery of your message.");
}

// Remove any un-safe values to prevent email injection
function smcf_filter($value) {
	$pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
	$value = preg_replace($pattern, "", $value);
	return $value;
}

// Validate email address format in case client-side validation "fails"
function smcf_validate_email($email) {
	$at = strrpos($email, "@");

	// Make sure the at (@) sybmol exists and  
	// it is not the first or last character
	if ($at && ($at < 1 || ($at + 1) == strlen($email)))
		return false;

	// Make sure there aren't multiple periods together
	if (preg_match("/(\.{2,})/", $email))
		return false;

	// Break up the local and domain portions
	$local = substr($email, 0, $at);
	$domain = substr($email, $at + 1);


	// Check lengths
	$locLen = strlen($local);
	$domLen = strlen($domain);
	if ($locLen < 1 || $locLen > 64 || $domLen < 4 || $domLen > 255)
		return false;

	// Make sure local and domain don't start with or end with a period
	if (preg_match("/(^\.|\.$)/", $local) || preg_match("/(^\.|\.$)/", $domain))
		return false;

	// Check for quoted-string addresses
	// Since almost anything is allowed in a quoted-string address,
	// we're just going to let them go through
	if (!preg_match('/^"(.+)"$/', $local)) {
		// It's a dot-string address...check for valid characters
		if (!preg_match('/^[-a-zA-Z0-9!#$%*\/?|^{}`~&\'+=_\.]*$/', $local))
			return false;
	}

	// Make sure domain contains only valid characters and at least one period
	if (!preg_match("/^[-a-zA-Z0-9\.]*$/", $domain) || !strpos($domain, "."))
		return false;	

	return true;
}

exit;

?>