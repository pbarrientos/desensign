<?php

if( isset($_POST) ){

    //form validation vars
    $formok = true;
    $errors = array();
     
    //sumbission data
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $datetime = date('d/m/Y H:i:s');
     
    //form data
    $name = $_POST['name'];    
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    
    //validate email address is not empty
    if(empty($email)){
        $formok = false;
        $errors[] = "You have not entered an email address";
    //validate email address is valid
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $formok = false;
        $errors[] = "You have not entered a valid email address";
    }

    if($formok)
      {
      //connection to the database
      $dbhandle = mysqli_connect("avkriminaliseracannabis.se.mysql", "avkriminalisera", "Cannabis2014", "avkriminalisera") 
        or die("Unable to connect to MySQL");
      //$dbhandle = mysqli_connect("localhost", "root", "raices", "akc") 
      //  or die("Unable to connect to MySQL");
      $query = "SELECT * FROM people WHERE email='".$email."'";

      $result = mysqli_query($dbhandle, $query);
      if($result->num_rows != 0){
        $errors[] = "Email already exists";
        }
      else
      {
        $result->close(); //free resultset
        $query = "INSERT INTO people (
        name,
        lastname,
        email 
        ) values (
          '".$name."',
          '".$lastname."',
          '".$email."'
        )";
        $result = mysqli_query ($dbhandle, $query);
        
        if(!($result)){
          $errors[] = "Email could not be inserted."+"<p>Please try again or contact us at info@avkriminaliseracannabis.se</p>";
           mysqli_close($dbhandle);
        }
        else{
           echo "E-post sparad";
           $headers = "From: data@avkriminaliseracannabis.se" . "\r\n";
           $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
           $emailbody = "<p>You have recieved a new message from the enquiries form on your website.</p>
                          <p><strong>Name: </strong> {$name} </p>
                          <p><strong>Lastname: </strong> {$lastname} </p>
                          <p><strong>Email Address: </strong> {$email} </p>
                          <p>This message was sent from the IP Address: {$ipaddress} on {$datetime}</p>";

           mail("data@avkriminaliseracannabis.se","Form submitted from avkriminaliseracannabis.se",$emailbody,$headers);
           
        }
      }

      foreach($errors as $error) {
              echo $error;
            }
      mysqli_close($dbhandle);
    }
    else{//form no ok
      echo "Validation errors in the form"+"<p>Please try again or contact us at info@avkriminaliseracannabis.se</p>";
    }
}
?>  