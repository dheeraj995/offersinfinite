<!DOCTYPE html>
<html>
<body>

<?php
$name = $email = $message = $contact = "";
$nameErr = $emailErr = $messageErr = $contactErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"] || $_POST["name"]==" ")) {
    $nameErr = "Name is required";
  } else {
    $name = form($_POST["name"]);
    // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
     $nameErr = "Only letters and white space allowed"; }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = form($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	 $emailErr = "Invalid email format"; }
  }

  if (empty($_POST["contact"])) {
    $contactErr = "Required";
  } else {
    $contact = form($_POST["contact"]);
  }
    
  if (empty($_POST["msg"])) {
    $message = "";
  } else {   
     $message = form($_POST["msg"]);
  } 
}

function form($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$to = "dheeraj@appanalytics.in";
$subject = "Contact Offers Infinite";
$mesag = "Hi, \n\r  My name is :". $name. "\n\r and You can Contact Me Through my email id i.e. :".$email." \n\r or by my Mobile Number or skype Id :".$contact." \n\r Query : ".$message ;
$headers = 'From: '.$email."\r\n";
$headers .= "To: ".$to."\n";
$headers .= "Organization: Offers Infinite \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

mail($to,$subject,$mesag,$headers, "-f dheeraj@appanalytics.in");
header('Location: index.html');
?>

</body>
</html>