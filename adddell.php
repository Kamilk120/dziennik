<?php
    require_once "./database.php";
    $id = $_GET['id'];
    $class = $_GET['class'];
    $co = $_GET['co'];
    $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
    if($co == "usun"){
        if($class=="student"){
            $qerry ="DELETE FROM `students` WHERE `id_student`=$id;";
            $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
        }
        if($class!="student"){
            $qerry ="DELETE FROM `administration` WHERE `id_person`=$id;";
            $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
        }
        else{
            echo "<script>alert('coś poszło nie tak')</script>";
        }
    }
    if($co == "edit"){
        if($class=="student"){
            $name = $_GET['imie'];
            $surname = $_GET['surname'];
            $mail = $_GET['mail'];
            $haslo = $_GET['haslo'];
            $namec = $_GET['clas'];
            $idclass = $_GET['idclass'];
            if($idclass=='useless'){
                $qerry ="SELECT id_class FROM `class` WHERE name_class = '$namec';";
                $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                $idclass = mysqli_fetch_array($klasy)['id_class'];
                $qerry ="UPDATE `students` SET `name`='$name',`surname`='$surname ',`id_class`='$idclass',`mail`='$mail',`haslo`='$haslo' WHERE `id_student`= $id;";
                $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
            else{
                $qerry ="UPDATE `students` SET `name`='$name',`surname`='$surname ',`id_class`='$idclass',`mail`='$mail',`haslo`='$haslo' WHERE `id_student`= $id;";
                $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
        }
        if($class!="student"){
            $name = $_GET['imie'];
            $surname = $_GET['surname'];
            $mail = $_GET['mail'];
            $haslo = $_GET['haslo'];
            $idclass = $_GET['idclass'];
            $ind = $_GET['clas'];
            $permis = $_GET['permis'];
            $qerry ="UPDATE `administration` SET `name`='$name',`surname`='$surname',`mail`='$mail',`haslo`='$haslo',`id_industry`='$ind',`permision`='$permis' WHERE id_person = $id;";
            $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
        }
        else{
            echo "<script>alert('coś poszło nie tak')</script>";
        }
    }
    else{
        echo "<script>alert('coś poszło nie tak')</script>";
    }
    header ("Location: ./usersadmin.php");
    mysqli_close($conect);
?>