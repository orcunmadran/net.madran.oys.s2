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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO lms_mesaj (gonderen, alici, konu, icerik) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['gonderen'], "text"),
                       GetSQLValueString($_POST['alici'], "text"),
                       GetSQLValueString($_POST['konu'], "text"),
                       GetSQLValueString($_POST['icerik'], "text"));

  mysql_select_db($database_lmscon, $lmscon);
  $Result1 = mysql_query($insertSQL, $lmscon) or die(mysql_error());

  $insertGoTo = "mesaj_gonderilen.php";
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

mysql_select_db($database_lmscon, $lmscon);
$query_adres = "SELECT kimlik, ad, soyad, CONCAT(ad, ' ', soyad, ' - ', kimlik) AS bilgi FROM lms_kullanici ORDER BY ad ASC";
$adres = mysql_query($query_adres, $lmscon) or die(mysql_error());
$row_adres = mysql_fetch_assoc($adres);
$totalRows_adres = mysql_num_rows($adres);
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
<script type="text/javascript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
function ekle(){
	document.form1.alici.value += document.form2.adresdefteri.value+" ";
}
function temizle(){
	document.form1.alici.value = "";
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
  if (myErr!=''){alert('Mesaj formunda eksik / hatalı bilgi var:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
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
         <td width="7%"><a href="javascript:history.back()"><img src="simgeler/back_24.gif" alt="Geri dön" width="24" height="24" border="0" /></a></td>
         <td width="93%">Yeni Mesaj Oluştur</td>
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
         <td width="60%" valign="top"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
           <table width="100%" border="0" cellspacing="5" cellpadding="5">

             <tr>
               <td width="15%" class="icyazi"><div align="left"><strong>Gönderen</strong></div></td>
               <td width="2%" class="icyazi"><strong>:</strong></td>
               <td class="icyazi"><?php echo $row_tanitim['ad']; ?> <?php echo $row_tanitim['soyad']; ?> <input name="gonderen" type="hidden" id="gonderen" value="<?php echo $row_tanitim['kimlik']; ?>" /></td>
             </tr>
             <tr>
               <td valign="top" class="icyazi"><div align="left"><strong>Alıcı</strong></div></td>
               <td valign="top" class="icyazi"><strong>:</strong></td>
               <td valign="top" class="icyazi"><label>
                 <textarea name="alici" cols="50" rows="3" class="metinkutusu" id="alici"></textarea>
               </label>                 <label class="baslik">*</label></td>
               </tr>
             <tr>
               <td class="icyazi"><div align="left"><strong>Konu</strong></div></td>
               <td class="icyazi"><strong>:</strong></td>
               <td class="icyazi"><input name="konu" type="text" class="metinkutusu" id="konu" size="55" maxlength="100" />
                 <span class="baslik">                 *</span></td>
             </tr>
             <tr>
               <td valign="top" class="icyazi"><div align="left"><strong>Mesaj</strong></div></td>
               <td valign="top" class="icyazi"><strong>:</strong></td>
               <td valign="top" class="icyazi"><label>
                 <textarea name="icerik" cols="60" rows="7" class="metinkutusu" id="icerik"></textarea>
                 <span class="baslik">               *</span></label></td>
             </tr>
             <tr>
               <td class="icyazi">&nbsp;</td>
               <td class="icyazi">&nbsp;</td>
               <td class="icyazi"><label>
                 <input name="button" type="submit" class="buton" id="button" onclick="YY_checkform('form1','konu','#q','0','Konu','alici','1','1','Alıcı','icerik','1','1','Mesaj');return document.MM_returnValue" value="Gönder" />
               </label></td>
             </tr>
             <tr>
               <td colspan="2" class="icyazi"><div align="right" class="baslik">*</div></td>
               <td class="icyazi">Doldurulması zorunlu alanlar</td>
             </tr>
           </table>
                  <input type="hidden" name="MM_insert" value="form1" />
         </form>           </td>
         <td valign="top"><form id="form2" name="form2" action="">
           <table width="100%" border="0" cellspacing="5" cellpadding="5">
             <tr>
               <td width="35%" class="arabaslik">Adres Defteri</td>
               <td width="65%" class="arabaslik"><label>
                 <div align="right">
                   <input name="button2" type="button" class="buton" id="button2" onclick="MM_callJS('temizle()')" value="Alıcıları temizle" />
                   </div>
               </label></td>
             </tr>
             <tr>
               <td colspan="2"><hr size="1" /></td>
             </tr>
             <tr>
               <td colspan="2" class="icyazi"><div align="center">Mesaj göndermek istediğini kişi / kişileri seçiniz:</div></td>
             </tr>
             <tr>
               <td colspan="2"><label> </label>
                 <div align="center">
                     <select name="adresdefteri" size="10" class="adresdefteri" id="adresdefteri" onclick="MM_callJS('ekle()')">
                       <?php
do {  
?>
                       <option value="<?php echo $row_adres['kimlik']?>"><?php echo $row_adres['bilgi']?></option>
                       <?php
} while ($row_adres = mysql_fetch_assoc($adres));
  $rows = mysql_num_rows($adres);
  if($rows > 0) {
      mysql_data_seek($adres, 0);
	  $row_adres = mysql_fetch_assoc($adres);
  }
?>
                     </select>
                    </div>
                  </label></td>
             </tr>
           </table>
                    </form>          </td>
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

mysql_free_result($adres);
?>
