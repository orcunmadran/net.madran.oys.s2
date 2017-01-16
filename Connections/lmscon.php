<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_lmscon = "localhost";
$database_lmscon = "lms_v2";
$username_lmscon = "root";
$password_lmscon = "9360673";
$lmscon = mysql_pconnect($hostname_lmscon, $username_lmscon, $password_lmscon) or trigger_error(mysql_error(),E_USER_ERROR);

//Türkçe Karakter UTF-8
setlocale(LC_ALL, "tr_TR");
mysql_select_db($database_lmscon, $lmscon);
$SQL1 = "SET CHARACTER SET utf8";
$SQL2 = "SET NAMES 'utf8'";
$isle = mysql_query($SQL1, $lmscon) or die(mysql_error());
$isle2 = mysql_query($SQL2, $lmscon) or die(mysql_error());

//Genel Tanimlamalar
$dosyaboyutu = 2000000;
$yonetimeposta = "bote@baskent.edu.tr";
$copyright = '&copy;<a href="http://bote.baskent.edu.tr" target="_blank"> BÖTE</a> - Bilgisayar ve Öğretim Teknolojileri Eğitimi Bölümü';
$adres =
"Başkent Üniversitesi Eğitim Fakültesi"."<br>".
"Bilgisayar ve Öğretim Teknolojileri Eğitimi Bölümü"."<br>".
"Bağlıca Kampüsü Eskişehir Yolu 20. KM "."<br>".
"06810 Ankara TÜRKİYE";
$tel = "0 (312) 234 10 10 / 1076";
$faks = "0 (312) 234 11 74";
$web = "http://bote.baskent.edu.tr";
$eposta = "bote@baskent.edu.tr";
?>