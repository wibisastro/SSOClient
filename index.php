<?
require("gov2model.php");
$gov2=new gov2model;
$gov2->authorize("public");
?>

<h1>Gov 2.0 SSO Client</h1>

<div>
      <ul>
          <?if ($_SESSION["account_id"]){?>
			<li><a href="login.php"><?echo $_SESSION["fullname"];?></a></li>
			<li><a href="gov2login.php?cmd=logout">Logout</a></li>
          <?} else {?>
			<li><a href="login.php">Login</a></li>
			<li><a href="login.php?cmd=signup">Signup</a></li>
          <?}?>
		  <li><a href="member.php">Member Page</a></li>
		  <li><a href="guest.php">Guest Page</a></li>
      </ul>
</div>