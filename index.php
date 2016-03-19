</p>
<?php
require("dbconn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Email</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">

<script type="text/javascript" src="jquery.js"></script>
 

<body style="text-align: center;">
<?php // for unique code
$result2 = mysql_query("SELECT DISTINCT `unique` FROM `my_hobbies` ORDER BY `id` DESC LIMIT 1");
$count2 = mysql_num_rows($result2);	
while($row2 = mysql_fetch_array($result2))
{
	$id2 = $row2['unique'];
	$invono=$id2+1; 	   
}
?>

<?php
if (isset($_POST['submit_val'])) {
if ($_POST['dynfields']) {
foreach ( $_POST['dynfields'] as $key=>$value ) {
$un=uniqid();
$values = mysql_real_escape_string($value);
$mysql_get_users = mysql_query("SELECT * FROM my_hobbies where hobbies='$values'",  $connection);
$get_rows = mysql_affected_rows($connection);
			if($get_rows >=1){
			echo "user exists";
			die();
			}
				else{ 
$query = mysql_query("INSERT INTO my_hobbies VALUES ('','$values','$un')", $connection );
   	} 
}
}
 echo "<i><h2><strong>" . count($_POST['dynfields']) . "</strong> Successfully Submitted</h2></i>";
 mysql_close();
 }

?>
<?php if (!isset($_POST['submit_val'])) { ?>
 <h1>Add your Email</h1>
 
<!-----------------------------------new-->
</br>
<form name="codexworld_frm" action="" method="post">
<div class="field_wrapper">
	<div>
    	 
        <a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png"/></a>
    </div>
</div>
</br>
<input type="submit" name="submit_val" value="SUBMIT"/>
</form>

 
<?php } ?>
 
<script src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var maxField = 5; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	var fieldHTML = '<div><input type="email" name="dynfields[]" value="" placeholder="Please enter email id" required/><input type="hidden" name="unique" value="$invono"><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
	var x = 0; //Initial field counter is 1
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
		}
		else
		{
			 alert("You have reached the limit of adding " + maxField + " inputs");
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
</script>

<script>

    var counter = 1;

    var limit = 3;

    function addInput(divName){

         if (counter == limit)  {

              alert("You have reached the limit of adding " + counter + " inputs");

         }

         else {

              var newdiv = document.createElement('div');

              newdiv.innerHTML = "Entry " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";

              document.getElementById(divName).appendChild(newdiv);

              counter++;

         }

    }

</script>

</body>
</html>
