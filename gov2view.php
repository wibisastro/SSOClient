<?
/********************************************************************
*	Date		: 25 Mar 2015
*	Author		: Wibisono Sastrodiwiryo
*	Email		: wibi@alumni.ui.ac.id
*	Copyleft	: e-Gov Lab Univ of Indonesia 
*********************************************************************/


#------------------------configuration
    if ($gov2->error && !$view) {$view=$gov2->error;}
    elseif (!$gov2->error) {$view="profile";}

#------------------------view
switch ($view) {
    case "escape":
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Gov 2.0 Login iFrame</title>
        </head>
        <body>
        <script>
            window.parent.location.href = "https://<?echo $_SERVER["SERVER_NAME"];?>/gov2login.php?cmd=authorize&token=<?echo $token;?>"; 
        </script>
        <a target="_parent" href="https://<?echo $_SERVER["SERVER_NAME"];?>/gov2login.php?cmd=authorize&token=<?echo $token;?>"><img src="images/ajax-loader.gif" border="0"></a>
        </body>
        </html>
        <?
    break;
    case "NotExist":
    case "NotMember":
    case "UnauthorizedPage":
    case "UnauthorizedCase":
    case "InvalidToken":
        echo "Err:".$gov2->error;
    break;
    case "activate": #------case hanya untuk di account
        ?>
        <style>
        .saas-frame {
        position: relative;
        top: 20px;
        bottom: 0;
        left: 0;
        right: 0;
        }
        </style>
        <div class="saas-frame">
        <iframe src="<?echo SSONODE."/ssignup.php";?>?cmd=activate&act_code=<?echo $_GET["act_code"]?>&client=<?echo $_SERVER["SERVER_NAME"];?>" width="100%" frameborder="0"></iframe>		
        </div>	
        <script type="text/javascript" src="js/iframeResizer.min.js"></script>
        <script type="text/javascript">

            iFrameResize({
                log                     : false,                  // Enable console logging
                enablePublicMethods     : true,                  // Enable methods within iframe hosted page
                resizedCallback         : function(messageData){ // Callback fn when message is received
                }
            });
        </script>
        <?
    break;
    case "activation": #------case hanya untuk di account
        ?>
        <style>
        .saas-frame {
        position: relative;
        top: 20px;
        bottom: 0;
        left: 0;
        right: 0;
        }
        </style>
        <div class="saas-frame">
        <iframe src="<?echo SSONODE."/ssignup.php";?>?cmd=activation&client=<?echo $_SERVER["SERVER_NAME"];?>" width="100%" frameborder="0"></iframe>		
        </div>	
        <script type="text/javascript" src="js/iframeResizer.min.js"></script>
        <script type="text/javascript">

            iFrameResize({
                log                     : false,                  // Enable console logging
                enablePublicMethods     : true,                  // Enable methods within iframe hosted page
                resizedCallback         : function(messageData){ // Callback fn when message is received
                }
            });
        </script>
        <?
    break;
    case "signup":
        ?>
        <style>
        .saas-frame {
        position: relative;
        top: 20px;
        bottom: 0;
        left: 0;
        right: 0;
        }
        </style>
        <div class="saas-frame">
        <iframe src="<?echo SSONODE."/ssignup.php";?>?client=<?echo $_SERVER["SERVER_NAME"];?>" width="100%" frameborder="0"></iframe>		
        </div>	
        <script type="text/javascript" src="js/iframeResizer.min.js"></script>
        <script type="text/javascript">

            iFrameResize({
                log                     : false,                  // Enable console logging
                enablePublicMethods     : true,                  // Enable methods within iframe hosted page
                resizedCallback         : function(messageData){ // Callback fn when message is received
                }
            });
        </script>
        <?
    break;
    case "NotLogin":
        ?>
        <style>
        .saas-frame {
        position: relative;
        top: 20px;
        bottom: 0;
        left: 0;
        right: 0;
        }
        </style>
        <div class="saas-frame">
        <iframe src="<?echo SSONODE?>/slogin.php?client=<?echo $_SERVER["SERVER_NAME"];?>" width="100%" frameborder="0"></iframe>		
        </div>	
        <script type="text/javascript" src="js/iframeResizer.min.js"></script>
        <script type="text/javascript">

            iFrameResize({
                log                     : false,                  // Enable console logging
                enablePublicMethods     : true,                  // Enable methods within iframe hosted page
                resizedCallback         : function(messageData){ // Callback fn when message is received
                }
            });
        </script>
        <?
    break;
    case "profile":
        ?>
        <style>
        .saas-frame {
        position: relative;
        top: 20px;
        bottom: 0;
        left: 0;
        right: 0;
        }
        </style>
        <div class="saas-frame">
        <iframe src="<?echo SSONODE;?>/sprofile.php?client=<?echo $_SERVER["SERVER_NAME"];?>&tab=<?echo $_GET['tab'];?><?if ($_SESSION["account_id"]=="105") {?>&debug=1<?}?>" width="100%" frameborder="0"></iframe>
        </div>	
        <script type="text/javascript" src="js/iframeResizer.min.js"></script>
        <script type="text/javascript">

            iFrameResize({
                log                     : false,                  // Enable console logging
                enablePublicMethods     : true,                  // Enable methods within iframe hosted page
                resizedCallback         : function(messageData){ // Callback fn when message is received
                }
            });
        </script>
        <?
    break;
    default:
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Gov 2.0 Login iFrame</title>
        </head>
        <body>
        <script>
            window.location.href = "https://<?echo $_SERVER["SERVER_NAME"];?>";
        </script>
        </body>
        </html>
        <?
}
?>