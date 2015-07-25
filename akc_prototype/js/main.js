function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

$(function() {
	$('#shop').click(function (event) {
    event.preventDefault();
   	confirm("Webbshop kommer snart!");
    });
    
  $('.error').hide();
  $(".button").click(function() {
    // validate and process form here
    
    $('.error').hide();
    var name = $("input#name").val();
    var lastname = $("input#lastname").val();
    var email = $("input#email").val();
    if (email === "" || !validateEmail(email) ) {
      $("#email_error").show();
      $("input#email").focus();
      return false;
    }
     

    var dataString = 'name='+ name + '&lastname=' + lastname + '&email=' + email;
	//alert (dataString);return false;
	$.ajax({
	  type: "POST",
	  url: "php/akc_process_form.php",
	  data: dataString,
	  success: function(data, textStatus) {
	    $('.akc-form').html("<div id='message'></div>");
	    $('#message').html("<h3>Avkriminalisera cannabis har mottagit din förfrågan!</h3>")
	    .append("<p>Tack för ditt stöd.</br>"+data+"</p>")
	  },
	  error: function(e) {
		console.log(e);
		$('.akc-form').html("<div id='message'></div>");
	    $('#message').html("<h3>Error processing your form.</h3>")
	    .append("<p>Kontakt oss på info@avkriminaliseracannabis.se</p>")
	  }
	});
	return	 false;
  });

});

