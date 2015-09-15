<?php
 session_start();
 $username=$_SESSION['s_username'];

if($_SERVER['REQUEST_METHOD']=='POST')
{
 $_POST['s_username'] = $username;
mysql_connect("localhost","admin","admin");
mysql_select_db("test");
   
$uploads_dir = 'photo/';
//$images_name ="";
    foreach ($_FILES["image"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["image"]["tmp_name"][$key];
            $name = $username."_".$_FILES["image"]["name"][$key];
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
            if($images_name)
            {
                $images_name =$images_name.",".$name;
        }
        else
        {
            $images_name=$name;
        }
    }
    }
    $sql=mysql_query("INSERT INTO multiimg (sp_username,image) values('$username','$images_name')") or die;
    }
    if($sql){
        header("Location:display.php");
       // header("Location: ./emile\gallery-four.php");
    }
    else {
        echo "failed";
    }
    
    ?>