<?php
    require_once "./database.php";
    $id = $_GET['id'];
    $co = $_GET['co'];
    $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
    if($co == "edit"){
        $name = $_GET['imie'];
        $surname = $_GET['surname'];
        $class = $_GET['class'];
        $idclass = $_GET['idclass'];
        $qerry ="UPDATE `students` SET `name`='$name',`surname`='$surname ',`id_class`='$idclass' WHERE `id_student`= $id;";
        $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
    }
    else if($co == "dodaj"){
        $name = $_GET['imie'];
        $surname = $_GET['surname'];
        $mail = $_GET['mail'];
        $haslo = $_GET['haslo'];
        $industry = $_GET['industry'];
        $class = $_GET['class'];
        $qerry ="SELECT * FROM `class` WHERE name_class='$class' AND id_industry='$industry';";
        $w = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
        foreach($w as $wynik){
            echo $name.$surname.$mail.$haslo;
            $qerr ="INSERT INTO `students` VALUES (NULL,'$name','$surname','$mail','$haslo',".$wynik['id_class'].");";
            $ksd= mysqli_query($conect, $qerr) or die("nie udało sie wykonać");  
        } 
    }
    else if($co == "usun"){
        $qerry ="DELETE FROM `students` WHERE `id_student`=$id;";
        $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
    }
    else{
        echo "<script>alert('coś nie tak')</script>";
    }
    header ("Location: ./studentsglowna.php");
    mysqli_close($conect);
?>