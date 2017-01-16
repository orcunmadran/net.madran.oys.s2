<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_lmscon = "localhost";
$database_lmscon = "web8_db1";
$username_lmscon = "web8_u1";
$password_lmscon = "oys7619";
$lmscon = mysql_pconnect($hostname_lmscon, $username_lmscon, $password_lmscon) or trigger_error(mysql_error(),E_USER_ERROR);

//Türkçe Karakter UTF-8
setlocale(LC_ALL, "tr_TR");
mysql_select_db($database_lmscon, $lmscon);
$SQL1 = "SET CHARACTER SET utf8";
$SQL2 = "SET NAMES 'utf8'";
$isle = mysql_query($SQL1, $lmscon) or die(mysql_error());
$isle2 = mysql_query($SQL2, $lmscon) or die(mysql_error());

//Genel Tanimlamalar
$dosyaboyutu = 2100000;
$yonetimeposta = "bote@baskent.edu.tr";
$oysadres = "http://oys.midas.baskent.edu.tr";
$copyright = '&copy;<a href="http://bote.baskent.edu.tr" target="_blank"> BÖTE</a> - Bilgisayar ve Öğretim Teknolojileri Eğitimi Bölümü';
$adres =
"Baskent Üniversitesi Egitim Fakültesi"."<br>".
"Bilgisayar ve Ögretim Teknolojileri Egitimi Bölümü"."<br>".
"Baglica Kampüsü Eskisehir Yolu 20. KM "."<br>".
"06810 Ankara TÜRKIYE";
$tel = "0 (312) 234 10 10 / 1076";
$faks = "0 (312) 234 11 74";
$web = "http://bote.baskent.edu.tr";
$eposta = "bote@baskent.edu.tr";
?>