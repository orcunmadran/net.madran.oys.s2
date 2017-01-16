<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1,2";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../../yetki_yok.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php

require_once('init.php');

//@error_reporting(0);
$error = '';

function doLogin($userid) {
	global $smarty;
	$_SESSION['userid'] = $userid;
	include('index.php');
	exit;
}

$userid = ChatServer::isLoggedIn();
if($userid != null && ChatServer::userInRole($userid, ROLE_ADMIN)) 
{
	doLogin($userid);
} 
else 
{
	unset($_SESSION['userid']);
}	

if(isset($_REQUEST['do'])) {
	if(
		($userid = ChatServer::login($_REQUEST['login'], $_REQUEST['password'])) 
		&& (ChatServer::userInRole($userid, ROLE_ADMIN) || ChatServer::userInRole($userid, ROLE_MODERATOR))
	  ) 
	{
		doLogin($userid);
	} 
	else 
	{
		unset($_SESSION['userid']);
		$error = 'Could not grant admin role for this login and password. '.mysql_error();
	}
} else {
	unset($_SESSION['userid']);
	$_REQUEST['login'] = '';
	$_REQUEST['password'] = '';
}

$installed = isInstalled();
if( !$installed ) 
{
	unset($_SESSION['userid']);
	$error = 'FlashChat is not installed.';
}
 
//Assign Smarty variables and load the admin template
$smarty->assign('error',$error);
$smarty->assign('installed',$installed);
$smarty->display('login.tpl');
?>