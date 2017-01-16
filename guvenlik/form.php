<? 
  # Oturumu baslat 
  session_start(); 

  # Kodu dogrula 
  if($_POST["gonder"]){ 

     # Kod dogrulandysa 
     if($_SESSION["kod"] == $_POST["kod"]){ 
        $mesaj = "Gvenlik kodu doruland"; 
        } 

     # Dogrulanmadysa 
     else{ 
        $mesaj = "Girdiiniz kod hatal !"; 
        } 
     } 
?> 
<html> 
<head> 
<title>Gvenlik Kodu</title> 
<style> 
body, input{ 
   border: 1px solid silver; 
   color : black; 
   background-color: #FFFFFF; 
   font-family: Tahoma; 
   font-size: 8pt 
   } 
</style> 
</head> 

<body> 
  <center> 
    <img src="guvenlik_kodu.php"> 
    <br> 
    <br> 
    <form method="POST" action="form.php"> 
      Ltfen resimde grdnz gvenlik kodunu girin<br> 
      ( <font color="red"><?echo $mesaj?></font> ) 
      <br> 
      <br> 
      <input type="text"   name="kod" value="<?echo $_POST["kod"]?>"> 
      <input type="submit" name="gonder" value="Gnder"> 
    </form> 
  </center> 
</body> 

</html> 