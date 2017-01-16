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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO lms_forum_baslik (dersno, subeno, kimlik, baslik, aciklama) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['dersno'], "int"),
                       GetSQLValueString($_POST['subeno'], "int"),
                       GetSQLValueString($_POST['kimlik'], "text"),
                       GetSQLValueString($_POST['baslik'], "text"),
                       GetSQLValueString($_POST['aciklama'], "text"));

  mysql_select_db($database_lmscon, $lmscon);
  $Result1 = mysql_query($insertSQL, $lmscon) or die(mysql_error());

  $insertGoTo = "forum.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
$degeriki_ders = "-1";
if (isset($_GET['dersno'])) {
  $degeriki_ders = $_GET['dersno'];
}
$degeruc_ders = "-1";
if (isset($_GET['subeno'])) {
  $degeruc_ders = $_GET['subeno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_ders = sprintf("SELECT DISTINCT B.no AS baslikno, B.baslik AS forumbaslik, B.aciklama AS forumaciklama, DATE_FORMAT(tarih, '%%d.%%m.%%Y - %%H:%%i') AS zaman FROM lms_ders DE, lms_sube SU, lms_forum_baslik B WHERE DE.no = SU.dersno AND SU.kimlik = %s AND DE.no = %s AND SU.no = %s AND B.dersno = DE.no AND B.subeno = SU.no ORDER BY B.tarih DESC", GetSQLValueString($deger_ders, "text"),GetSQLValueString($degeriki_ders, "int"),GetSQLValueString($degeruc_ders, "int"));
$ders = mysql_query($query_ders, $lmscon) or die(mysql_error());
$row_ders = mysql_fetch_assoc($ders);
$totalRows_ders = mysql_num_rows($ders);

$deger_baslik = "-1";
if (isset($_SESSION['MM_Username'])) {
  $deger_baslik = $_SESSION['MM_Username'];
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
$query_baslik = sprintf("SELECT CONCAT(DE.kod, ' - ', SU.kod, '  ', DE.ad) AS anabaslik, DE.no AS dersno, SU.no AS subeno FROM lms_ders DE, lms_sube SU WHERE DE.no = SU.dersno AND SU.kimlik = %s AND DE.no = %s AND SU.no = %s", GetSQLValueString($deger_baslik, "text"),GetSQLValueString($degeriki_baslik, "int"),GetSQLValueString($degeruc_baslik, "int"));
$baslik = mysql_query($query_baslik, $lmscon) or die(mysql_error());
$row_baslik = mysql_fetch_assoc($baslik);
$totalRows_baslik = mysql_num_rows($baslik);

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
function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
function YY_checkform() { //v4.66
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(myV)||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('Bilgi formunda eksik / hatalı bilgi var:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
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
         <td width="3%" valign="top"><a href="forumlar.php"><img src="simgeler/back_24.gif" alt="Geri Dön" width="24" height="24" border="0" /></a></td>
         <td width="97%" valign="top"><?php echo $row_baslik['anabaslik']; ?></td>
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
         <td width="60%" class="baslik">Forum Başlıkları</td>
         <td class="baslik">Yeni Başlık Oluştur</td>
        </tr>
       <tr>
         <td valign="top"><?php if ($totalRows_ders == 0) { // Show if recordset empty ?>
             <table width="100%" border="0" cellspacing="2" cellpadding="3">
               <tr>
                  <td class="arabaslik">Bu forum içerisinde açılmış olan başlık bulunmamaktadır.</td>
               </tr>
                      </table>
             <?php } // Show if recordset empty ?>
           <?php if ($totalRows_ders > 0) { // Show if recordset not empty ?>
             <table width="100%" border="0" cellspacing="2" cellpadding="3">
               <?php do { ?>
                 <tr>
                   <td width="4%" valign="top"><img src="simgeler/docs_16.gif" width="16" height="16" /></td>
                   <td width="75%" class="arabaslik"><a href="forum_baslik.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."baslikno=".$row_ders['baslikno'] ?>"><?php echo $row_ders['forumbaslik']; ?></a></td>
                   <td colspan="3" nowrap="nowrap" class="arabaslik"><div align="right"><?php echo $row_ders['zaman']; ?></div></td>
                 </tr>
                 <tr>
                   <td>&nbsp;</td>
                   <td valign="top" class="icyazi"><?php echo $row_ders['forumaciklama']; ?></td>
                   <?php if ($row_tanitim['yetki'] < 5) {?>
                   <td valign="bottom" class="icyazi"><div align="right"><strong> İşlemler:</strong></div></td>
                   <td valign="bottom" class="icyazi"><a href="forum_baslik_sil.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."baslikno=".$row_ders['baslikno'] ?>" title="Sil"><img src="simgeler/del_16.gif" alt="Sil" width="16" height="16" border="0" onclick="GP_popupConfirmMsg('Forum içerisindeki başlık kalıcı olarak silinecektir!');return document.MM_returnValue" /></a></td>
                   <td valign="bottom" class="icyazi"><a href="forum_baslik_guncelle.php?<?php echo $MM_keepURL.(($MM_keepURL!="")?"&":"")."baslikno=".$row_ders['baslikno'] ?>" title="Güncelle"><img src="simgeler/edit_16.gif" alt="Güncelle" width="16" height="16" border="0" /></a></td>
                 <?php }?>
                 </tr>
                 <tr>
                   <td>&nbsp;</td>
                   <td colspan="4" class="icyazi"><hr size="1" /></td>
                 </tr>
                 <?php } while ($row_ders = mysql_fetch_assoc($ders)); ?>
             </table>
          <?php } // Show if recordset not empty ?></td>
         <td valign="top"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
           <table width="100%" border="0" cellspacing="2" cellpadding="3">
             <tr>
               <td width="20%" class="icyazi"><strong>Başlık</strong></td>
               <td width="3%" class="icyazi"><strong>:</strong></td>
               <td width="77%"><label>
                 <input name="baslik" type="text" class="metinkutusu" id="baslik" size="30" maxlength="255" />
                 <span class="baslik">*</span></label></td>
             </tr>
             <tr>
               <td valign="top" class="icyazi"><strong>Açıklama</strong></td>
               <td valign="top" class="icyazi"><strong>:</strong></td>
               <td><label>
                 <textarea name="aciklama" cols="35" rows="7" class="metinkutusu" id="aciklama"></textarea>
                 <span class="baslik">*</span></label></td>
             </tr>
             <tr>
               <td><input name="dersno" type="hidden" id="dersno" value="<?php echo $row_baslik['dersno']; ?>" />
                 <input name="subeno" type="hidden" id="subeno" value="<?php echo $row_baslik['subeno']; ?>" />
                 <input name="kimlik" type="hidden" id="kimlik" value="<?php echo $row_tanitim['kimlik']; ?>" /></td>
               <td>&nbsp;</td>
               <td><label>
                 <input name="button" type="submit" class="buton" id="button" onclick="YY_checkform('form1','baslik','#q','0','Başlık','aciklama','1','1','Açıklama','dersno','#q','0','Ders NO','subeno','#q','0','Şube NO','kimlik','#q','0','Kullanıcı Adı');return document.MM_returnValue" value="Yeni Başlık Oluştur" />
               </label></td>
             </tr>
             <tr>
               <td colspan="2"><div align="right"> <span class="baslik">*</span></div></td>
               <td class="icyazi">Doldurulması zorunlu alanlar</td>
             </tr>
           </table>
                  <input type="hidden" name="MM_insert" value="form1" />
         </form>
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

mysql_free_result($baslik);
?>
