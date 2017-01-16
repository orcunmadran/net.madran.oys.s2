<?php require_once('Connections/lmscon.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1,2,3,4,5,6,7,8,9";
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

$MM_restrictGoTo = "yetki_yok.php";
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
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "islem")) {
  $updateSQL = sprintf("UPDATE lms_mesaj SET silindi=%s WHERE `no`=%s",
                       GetSQLValueString($_POST['silindi'], "text"),
                       GetSQLValueString($_POST['no'], "int"));

  mysql_select_db($database_lmscon, $lmscon);
  $Result1 = mysql_query($updateSQL, $lmscon) or die(mysql_error());

  $updateGoTo = "mesajlar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$degerbir_m = "-1";
if (isset($_GET['mesajno'])) {
  $degerbir_m = $_GET['mesajno'];
}
$degeriki_m = "-1";
if (isset($_SESSION['MM_Username'])) {
  $degeriki_m = $_SESSION['MM_Username'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_m = sprintf("SELECT no, silindi FROM lms_mesaj WHERE no = %s AND alici LIKE %s", GetSQLValueString($degerbir_m, "int"),GetSQLValueString("%" . $degeriki_m . "%", "text"));
$m = mysql_query($query_m, $lmscon) or die(mysql_error());
$row_m = mysql_fetch_assoc($m);
$totalRows_m = mysql_num_rows($m);

$colname_tanitim = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_tanitim = $_SESSION['MM_Username'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_tanitim = sprintf("SELECT * FROM lms_kullanici WHERE kimlik = %s", GetSQLValueString($colname_tanitim, "text"));
$tanitim = mysql_query($query_tanitim, $lmscon) or die(mysql_error());
$row_tanitim = mysql_fetch_assoc($tanitim);
$totalRows_tanitim = mysql_num_rows($tanitim);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Öğretim Yönetim Sistemi :::</title>
<script type="text/javascript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
</head>

<body onload="MM_callJS('document.islem.submit()')">
<form id="islem" name="islem" method="POST" action="<?php echo $editFormAction; ?>">
  <input name="no" type="hidden" id="no" value="<?php echo $row_m['no']; ?>" />
  <input name="silindi" type="hidden" id="silindi" value="<?php echo $row_m['silindi']." ".$row_tanitim['kimlik']; ?>" />
  <input type="hidden" name="MM_update" value="islem" />
</form>
</body>
</html>
<?php
mysql_free_result($tanitim);

mysql_free_result($m);
?>
