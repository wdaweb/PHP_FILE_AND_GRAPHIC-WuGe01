<?php
date_default_timezone_set("Asia/Taipei");
echo "<pre>";
print_r($_FILES);
echo "</pre>";

// $sub=explode('.',$_FILES['img']['name']);
// $sub[1];->副檔名

if($_FILES['img']['error']==0){    
    switch($_FILES['img']['type']){
        case "image/jpeg";
            $sub='.jpg';
        break;
        case "image/png";
            $sub='.png';
        break;
        case "image/gif";
            $sub='.gif';
        break;   
    }

    $name=date("Ymdhis").$sub;

move_uploaded_file($_FILES['img']['tmp_name'],"../update/".$name);

}



?>
<img src="../update/<?=$name;?>">