<?php require_once('Connections/lmscon.php'); ?>
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
  if (myErr!=''){alert('İletişim formunda eksik / hatalı bilgi var:\t\t\t\t\t\n\n'+myErr)}
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
         <td class="ustbaslik">İletişim</td>
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
         <td width="40%" class="baslik">Yazışma Adresi</td>
         <td width="52%" class="baslik">İletişim Formu</td>
       </tr>
       <tr>
         <td valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5">
           <tr>
             <td colspan="3" class="icyazi"><?php echo $adres ?>&nbsp;</td>
             </tr>

           <tr>
             <td width="15%" nowrap="nowrap" class="icyazi"><strong>Tel</strong></td>
             <td width="3%" class="icyazi"><strong>:</strong></td>
             <td width="82%" class="icyazi"><?php echo $tel ?></td>
           </tr>
           <tr>
             <td nowrap="nowrap" class="icyazi"><strong>Faks</strong></td>
             <td class="icyazi"><strong>:</strong></td>
             <td class="icyazi"><?php echo $faks ?></td>
           </tr>
           <tr>
             <td nowrap="nowrap" class="icyazi"><strong>Web Adresi</strong></td>
             <td class="icyazi"><strong>:</strong></td>
             <td class="icyazi"><a href="<?php echo $web ?>" target="_blank"><?php echo $web ?></a></td>
           </tr>
           <tr>
             <td nowrap="nowrap" class="icyazi"><strong>E - Posta</strong></td>
             <td class="icyazi"><strong>:</strong></td>
             <td class="icyazi"><a href="mailto:<?php echo $eposta ?>"><?php echo $eposta ?></a></td>
           </tr>
         </table></td>
         <td valign="top"><form id="form1" name="form1" method="post" action="index_iletisim_sonuc.php">
           <table width="100%" border="0" cellspacing="2" cellpadding="3">
             <tr>
               <td width="30%" nowrap="nowrap" class="icyazi"><strong>Adınız Soyadınız</strong></td>
               <td width="2%" class="icyazi"><strong>:</strong></td>
               <td width="68%" class="icyazi"><label>
                 <input name="adsoyad" type="text" class="metinkutusu" id="adsoyad" size="30" />
                 <span class="baslik">*</span></label></td>
             </tr>
             <tr>
               <td nowrap="nowrap" class="icyazi"><strong>E - Posta Adresiniz</strong></td>
               <td class="icyazi"><strong>:</strong></td>
               <td class="icyazi"><input name="eposta" type="text" class="metinkutusu" id="eposta" size="40" />
                 <span class="baslik">*</span></td>
             </tr>
             <tr>
               <td nowrap="nowrap" class="icyazi"><strong>Konu</strong></td>
               <td class="icyazi"><strong>:</strong></td>
               <td class="icyazi"><input name="konu" type="text" class="metinkutusu" id="konu" size="45" />
                 <span class="baslik">*</span></td>
             </tr>
             <tr>
               <td valign="top" nowrap="nowrap" class="icyazi"><strong>Mesaj</strong></td>
               <td valign="top" class="icyazi"><strong>:</strong></td>
               <td valign="top" class="icyazi"><label>
                 <textarea name="mesaj" cols="50" rows="5" class="metinkutusu" id="mesaj"></textarea>
                 <span class="baslik">*</span></label></td>
             </tr>
             <tr>
               <td nowrap="nowrap" class="icyazi"><img src="guvenlik/guvenlik_kodu.php" alt="Güvenlik Kodu" /></td>
               <td class="icyazi"><strong>:</strong></td>
               <td class="icyazi"><label>
                 <input name="dogrulama" type="text" class="metinkutusu" id="dogrulama" />
                 <span class="baslik">*  </span><span class="baslikMAVI">*</span></label></td>
             </tr>
             <tr>
               <td valign="top" nowrap="nowrap" class="icyazi">&nbsp;</td>
               <td valign="top" class="icyazi">&nbsp;</td>
               <td valign="top" class="icyazi"><label>
                 <input name="button" type="submit" class="buton" id="button" onclick="YY_checkform('form1','adsoyad','#q','0','Ad Soyad','eposta','#S','2','E - Posta','konu','#q','0','Konu','dogrulama','#q','0','Güvenlik Kodu','mesaj','1','1','Mesaj');return document.MM_returnValue" value="Gönder" />
               </label></td>
             </tr>
             <tr>
               <td colspan="2" valign="top" nowrap="nowrap" class="icyazi"><div align="right"> <span class="baslik">*</span></div></td>
               <td valign="top" class="icyazi">Doldurulması zorunlu alanlar</td>
             </tr>
             <tr>
               <td colspan="2" valign="top" nowrap="nowrap" class="icyazi"><div align="right" class="baslikMAVI">*</div></td>
               <td valign="top" class="icyazi">Sol bölümde yer alan güvenlik kodunu ilgili metin kutusuna giriniz.</td>
             </tr>
           </table>
         </form>           </td>
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
