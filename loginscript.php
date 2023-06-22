<?php
    session_start();
    if(isset($_SESSION['log'])){
        $_SESSION['log']=null ;
    }
    if(isset($_SESSION['reg'])){
        $_SESSION['reg']=null ;
    }
    if(isset($_SESSION['rege'])){
        $_SESSION['rege']=null ;
    }
    if(isset($_SESSION['regp'])){
        $_SESSION['regp']=null ;
    }
    $who=$_SESSION['who'];
    require_once "./database.php";
    $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
    if($who=="student"){
        if($_POST['action']=='login' && $_POST['maill']!=null && $_POST['haslol']!=null){
            $mail= $_POST['maill'];
            $haslo= $_POST['haslol'];
            $qerry ="SELECT `id_student`, `name`, `mail`, `haslo`, `id_class` FROM `students` WHERE `mail`= '$mail';";
            $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            if(isset($wynik)){
                if(mysqli_fetch_array($wynik)['haslo']==$haslo){
                    $_SESSION['log']="zalogowano";
                    foreach($wynik as $w){
                        $_SESSION['id']= $w['id_student'];
                        $_SESSION['name']= $w['name'];
                    }
                    $_SESSION['class']="student";
                    mysqli_close($conect);
                    header("Location: ./main.php");
                }
                else{
                    $_SESSION['log']='error';
                    mysqli_close($conect);
                    header("Location: ./loginThema.php");
                }
           }
           else{
               $_SESSION['log']='error';
               mysqli_close($conect);
               header("Location: ./loginThema.php");
           }
        }
        else if($_POST['action']=='rejestr' && $_POST['imier']!=null && $_POST['nazwiskor']!=null && $_POST['mailr']!=null && $_POST['haslor']!=null && $_POST['haslor']!=null){
            $mail= $_POST['mailr'];
            $imie=$_POST['imier'];
            $nazwisko=$_POST['nazwiskor'];
            $haslo= $_POST['haslor'];
            if($haslo== $_POST['haslorp']){
                $qerry ="SELECT `mail` FROM `students` WHERE `mail`= '$mail';";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                if(mysqli_fetch_array($wynik)['mail'] == null){
                    $_SESSION['regp']='1';
                    $qerry ="INSERT INTO `students`(`id_student`, `name`, `surname`, `mail`, `haslo`) VALUES (NULL,'$imie','$nazwisko', '$mail','$haslo');";
                    $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                    mysqli_close($conect);
                    header("Location: ./loginThema.php");
                }
                else{
                    $_SESSION['rege']='error';
                    mysqli_close($conect);
                    header("Location: ./loginThema.php");
                }
            }
            else{
                $_SESSION['reg']='error';
                mysqli_close($conect);
                header("Location: ./loginThema.php");
            }
        }
        else{
            $_SESSION['reg']='error';
            mysqli_close($conect);
            header("Location: ./loginThema.php");
        }
    }
    else if($who=="admin"){
        if($_POST['action']=='login' && $_POST['maill']!=null && $_POST['haslol']!=null){
            $mail= $_POST['maill'];
            $haslo= $_POST['haslol'];
            $qerry ="SELECT `id_person`, `name`, `permision`,`mail`, `haslo` FROM `administration` WHERE `mail`= '$mail';";
            $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
            if(isset($wynik)){
                if(mysqli_fetch_array($wynik)['haslo']==$haslo){
                    $_SESSION['log']="zalogowano";
                    foreach($wynik as $w){
                        $_SESSION['id']= $w['id_person'];
                        $_SESSION['name']= $w['name'];
                        $_SESSION['class']=$w['permision'];
                    }
                    mysqli_close($conect);
                    header("Location: ./main.php");
                }
                 else{
                     $_SESSION['log']='error';
                     mysqli_close($conect);
                     header("Location: ./loginThema.php");
                 }
            }
            else{
                $_SESSION['log']='error';
                mysqli_close($conect);
                header("Location: ./loginThema.php");
            }
        }
        else if($_POST['action']=='rejestr' && $_POST['imier']!=null && $_POST['nazwiskor']!=null && $_POST['mailr']!=null && $_POST['haslor']!=null && $_POST['haslor']!=null){
            $mail= $_POST['mailr'];
            $imie=$_POST['imier'];
            $nazwisko=$_POST['nazwiskor'];
            $haslo= $_POST['haslor'];
            if($haslo== $_POST['haslorp']){
                $qerry ="SELECT `mail` FROM `administration` WHERE `mail`= '$mail';";
                $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                if(mysqli_fetch_array($wynik)['mail'] == null){
                    $_SESSION['regp']='1';
                    $qerry ="INSERT INTO `administration`(`id_person`, `name`, `surname`, `mail`, `haslo`) VALUES (NULL,'$imie','$nazwisko', '$mail','$haslo');";
                    $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                    mysqli_close($conect);
                    header("Location: ./loginThema.php");
                }
                else{
                    $_SESSION['rege']='error';
                    mysqli_close($conect);
                    header("Location: ./loginThema.php");
                }
            }
            else{
                $_SESSION['reg']='error';
                mysqli_close($conect);
                header("Location: ./loginThema.php");
            }
        }
        else{
            $_SESSION['log']='error';
            mysqli_close($conect);
            header("Location: ./loginThema.php");
        }
    }
    else{
        mysqli_close($conect);
        header("Location: ./loginThema.php");
    }
?>