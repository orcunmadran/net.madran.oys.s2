<?php require_once('Connections/lmscon.php'); ?>
<?php session_start()?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "islem")) {
  $insertSQL = sprintf("INSERT INTO lms_giriscikis (kimlik, eylem, ipnum) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['kimlik'], "text"),
                       GetSQLValueString($_POST['eylem'], "int"),
                       GetSQLValueString($_POST['ipnum'], "text"));

  mysql_select_db($database_lmscon, $lmscon);
  $Result1 = mysql_query($insertSQL, $lmscon) or die(mysql_error());

  $insertGoTo = "anasayfa.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
  <input name="kimlik" type="hidden" id="kimlik" value="<?php echo $_SESSION['MM_Username'] ?>" />
  <input name="eylem" type="hidden" id="eylem" value="1" />
  <input name="ipnum" type="hidden" id="ipnum" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
  <input type="hidden" name="MM_insert" value="islem" />
</form>
</body>
</html>
