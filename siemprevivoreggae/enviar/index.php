<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Siemprevivoreggae.cl - Inscripcion de bandas.</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styles.css">

<script type="text/javascript">
	$(document).ready(function(){
		$('#emailForm').ajaxForm({
			beforeSubmit: validate,
			success: function(data, statusText, xhr, form) {
				$('#loading').html('Tu inscripcion se envio correctamente');
				alert("Tu inscripcion se envio correctamente");
				//$('#loading').hide();
				$("#artista").val("");
				$("#link").val("");
				$("#ciudad").val("");
				$("#contacto").val("");
				$("#representante").val("");
				$("#adjunto").val("");
				$("#mensaje").val("");
				//$('#sendEmail').css('heigth':'200px');
				//$('#emailForm').css('display':'none');
				
				$('#loading').html('<a href="#" onClick="window.close()">||| Cerrar esta ventana |||</a>');
				$('#loading').show();
			}
		});
		
		function validate(formData, jqForm, options) {
			var form = jqForm[0]; 
			if(form.artista.value == ""){
				alert("Ingrese nombre de artista");
				form.artista.focus();
				return false;
			}else if(form.link.value == ""){
				alert("Ingrese link de Youtube o Soundcloud");
				return false;
			}else if(form.ciudad.value == ""){
				alert("Ingrese ciudad");
				form.ciudad.focus();
				return false;
			}else if(form.contacto.value == ""){
				alert("Ingrese email de contacto");
				form.contacto.focus();
				return false;
			}else if(form.representante.value == ""){
				alert("Ingrese nombre de representante");
				form.representante.focus();
				return false;
			}
			else if(form.adjunto.value == ""){
				alert("Ingrese foto");
				return false;
			}
			else if(!form.reglas.checked){
				alert("Debes aceptar las bases del concurso");
				return false;
			}
			$('#loading').html('Enviando...').show();
		}
	});
	
</script>
<style type="text/css">
	body{
		background: black
	}
	#sendEmail{
		font:normal 1em Tahoma, Geneva, sans-serif;
		color:#FFF;
		border:1px solid #999;
		width: 90%;
		min-width: 300px;
		padding:5px;
		margin:0 auto;
	}
	#sendEmail #bases{
		font-size: 1em;
		display: block;
		min-height: 48px;
	}
	#sendEmail #bases a, #sendEmail #acepto a{
		text-decoration: none;
		color: white;
		min-height: 48px;
		display: block;
	}
	#sendEmail a:hover{
		text-decoration: underline;
	}
	#sendEmail #acepto{
		font-size: 1em;
		display: block;
		min-height: 48px;
	}
	#sendEmail #acepto input{
		min-height: 48px;
	}
	#sendEmail legend{
		color:#09F;
		font-size:1em;
	}
	#sendEmail label{
		width:30%;
		float:left;
		text-align:left;
	}
	#sendEmail input{
		width: 100%;
	}
	#sendEmail .row{
		overflow:hidden;
		margin:6px 0;
	}
	#sendEmail  .button{
		background:#09F;
		color:#FFF;
		width:30%;
		padding:5px 0;
		margin-top:20px;
		cursor:pointer;
	}
	#loading{
		background:#F5F5F5;
		color: #09F;
		border-top:1px solid #F3F3F3;
		border-bottom:1px solid #F3F3F3;
		display:none;
		text-align:center;
		margin:6px 0;
		padding:5px 0;

	}
	input, textarea{
		font:normal 1em Tahoma, Geneva, sans-serif;
		color:#000;
	}
	
</style>
</head>

<body>
	<div id="logotype" style="margin:0 auto;float: none;">
		<img src="../img/logos/logo2014.png" alt="Siempre Vivo Reggae logo" width="200" height="152">
	</div>

<fieldset id="sendEmail">
	<legend>Concurso Siempre Vivo Reggae 2014</legend>
	<div id="bases"><a href="../docs/BASES-CONCURSO-SVR-2014.pdf">Descarga bases del concurso</a></div>
	<br>
	<form name="emailForm" id="emailForm" method="POST" action="enviar.php"  enctype="multipart/form-data">
        <div class="row"><label>Artista(*):</label> <input type="text" name="artista" id="artista"/></div>
        <div class="row"><label>Link de Youtube o Soundcloud(*):</label> <input type="text" name="link" id="link" /></div>
        <div class="row"><label>Ciudad(*):</label> <input type="text" name="ciudad" id="ciudad" /></div>
        <div class="row"><label>Email de contacto(*):</label> <input type="text" name="contacto" id="contacto-" /></div>
        <div class="row"><label>Nombre del representante(*):</label> <input type="text" name="representante" id="representante" /></div>
        <div class="row"><label>Foto(*):</label><br>(Formato jpg, gif o png. Tamano maximo 1 MB) <input type="file" id="adjunto" name="adjunto"></div>
        <div class="row"><label>Información adicional:</label> <textarea  name="mensaje" id="mensaje" rows="7" cols="70"></textarea> </div>
        <div class="row" id="acepto"><input type="checkbox" name="reglas" value="reglas">Acepto las <a href="../docs/BASES-CONCURSO-SVR-2014.pdf" target="_blank" style="text-decoration:underline;">bases del concurso.</a>(*)</div>
        
        <div align="center"><input type="submit" value="Inscribir artista" class="button"></div>
        
    </form>
      <div id="loading"></div>

</fieldset>
</body>
</html>