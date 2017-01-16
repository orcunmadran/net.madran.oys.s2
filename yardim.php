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
         <td>Yardım</td>
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
         <td class="baslik"><div align="center">Simge</div></td>
         <td class="baslik"><div align="center">Tanım</div></td>
         <td class="baslik">Açıklama</td>
         <td class="baslik">Kılavuz</td>
       </tr>
       <tr>
         <td width="10%" bgcolor="#F1F1F1"><div align="center"><img src="simgeler/home_32.gif" alt="Anasayfa" width="32" height="32" /></div></td>
         <td width="16%" nowrap="nowrap" bgcolor="#F1F1F1" class="arabaslik"><div align="center">Anasayfa</div></td>
         <td width="66%" bgcolor="#F1F1F1" class="icyazi">Öğretim yönetim sistemine başarılı bir şekilde giriş yaptığınızda sizi karşılayan sayfadır. Sol bölümde gündemde yer alan olaylar ile ilgili içerik, sağ bölümde ise yeni mesaj ve hatırlatma bölümlerinin yanı sıra haber, duyuru ve etkinlik bilgileri yer almaktadır.</td>
         <td width="8%" bgcolor="#F1F1F1" class="icyazi"><div align="center"><a href="kilavuzlar/anasayfa.pdf" target="_blank"><img src="resimler/pdf.gif" alt="Kılavuz - Anasayfa" width="38" height="36" border="0" /></a></div></td>
       </tr>
       <tr>
         <td><div align="center"><img src="simgeler/hist_32.gif" alt="Dersler" width="32" height="32" /></div></td>
         <td nowrap="nowrap" class="arabaslik"><div align="center">Dersler</div></td>
         <td class="icyazi">Sistem içerisinde size yüklenmiş olan derslerin listesini görebileceğiniz sayfadır. Bu liste içerisinde dersin adına tıklayarak dersin anasayfasına, ders sorumlusuna tıklayarak da ders sorumlusunun profiline ulaşabilirsiniz.</td>
         <td><div align="center"><a href="kilavuzlar/dersler.pdf" target="_blank"><img src="resimler/pdf.gif" alt="Kılavuz - Dersler" width="38" height="36" border="0" /></a></div></td>
       </tr>
       <tr>
         <td bgcolor="#F1F1F1"><div align="center"><img src="simgeler/mail_32.gif" alt="Mesajlar" width="32" height="32" /></div></td>
         <td nowrap="nowrap" bgcolor="#F1F1F1" class="arabaslik"><div align="center">Mesajlar</div></td>
         <td bgcolor="#F1F1F1" class="icyazi">Sistem içi mesajlar alıp gönderebileceğiniz sayfadır. Göndermiş olduğunuz mesajların alıcı tarafından okunup okunmadığını takip edebilir, birden çok alıcıya aynı anda mesaj gönderebilirsiniz.</td>
         <td bgcolor="#F1F1F1"><div align="center"><a href="kilavuzlar/mesajlar.pdf" target="_blank"><img src="resimler/pdf.gif" alt="Kılavuz - Mesajlar" width="38" height="36" border="0" /></a></div></td>
       </tr>
       <tr>
         <td><div align="center"><img src="simgeler/docs_32.gif" alt="Tartışma Grupları (Forumlar)" width="32" height="32" /></div></td>
         <td nowrap="nowrap" class="arabaslik"><div align="center">Tartışma Grupları</div></td>
         <td class="icyazi">Sorumlu olduğunuz dersle ilgili tartışma gruplarını görüntüleyebileceğiniz sayfadır. Her dersin kendine ait bir tartışma grubu ve her tartışma grubunun da kendine ait konu başlıkları bulunmaktadır. Konu başlıkları altında yorum yapabilir, yapılan yorumları okuyabilirsiniz.</td>
         <td><div align="center"><a href="kilavuzlar/tartisma_gruplari.pdf" target="_blank"><img src="resimler/pdf.gif" alt="Kılavuz - Tartışma Grupları" width="38" height="36" border="0" /></a></div></td>
       </tr>
       <tr>
         <td bgcolor="#F1F1F1"><div align="center"><img src="simgeler/group_32.gif" alt="Sohbet Odaları" width="32" height="32" /></div></td>
         <td nowrap="nowrap" bgcolor="#F1F1F1" class="arabaslik"><div align="center">Sohbet Odaları</div></td>
         <td bgcolor="#F1F1F1" class="icyazi">Eş zamanlı mesajlaşma olanağı sağlayan sohbet odalarına ulaşabileceğiniz sayfadır. Genel amaçlı sohbet odaları olduğu gibi her dersin kendine ait sohbet odası da bulunmaktadır. Derse ait sohbet odaları ile ilgili bilgilere (sohbet gün ve saati, sohbet odasının parolası) dersin anasayfasından ulaşabilirsiniz.</td>
         <td bgcolor="#F1F1F1"><div align="center"><a href="kilavuzlar/sohbet_odalari.pdf" target="_blank"><img src="resimler/pdf.gif" alt="Kılavuz - Sohbet Odaları" width="38" height="36" border="0" /></a></div></td>
       </tr>
       <tr>
         <td><div align="center"><img src="simgeler/notep_32.gif" alt="Not Defteri" width="32" height="32" /></div></td>
         <td nowrap="nowrap" class="arabaslik"><div align="center">Not Defteri</div></td>
         <td class="icyazi">Not almak istediğiniz bilgileri kaydedebileceğiniz sayfadır. Bu sayfa içerisinde yeni notlar oluşturabilir, oluşturduğunuz notları okuyabilir, silebilir ya da güncelleyebilirsiniz. Yeni bir not oluştururken hatırlatma opsiyonunu devreye sokabilir, hatırlatma için belirlediğiniz gün sistemin sizi uyarmasını sağlayabilirsiniz.</td>
         <td><div align="center"><a href="kilavuzlar/not_defteri.pdf" target="_blank"><img src="resimler/pdf.gif" alt="Kılavuz - Not Defteri" width="38" height="36" border="0" /></a></div></td>
       </tr>
       <tr>
         <td bgcolor="#F1F1F1"><div align="center"><img src="simgeler/srch_32.gif" alt="Arama" width="32" height="32" /></div></td>
         <td nowrap="nowrap" bgcolor="#F1F1F1" class="arabaslik"><div align="center">Arama</div></td>
         <td bgcolor="#F1F1F1" class="icyazi">Sistem içi ve dışı arama seçeneklerinin sunulduğu sayfadır. Bu sayfa içerisinden sistem içinde yer alan kullanıcıları arayabilir, Google arama motoru yardımı ile İnternet üzerinde arama yapabilir, yine Google'ın bir hizmeti olan Google Scholar yardımı ile akademik ağdaki dokümanları tarayabilirsiniz.</td>
         <td bgcolor="#F1F1F1"><div align="center"><a href="kilavuzlar/arama.pdf" target="_blank"><img src="resimler/pdf.gif" alt="Kılavuz - Arama" width="38" height="36" border="0" /></a></div></td>
       </tr>
       <tr>
         <td><div align="center"><img src="simgeler/confg_32.gif" alt="Yönetim Paneli" width="32" height="32" /></div></td>
         <td nowrap="nowrap" class="arabaslik"><div align="center">Yönetim Paneli</div></td>
         <td class="icyazi">Yönetim paneli kullanıcıların yetkilerine göre farklı kontrollerin etkin olduğu bir sayfadır. Bu sayfa içinde tüm kullanıcılar kişisel bilgilerini (e-posta adresi, Web adresi, şifre, görüntü resmi) güncelleyebilirler. Akademik yöneticiler dersler ile ilgili her türlü işlemlerii, öğretim elemanları ise tartışma grupları ve sohbet odaları ile ilgili işlemleri bu panel yardımı ile gerçekleştirebilirler</td>
         <td><div align="center"><a href="kilavuzlar/yonetim_paneli.pdf" target="_blank"><img src="resimler/pdf.gif" alt="Kılavuz - Yönetim Paneli" width="38" height="36" border="0" /></a></div></td>
       </tr>
       <tr>
         <td bgcolor="#F1F1F1"><div align="center"><img src="simgeler/close_32.gif" alt="Oturumu Kapat" width="32" height="32" /></div></td>
         <td nowrap="nowrap" bgcolor="#F1F1F1" class="arabaslik"><div align="center">Oturumu Kapat</div></td>
         <td bgcolor="#F1F1F1" class="icyazi">Sisteme giriş yapıldığında açılan oturumu güvenli bir şekilde kapatmanız için kullanmanız gereken seçenektir. Sistemden çıkış yaparken İnternet tarayıcınızı (İnternet Explorer, Firefox, Opera vb.) direkt kapatmak yerine bu butona tıklayarak sistemden çıkış yaptığınızda sizden sonra bilgisayar terminalini kullanan kişilerin sizin hesabınızla sistemi kullanmalarını engellemiş olursunuz.</td>
         <td bgcolor="#F1F1F1"><div align="center"><a href="kilavuzlar/oturumu_kapat.pdf" target="_blank"><img src="resimler/pdf.gif" alt="Kılavuz - Oturumu Kapat" width="38" height="36" border="0" /></a></div></td>
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
?>
