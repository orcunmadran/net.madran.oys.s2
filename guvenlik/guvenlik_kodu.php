<? 
  # Baslik bilgisi 
  session_start(); 
  header ("Content-type: image/png"); 
  srand((double)microtime() * 1000000); 

  # Guvenlik kodu uret 
  $kod   = substr(md5(uniqid(rand())),0,5); 
  $_SESSION["kod"] = $kod; // Kodu oturuma kaydet

  # Fontlar .. 
  $font  = array( 
     "verdana.ttf",
     ); 

  # Resmi hazirla 
  $resim = @imagecreate((strlen($kod)*20)+20,20); 
  $zemin = imagecreatefrompng('zemin.png'); 
  $metin = imagecolorallocate ($resim, 0, 0, 0); 

  imagesettile($resim,$zemin); 
  imagefilledrectangle($resim,0,0,(strlen($kod)*20)+20,20,IMG_COLOR_TILED); 

  # Kodu bas 
  for($i=0; $i < strlen($kod); $i++){ 
     shuffle($font); 
     imagettftext($resim, 11, 0, 10+($i*20),16, $metin, "font/".current($font),$kod[$i]); 
     } 

  # Resmi cikart 
  imagepng($resim); 
  imagedestroy($resim); 
?> 