<?php
//require_once "sanitizing_html.php";
if (isset($_POST['bouton'])){

/*$html_string = "<div style=\"color: red; font-size: 30px;\">" . 
	"This <strong>string</strong> contains text & " .
	"<span style=\"color: green;\">HTML</span>.".
	"</div>".
	"<br />";

$javascript_string = "<script>alert('Gotcha!');</script>";*/


// METHODS to protect netoyage de donnees
 //htmlspecialchars($html_string)
 //echo htmlentities($html_string);
 //echo strip_tags($html_string);


//1. unsafe and diclanch with js (the code can be fullfilled)
//echo $_POST['username'];
//echo $_POST['password'];

//2. forbids special chars pour remplir
//echo htmlspecialchars($_POST['username']);
//echo htmlspecialchars($_POST['password']);

//3. forbids special chars pour remplir
//echo htmlentities($_POST['username']);
//echo htmlentities($_POST['password']);


//4. forbids special chars pour stocker
echo strip_tags($_POST['username']);
echo strip_tags($_POST['password']);

?>
<form method="POST" action=''>
	name <input type="text" name="username" />
	password<input type="text" name="password"/>
	age<input type="text" name="age" />
	salaire<input type="text" name="salaire"/>
	<input type="submit" value="envoyer" name="bouton">
</form>
