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

mysql_select_db($database_lmscon, $lmscon);
$query_katalog = "SELECT D.*, CONCAT(K.ad, ' ', K.soyad) AS adsoyad FROM lms_ders D, lms_kullanici K WHERE D.aktif = 'EVET' AND D.kimlik = K.kimlik ORDER BY D.kod";
$katalog = mysql_query($query_katalog, $lmscon) or die(mysql_error());
$row_katalog = mysql_fetch_assoc($katalog);
$totalRows_katalog = mysql_num_rows($katalog);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
         <td class="ustbaslik">Eğitim Kataloğu</td>
       </tr>
     </table>
   <!-- InstanceEndEditable --></td>
   <td background="fw_images_2/lms_dis_r3_c11.gif">&nbsp;</td>
   <td><img src="fw_images_2/spacer.gif" width="1" height="60" border="0" alt="" /></td>
  </tr>
  <tr>
   <td background="fw_images_2/lms_dis_r3_c1.gif">&nbsp;</td>
   <td colspan="9" valign="top"><!-- InstanceBeginEditable name="İcerik" -->
     <table width="100%" border="0" cellspacing="1" cellpadding="1">
       <?php if ($totalRows_katalog == 0) { // Show if recordset empty ?>
         <tr>
           <td class="baslik"><table width="100%" border="0" cellspacing="5" cellpadding="5">
               <tr>
                 <td><p>Öğretim Yönetim Sistemi içerisinde aktif ders bulunmamaktadır.</p>
                     <p class="arabaslik">Lütfen daha sonra yeniden ziyaret ediniz.</p></td>
               </tr>
           </table></td>
         </tr>
         <?php } // Show if recordset empty ?>
       <?php if ($totalRows_katalog > 0) { // Show if recordset not empty ?>
         <tr>
           <td><table width="100%" border="0" cellspacing="5" cellpadding="5">
                <tr>
                  <td colspan="4" nowrap="nowrap" class="arabaslik"><span class="baslik">Öğretim Yönetim Sistemi içerisinde yer alan dersler aşağıda listelenmiştir.<br />
                    <br />
                    </span></td>
                </tr>
             <tr>
                  <td width="11%" nowrap="nowrap" bgcolor="#E5E5E5" class="arabaslik">Dersin Kodu</td>
                  <td width="25%" nowrap="nowrap" bgcolor="#E5E5E5" class="arabaslik">Dersin Adı</td>
                  <td width="25%" nowrap="nowrap" bgcolor="#E5E5E5" class="arabaslik">Dersin Sorumlusu</td>
                  <td width="50%" nowrap="nowrap" bgcolor="#E5E5E5" class="arabaslik">Kısa Açıklama</td>
                </tr>
             <?php do { ?>
               <tr>
                 <td valign="top" class="icyazi"><?php echo $row_katalog['kod']; ?></td>
                 <td valign="top" class="icyazi"><?php echo $row_katalog['ad']; ?></td>
                 <td valign="top" class="icyazi"><?php echo $row_katalog['adsoyad']; ?></td>
                 <td valign="top" class="icyazi"><?php echo $row_katalog['tanim']; ?></td>
               </tr>
               <?php } while ($row_katalog = mysql_fetch_assoc($katalog)); ?>
                      </table></td>
         </tr>
         <?php } // Show if recordset not empty ?>

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
mysql_free_result($katalog);
?>
