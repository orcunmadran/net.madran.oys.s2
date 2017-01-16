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

$colname_tanitim = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_tanitim = $_SESSION['MM_Username'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_tanitim = sprintf("SELECT * FROM lms_kullanici WHERE kimlik = %s", GetSQLValueString($colname_tanitim, "text"));
$tanitim = mysql_query($query_tanitim, $lmscon) or die(mysql_error());
$row_tanitim = mysql_fetch_assoc($tanitim);
$totalRows_tanitim = mysql_num_rows($tanitim);

$deger_ders = "-1";
if (isset($_SESSION['MM_Username'])) {
  $deger_ders = $_SESSION['MM_Username'];
}
$degeruc_ders = "-1";
if (isset($_GET['subeno'])) {
  $degeruc_ders = $_GET['subeno'];
}
$degeriki_ders = "-1";
if (isset($_GET['dersno'])) {
  $degeriki_ders = $_GET['dersno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_ders = sprintf("SELECT DE.*, SU.kod AS subekodu FROM lms_ders DE, lms_sube SU WHERE DE.no = SU.dersno AND SU.kimlik = %s AND DE.no = %s AND SU.no = %s", GetSQLValueString($deger_ders, "text"),GetSQLValueString($degeriki_ders, "int"),GetSQLValueString($degeruc_ders, "int"));
$ders = mysql_query($query_ders, $lmscon) or die(mysql_error());
$row_ders = mysql_fetch_assoc($ders);
$totalRows_ders = mysql_num_rows($ders);

$deger_dok = "-1";
if (isset($_GET['dersno'])) {
  $deger_dok = $_GET['dersno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_dok = sprintf("SELECT * FROM lms_dokuman WHERE dersno = %s ORDER BY orjinalad", GetSQLValueString($deger_dok, "int"));
$dok = mysql_query($query_dok, $lmscon) or die(mysql_error());
$row_dok = mysql_fetch_assoc($dok);
$totalRows_dok = mysql_num_rows($dok);

$colname_cev = "-1";
if (isset($_GET['dersno'])) {
  $colname_cev = $_GET['dersno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_cev = sprintf("SELECT * FROM lms_cevrimici WHERE dersno = %s ORDER BY baslik ASC", GetSQLValueString($colname_cev, "int"));
$cev = mysql_query($query_cev, $lmscon) or die(mysql_error());
$row_cev = mysql_fetch_assoc($cev);
$totalRows_cev = mysql_num_rows($cev);

$colname_prj = "-1";
if (isset($_GET['dersno'])) {
  $colname_prj = $_GET['dersno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_prj = sprintf("SELECT *, DATE_FORMAT(teslim, '%%d.%%m.%%Y') AS tarih FROM lms_proje WHERE dersno = %s ORDER BY orjinalad ASC", GetSQLValueString($colname_prj, "int"));
$prj = mysql_query($query_prj, $lmscon) or die(mysql_error());
$row_prj = mysql_fetch_assoc($prj);
$totalRows_prj = mysql_num_rows($prj);

$veri_sb = "-1";
if (isset($_GET['subeno'])) {
  $veri_sb = $_GET['subeno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_sb = sprintf("SELECT GN.gun AS tamgun, SU.* FROM lms_sube_sohbet SU, lms_gunler GN WHERE SU.gun = GN.deger AND SU.subeno = %s ORDER BY GN.no", GetSQLValueString($veri_sb, "int"));
$sb = mysql_query($query_sb, $lmscon) or die(mysql_error());
$row_sb = mysql_fetch_assoc($sb);
$totalRows_sb = mysql_num_rows($sb);

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
$_SESSION['dersno'] = $row_ders['no'];
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
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
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
         <td width="3%" valign="top"><a href="dersler.php"><img src="simgeler/back_24.gif" alt="Geri Dön" width="24" height="24" border="0" /></a></td>
         <td width="97%" valign="top"><?php echo $row_ders['kod']; ?> - <?php echo $row_ders['subekodu']; ?>  <?php echo $row_ders['ad']; ?></td>
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
         <td width="60%" valign="top"><?php echo $row_ders['izlence']; ?></td>
         <td width="40%" valign="top">
         <?php if ($totalRows_ders > 0) {?>
			<table width="100%" border="0" align="right" cellpadding="5" cellspacing="5">
           <tr>
             <td width="88%" class="baslik">Eğitim Araçları</td>
             <td width="12%" class="baslik"><a href="yonetim_sube_ogrenci_liste.php?<?php echo $MM_keepURL; ?>" title="Sınıf listesini görüntüle" target="_blank"><img src="simgeler/paste_24.gif" alt="Sınıf listesini görüntüle" width="24" height="24" border="0" /></a></td>
           </tr>
           <tr>
             <td colspan="2"><span class="arabaslik">Etkileşimli Eğitim</span></td>
           </tr>
           <tr>
             <td colspan="2"><table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC">
                <?php if ($row_ders['etkilesim'] == "HAYIR") { ?>
               <tr>
                 <td colspan="2" bordercolor="#FFFFFF" class="icyazi">Bu ders için oluşturulmuş etkileşimli eğitim yok.</td>
               </tr>
               <?php } ?>
               <?php if ($row_ders['etkilesim'] == "EVET") { ?>
               <tr>
                 <td width="7%" bordercolor="#FFFFFF"><a href="#"><img src="simgeler/hd_16.gif" alt="Eğitimi Başlat" width="16" height="16" border="0" onclick="MM_openBrWindow('etkilesim/<?php echo $row_ders['no']; ?>/egitim.html','','resizable=yes,width=820,height=570')" /></a></td>
                 <td width="93%" bordercolor="#FFFFFF" class="icyazi"><a href="#" onclick="MM_openBrWindow('etkilesim/<?php echo $row_ders['no']; ?>/egitim.html','','resizable=yes,width=820,height=570')">Eğitimi Başlat</a></td>
               </tr>
               <?php } ?>
             </table></td>
           </tr>
           <tr>
             <td colspan="2" class="arabaslik">Kaynak Dokümanlar</td>
           </tr>
           <tr>
             <td colspan="2"><table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC">
               <?php if ($totalRows_dok == 0) { // Show if recordset empty ?>
                 <tr>
                   <td colspan="2" bordercolor="#FFFFFF" class="icyazi">Bu ders için sisteme yüklenmiş doküman yok.</td>
                 </tr>
                 <?php } // Show if recordset empty ?>
                 <?php do { ?>
                   <?php if ($totalRows_dok > 0) { // Show if recordset not empty ?>
                     <tr>
                       <td width="4%" bordercolor="#FFFFFF" class="icyazi"><img src="simgeler/copy_16.gif" alt="Güncelleme: <?php echo $row_dok['guncelleme']; ?>" width="16" height="16" /></td>
                       <td width="96%" valign="top" bordercolor="#FFFFFF" class="icyazi"><a href="dokumanlar/<?php echo $row_dok['dersno']; ?>_<?php echo $row_dok['dosyaadi']; ?>" target="_blank"><?php echo $row_dok['orjinalad']; ?></a></td>
                     </tr>
                     <?php } // Show if recordset not empty ?>
                   <?php } while ($row_dok = mysql_fetch_assoc($dok)); ?>
             </table></td>
           </tr>
           <tr>
             <td colspan="2" class="arabaslik">Çevrimiçi Kaynaklar</td>
           </tr>
           <tr>
             <td colspan="2"><table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC">
               <?php if ($totalRows_cev == 0) { // Show if recordset empty ?>
                 <tr>
                   <td colspan="2" bordercolor="#FFFFFF" class="icyazi">Bu ders için tanımlanmış çevrimiçi kaynak yok.</td>
                 </tr>
                 <?php } // Show if recordset empty ?>
               <?php do { ?>
                 <?php if ($totalRows_cev > 0) { // Show if recordset not empty ?>
                   <tr>
                     <td width="3%" valign="top" bordercolor="#FFFFFF"><img src="simgeler/web_16.gif" alt="Eklenme tarihi: <?php echo $row_cev['eklenti']; ?> " width="16" height="16" /></td>
                     <td width="97%" valign="top" bordercolor="#FFFFFF" class="icyazi"><a href="<?php echo $row_cev['adres']; ?>" target="_blank"><?php echo $row_cev['baslik']; ?></a></td>
                   </tr>
                   <?php } // Show if recordset not empty ?>
                 <?php } while ($row_cev = mysql_fetch_assoc($cev)); ?>
             </table></td>
           </tr>
           <tr>
             <td colspan="2" class="arabaslik">Ödevler ve Projeler</td>
           </tr>
           <tr>
             <td colspan="2" class="icyazi"><table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC">
               <?php if ($totalRows_prj == 0) { // Show if recordset empty ?>
                 <tr>
                   <td colspan="4" bordercolor="#FFFFFF">Bu ders için belirlenmiş ödev / proje yok.</td>
                 </tr>
                 <?php } // Show if recordset empty ?>
				<?php if ($totalRows_prj > 0) { ?>
                 <tr>
                 <td bordercolor="#FFFFFF">&nbsp;</td>
                 <td bordercolor="#FFFFFF"><strong>Doküman</strong></td>
                 <td nowrap="nowrap" bordercolor="#FFFFFF"><div align="center"><strong>Teslim</strong> <span class="icyazi"><strong>T.</strong></span></div></td>
                 <td bordercolor="#FFFFFF" class="icyazi"><div align="center"><strong>İşlemler</strong></div></td>
               </tr>
                 <?php do { ?>
                   <tr>
                     <td width="10%" valign="top" bordercolor="#FFFFFF"><img src="simgeler/adfav_16.gif" alt="Güncellenme Tarihi: <?php echo $row_prj['guncelleme']; ?>" width="16" height="16" /></td>
                     <td width="60%" valign="top" bordercolor="#FFFFFF" class="icyazi"><a href="projeler/<?php echo $row_prj['dersno']; ?>_<?php echo $row_prj['dosyaadi']; ?>" target="_blank"><?php echo $row_prj['orjinalad']; ?></a></td>
                     <td width="23%" valign="top" bordercolor="#FFFFFF" class="icyazi"><div align="center"><?php echo $row_prj['tarih']; ?></div></td>
                     <td width="7%" valign="top" bordercolor="#FFFFFF" class="icyazi"><div align="center">
                     <?php if($row_tanitim['yetki'] == 5) {?>
                     <a href="ders_proje.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."projeno=".$row_prj['no'] ?>" title="Ödev / Proje gönder, güncelle, ayrıntı gör"><img src="simgeler/exp_16.gif" alt="Ödev / Proje gönder, güncelle, ayrıntı gör" width="16" height="16" border="0" /></a>
					 <?php }?>
                     <?php if($row_tanitim['yetki'] < 4) {?>
                     <a href="ders_proje_degerlendir.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."projeno=".$row_prj['no'] ?>" title="Ödev / Proje Değerlendir"><img src="simgeler/edit_16.gif" alt="Ödev / Proje Değerlendir" width="16" height="16" border="0" /></a>
                     <?php }?>
                     </div></td></tr>
                   <?php } while ($row_prj = mysql_fetch_assoc($prj)); ?>
                   <?php } ?>
             </table></td>
           </tr>
           <tr>
             <td colspan="2" class="icyazi"><span class="baslik">İletişim Araçları</span></td>
           </tr>
           <tr>
             <td colspan="2" class="icyazi"><table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC">
               <tr>
                 <td width="11%" bordercolor="#FFFFFF"><img src="simgeler/docs_16.gif" alt="Forum Adı: <?php echo $row_ders['ad']; ?>" width="16" height="16" /></td>
                 <td width="89%" bordercolor="#FFFFFF"><a href="forum.php?<?php echo $MM_keepURL; ?>">Dersin Tartışma Grubu (Forum).</a></td>
               </tr>
             </table></td>
           </tr>
           <tr>
             <td colspan="2" class="icyazi"><span class="arabaslik">Sohbet Odaları</span></td>
           </tr>
           <tr>
             <td colspan="2" class="icyazi"><table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC">
               <?php if ($totalRows_sb == 0) { // Show if recordset empty ?>
               <tr>
                 <td colspan="5" bordercolor="#FFFFFF" class="icyazi">Bu ders için belirlenmiş sohbet saati yok.</td>
               </tr>
               <?php } // Show if recordset empty ?>
               <?php if ($totalRows_sb > 0) { // Show if recordset not empty ?>
                 <tr>
                   <td valign="top" bordercolor="#FFFFFF">&nbsp;</td>
                   <td width="1%" valign="top" bordercolor="#FFFFFF" class="icyazi"><strong>Gün</strong></td>
                   <td width="1%" valign="top" bordercolor="#FFFFFF" class="icyazi"><div align="center"><strong>Saat</strong></div></td>
                   <td valign="top" bordercolor="#FFFFFF" class="icyazi"><strong>Oda</strong></td>
                   <td width="1%" valign="top" bordercolor="#FFFFFF" class="icyazi"><strong>Şifre</strong></td>
                 </tr>
                 <?php do { ?>
                   <tr>
                     <td width="3%" valign="top" bordercolor="#FFFFFF"><img src="simgeler/group_16.gif" width="16" height="16" /></td>
                     <td width="13%" valign="top" bordercolor="#FFFFFF" class="icyazi"><?php echo $row_sb['tamgun']; ?></td>
                     <td width="12%" valign="top" bordercolor="#FFFFFF" class="icyazi"><div align="center"><?php echo $row_sb['saat']; ?></div></td>
                     <td width="99%" valign="top" bordercolor="#FFFFFF" class="icyazi"><?php echo $row_sb['ad']; ?></td>
                     <td width="48%" valign="top" bordercolor="#FFFFFF" class="icyazi"><?php echo $row_sb['sifre']; ?></td>
                   </tr>
                   <?php } while ($row_sb = mysql_fetch_assoc($sb)); ?>
                 <?php } // Show if recordset not empty ?>
             </table></td>
           </tr>
         </table>
         <?php }?>
          </td>
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

mysql_free_result($ders);

mysql_free_result($dok);

mysql_free_result($cev);

mysql_free_result($prj);

mysql_free_result($sb);
?>
