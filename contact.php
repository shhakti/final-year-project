<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title> Contact Form </title>
</head>
<body> 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Php Login System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

      
     
    </ul>
  </div>
</nav>


	<div class="container">
		<?php 
	if(isset($_POST['submit_form']))
			{ 
          $name=$_POST['id']; 
       $email=$_POST['username']; 
        $msg=$_POST['msg']; 
          $phone=$_POST['phone']; 
           $FromName="Techno Smarter";
$FromEmail="info@yourdomain.com";
$ReplyTo=$email;
$toemail="technosmarterinfo@gmail.com";
$subject="Techno Smarter Contact form "; 
$message='Name:-'.$name.'<br>Email :-' .$email.'<br> Phone No:-'.$phone.'<br> Message:-'.$msg;
$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ".$FromName." <".$FromEmail.">\n";
$headers .= "Reply-To: ".$ReplyTo."\n";
$headers .= "X-Sender: <".$FromEmail.">\n";
$headers .= "X-Mailer: PHP\n";
$headers .= "X-Priority: 1\n";
$headers .= "Return-Path: <".$FromEmail.">\n";

	if(mail($toemail, $subject, $message, $headers,'-f'.$FromEmail) ){

        $hide=2;
         echo '<div class="success"><center><span style="font-size:100px;">&#9989;</span></center> <br> Thank you <strong>'.$name.',</strong> Your message has been sent. We will reply soon as possible. </div> '; 
	      
	} else {
		echo "The server failed to send the message. Please try again later or Make sure , you are using live server for email.";
} 
			}
		?>
		<?php if(!isset($hide)) { ?>
			<h2>Contact Us &#9971;</h2>
			
	<form action="" method="POST">
		<label> Name :-</label>
		<input type="text" name="id" class="form-control" required>

		<label>Email :-</label>
		<input type="email" name="username" class="form-control" required>

		<label>Phone Number :-</label>
		<input type="number" name="phone" class="form-control" required>

		<label> Message :-</label>
		<textarea name="msg" cols="10" rows="5"  class="form-control" required></textarea> 
		<input type="submit" name="submit_form" value="Send" class="btn-primary">
</form>
<?php }?> 
</div>
</body>
</html>
<style type="text/css">
		body{
background-color: #f1f1f1;
	}
		.form-control {
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    color: #555;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.btn-primary {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 400;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 4px; 
    background-color: #337ab7;
    color: #fff;
}
textarea.form-control {
    height: auto;
}
.container 
{ 
margin-left: 30%;
width: 400px ;
margin-top: 6%;
background-color: #fff;
padding: 30px;
padding-right: 60px;
box-shadow: 10px 5px 5px grey;
 }
label   {
	font-size: 18px;
}
.success 
{ 
	margin: 5px auto;
  border-radius: 5px;
  border: 3px solid #fff;
  background: #33CC00;
  color: #fff;
font-size: 20px;
  padding: 10px;
  box-shadow: 10px 5px 5px grey;
}
	</style>