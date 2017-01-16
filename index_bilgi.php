<?php require_once('Connections/lmscon.php'); ?>
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

$colname_bilgi = "-1";
if (isset($_POST['eposta'])) {
  $colname_bilgi = $_POST['eposta'];
}
mysql_select_db($database_lmscon, $lmscon);
$query_bilgi = sprintf("SELECT * FROM lms_kullanici WHERE eposta = %s", GetSQLValueString($colname_bilgi, "text"));
$bilgi = mysql_query($query_bilgi, $lmscon) or die(mysql_error());
$row_bilgi = mysql_fetch_assoc($bilgi);
$totalRows_bilgi = mysql_num_rows($bilgi);
?>
<?php 
if ($totalRows_bilgi > 0) { 

			$name = $row_bilgi['ad'];
			$surname = $row_bilgi['soyad'];
			$email = $row_bilgi['eposta'];
			$user = $row_bilgi['kimlik'];
			$pass = $row_bilgi['sifre']; 
			$gonderen = "bote@baskent.edu.tr";
			
			$subject="Sisteme giris bilgileriniz";
			$mailcontent=
			"Sn. ".$name." ".$surname.","."\n\r"."<br>"."<br>".
			"Öğretim Yönetim Sistemi (ÖYS) kullanıcı adı ve şifre bilgileriniz aşağıda yer almaktadır:"."\n\r"."<br>"."<br>".
			"-------------------------"."\n\r"."<br>".
			"ÖYS Adres: "."<a href=".$oysadres.">".$oysadres."</a>"."\n\r"."<br>".
			"Kullanıcı Adı: "." ".$user."\n\r"."<br>".
			"Şifre: ".$pass."\n\r"."<br>".
			"-------------------------"."\n\r"."<br>"."<br>".
			"<a href=".$siteurl.">".$siteurl."</a>";
			
			mail($email, $subject, $mailcontent, "From: $gonderen\n".'Content-type: text/html; charset=UTF-8');  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/lms_dis.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>::: Öğretim Yönetim Sistemi :::</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--Fireworks CS3 Dreamweaver CS3 target.  Created Fri Jul 27 21:09:33 GMT+0300 (GTB Yaz Saati) 2007-->
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
.style1 {color: #FF0000}
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
<body bgcolor="#ffffff" onload="MM_preloadImages('fw_images_2/lms_dis_r1_c3_f2.gif','fw_images_2/lms_dis_r1_c5_f2.gif','fw_images_2/lms_dis_r1_c7_f2.gif','fw_images_2/lms_dis_r1_c9_f2.gif')">
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
<!-- fwtable fwsrc="lms_ic.png" fwpage="LMS dis" fwbase="lms_dis.gif" fwstyle="Dreamweaver" fwdocid = "1032219995" fwnested="0" -->
  <tr>
   <td><img src="fw_images_2/spacer.gif" width="10" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="748" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="40" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="6" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="40" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="6" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="40" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="6" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="40" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="4" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="10" height="1" border="0" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>

  <tr>
   <td colspan="2"><img name="lms_dis_r1_c1" src="resimler/kurum_logo_dis.gif" width="758" height="60" border="0" id="lms_dis_r1_c1" alt="" /></td>
   <td><a href="index.php" title="Anasayfa" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_dis_r1_c3','','fw_images_2/lms_dis_r1_c3_f2.gif',1)"><img name="lms_dis_r1_c3" src="fw_images_2/lms_dis_r1_c3.gif" width="40" height="60" border="0" id="lms_dis_r1_c3" alt="Anasayfa" /></a></td>
   <td><img name="lms_dis_r1_c4" src="fw_images_2/lms_dis_r1_c4.gif" width="6" height="60" border="0" id="lms_dis_r1_c4" alt="" /></td>
   <td><a href="index_egitim_katalogu.php" title="Eğitim Kataloğu" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_dis_r1_c5','','fw_images_2/lms_dis_r1_c5_f2.gif',1)"><img name="lms_dis_r1_c5" src="fw_images_2/lms_dis_r1_c5.gif" width="40" height="60" border="0" id="lms_dis_r1_c5" alt="Eğitim Kataloğu" /></a></td>
   <td><img name="lms_dis_r1_c6" src="fw_images_2/lms_dis_r1_c6.gif" width="6" height="60" border="0" id="lms_dis_r1_c6" alt="" /></td>
   <td><a href="index_iletisim.php" title="İletişim" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_dis_r1_c7','','fw_images_2/lms_dis_r1_c7_f2.gif',1)"><img name="lms_dis_r1_c7" src="fw_images_2/lms_dis_r1_c7.gif" width="40" height="60" border="0" id="lms_dis_r1_c7" alt="İletişim" /></a></td>
   <td><img name="lms_dis_r1_c8" src="fw_images_2/lms_dis_r1_c8.gif" width="6" height="60" border="0" id="lms_dis_r1_c8" alt="" /></td>
   <td><a href="index_yardim.php" title="Yardım" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('lms_dis_r1_c9','','fw_images_2/lms_dis_r1_c9_f2.gif',1)"><img name="lms_dis_r1_c9" src="fw_images_2/lms_dis_r1_c9.gif" width="40" height="60" border="0" id="lms_dis_r1_c9" alt="Yardım" /></a></td>
   <td colspan="2"><img name="lms_dis_r1_c10" src="fw_images_2/lms_dis_r1_c10.gif" width="14" height="60" border="0" id="lms_dis_r1_c10" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="1" height="60" border="0" alt="" /></td>
  </tr>
  <tr>
   <td background="fw_images_2/lms_dis_r3_c1.gif">&nbsp;</td>
   <td colspan="9"><!-- InstanceBeginEditable name="Baslik" -->
     <table width="100%" border="0" cellspacing="5" cellpadding="5">
       <tr>
         <td width="4%" class="ustbaslik"><img src="simgeler/about_24.gif" width="24" height="24" /></td>
         <td width="98%" class="ustbaslik">Sistem Mesajı</td>
       </tr>
     </table>
   <!-- InstanceEndEditable --></td>
   <td background="fw_images_2/lms_dis_r3_c11.gif">&nbsp;</td>
   <td><img src="fw_images_2/spacer.gif" width="1" height="60" border="0" alt="" /></td>
  </tr>
  <tr>
   <td background="fw_images_2/lms_dis_r3_c1.gif">&nbsp;</td>
   <td colspan="9" valign="top"><!-- InstanceBeginEditable name="İcerik" -->
     <table width="100%" border="0" cellspacing="5" cellpadding="5">
       <?php if ($totalRows_bilgi > 0) { // Show if recordset not empty ?>
         <tr>
           <td width="4%">&nbsp;</td>
           <td width="96%"><p class="arabaslik">Sayın <?php echo $row_bilgi['ad']; ?> <?php echo $row_bilgi['soyad']; ?>,</p>
               <p class="icyazi">Kullanıcı adı ve şifre bilgileriniz aşağıdaki e-posta adresine gönderilmiştir.</p>
             <p class="icyazi"><?php echo $row_bilgi['eposta']; ?></p></td>
         </tr>
         <?php } // Show if recordset not empty ?>
       <?php if ($totalRows_bilgi == 0) { // Show if recordset empty ?>
  <tr>
    <td>&nbsp;</td>
    <td><p class="arabaslik">Aşağıda yer alan e-posta adresi sistemimize kayıtlı değildir.</p>        <p class="icyazi style1"><strong><?php echo $_POST['eposta']; ?></strong></p>
      <p class="icyazi">Lütfen sisteme kayıtlı olan e-posta adresinizi kullanınız.</p>
      <p class="icyazi">Yeniden Kullanıcı adı / şifre talebinde bulunmak için <a href="index_bilgi_tekrar.php">tıklayınız</a>.</p></td>
  </tr>
  <?php } // Show if recordset empty ?>

          </table>
   <!-- InstanceEndEditable --></td>
   <td background="fw_images_2/lms_dis_r3_c11.gif">&nbsp;</td>
   <td><img src="fw_images_2/spacer.gif" width="1" height="370" border="0" alt="" /></td>
  </tr>
  <tr>
   <td colspan="11"><img name="lms_dis_r4_c1" src="fw_images_2/lms_dis_r4_c1.gif" width="950" height="10" border="0" id="lms_dis_r4_c1" alt="" /></td>
   <td><img src="fw_images_2/spacer.gif" width="1" height="10" border="0" alt="" /></td>
  </tr>
</table>
<p align="center"><span class="icyazi"><?php echo $copyright ?></span></p>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($bilgi);
?>
