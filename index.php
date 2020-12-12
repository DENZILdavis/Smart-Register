<?php
	//setting default time
	date_default_timezone_set("Asia/Kolkata");
?>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$usernameerr=$passworderr="";
$username=trim($_POST["username"]);
$password=trim($_POST["password"]);

$cookiename="user";

$link = mysqli_connect("servername", "username", "password", "dbname");
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

	

	if(isset($_POST["subin"])){
	 	
	if(isset($_COOKIE[$cookiename])){
	$c="ALREADY LOGGED IN...PLEASE LOGOUT";
	}
	else{
		if(empty($usernameerr) && empty($passworderr)){
	
	$ip=$_POST["text"];

	//checking wheather the user is student (only INTEGERS)
	if(filter_var($username,FILTER_VALIDATE_INT)){
	//checking whather he is logged out
								

	
        // Prepare a select statement
		$date=date("Y-m-d");
                                                            
		 $time=date("H:i:s"); 
		 $cookiename="user";
		 setcookie($cookiename,$username,time()+(86400*2), "/");
		$stmt=$link->prepare("INSERT INTO register (username,ip,timein,datein) VALUES (?,?,?,?)");
			 
		$stmt->bind_param("ssss",$username,$ip,$time,$date);
        $stmt->execute();//attempt to execute
					              			
                                                         
	 
      	$c="SUCCESSFULLY LOGGED IN"   ;


		}


			else {
									setcookie("facultyname",$username,time()+(86400*2),"/");
		$link->close();
		header("location: out.php");
		exit;
}
}
else{
$usernameerr=" please enter a username";
}
if(!(empty($usernameerr))){
	echo $usernameerr;
}}}
if(isset($_POST["subout"]))
{
if(!(isset($_COOKIE[$cookiename]))){
$c="please login first";
}
elseif($_COOKIE["user"]!=$_POST["username"]){
$c=" This username was not logged in!! ";}
else{
$timeout=date("H:i:s");

$stmt=$link->prepare("UPDATE register SET timeout=?,STATUS=? WHERE username=? AND timeout IS NULL");
$denzil=$_COOKIE["user"];
$blank=" ";
$stmt->bind_param("sss",$timeout,$blank,$denzil);
$stmt->execute();

setcookie("user","",time()-3600);
$c="SUCCESSFULLY LOGGED OUT....THANK YOU";

}
}
$link->close();}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" name="viewport" content="width=device-width,initial-scale=1.0">
<style>


 h2{color:font-size:22px;color:green;}



 </style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->

<script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> 
	</script> 

	<script> 
		
		// in order to retrieve the IP address 

		$.get("https://ipinfo.io", function(response) { 
			
document.getElementById("list").value=response.ip;
		}, "json") 

		// "json" shows that data will be fetched in json format 
	</script> 
	


  


<body>
<center>
<div class="container center_div">
<img src="logo.jpg" class="img-rounded" alt="Cinque Terre" width="304" height="236"> 

<h4 style="color:green;">SMART REGISTER</h4>
<h2 style="font-face:verdana;">SAHRDAYA INTERNET PORTAL  </h2>
<h3 style="color:blue;text-align:center;">This is a heading</h3>
 <div class="col-xs-6">
<div class="form-group">
	<div class="col-md-8 col-md-offset-8">

	<table border=0>
		<form name="frm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
			<div class="input-group">
				<tr>
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input class="form-control" id="asd" type="text" name="username" placeholder="username" value="<?php echo $_POST["username"];?>" required ><br></tr>

			</div>
 		<div class="input-group">
<tr>
	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input class="form-control" type="password" name="password" placeholder="password" ></tr></div>
<tr><br><input class="form-control" type="text" name="text" id="list" readonly><br>
<br></tr>

 
<tr><input type="submit" name="subin" value="login "class="btn btn-success">

<td></td><td></td><td></td><td></td>
<input type="submit" name="subout" value="logout" class="btn btn-danger" > </tr><br>


<tr></tr><h5 style="color:green;"><?php
echo $c;
?></h5>
							</center>
						</div>
			 		</div>
			 	</div>
			</table>

		</form>
	</body>
</html>		
