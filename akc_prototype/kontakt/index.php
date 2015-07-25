<!DOCTYPE html">
<html lang="sv">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Avkriminalisera Cannabis - Kontakt</title>

	<style type="text/css">
	body{
		background: #a3c241;
	}
	#logotype{
		text-align: center;
	}
	#sendEmail{
		font:normal 1em Tahoma, Geneva, sans-serif;
		color:#FFF;
		width: 90%;
		min-width: 300px;
		padding:5px;
		margin:0 auto;
	}
	#emailForm{
		background: #566723;
		padding: 10px;
		border-radius: 10px;
		color: #a3c241;
	}
	fieldset {
		border: 0;
		margin: 0;
		padding: 0;
	}
	input[type=text], textarea {
		width: 96%;
		border-radius: 5px;
		border: none;
		line-height: 1.5em;
		padding: 4px;
		margin-top: 6px;
		margin-bottom: 16px;
	}
	
	#sendEmail a{
		text-decoration: none;
		color: white;
	}
	#sendEmail a:hover{
		text-decoration: underline;
	}
	#sendEmail h2{
		font: 1.5em Helvetica, Helvetica Neue, Arial;
		font-family: 'Lato', sans-serif;
		text-align: center;
	}
	#sendEmail label{
		display: inline-block;
	}
	#sendEmail .row label{
		display: inline-block;
	}

	#sendEmail  .button{
		border-radius: 5px;
		border: none;
		color: white;
		background: #a3c241;
		padding: 10px;
		cursor:pointer;
		margin: 0 auto;
		margin-top:20px;
		display: block;
	}
	#loading{
		display:none;
		text-align:center;
		margin:6px 0;
		padding:5px 0;
	}
	#loading a{
		color: #566723;
	}
	input, textarea{
		font:normal 1em Tahoma, Geneva, sans-serif;
		color:#000;
	}
	</style>
</head>

<body>
	<div id="logotype" style="margin:0 auto;float: none;">
		<img src="../img/avkrim_pin.jpg" alt="Avkriminalisera Cannabis logo">
	</div>

	<div id="sendEmail">
		<h2>Kontakta Avkriminalisera Cannabis</h2>
		<br>
		<form name="emailForm" id="emailForm" method="POST" action="send.php" enctype="multipart/form-data">
			<fieldset>
				<div class="row">
					<label>Namn(*):</label>
					<input type="text" name="name" id="name"/>
				</div>
				<div class="row">
					<label>Email(*):</label>
					<input type="text" name="email" id="email" />
				</div>
				<div class="row">
					<label>Ämne(*):</label>
					<input type="text" name="subject" id="subject" />
				</div>
				<div class="row">
					<label>Meddelande:</label>
					<textarea  name="message" id="message"></textarea>
				</div>
				<div>(*) Obligatoriska fälten.</div>
			</fieldset>
			<div><input type="submit" value="Skicka" class="button"></div>

		</form>
		<div id="loading">laddas...</div>

	</div>

	<script type="text/javascript" src="../js/vendor/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="jquery.form.js"></script>
	<script type="text/javascript">

	$(document).ready(function(){
		
		$('#emailForm').ajaxForm({
			beforeSubmit: validate,
			success: function(data, statusText, xhr, form) {
				alert("Formuläret skickat, vi kommer att kontakta dig inom kort.");
				$('#loading').hide();
				$("#name").val("");
				$("#email").val("");
				$("#subject").val("");
				$("#message").val("");
				$('#emailForm').html('<div style="text-align:center;">Formuläret skickat.<br/><a href="#" onClick="window.close()">||| Stäng fönstret |||</a></div>');
			}
		});
		
		function validate(formData, jqForm, options) {
			var form = jqForm[0]; 
			if(form.name.value == ""){
				alert("Fyll i ditt namn.");
				form.name.focus();
				return false;
			}else if(form.email.value == ""){
				alert("Fyll i din email.");
				form.email.focus();
				return false;
			}else if(form.subject.value == ""){
				alert("Fyll i ett ämne.");
				form.subject.focus();
				return false;
			}else if(form.message.value == ""){
				alert("Skriv in ditt meddelande");
				form.message.focus();
				return false;
			}
			$('#loading').html('Formuläret skickas...').show();
		}
	});

</script>
</body>
</html>