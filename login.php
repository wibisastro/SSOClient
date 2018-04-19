<?
/********************************************************************
*	Date		: 18 Apr 2018
*	Author		: Wibisono Sastrodiwiryo
*	Email		: wibi@cybergl.co.id
*	Copyright	: Cyber GovLabs. All rights reserved.
*********************************************************************/
require("gov2model.php");
$gov2=new gov2model;
$gov2->authorize("guest");

switch($_GET["cmd"]) {
    case "fbconnect":
        $pagetitle="Gov 2.0 Facebook Connect";
        $view="fbconnect";
    break;
    case "activate":
        $pagetitle="Gov 2.0 Activation";
        $view="activate";
    break;
    case "signup":
        $pagetitle="Gov 2.0 Registration";
        $view="signup";
    break;
    default:
        if ($gov2->error) {$pagetitle="Gov 2.0 Login";}
        else {$pagetitle="Gov 2.0 Profile";}
}
?>

<h1><a href="index.php"><?echo $pagetitle;?></a></h1>

<?include("gov2view.php");?>