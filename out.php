<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>span.result{color:green;}</style>
	</head>
<body bgcolor="yellow">




		<?php

		if(isset($_COOKIE["facultyname"])){
		
		$link = mysqli_connect("servername", "username", "password", "dbname");

		echo "<h3>Hi,";
		echo "  ";
		$name=$_COOKIE["facultyname"];
		echo $name."</h3>";
		$date=date("Y-m-d");



		?>
		<div class="text-center">
		<div class="container">
		<div class="form-group">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
					<input type="date" value="<?php echo $date;?>"  name="date"><select class="form-control" name="labselect" size=1>
		<option value="MAIN_BLOCK" selected="SELECTED">MAIN BLOCK</option>	
		<option value="DB_LAB_2">DB LAB 2</option>
	<option value="DB LAB_3">DB LAB 3</option>
					</select><br>
					<select class="form-control" name="timeselect" size="1" >
    <option value="120000" >LUNCH TIME</option>	
     <option value="090000">1ST HOUR</option>
	<option value="110000">3RD HOUR</option>
	<option value="130000">4TH HOUR</option>
	<option value="140000">5TH HOUR</option>
     <option value="000000">WHOLE DAY</option>
					</select><br>
	<input class="btn btn-info" type="submit" value="submit" name="submit" class=".btn-warning">
					</form></div><br>

		<?php	
		if($_POST["submit"]){
		$timeselected=(int)$_POST["timeselect"];
		if($timeselected==000000){
		$time2=230000;}
		elseif($timeselected!=000000){

		$time2=$timeselected+20000;}


		$datesel=(string)$_POST["date"];?>
		<h4 class="dispaly-3" style="color:#3ba197;">DATE SELECTED:
		<?php
		echo $datesel."</h4><br><br>";
		$datesel = preg_replace("/[^a-zA-Z0-9]/", "", $datesel);
				
		$result=mysqli_query($link,"SELECT * FROM register WHERE datein=$datesel  AND timein BETWEEN $timeselected AND $time2");	

				
		                
							
		//checking any results exists

		if (mysqli_num_rows($result)>0) {
		?>
		<table class=" table table-striped"><thead><tr><th>sr </th><th>username</th><th> I P </th><th>sys no </th><th>timein</th><th>timeout</th><th>STATUS</th></tr></thead><tbody>
		<?php
		$count=0;

			// output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		$count=$count+1;
		echo "<tr><td>" . $count. "</td><td>" . $row["username"]. "</td><td> " . $row["ip"]. "</td><td></td><td> ". $row["timein"]."</td><td>".$row["timeout"] . "</td><td>";
		?>
		<span class="result">
		<?php
		echo $row["STATUS"]."</span></td></tr>";
		    

		}
		echo "</tbody></table>";
		} else {
		    echo "<mark><h2>NO STUDENT HAS ENTERED!!</h2></mark>";}
		}
		}
		?>
		</div>
		<a href="index.php"> <input type="button" class="btn btn-danger" value="LOGOUT"></a>
		</div>
	</body>
</html>
<?php
	$link->close();			 
?>
