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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['kimlik'])) {
  $loginUsername=$_POST['kimlik'];
  $password=$_POST['sifre'];
  $MM_fldUserAuthorization = "yetki";
  $MM_redirectLoginSuccess = "index_giris.php";
  $MM_redirectLoginFailed = "index_hata.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_lmscon, $lmscon);
  	
  $LoginRS__query=sprintf("SELECT kimlik, sifre, yetki FROM lms_kullanici WHERE kimlik=%s AND sifre=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $lmscon) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'yetki');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
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
  if (myErr!=''){alert('Bilgi formunda eksik / hatalı bölümler var:\t\t\t\t\t\n\n'+myErr)}
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
         <td width="2%" class="baslik"><img src="simgeler/stop_24.gif" width="24" height="24" /></td>
         <td width="48%" class="baslik">Kullanıcı Adı ya da Şifre Hatalı</td>
         <td width="50%" class="ustbaslik"><div align="left"></div></td>
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
       <tr>
         <td width="50%" valign="top"><form id="giris" name="giris" method="POST" action="<?php echo $loginFormAction; ?>">
           <table width="100%" border="0" cellspacing="2" cellpadding="3">
             <tr>
               <td width="14%" nowrap="nowrap" class="arabaslik">Kullanıcı Adı</td>
               <td width="3%" class="arabaslik">:</td>
               <td width="83%"><label>
                 <input name="kimlik" type="text" class="metinkutusu" id="kimlik" size="20" maxlength="20" />
                 <span class="icyazi">*</span></label></td>
             </tr>
             <tr>
               <td nowrap="nowrap" class="arabaslik">Şifre</td>
               <td class="arabaslik">:</td>
               <td><input name="sifre" type="password" class="metinkutusu" id="sifre" size="20" maxlength="20" />
                 <span class="icyazi">**</span></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td><label>
                 <input name="button" type="submit" class="buton" id="button" onclick="YY_checkform('giris','kimlik','#q','0','Kullanıcı adı','sifre','#q','0','Şifre');return document.MM_returnValue" value="Sisteme Giriş" />
               </label></td>
             </tr>
           </table>
                           <table width="100%" border="0" cellspacing="2" cellpadding="3">
                             <tr>
                               <td valign="top" class="icyazi">* </td>
                               <td class="icyazi"><p>Kullanıcı adı olarak; </p>
                                   <ul>
                                     <li>Öğrenci iseniz öğrenci numaranızı,</li>
                                     <li>Öğretim elemanı iseniz kurum kullanıcı adınızı kullanınız.</li>
                                   </ul></td>
                             </tr>
                             <tr>
                               <td valign="top" class="icyazi">**</td>
                               <td class="icyazi">Öğretim Yönetim Sistemi için daha önce giriş şifresi almadıysanız ya da şifrenizi unuttuysanız yandaki bölümden sisteme kayıtlı olduğunuz e-posta adresi ile şifrenizi ve kullanıcı adınızı öğrenebilirsiniz.</td>
                             </tr>
                           </table>
                           </form>           </td>
         <td width="50%" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
           <tr>
             <td colspan="2"><p class="arabaslik">Kullanıcı Adımı / Şifremi Unuttum</p></td>
             </tr>
           <tr>
             <td colspan="2"><p class="icyazi">Öğretim Yönetim Sistemine kayıtlı olan e-posta adresiniz * yardımıyla aşağıdaki formu doldurarak kullanıcı adı ve şifrenizi öğrenebilirsiniz.</p>               </td>
           </tr>
           <tr>
             <td colspan="2"><form id="unuttum" name="unuttum" method="post" action="index_bilgi.php">
               <label> <span class="arabaslik">E - Posta:</span>
                 <input name="eposta" type="text" class="metinkutusu" id="eposta" size="30" maxlength="50" />
               </label>
               <label>
               <input name="button2" type="submit" class="buton" id="button2" onclick="YY_checkform('unuttum','eposta','S','2','Lütfen geçerli bir e-posta adresi giriniz.');return document.MM_returnValue" value="Gönder" />
               </label>
             </form></td>
           </tr>
           <tr>
             <td valign="top"><p class="icyazi">* </p>               </td>
             <td><p class="icyazi">Eğer e-posta adresinizi sistem içerisinden değiştirmediyseniz varsayılan e-posta adresiniz kurum / okul e-posta adresinizdir.</p>
               <p class="icyazi">Örnek:</p>
               <ul>
                 <li class="icyazi">omadran@baskent.edu.tr (Öğretim elemanları)</li>
                 <li class="icyazi">20291345@mail.baskent.edu.tr (Öğrenciler)</li>
               </ul></td>
           </tr>
         </table></td>
       </tr>
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
