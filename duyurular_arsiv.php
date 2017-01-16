<?php require_once('Connections/lmscon.php'); ?>
<?php
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

$currentPage = $_SERVER["PHP_SELF"];

$colname_tanitim = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_tanitim = $_SESSION['MM_Username'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_tanitim = sprintf("SELECT * FROM lms_kullanici WHERE kimlik = %s", GetSQLValueString($colname_tanitim, "text"));
$tanitim = mysql_query($query_tanitim, $lmscon) or die(mysql_error());
$row_tanitim = mysql_fetch_assoc($tanitim);
$totalRows_tanitim = mysql_num_rows($tanitim);

$deger_ym = "-1";
if (isset($_SESSION['MM_Username'])) {
  $deger_ym = $_SESSION['MM_Username'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_ym = sprintf("SELECT M.no FROM lms_mesaj M WHERE M.alici LIKE %s AND M.silindi NOT LIKE %s AND M.okundu NOT LIKE %s", GetSQLValueString("%" . $deger_ym . "%", "text"),GetSQLValueString("%" . $deger_ym . "%", "text"),GetSQLValueString("%" . $deger_ym . "%", "text"));
$ym = mysql_query($query_ym, $lmscon) or die(mysql_error());
$row_ym = mysql_fetch_assoc($ym);
$totalRows_ym = mysql_num_rows($ym);

$maxRows_dyr = 10;
$pageNum_dyr = 0;
if (isset($_GET['pageNum_dyr'])) {
  $pageNum_dyr = $_GET['pageNum_dyr'];
}
$startRow_dyr = $pageNum_dyr * $maxRows_dyr;

$deger_dyr = "-1";
if (isset($_SESSION['MM_Username'])) {
  $deger_dyr = $_SESSION['MM_Username'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_dyr = sprintf("SELECT DISTINCT DU.* FROM lms_ders DE, lms_sube SU, lms_sinif SN, lms_kullanici K, lms_duyuru DU WHERE DE.no = SU.dersno AND SU.no = SN.subeno AND SU.kimlik = K.kimlik AND SN.kimlik = %s AND DE.aktif = 'EVET' AND (DU.kod = DE.no OR DU.kod = SU.subeadi) AND bitis < DATE_FORMAT(now(), '%%Y-%%m-%%d') ORDER BY no DESC", GetSQLValueString($deger_dyr, "text"));
$query_limit_dyr = sprintf("%s LIMIT %d, %d", $query_dyr, $startRow_dyr, $maxRows_dyr);
$dyr = mysql_query($query_limit_dyr, $lmscon) or die(mysql_error());
$row_dyr = mysql_fetch_assoc($dyr);

if (isset($_GET['totalRows_dyr'])) {
  $totalRows_dyr = $_GET['totalRows_dyr'];
} else {
  $all_dyr = mysql_query($query_dyr);
  $totalRows_dyr = mysql_num_rows($all_dyr);
}
$totalPages_dyr = ceil($totalRows_dyr/$maxRows_dyr)-1;

$maxRows_dyroe = 10;
$pageNum_dyroe = 0;
if (isset($_GET['pageNum_dyroe'])) {
  $pageNum_dyroe = $_GET['pageNum_dyroe'];
}
$startRow_dyroe = $pageNum_dyroe * $maxRows_dyroe;

$deger_dyroe = "-1";
if (isset($_SESSION['MM_Username'])) {
  $deger_dyroe = $_SESSION['MM_Username'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_dyroe = sprintf("SELECT DISTINCT DU.* FROM lms_ders DE, lms_sube SU, lms_duyuru DU WHERE DE.no = SU.dersno AND SU.kimlik = %s AND DE.aktif = 'EVET' AND (DU.kod = DE.no OR DU.kod = SU.subeadi) AND bitis < DATE_FORMAT(now(), '%%Y-%%m-%%d') ORDER BY no DESC", GetSQLValueString($deger_dyroe, "text"));
$query_limit_dyroe = sprintf("%s LIMIT %d, %d", $query_dyroe, $startRow_dyroe, $maxRows_dyroe);
$dyroe = mysql_query($query_limit_dyroe, $lmscon) or die(mysql_error());
$row_dyroe = mysql_fetch_assoc($dyroe);

if (isset($_GET['totalRows_dyroe'])) {
  $totalRows_dyroe = $_GET['totalRows_dyroe'];
} else {
  $all_dyroe = mysql_query($query_dyroe);
  $totalRows_dyroe = mysql_num_rows($all_dyroe);
}
$totalPages_dyroe = ceil($totalRows_dyroe/$maxRows_dyroe)-1;

$deger_m = "-1";
if (isset($_SESSION['MM_Username'])) {
  $deger_m = $_SESSION['MM_Username'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_m = sprintf("SELECT M.*, DATE_FORMAT(zaman, '%%d.%%m.%%Y - %%H:%%i') AS tarihsaat, CONCAT(K.ad, ' ', K.soyad) AS adsoyad FROM lms_mesaj M, lms_kullanici K WHERE M.alici LIKE %s AND M.silindi = 0 AND M.gonderen = K.kimlik ORDER BY M.zaman DESC", GetSQLValueString("%" . $deger_m . "%", "text"));
$m = mysql_query($query_m, $lmscon) or die(mysql_error());
$row_m = mysql_fetch_assoc($m);
$totalRows_m = mysql_num_rows($m);

$maxRows_dyrgnl = 5;
$pageNum_dyrgnl = 0;
if (isset($_GET['pageNum_dyrgnl'])) {
  $pageNum_dyrgnl = $_GET['pageNum_dyrgnl'];
}
$startRow_dyrgnl = $pageNum_dyrgnl * $maxRows_dyrgnl;

mysql_select_db($database_lmscon, $lmscon);
$query_dyrgnl = "SELECT * FROM lms_duyuru WHERE kod = 0 AND bitis < DATE_FORMAT(now(), '%Y-%m-%d') ORDER BY no DESC";
$query_limit_dyrgnl = sprintf("%s LIMIT %d, %d", $query_dyrgnl, $startRow_dyrgnl, $maxRows_dyrgnl);
$dyrgnl = mysql_query($query_limit_dyrgnl, $lmscon) or die(mysql_error());
$row_dyrgnl = mysql_fetch_assoc($dyrgnl);

if (isset($_GET['totalRows_dyrgnl'])) {
  $totalRows_dyrgnl = $_GET['totalRows_dyrgnl'];
} else {
  $all_dyrgnl = mysql_query($query_dyrgnl);
  $totalRows_dyrgnl = mysql_num_rows($all_dyrgnl);
}
$totalPages_dyrgnl = ceil($totalRows_dyrgnl/$maxRows_dyrgnl)-1;

$queryString_dyr = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_dyr") == false && 
        stristr($param, "totalRows_dyr") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_dyr = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_dyr = sprintf("&totalRows_dyr=%d%s", $totalRows_dyr, $queryString_dyr);

$queryString_dyroe = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_dyroe") == false && 
        stristr($param, "totalRows_dyroe") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_dyroe = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_dyroe = sprintf("&totalRows_dyroe=%d%s", $totalRows_dyroe, $queryString_dyroe);

$queryString_dyrgnl = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_dyrgnl") == false && 
        stristr($param, "totalRows_dyrgnl") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_dyrgnl = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_dyrgnl = sprintf("&totalRows_dyrgnl=%d%s", $totalRows_dyrgnl, $queryString_dyrgnl);

$MM_paramName = ""; 

// *** Go To Record and Move To Record: create strings for maintaining URL and Form parameters
// create the list of parameters which should not be maintained
$MM_removeList = "&index=";
if ($MM_paramName != "") $MM_removeList .= "&".strtolower($MM_paramName)."=";
$MM_keepURL="";
$MM_keepForm="";
$MM_keepBoth="";
$MM_keepNone="";
// add the URL parameters to the MM_keepURL string
reset ($HTTP_GET_VARS);
while (list ($key, $val) = each ($HTTP_GET_VARS)) {
	$nextItem = "&".strtolower($key)."=";
	if (!stristr($MM_removeList, $nextItem)) {
		$MM_keepURL .= "&".$key."=".urlencode($val);
	}
}
// add the URL parameters to the MM_keepURL string
if(isset($HTTP_POST_VARS)){
	reset ($HTTP_POST_VARS);
	while (list ($key, $val) = each ($HTTP_POST_VARS)) {
		$nextItem = "&".strtolower($key)."=";
		if (!stristr($MM_removeList, $nextItem)) {
			$MM_keepForm .= "&".$key."=".urlencode($val);
		}
	}
}
// create the Form + URL string and remove the intial '&' from each of the strings
$MM_keepBoth = $MM_keepURL."&".$MM_keepForm;
if (strlen($MM_keepBoth) > 0) $MM_keepBoth = substr($MM_keepBoth, 1);
if (strlen($MM_keepURL) > 0)  $MM_keepURL = substr($MM_keepURL, 1);
if (strlen($MM_keepForm) > 0) $MM_keepForm = substr($MM_keepForm, 1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/lms_ic.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>::: Öğretim Yönetim Sistemi :::</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--Fireworks CS3 Dreamweaver CS3 target.  Created Fri Jul 27 16:59:51 GMT+0300 (GTB Yaz Saati) 2007-->
<script language="JavaScript1.2" type="text/javascript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

//-->
</script>
<link href="lms.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {color: #CC0000;
	font-weight: bold;
}
-->
</style>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-top: 25px;
}
-->
</style></head>
<body bgcolor="#ffffff" onload="MM_preloadImages('fw_images/lms_ic_r1_c20_f2.gif','fw_images/lms_ic_r2_c4_f2.gif','fw_images/lms_ic_r2_c6_f2.gif','fw_images/lms_ic_r2_c8_f2.gif','fw_images/lms_ic_r2_c10_f2.gif','fw_images/lms_ic_r2_c12_f2.gif','fw_images/lms_ic_r2_c14_f2.gif','fw_images/lms_ic_r2_c16_f2.gif','fw_images/lms_ic_r2_c18_f2.gif','fw_images/lms_ic_r2_c20_f2.gif')">
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
<!-- fwtable fwsrc="lms_ic.png" fwpage="LMS ic" fwbase="lms_ic.gif" fwstyle="Dreamweaver" fwdocid = "52238024" fwnested="0" -->
  <tr>
   <td><img src="fw_images/spacer.gif" width="10" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="542" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="13" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="38" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="9" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="33" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="8" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="33" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="8" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="32" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="8" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="34" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="7" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="33" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="8" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="34" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="7" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="34" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="5" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="44" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="10" height="1" border="0" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>

  <tr>
   <td colspan="2"><img name="lms_ic_r1_c1" src="resimler/kurum_logo_ic.gif" width="552" height="60" border="0" id="lms_ic_r1_c1" alt="" /></td>
   <td><img name="lms_ic_r1_c3" src="fw_images/lms_ic_r1_c3.gif" width="13" height="60" border="0" id="lms_ic_r1_c3" alt="" /></td>
   <td colspan="16" background="fw_images/lms_ic_r1_c4.gif"><div align="center" class="kullanici"><?php echo $row_tanitim['ad']; ?>  <?php echo $row_tanitim['soyad']; ?></div></td>
   <td colspan="2"><a href="index_cikis.php" title="Oturumu Kapat" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r1_c20','','fw_images/lms_ic_r1_c20_f2.gif',1)"><img name="lms_ic_r1_c20" src="fw_images/lms_ic_r1_c20.gif" width="54" height="60" border="0" id="lms_ic_r1_c20" alt="Oturumu Kapat" /></a></td>
   <td><img src="fw_images/spacer.gif" width="1" height="60" border="0" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2" background="fw_images/lms_ic_r5_c1.gif">&nbsp;</td>
   <td rowspan="2" class="ustbaslik"><!-- InstanceBeginEditable name="Baslik" -->
     <table width="100%" border="0" cellspacing="5" cellpadding="5">
       <tr>
         <td width="3%"><a href="javascript:history.back()"><img src="simgeler/back_24.gif" alt="Geri Dön" width="24" height="24" border="0" /></a></td>
         <td width="97%">Duyuru Arşivi</td>
       </tr>
     </table>
   <!-- InstanceEndEditable --></td>
   <td rowspan="2"><img name="lms_ic_r2_c3" src="fw_images/lms_ic_r2_c3.gif" width="13" height="50" border="0" id="lms_ic_r2_c3" alt="" /></td>
   <td><a href="anasayfa.php"  title="Anasayfa" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r2_c4','','fw_images/lms_ic_r2_c4_f2.gif',1)"><img name="lms_ic_r2_c4" src="fw_images/lms_ic_r2_c4.gif" width="38" height="40" border="0" id="lms_ic_r2_c4" alt="Anasayfa" /></a></td>
   <td><img name="lms_ic_r2_c5" src="fw_images/lms_ic_r2_c5.gif" width="9" height="40" border="0" id="lms_ic_r2_c5" alt="" /></td>
   <td><a href="dersler.php"  title="Dersler" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r2_c6','','fw_images/lms_ic_r2_c6_f2.gif',1)"><img name="lms_ic_r2_c6" src="fw_images/lms_ic_r2_c6.gif" width="33" height="40" border="0" id="lms_ic_r2_c6" alt="Dersler" /></a></td>
   <td><img name="lms_ic_r2_c7" src="fw_images/lms_ic_r2_c7.gif" width="8" height="40" border="0" id="lms_ic_r2_c7" alt="" /></td>
   <td><a href="mesajlar.php" title="Mesajlar" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r2_c8','','fw_images/lms_ic_r2_c8_f2.gif',1)"><img name="lms_ic_r2_c8" src="fw_images/lms_ic_r2_c8.gif" width="33" height="40" border="0" id="lms_ic_r2_c8" alt="Mesajlar" /></a></td>
   <td><img name="lms_ic_r2_c9" src="fw_images/lms_ic_r2_c9.gif" width="8" height="40" border="0" id="lms_ic_r2_c9" alt="" /></td>
   <td><a href="forumlar.php" title="Tartışma Grupları" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r2_c10','','fw_images/lms_ic_r2_c10_f2.gif',1)"><img name="lms_ic_r2_c10" src="fw_images/lms_ic_r2_c10.gif" width="32" height="40" border="0" id="lms_ic_r2_c10" alt="Tartışma Grupları" /></a></td>
   <td><img name="lms_ic_r2_c11" src="fw_images/lms_ic_r2_c11.gif" width="8" height="40" border="0" id="lms_ic_r2_c11" alt="" /></td>
   <td><a href="sohbet_odalari.php" title="Sohbet Odaları" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r2_c12','','fw_images/lms_ic_r2_c12_f2.gif',1)"><img name="lms_ic_r2_c12" src="fw_images/lms_ic_r2_c12.gif" width="34" height="40" border="0" id="lms_ic_r2_c12" alt="Sohbet Odaları" /></a></td>
   <td><img name="lms_ic_r2_c13" src="fw_images/lms_ic_r2_c13.gif" width="7" height="40" border="0" id="lms_ic_r2_c13" alt="" /></td>
   <td><a href="not_defteri.php" title="Not Defteri" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r2_c14','','fw_images/lms_ic_r2_c14_f2.gif',1)"><img name="lms_ic_r2_c14" src="fw_images/lms_ic_r2_c14.gif" width="33" height="40" border="0" id="lms_ic_r2_c14" alt="Not Defteri" /></a></td>
   <td><img name="lms_ic_r2_c15" src="fw_images/lms_ic_r2_c15.gif" width="8" height="40" border="0" id="lms_ic_r2_c15" alt="" /></td>
   <td><a href="arama.php" title="Arama" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r2_c16','','fw_images/lms_ic_r2_c16_f2.gif',1)"><img name="lms_ic_r2_c16" src="fw_images/lms_ic_r2_c16.gif" width="34" height="40" border="0" id="lms_ic_r2_c16" alt="Arama" /></a></td>
   <td><img name="lms_ic_r2_c17" src="fw_images/lms_ic_r2_c17.gif" width="7" height="40" border="0" id="lms_ic_r2_c17" alt="" /></td>
   <td><a href="yonetim.php" title="Yönetim Paneli" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r2_c18','','fw_images/lms_ic_r2_c18_f2.gif',1)"><img name="lms_ic_r2_c18" src="fw_images/lms_ic_r2_c18.gif" width="34" height="40" border="0" id="lms_ic_r2_c18" alt="Yönetim Paneli" /></a></td>
   <td><img name="lms_ic_r2_c19" src="fw_images/lms_ic_r2_c19.gif" width="5" height="40" border="0" id="lms_ic_r2_c19" alt="" /></td>
   <td colspan="2" background="resimler/sag_kaplama.gif" bgcolor="#CCCCCC"><a href="yardim.php" title="Yardım" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_ic_r2_c20','','fw_images/lms_ic_r2_c20_f2.gif',1)"><img name="lms_ic_r2_c20" src="fw_images/lms_ic_r2_c20.gif" width="54" height="40" border="0" id="lms_ic_r2_c20" alt="Yardım" /></a></td>
   <td><img src="fw_images/spacer.gif" width="1" height="40" border="0" alt="" /></td>
  </tr>
  <tr>
   <td colspan="18" background="fw_images/lms_ic_r3_c4.gif">&nbsp;</td>
   <td><img src="fw_images/spacer.gif" width="1" height="10" border="0" alt="" /></td>
  </tr>
  <tr>
   <td colspan="2"><img name="lms_ic_r4_c1" src="fw_images/lms_ic_r4_c1.gif" width="552" height="20" border="0" id="lms_ic_r4_c1" alt="" /></td>
   <td colspan="19" background="fw_images/lms_ic_r3_c4.gif"><img name="lms_ic_r4_c3" src="fw_images/lms_ic_r4_c3.gif" width="398" height="20" border="0" id="lms_ic_r4_c3" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="1" height="20" border="0" alt="" /></td>
  </tr>
  <tr>
   <td background="fw_images/lms_ic_r5_c1.gif">&nbsp;</td>
   <td colspan="19" valign="top"><!-- InstanceBeginEditable name="İcerik" -->
     <table width="100%" border="0" cellspacing="5" cellpadding="5">
       <tr>
         <td width="60%" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5">
           <tr>
             <td colspan="2"><span class="arabaslik">Genel Duyurular - Haberler - Etkinlikler</span></td>
           </tr>
           <?php if ($totalRows_dyrgnl == 0) { // Show if recordset empty ?>
             <tr>
               <td colspan="2"><span class="icyazi">Yayında olan haber, duyuru ya da etkinlik yok.</span></td>
             </tr>
             <?php } // Show if recordset empty ?>
             <?php if ($totalRows_dyrgnl > 0) {?>
           <?php do { ?>
             <tr>
               <td width="3%"><img src="resimler/new_16.gif" width="16" height="16" /></td>
               <td width="97%" class="icyazi"><a href="duyuru_ayrinti.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."duyuruno=".$row_dyrgnl['no'] ?>"><?php echo $row_dyrgnl['baslik']; ?></a></td>
             </tr>
             <?php } while ($row_dyrgnl = mysql_fetch_assoc($dyrgnl)); ?>
             <?php }?>
<tr>
             <td>&nbsp;</td>
             <td><div align="center">
                 <table border="0">
                   <tr>
                     <td><?php if ($pageNum_dyrgnl > 0) { // Show if not first page ?>
                         <a href="<?php printf("%s?pageNum_dyrgnl=%d%s", $currentPage, 0, $queryString_dyrgnl); ?>"><img src="resimler/First.gif" border="0" /></a>
                         <?php } // Show if not first page ?>
                     </td>
                     <td><?php if ($pageNum_dyrgnl > 0) { // Show if not first page ?>
                         <a href="<?php printf("%s?pageNum_dyrgnl=%d%s", $currentPage, max(0, $pageNum_dyrgnl - 1), $queryString_dyrgnl); ?>"><img src="resimler/Previous.gif" border="0" /></a>
                         <?php } // Show if not first page ?>
                     </td>
                     <td><?php if ($pageNum_dyrgnl < $totalPages_dyrgnl) { // Show if not last page ?>
                         <a href="<?php printf("%s?pageNum_dyrgnl=%d%s", $currentPage, min($totalPages_dyrgnl, $pageNum_dyrgnl + 1), $queryString_dyrgnl); ?>"><img src="resimler/Next.gif" border="0" /></a>
                         <?php } // Show if not last page ?>
                     </td>
                     <td><?php if ($pageNum_dyrgnl < $totalPages_dyrgnl) { // Show if not last page ?>
                         <a href="<?php printf("%s?pageNum_dyrgnl=%d%s", $currentPage, $totalPages_dyrgnl, $queryString_dyrgnl); ?>"><img src="resimler/Last.gif" border="0" /></a>
                         <?php } // Show if not last page ?>
                     </td>
                   </tr>
                 </table>
             </div></td>
           </tr>
         </table>
           <?php if ($row_tanitim['yetki'] > 4) {?>
           <table width="100%" border="0" cellpadding="5" cellspacing="5">
             <tr>
               <td colspan="3" class="arabaslik">Duyuru Panosu (Dersler &amp; Şubeler)</td>
              </tr>
             <?php if ($totalRows_dyr == 0) { // Show if recordset empty ?>
             <tr>
               <td colspan="3" class="icyazi">Dersler ya da şubeler ile ilgili bir duyuru yok.</td>
             </tr>
             <?php } // Show if recordset empty ?>
             <?php do { ?>
             <?php if ($totalRows_dyr > 0) { // Show if recordset not empty ?>
             <tr>
               <td><img src="resimler/new_16.gif" width="16" height="16" /></td>
               <td colspan="2" valign="top"><span class="icyazi"><a href="duyuru_ayrinti.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."duyuruno=".$row_dyr['no'] ?>"><?php echo $row_dyr['baslik']; ?></a></span></td>
             </tr>
             <?php } // Show if recordset not empty ?>
             <?php } while ($row_dyr = mysql_fetch_assoc($dyr)); ?>
             <tr>
               <td width="7%">&nbsp;</td>
               <td colspan="2" class="icyazi"><div align="center">
                   <table border="0">
                     <tr>
                       <td><?php if ($pageNum_dyr > 0) { // Show if not first page ?>
                           <a href="<?php printf("%s?pageNum_dyr=%d%s", $currentPage, 0, $queryString_dyr); ?>"><img src="resimler/First.gif" border="0" /></a>
                        <?php } // Show if not first page ?>                       </td>
                       <td><?php if ($pageNum_dyr > 0) { // Show if not first page ?>
                           <a href="<?php printf("%s?pageNum_dyr=%d%s", $currentPage, max(0, $pageNum_dyr - 1), $queryString_dyr); ?>"><img src="resimler/Previous.gif" border="0" /></a>
                        <?php } // Show if not first page ?>                       </td>
                       <td><?php if ($pageNum_dyr < $totalPages_dyr) { // Show if not last page ?>
                           <a href="<?php printf("%s?pageNum_dyr=%d%s", $currentPage, min($totalPages_dyr, $pageNum_dyr + 1), $queryString_dyr); ?>"><img src="resimler/Next.gif" border="0" /></a>
                        <?php } // Show if not last page ?>                       </td>
                       <td><?php if ($pageNum_dyr < $totalPages_dyr) { // Show if not last page ?>
                           <a href="<?php printf("%s?pageNum_dyr=%d%s", $currentPage, $totalPages_dyr, $queryString_dyr); ?>"><img src="resimler/Last.gif" border="0" /></a>
                        <?php } // Show if not last page ?>                       </td>
                     </tr>
                   </table>
               </div></td>
             </tr>
           </table>
           <?php }?>
           <?php if ($row_tanitim['yetki'] < 5) {?>
           <table width="100%" border="0" cellpadding="5" cellspacing="5">
             <tr>
               <td colspan="3" class="icyazi"><span class="arabaslik">Duyuru Panosu (Dersler &amp; Şubeler)</span></td>
             </tr>
             <?php if ($totalRows_dyroe == 0) { // Show if recordset empty ?>
               <tr>
                 <td colspan="3" class="icyazi">Dersler ya da şubeler ile ilgili bir duyuru yok.</td>
               </tr>
               <?php } // Show if recordset empty ?>
<?php do { ?>
             <?php if ($totalRows_dyroe > 0) { // Show if recordset not empty ?>
             <tr>
               <td><img src="resimler/new_16.gif" width="16" height="16" /></td>
               <td width="94%" colspan="2" valign="top"><span class="icyazi"><a href="duyuru_ayrinti.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."duyuruno=".$row_dyroe['no'] ?>"><?php echo $row_dyroe['baslik']; ?></a></span></td>
             </tr>
             <?php } // Show if recordset not empty ?>
             <?php } while ($row_dyroe = mysql_fetch_assoc($dyroe)); ?>
             <tr>
               <td width="6%">&nbsp;</td>
               <td colspan="2" class="icyazi"><div align="center">
                   <table border="0">
                     <tr>
                       <td><?php if ($pageNum_dyroe > 0) { // Show if not first page ?>
                           <a href="<?php printf("%s?pageNum_dyroe=%d%s", $currentPage, 0, $queryString_dyroe); ?>"><img src="resimler/First.gif" border="0" /></a>
                        <?php } // Show if not first page ?>                       </td>
                       <td><?php if ($pageNum_dyroe > 0) { // Show if not first page ?>
                           <a href="<?php printf("%s?pageNum_dyroe=%d%s", $currentPage, max(0, $pageNum_dyroe - 1), $queryString_dyroe); ?>"><img src="resimler/Previous.gif" border="0" /></a>
                        <?php } // Show if not first page ?>                       </td>
                       <td><?php if ($pageNum_dyroe < $totalPages_dyroe) { // Show if not last page ?>
                           <a href="<?php printf("%s?pageNum_dyroe=%d%s", $currentPage, min($totalPages_dyroe, $pageNum_dyroe + 1), $queryString_dyroe); ?>"><img src="resimler/Next.gif" border="0" /></a>
                        <?php } // Show if not last page ?>                       </td>
                       <td><?php if ($pageNum_dyroe < $totalPages_dyroe) { // Show if not last page ?>
                           <a href="<?php printf("%s?pageNum_dyroe=%d%s", $currentPage, $totalPages_dyroe, $queryString_dyroe); ?>"><img src="resimler/Last.gif" border="0" /></a>
                        <?php } // Show if not last page ?>                       </td>
                     </tr>
                   </table>
               </div></td>
             </tr>
           </table>
          <?php }?></td>
         <td width="40%" valign="top"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
           <tr>
             <td><table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#333333" bgcolor="#F1F1F1">
                 <tr>
                   <td bordercolor="#F1F1F1"><span class="arabaslik">Posta Kutusu</span></td>
                 </tr>
               </table>
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                     <td>&nbsp;</td>
                   </tr>
               </table></td>
           </tr>
           <tr>
             <td><table width="100%" border="1" align="center" cellpadding="5" cellspacing="5" bordercolor="#333333" bgcolor="#F1F1F1">
                 <tr>
                   <td width="10%" bordercolor="#F1F1F1"><img src="simgeler/mesaj/yeni.gif" alt="Yeni Mesaj Oluştur" width="16" height="15" /></td>
                   <td nowrap="nowrap" bordercolor="#F1F1F1" class="icyazi"><a href="mesaj_gonder.php">Yeni Mesaj Oluştur</a></td>
                 </tr>
                 <tr>
                   <td bordercolor="#F1F1F1"><img src="simgeler/mesaj/gelenler.gif" alt="Gelen Mesajlar" width="16" height="15" /></td>
                   <td bordercolor="#F1F1F1" class="icyazi"><p><a href="mesajlar.php">Gelen Mesajlar </a>
                           <?php if ($totalRows_ym > 0) { // Show if recordset not empty ?>
                     (<span class="style1"><?php echo $totalRows_ym ?></span>)
                     <?php } // Show if recordset not empty ?>
                   </p></td>
                 </tr>
                 <tr>
                   <td bordercolor="#F1F1F1"><img src="simgeler/mesaj/gonderilenler.gif" alt="Gönderilmiş Mesajlar" width="16" height="15" /></td>
                   <td nowrap="nowrap" bordercolor="#F1F1F1" class="icyazi"><a href="mesaj_gonderilen.php">Gönderilmiş Mesajlar</a></td>
                 </tr>
             </table></td>
           </tr>
           <tr>
             <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                 <tr>
                   <td>&nbsp;</td>
                 </tr>
               </table>
                 <table width="100%" border="1" align="center" cellpadding="5" cellspacing="5" bordercolor="#333333" bgcolor="#F1F1F1">
                   <tr>
                     <td width="10%" bordercolor="#F1F1F1"><img src="simgeler/mesaj/duyuru.gif" alt="Güncel Duyurular" width="16" height="15" /></td>
                     <td nowrap="nowrap" bordercolor="#F1F1F1" class="icyazi"><a href="duyurular.php">Güncel Duyurular</a></td>
                   </tr>
                   <tr>
                     <td bordercolor="#F1F1F1"><img src="simgeler/mesaj/arsiv.gif" alt="Güncel Duyurular" width="16" height="15" /></td>
                     <td nowrap="nowrap" bordercolor="#F1F1F1" class="icyazi"><a href="duyurular_arsiv.php">Duyuru Arşivi</a></td>
                   </tr>
               </table></td>
           </tr>
         </table></td>
       </tr>
     </table>
   <!-- InstanceEndEditable --></td>
   <td background="fw_images/lms_ic_r5_c21.gif">&nbsp;</td>
   <td><img src="fw_images/spacer.gif" width="1" height="360" border="0" alt="" /></td>
  </tr>
  <tr>
   <td colspan="21"><img name="lms_ic_r6_c1" src="fw_images/lms_ic_r6_c1.gif" width="950" height="10" border="0" id="lms_ic_r6_c1" alt="" /></td>
   <td><img src="fw_images/spacer.gif" width="1" height="10" border="0" alt="" /></td>
  </tr>
</table>
<p align="center" class="icyazi"><?php echo $copyright ?></p>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($tanitim);

mysql_free_result($ym);

mysql_free_result($dyr);

mysql_free_result($dyroe);

mysql_free_result($m);

mysql_free_result($dyrgnl);
?>
