<?php require_once('Connections/lmscon.php'); ?>
<?php require_once('Connections/lmscon.php'); ?>
<?php require_once('Connections/lmscon.php'); ?>
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

mysql_select_db($database_lmscon, $lmscon);
$query_ogrenciler = "SELECT kimlik, CONCAT(kimlik, ' - ', ad, ' ', soyad) AS bilgi FROM lms_kullanici WHERE yetki = 5 ORDER BY kimlik ASC";
$ogrenciler = mysql_query($query_ogrenciler, $lmscon) or die(mysql_error());
$row_ogrenciler = mysql_fetch_assoc($ogrenciler);
$totalRows_ogrenciler = mysql_num_rows($ogrenciler);

$deger_subebilgi = "-1";
if (isset($_GET['subeno'])) {
  $deger_subebilgi = $_GET['subeno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_subebilgi = sprintf("SELECT D.kod AS dersKod, D.ad AS dersAd, S.kod, S.subeadi, CONCAT(K.ad, ' ', K.soyad) AS adsoyad FROM lms_sube S, lms_ders D, lms_kullanici K WHERE S.no = %s AND S.dersno = D.no AND S.kimlik = K.kimlik", GetSQLValueString($deger_subebilgi, "int"));
$subebilgi = mysql_query($query_subebilgi, $lmscon) or die(mysql_error());
$row_subebilgi = mysql_fetch_assoc($subebilgi);
$totalRows_subebilgi = mysql_num_rows($subebilgi);

$deger_liste = "-1";
if (isset($_GET['subeno'])) {
  $deger_liste = $_GET['subeno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_liste = sprintf("SELECT SN.no, SN.kimlik, CONCAT(K.ad, ' ', K.soyad) AS adsoyad FROM lms_sinif SN, lms_sube SB, lms_kullanici K WHERE SN.subeno = %s AND SN.subeno = SB.no AND SN.kimlik = K.kimlik ORDER BY K.soyad ", GetSQLValueString($deger_liste, "int"));
$liste = mysql_query($query_liste, $lmscon) or die(mysql_error());
$row_liste = mysql_fetch_assoc($liste);
$totalRows_liste = mysql_num_rows($liste);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>::: Öğretim Yönetim Sistemi :::</title>

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

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<link href="lms.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--

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
  if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
//-->
function olustur(){
	var ob= document.form1.ogrenci.value;
	var sb = document.form1.subeadi.value;
	document.form1.kimlik.value=ob
	document.form1.kontrol.value=ob+ "." +sb;
	}
function olustur2(){
	var ob= document.form1.kimlik.value;
	var sb = document.form1.subeadi.value;
	document.form1.kontrol.value=ob+ "." +sb;
	}
</script>

<style type="text/css">
<!--
body {
	margin-top: 25px;
}
.style1 {
	font-size: 24px
}
-->
</style>
</head>
<body bgcolor="#ffffff">
<table width="500" border="1" align="center" cellpadding="5" cellspacing="5" bordercolor="#FFFFFF">
  <tr>
    <td width="50" class="ustbaslik style1"><img src="resimler/baskent_logo.gif" /></td>
    <td width="311" class="baslik">Başkent Üniversitesi</td>
    <td width="32"><a href="javascript:window.print()"><img src="simgeler/print_32.gif" alt="Yazdır" width="32" height="32" border="0" /></a></td>
    <td width="32"><a href="javascript:window.close()"><img src="simgeler/close_32.gif" alt="Kapat" width="32" height="32" border="0" /></a></td>
  </tr>
  
  <tr>
    <td colspan="4" bordercolor="#000000"><table border="0" cellspacing="2" cellpadding="3">
      <tr>
        <td nowrap="nowrap" class="icyazi"><strong>Dersin Kodu</strong></td>
        <td class="icyazi"><strong>:</strong></td>
        <td class="icyazi"><?php echo $row_subebilgi['dersKod']; ?></td>
      </tr>
      <tr>
        <td nowrap="nowrap" class="icyazi"><strong>Dersin Kodu Adı</strong></td>
        <td class="icyazi"><strong>:</strong></td>
        <td class="icyazi"><?php echo $row_subebilgi['dersAd']; ?></td>
      </tr>
      <tr>
        <td nowrap="nowrap" class="icyazi"><strong>Şube Kodu</strong></td>
        <td class="icyazi"><strong>:</strong></td>
        <td class="icyazi"><?php echo $row_subebilgi['kod']; ?></td>
      </tr>
      <tr>
        <td nowrap="nowrap" class="icyazi"><strong>Şube Sorumlusu</strong></td>
        <td class="icyazi"><strong>:</strong></td>
        <td class="icyazi"><?php echo $row_subebilgi['adsoyad']; ?></td>
      </tr>
      <tr>
        <td class="icyazi"><strong>Sınıf Mevcudu</strong></td>
        <td class="icyazi"><strong>:</strong></td>
        <td class="icyazi"><?php echo $totalRows_liste ?> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" bordercolor="#000000"><table width="100%" border="1" cellpadding="3" cellspacing="2" bordercolor="#FFFFFF">
      <?php if ($totalRows_liste == 0) { ?>
      <?php } ?>
      <?php if ($totalRows_liste > 0) { ?>
      <tr>
        <td width="25%" nowrap="nowrap" class="icyazi"><div align="center"><strong>Öğrenci No</strong></div></td>
        <td width="4%" nowrap="nowrap" class="icyazi">&nbsp;</td>
        <td width="45%" nowrap="nowrap" class="icyazi"><strong>Ad Soyad</strong></td>
        <td width="25%" nowrap="nowrap" bgcolor="#CCCCCC" class="icyazi">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" nowrap="nowrap" class="icyazi"><hr align="center" size="1" /></td>
      </tr>
      <?php do { ?>
      <tr>
        <td nowrap="nowrap" class="icyazi"><div align="center"><?php echo $row_liste['kimlik']; ?></div></td>
        <td nowrap="nowrap" class="icyazi"> <div align="center">- </div></td>
        <td nowrap="nowrap" class="icyazi"><?php echo $row_liste['adsoyad']; ?></td>
        <td nowrap="nowrap" bordercolor="#000000">&nbsp;</td>
      </tr>
      <?php } while ($row_liste = mysql_fetch_assoc($liste)); ?>
      <?php } ?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center" class="icyazi">&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($tanitim);

mysql_free_result($ogrenciler);

mysql_free_result($subebilgi);

mysql_free_result($liste);
?>
