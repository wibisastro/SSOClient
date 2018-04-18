<?
/********************************************************************
*	Date		: 25 Mar 2015
*	Author		: Wibisono Sastrodiwiryo
*	Email		: wibi@alumni.ui.ac.id
*	Copyleft	: e-Gov Lab Univ of Indonesia 
*********************************************************************/


#------------------------configuration
while (list($key,$val)=each($_GET)) {
    $val=strip_tags($val);
    if (preg_match('/[^a-zA-Z0-9_.]/', $val)) {header("location: illegal.html");exit;} 
    else {$_GET[$key]=$val;}
}

$_GET['error']=isset($_GET['error']) ? $_GET['error'] : '';

switch ($_GET['error']) {
    case "all":error_reporting(E_ALL);break;
    case "warning":error_reporting(E_ALL & ~E_NOTICE);break;
    default:error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);break;
}

#-----instalation helper, must be shut off upon success
 	ini_set("display_errors", 1);
    session_start();

    define("GOV2XMLPATH",__DIR__."/xml/"); 
	#-ganti jika lokasinya dipindah. saran pindahkan ke luar web root

switch ($_SERVER["SERVER_NAME"]) {
	case "duknaker.dep.eplanning.id":
	case "masda.dep.eplanning.id":
		define("SSONODE","https://sso.gov2.web.id");
	break;
    case "kemenkeu.kl.krisna.systems":
    case "bappenas.kl.krisna.systems":
        define("SSONODE","https://sso.kl.krisna.systems");
	break;
    case "bella.jegeg.ngontel":
        define("SSONODE","http://sso.local.gov2.web.id");
	break;
	default:
		echo "UnRegisteredDomain";
		exit;
}

	define("SSOCONN","https://sso.gov2.web.id");
 
#------------------------model

class gov2model {
	function gov2model () {
        global $cases;
	    $this->timeout_session	= 60*5; #-----5 menit     
        if (isset($_GET['view'])) {
            switch($_GET['view']) {
                case "cases":echo json_encode($cases);break;
		        case "cookie":echo json_encode($_COOKIE);break;
		        case "session":echo json_encode($_SESSION);break;
            }
            exit;
        }
	}
    
    function readxml ($filename) {
        if (file_exists(GOV2XMLPATH."/".$filename.".xml")) {
			return simplexml_load_file(GOV2XMLPATH."/".$filename.".xml");
		} else {
			return "NotExist";
		}		
    } 
    
    function authorize ($privilege="member") {
        global $public,$secret,$_GET,$_POST;
        $valid="";
        if (!isset($_SESSION['account_id']) && $privilege!="public") {$error="NotLogin";}
        else {
            if (time()-$_SESSION["started"] > time()+$this->timeout_session) {$error="SessionExpired";}
            else {
                if ($privilege=="public") {unset($error);} else {
                    if ($privilege=="member" || $privilege=="webmaster") {
                        $members=$this->readxml("gov2member");
                        if ($members!="NotExist") {
                            foreach ($members->member as $member) {
                                if ($member->account_id==$_SESSION["account_id"]) {
                                    $valid=$member;
                                    unset($error);
                                    break;
                                } else {$error="NotMember";}
                            }
                            if (!$error) {
                                if (!$valid->webmaster) {
                                    foreach ($valid->privilege as $cases) {
                                        $controller = $cases->attributes();
                                        if ($controller['controller']==$_SERVER['SCRIPT_NAME']) {
                                            unset($error);
                                            if (!$_GET['cmd'] && !$_POST['cmd'] && !is_array($cases->case)) {break;} else {
                                                foreach ($cases->case as $case) {
                                                    if ($_GET['cmd']==$case || $_POST['cmd']==$case) {unset($error);break;} 
                                                    else {$error="UnauthorizedCase";}              
                                                }
                                            }
                                        } else {$error="UnauthorizedPage";}
                                    }
                                }

                            }                 
                        } else {$error="NotConfigured";}
                    }
                    $_SESSION["started"]=time()+$this->timeout_session;
                    $_SESSION["counter"]++;
//                    $this->cookie_save('started,counter');
                } 
            }
        } 
        $this->authorized=$_SESSION;
        $this->error=$error;
    }
}
?>