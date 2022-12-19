<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<form action="" method="POST" enctype="multipart/form-data">
  <input type="file"  name="photo" id="">
  <input type="hidden" value="1"  name="filemm" id="">
  
  <button  type="submit">gönder</button>
</form>


</body>
</html>
<?php
if (isset($_POST["filemm"])) {

  $tmp_name = $_FILES['photo']['tmp_name'];
  $name = basename($_FILES["photo"]["name"]);
  if (move_uploaded_file($tmp_name, "assets/$name")) {
    // header('Content-type: image/jpg');
    $dosya = "assets/".$name;
    // $dosya = "assets/14203319_322322341451659_2447550367294670423_n.jpg";
          
          list($genislik, $yukseklik) = getimagesize($dosya);
    
          $yeni_genislik = 250;
          $yeni_yukseklik = 250;
          
          $hedef = imagecreatetruecolor($yeni_genislik, $yeni_yukseklik);
          $kaynak = imagecreatefromjpeg($dosya);
          
          // imagejpeg($yeni_resim);
          //imagejpeg($yeni_resim, 'yeni_resim.jpg', 100);  // oluşan resmi yeni_resim.jpg olarak %100 kalitede kaydet.
          
          imagecopyresampled($hedef, $kaynak, 0, 0, 0, 0, $yeni_genislik, $yeni_yukseklik, $genislik, $yukseklik);
          //imagecopyresized($yeni_resim, $mevcut_resim, 0, 0, 0, 0, $yeni_genislik, $yeni_yukseklik, $genislik, $yukseklik);
    $rasgeleisim = uniqid();
    
          $son_resim = "assets/".$rasgeleisim.".jpg";
    imagejpeg($hedef,$son_resim,20);
  
    unlink($dosya);
          echo "<br> <img src='$son_resim' >";
  }
}
         
?>