<?
require("gov2model.php");
$gov2=new gov2model;
$gov2->authorize("member");
if (!$gov2->error) {
	echo "Selamat datang ".$_SESSION['fullname'];
} else {
	echo $gov2->error;
}
?>
