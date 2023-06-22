<?php
    require_once "./database.php";
    session_start();
    if(isset($_SESSION['editprofil'])){
        $_SESSION['editprofil'] = null;
    }
    if(isset($_SESSION['id']) && isset($_SESSION['who'])){
        $id = $_SESSION['id'];
        $who=$_SESSION['who'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['surname'];
        $mail = $_POST['mail'];
        $haslo = $_POST['haslo'];
        $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
        if($who=="student"){
            $qerry ="SELECT * FROM students WHERE id_student=$id;";
            $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            foreach($wynik as $w){
                $name = $w['name'];
                $surname = $w['surname'];
                $email = $w['mail'];
                $passw = $w['haslo'];
            }
            if($imie!=$name){
                $qerry ="UPDATE `students` SET `name`='$imie' WHERE `id_student`=$id;";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
            else if($nazwisko!=$surname){
                $qerry ="UPDATE `students` SET `surname`='$nazwisko' WHERE `id_student`=$id;";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
            else if($mail!=$email){
                $qerry ="UPDATE `students` SET `mail`='$mail' WHERE `id_student`=$id;";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
            else if($haslo==$_POST['haslo'] && $_POST['haslo'] !=null && $haslo != null){
                $qerry ="UPDATE `students` SET `haslo`='$haslo' WHERE `id_student`=$id;";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
            else{
                $_SESSION['editprofil']="error";
            }
            mysqli_close($conect);
            header("Location: ./profil.php");
        }
        else if($who=="admin"){
            $qerry ="SELECT * FROM administration WHERE id_person=$id;";
            $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            if($imie!=mysqli_fetch_array($wynik)['name']){
                $qerry ="UPDATE `administration` SET `name`='$imie' WHERE `id_person`=$id;";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
            else if($nazwisko!=mysqli_fetch_array($wynik)['surname']){
                $qerry ="UPDATE `administration` SET `surname`='$nazwisko' WHERE `id_person`=$id;";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
            else if($mail!=mysqli_fetch_array($wynik)['mail']){
                $qerry ="UPDATE `administration` SET `mail`='$mail' WHERE `id_person`=$id;";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
            else if($haslo==$_POST['haslo'] && $_POST['haslo'] !=null && $haslo != null){
                $qerry ="UPDATE `administration` SET `haslo`='$haslo' WHERE `id_person`=$id;";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            }
            else{
                $_SESSION['editprofil']="error";
            }
            mysqli_close($conect);
            header("Location: ./profil.php");
        }
        else{
            $_SESSION['editprofil']="error";
            mysqli_close($conect);
            header("Location: ./loginChose.php");
        }
    }
    else{
        $_SESSION['editprofil']="error";
        header("Location: ./loginChose.php");
     }
?>    