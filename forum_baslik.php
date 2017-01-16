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

$maxRows_fy = 5;
$pageNum_fy = 0;
if (isset($_GET['pageNum_fy'])) {
  $pageNum_fy = $_GET['pageNum_fy'];
}
$startRow_fy = $pageNum_fy * $maxRows_fy;

$deger_fy = "-1";
if (isset($_GET['baslikno'])) {
  $deger_fy = $_GET['baslikno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_fy = sprintf("SELECT Y.no, Y.yorum, DATE_FORMAT(Y.zaman, '%%d.%%m.%%Y - %%H:%%i') AS tarihsaat, Y.engelle, CONCAT(K.ad, ' ', K.soyad) AS adsoyad, Y.kimlik FROM lms_forum_yorum Y, lms_kullanici K WHERE Y.kimlik = K.kimlik AND Y.baslikno = %s ORDER BY Y.zaman DESC", GetSQLValueString($deger_fy, "int"));
$query_limit_fy = sprintf("%s LIMIT %d, %d", $query_fy, $startRow_fy, $maxRows_fy);
$fy = mysql_query($query_limit_fy, $lmscon) or die(mysql_error());
$row_fy = mysql_fetch_assoc($fy);

if (isset($_GET['totalRows_fy'])) {
  $totalRows_fy = $_GET['totalRows_fy'];
} else {
  $all_fy = mysql_query($query_fy);
  $totalRows_fy = mysql_num_rows($all_fy);
}
$totalPages_fy = ceil($totalRows_fy/$maxRows_fy)-1;

$deger_baslik = "-1";
if (isset($_SESSION['MM_Username'])) {
  $deger_baslik = $_SESSION['MM_Username'];
}
$degerdort_baslik = "-1";
if (isset($_GET['baslikno'])) {
  $degerdort_baslik = $_GET['baslikno'];
}
$degeruc_baslik = "-1";
if (isset($_GET['subeno'])) {
  $degeruc_baslik = $_GET['subeno'];
}
$degeriki_baslik = "-1";
if (isset($_GET['dersno'])) {
  $degeriki_baslik = $_GET['dersno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_baslik = sprintf("SELECT CONCAT(DE.kod, ' - ', SU.kod, '  ', DE.ad) AS anabaslik, DE.no AS dersno, SU.no AS subeno, CONCAT(K.ad, ' ', K.soyad) AS adsoyad, SU.kimlik, B.baslik, B.aciklama, B.no AS baslikno FROM lms_ders DE, lms_sube SU, lms_sinif SN, lms_forum_baslik B, lms_kullanici K WHERE ((DE.no = SU.dersno) OR (DE.no = SU.dersno AND SN.subeno = SU.no)) AND (SU.kimlik = %s OR SN.kimlik = %s) AND DE.aktif = 'EVET' AND DE.no = %s AND SU.no = %s AND B.kimlik = K.kimlik AND B.no = %s", GetSQLValueString($deger_baslik, "text"),GetSQLValueString($deger_baslik, "text"),GetSQLValueString($degeriki_baslik, "int"),GetSQLValueString($degeruc_baslik, "int"),GetSQLValueString($degerdort_baslik, "text"));
$baslik = mysql_query($query_baslik, $lmscon) or die(mysql_error());
$row_baslik = mysql_fetch_assoc($baslik);
$totalRows_baslik = mysql_num_rows($baslik);

$deger_kontrol = "-1";
if (isset($_GET['baslikno'])) {
  $deger_kontrol = $_GET['baslikno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_kontrol = sprintf("SELECT kilit FROM lms_forum_baslik WHERE no = %s AND kilit = 'HAYIR'", GetSQLValueString($deger_kontrol, "int"));
$kontrol = mysql_query($query_kontrol, $lmscon) or die(mysql_error());
$row_kontrol = mysql_fetch_assoc($kontrol);
$totalRows_kontrol = mysql_num_rows($kontrol);

$queryString_fy = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_fy") == false && 
        stristr($param, "totalRows_fy") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_fy = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_fy = sprintf("&totalRows_fy=%d%s", $totalRows_fy, $queryString_fy);

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
?>
<?php 
//Geri Donus
$linka = "forum.php?dersno=".$row_baslik['dersno']."&subeno=".$row_baslik['subeno'];
$linkb = "forum2.php?dersno=".$row_baslik['dersno']."&subeno=".$row_baslik['subeno'];
if($row_tanitim['yetki'] < 4){
$link = $linka;
} else {
$link = $linkb;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
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
.style1 {color: #CC0000}
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
         <td width="7%"><a href="<?php echo $link; ?>"><img src="simgeler/back_24.gif" alt="Geri dön" width="24" height="24" border="0" /></a></td>
         <td width="93%"><?php echo $row_baslik['anabaslik']; ?></td>
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
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="60%" valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="5">
           <tr>
             <td colspan="3" valign="top" nowrap="nowrap" class="baslik"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                 <tr>
                   <td width="96%" valign="top"><?php echo $row_baslik['baslik']; ?></td>
                   <td width="4%" valign="top"><?php if ($totalRows_kontrol == 0) { // Show if recordset empty ?>
                       <img src="simgeler/lock_24.gif" alt="Forum başlığı kilitli" width="24" height="24" />
                       <?php } // Show if recordset empty ?>
</td>
                 </tr>
               </table></td>
             </tr>
           <tr>
             <td width="15%" valign="top" nowrap="nowrap" class="icyazi"><strong>Açıklama</strong></td>
             <td width="2%" valign="top" class="icyazi">               <p><strong>:</strong></p></td>
             <td width="83%" valign="top" class="icyazi"><?php echo $row_baslik['aciklama']; ?></td>
           </tr>
           <tr>
             <td valign="top" nowrap="nowrap" class="icyazi"><span class="icyazi"><strong>Forum Sorumlusu</strong></span></td>
             <td valign="top" class="icyazi"><strong>:</strong></td>
             <td valign="top" class="icyazi"><a href="profil.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."kimlik=".$row_baslik['kimlik'] ?>" class="icyazi"><?php echo $row_baslik['adsoyad']; ?></a></td>
           </tr>
           
           
         </table>
           
           
           <?php if ($totalRows_fy == 0) { // Show if recordset empty ?>
             <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tr>
                  <td><p class="arabaslik"><br />
                    Bu başlık altında şu an için yapılmış yorum yok.</p>                  </td>
                </tr>
                        </table>
             <?php } // Show if recordset empty ?>
             <?php if ($totalRows_fy > 0) { // Show if recordset not empty ?>
  <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <?php do { ?>
        <tr>
          <td colspan="5" valign="top"><hr size="1" /></td>
        </tr>
       <tr>
         <td width="10%" valign="top" nowrap="nowrap"><span class="icyazi"><a href="profil.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."kimlik=".$row_fy['kimlik'] ?>"><strong><?php echo $row_fy['adsoyad']; ?></strong></a></span></td>
         <td colspan="4" valign="top" class="icyazi"><div align="right"><strong><?php echo $row_fy['tarihsaat']; ?></strong></div></td>
         </tr>
           <tr>
             <td colspan="2" valign="top" class="icyazi">
			 <?php if ($row_fy['engelle'] == 0) {?>
			 <?php echo str_replace("\n","<br>", htmlspecialchars($row_fy['yorum'], ENT_QUOTES));?>
             <?php } else {?>
             <span class="style1">Bu yorum, içeriği forum kurallarına uymadığı için <strong>engellenmiştir</strong>.</span>
             <?php }?>             </td>
             <?php if ($row_tanitim['yetki'] < 4) {?>
             <?php if ($row_fy['engelle'] == 0) {?>
             <td width="1%" valign="top"><a href="forum_yorum_kontrol.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."yorumno=".$row_fy['no']."&engelle=1" ?>" title="Engelle"><img src="simgeler/pause_16.gif" alt="Engelle" width="16" height="16" border="0" /></a></td>
             <?php }?>
             <?php if ($row_fy['engelle'] == 1) {?>
             <td width="1%" valign="top"><a href="forum_yorum_kontrol.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."yorumno=".$row_fy['no']."&engelle=0" ?>" title="Göster"><img src="simgeler/play_16.gif" alt="Göster" width="16" height="16" border="0" /></a></td>
             <?php }?>
			 <?php }?>
             <?php if ($row_kontrol['kilit'] == "HAYIR") {?>
             <?php if ($row_fy['kimlik'] == $row_tanitim['kimlik']) {?>
             <?php if ($row_fy['engelle'] == 0) {?>
             <td width="1%" valign="top"><a href="forum_yorum_guncelle.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."yorumno=".$row_fy['no'] ?>" title="Güncelle"><img src="simgeler/edit_16.gif" alt="Güncelle" width="16" height="16" border="0" /></a></td>
             <?php }?>
			 <?php }?>
			 <?php }?>
           </tr>
      
        <?php } while ($row_fy = mysql_fetch_assoc($fy)); ?>
    <tr>
      <td colspan="5" valign="top"><div align="center">
        <table border="0">
          <tr>
            <td><?php if ($pageNum_fy > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_fy=%d%s", $currentPage, 0, $queryString_fy); ?>"><img src="resimler/First.gif" border="0" /></a>
                <?php } // Show if not first page ?>            </td>
            <td><?php if ($pageNum_fy > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_fy=%d%s", $currentPage, max(0, $pageNum_fy - 1), $queryString_fy); ?>"><img src="resimler/Previous.gif" border="0" /></a>
                <?php } // Show if not first page ?>            </td>
            <td><?php if ($pageNum_fy < $totalPages_fy) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_fy=%d%s", $currentPage, min($totalPages_fy, $pageNum_fy + 1), $queryString_fy); ?>"><img src="resimler/Next.gif" border="0" /></a>
                <?php } // Show if not last page ?>            </td>
            <td><?php if ($pageNum_fy < $totalPages_fy) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_fy=%d%s", $currentPage, $totalPages_fy, $queryString_fy); ?>"><img src="resimler/Last.gif" border="0" /></a>
                <?php } // Show if not last page ?>            </td>
          </tr>
        </table>
      </div></td>
                </tr>
             </table>
  <?php } // Show if recordset not empty ?></td>
         <td valign="top"><table width="90%" border="0" align="right" cellpadding="5" cellspacing="5">
           <tr>
             <td width="100%" class="baslik">Forum İstatistikleri</td>
             </tr>
           <tr>
             <td nowrap="nowrap" class="icyazi"><table border="0" cellspacing="2" cellpadding="3">
               <tr>
                 <td nowrap="nowrap" class="icyazi"><strong>Toplam Yorum Sayısı</strong></td>
                 <td class="icyazi"><strong>:</strong></td>
                 <td class="icyazi"><?php echo $totalRows_fy ?> </td>
               </tr>
               <tr>
                 <td nowrap="nowrap" class="icyazi"><strong>Gösterilen Yorum Aralığı</strong></td>
                 <td class="icyazi"><strong>:</strong></td>
                 <td class="icyazi"><?php echo ($startRow_fy + 1) ?> - <?php echo min($startRow_fy + $maxRows_fy, $totalRows_fy) ?></td>
               </tr>

             </table></td>
             </tr>
           <tr>
             <td nowrap="nowrap" class="icyazi"><span class="baslik">Forum İşlemleri</span></td>
             </tr>
           <tr>
             <td nowrap="nowrap" class="icyazi"><table width="100%" border="0" cellspacing="2" cellpadding="3">
               <?php if ($totalRows_kontrol == 0) { // Show if recordset empty ?>
                 <tr>
                   <td valign="top"><img src="simgeler/lock_16.gif" alt="Forum başlığı kilitli" width="16" height="16" /></td>
                   <td>Bu forum başlığı forum sorumlusu tarafından kilitlenmiştir. Yeni bir yorum eklenemez.</td>
                 </tr>
                 <?php } // Show if recordset empty ?>
               <?php if ($totalRows_kontrol > 0) { // Show if recordset not empty ?>
                 <tr>
                   <td width="8%"><img src="simgeler/add_16.gif" alt="Yorum Ekle" /></td>
                   <td width="92%"><a href="forum_yorum.php?<?php echo $MM_keepURL; ?>">Yorum Ekle</a></td>
                 </tr>
                 <?php } // Show if recordset not empty ?>

               <tr>
                 <td><img src="simgeler/mail_16.gif" width="16" height="16" /></td>
                 <td><a href="profil_mesaj.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."kimlik=".$row_baslik['kimlik'] ?>">Forum sorumlusuna mesaj gönder</a></td>
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

mysql_free_result($fy);

mysql_free_result($baslik);

mysql_free_result($kontrol);
?>
