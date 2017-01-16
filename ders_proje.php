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

$colname_prj = "-1";
if (isset($_GET['projeno'])) {
  $colname_prj = $_GET['projeno'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_prj = sprintf("SELECT P.*, DATE_FORMAT(P.teslim, '%%d.%%m.%%Y') AS Ttarih, D.ad FROM lms_proje P,  lms_ders D WHERE P.no = %s AND P.dersno = D.no", GetSQLValueString($colname_prj, "int"));
$prj = mysql_query($query_prj, $lmscon) or die(mysql_error());
$row_prj = mysql_fetch_assoc($prj);
$totalRows_prj = mysql_num_rows($prj);

$deger_odev = "-1";
if (isset($_GET['projeno'])) {
  $deger_odev = $_GET['projeno'];
}
$degeriki_odev = "-1";
if (isset($_SESSION['MM_Username'])) {
  $degeriki_odev = $_SESSION['MM_Username'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_odev = sprintf("SELECT O.* FROM lms_odev O, lms_proje P WHERE O.projeno = P.no AND O.projeno = %s AND O.kimlik = %s", GetSQLValueString($deger_odev, "int"),GetSQLValueString($degeriki_odev, "text"));
$odev = mysql_query($query_odev, $lmscon) or die(mysql_error());
$row_odev = mysql_fetch_assoc($odev);
$totalRows_odev = mysql_num_rows($odev);
?>
<?php
$_SESSION['projeno'] = $row_prj['no'];
?>
<?php 
//Teslim Kontrol
if($row_prj['teslim'] >= date('Y-m-d')){
$zamandoldu = 0;
}
else{
$zamandoldu = 1;
}
//Yukleme Kontrol
if($totalRows_odev > 0){
$yuklendi = 1;
}
else{
$yuklendi = 0;
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
         <td width="7%"><a href="ders2.php?dersno=<?php echo $_SESSION['dersno']."&"."subeno=".$_SESSION['subeno']; ?>"><img src="simgeler/back_24.gif" alt="Geri dön" width="24" height="24" border="0" /></a></td>
         <td width="93%">Ödev &amp; Proje</td>
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
         <td width="60%" class="baslik">Ödev &amp; Proje Yükle / Güncelle</td>
         <td class="baslik">Ödev &amp; Proje Ayrıntı</td>
       </tr>
       <tr>
         <td valign="top">
         <?php if($zamandoldu == 1 ) {?>
         <p class="arabaslik">Son teslim tarihi (<em> <?php echo $row_prj['Ttarih']; ?></em> ) geçtiği için yükleme / güncelleme yapmanız mümkün değil.</p>
           <p class="icyazi">Dersin sayfasına dönmek için <a href="ders2.php?dersno=<?php echo $_SESSION['dersno']."&"."subeno=".$_SESSION['subeno']; ?>">tıklayınız</a>.</p>
           <?php }?>
           <?php if($zamandoldu == 0 ) {?>
           <form action="ders_proje2.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
           <table width="100%" border="0" cellpadding="3" cellspacing="2">

             <tr>
               <td colspan="3" class="icyazi"><hr size="1" /></td>
             </tr>
             <tr>
               <td width="99" nowrap="nowrap" class="icyazi"><strong>Dokümanı Seç</strong></td>
               <td width="4" class="icyazi"><strong>:</strong></td>
               <td width="342"><input name="dosya" type="file" class="metinkutusu" id="dosya" />
                   <span class="baslikMAVI">*</span></td>
             </tr>
             <tr>
               <td><input name="no" type="hidden" id="no" value="<?php echo $row_prj['no']; ?>" />
                 <input name="yuklendi" type="hidden" id="yuklendi" value="<?php echo $yuklendi; ?>" />
                 <input name="yuklenenad" type="hidden" id="yuklenenad" value="<?php echo $row_odev['dosyaadi']; ?>" /></td>
               <td>&nbsp;</td>
               <td><input name="button" type="submit" class="buton" id="button" value="Doküman Yükle" /></td>
             </tr>
             <tr>
               <td colspan="3"><hr size="1" /></td>
             </tr>
           </table>
           <table width="100%" border="0" cellpadding="3" cellspacing="2">

             <tr>
               <td width="3%" valign="top"><span class="baslikMAVI">*</span></td>
               <td width="97%" valign="top" class="icyazi">Yüklemiş olduğunuz bir dokümanı güncellemek için dosyayı yeniden yüklemeniz yeterli olacaktır.</td>
             </tr>
             <tr>
               <td colspan="2" valign="top"><span class="arabaslik">Doküman  ile ilgili sınırlamalar</span></td>
             </tr>
             <tr>
               <td colspan="2" valign="top"><ul>
                   <li class="icyazi">Birden fazla dosya yüklemek istediğinizde dosyaları sıkıştırılmış dosya formatında (zip) sisteme yükleyebilirsiniz.</li>
                   <li class="icyazi">Yükleyeceğiniz dokümanın dosya uzantısı exe, com, bat, js, htm, html ve php olmamalıdır. (Yasaklanmış dosya uzantılarına sahip dosyaları sisteme yüklemek istiyorsanız bu dosyaları sıkıştırılmış dosya formatında (zip) sisteme yükleyebilirsiniz.)</li>
                   <li class="icyazi">Dokümanınızın dosya büyüklüğü 2000 KB'ın üzerinde olmamalıdır.</li>
               </ul></td>
             </tr>
           </table>
         </form>
         <?php }?>
         </td>
         <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
           <tr>
             <td width="29%" valign="top" nowrap="nowrap" class="icyazi"><strong>Dersin Adı</strong></td>
             <td width="3%" valign="top" class="icyazi"><strong>:</strong></td>
             <td width="68%" valign="top" class="icyazi"><?php echo $row_prj['ad']; ?></td>
           </tr>
           <tr>
             <td valign="top" nowrap="nowrap" class="icyazi"><strong>Ödev &amp; Proje</strong></td>
             <td valign="top" class="icyazi"><strong>:</strong></td>
             <td valign="top" class="icyazi"><a href="projeler/<?php echo $row_prj['dersno']."_".$row_prj['dosyaadi']; ?>" target="_blank"><?php echo $row_prj['orjinalad']; ?></a></td>
           </tr>
           <tr>
             <td valign="top" nowrap="nowrap" class="icyazi"><strong>Güncelleme</strong></td>
             <td valign="top" class="icyazi"><strong>:</strong></td>
             <td valign="top" class="icyazi"><?php echo $row_prj['guncelleme']; ?></td>
           </tr>
           <tr>
             <td valign="top" nowrap="nowrap" class="icyazi"><strong>Teslim Tarihi</strong></td>
             <td valign="top" class="icyazi"><strong>:</strong></td>
             <td valign="top" class="icyazi"><?php echo $row_prj['Ttarih']; ?> - 23:59</td>
           </tr>
           <tr>
             <td valign="top" nowrap="nowrap" class="icyazi"><strong>Bugün</strong></td>
             <td valign="top" class="icyazi"><strong>:</strong></td>
             <td valign="top" class="icyazi"><?php echo date('d.m.Y') ?>&nbsp;</td>
           </tr>
           <tr>
             <td colspan="3" valign="top" nowrap="nowrap" class="icyazi"><hr size="1" /></td>
             </tr>
           <tr>
             <td valign="top" nowrap="nowrap" class="icyazi"><strong>Durum</strong></td>
             <td valign="top" class="icyazi"><strong>:</strong></td>
             <td valign="top" class="icyazi"><?php if ($totalRows_odev == 0) { // Show if recordset empty ?>
                 Yüklenmedi
  <?php } // Show if recordset empty ?>
  <?php if ($totalRows_odev > 0) { // Show if recordset not empty ?>
    Yüklendi (<a href="odevler/<?php echo $row_odev['dosyaadi']; ?>" target="_blank"><?php echo $row_odev['dosyaadi']; ?></a>)
  <?php } // Show if recordset not empty ?></td>
           </tr>
           <tr>
             <td valign="top" nowrap="nowrap" class="icyazi"><strong>İlk Yükleme </strong></td>
             <td valign="top" class="icyazi"><strong>:</strong></td>
             <td valign="top" class="icyazi"><?php echo $row_odev['guncelleme']; ?></td>
           </tr>
           <tr>
             <td colspan="3" valign="top" nowrap="nowrap" class="icyazi"><hr size="1" /></td>
             </tr>
           <tr>
             <td valign="top" nowrap="nowrap" class="icyazi"><strong>Alınan Not</strong></td>
             <td valign="top" class="icyazi"><strong>:</strong></td>
             <td valign="top" class="icyazi"><p><strong><?php echo $row_odev['notu']; ?></strong> (100 üzerinden)</p>               </td>
           </tr>
           <tr>
             <td valign="top" nowrap="nowrap" class="icyazi"><strong>Dönüt</strong></td>
             <td valign="top" class="icyazi"><strong>:</strong></td>
             <td valign="top" class="icyazi"><?php echo $row_odev['donut']; ?></td>
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
<!-- InstanceEnd -->
</html>
<?php
mysql_free_result($tanitim);

mysql_free_result($prj);

mysql_free_result($odev);
?>