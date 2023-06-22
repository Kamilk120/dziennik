<!DOCTYPE html>
<html>
    <head>
        <title>szkoula</title>
        <meta charset="utf-8">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="./script/logowanie.js"></script>
        <link rel="shortcut icon" type="image/ico" href="./images/open-book.ico"/>
        <link rel="stylesheet" type="text/css" href="./style/background.css " />
        <link rel="stylesheet" type="text/css" href="./style/login.css" />
        <link rel="stylesheet" type="text/css" href="./style/profile.css" />
    </head>
    <header>
        <?php
            require_once "./database.php";
            session_start();
        ?>
        <div class="back">
            <a href="./main.php">   
                <img src="./images/left-back-arrow.png" class="back-arrow">
            </a>
        </div>
        <div class="logo">
            <a href="loginChose.php">
                <img src="./images/open-book.png" class="logo-img" alt="książka tu była"/>
            </a>   
            <p class="logo-text">Szkoula</p>
            <div class="menu"></div>
        </div>
    </header>
    <body>
        <div class="podpodcialo">
            <img src="./images/login-ikonka.png" class="zdj">
        </div>
        <?php
            if(isset($_SESSION['id'])){
                $id = $_SESSION['id'];
                $who=$_SESSION['who'];
                $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                if($who=="student"){
                    $qerry ="SELECT * FROM students WHERE id_student=$id;";
                    $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                    foreach($students as $wynik){
                        echo "<form action='./editprofil.php' method='post'>
                            <div class='podpodcialo'>
                                <div class='b1'>
                                    <input name='co' value='edit' style='display:none;'>
                                    <input name='idclass' value='".$wynik['id_class']."' style='display:none;'>
                                    <span class='b2 b3'>imię:</spaan>
                                    <input  class='b2' placeholder='imie' name='imie' value='".$wynik['name']."'>
                                    <span class='b2 b3'>nazwisko:</spaan>
                                    <input  class='b2' placeholder='nazwisko' name='surname' value='".$wynik['surname']."'>
                                    <span class='b2 b3'>e-mail:</spaan>
                                    <input  class='b2' placeholder='mail' name='mail' value='".$wynik['mail']."'>
                                    <span class='b2 b3'>nowe hasło:</spaan>
                                    <input  class='b2' placeholder='hasło' name='haslo'>
                                    <input  class='b2' placeholder='powtóż hasło' name='haslop'>
                                    <p class='antyrej'>";
                                        if(isset($_SESSION['editprofil']) && $_SESSION['editprofil'] == "error"){
                                            echo "<b>coś wprowadziłeś błędnie</b>";
                                        } 
                        echo        "</p>
                                    <input type='submit' value='aktualizuj'>
                                </div>
                            </div>
                        </form>";
                    } 
                    mysqli_close($conect);
                }
                else if($who=="admin"){
                    $qerry ="SELECT * FROM administration WHERE id_person=$id;";
                    $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                    foreach($students as $wynik){
                        echo "<form action='./editprofil.php' method='post'>
                            <div class='podpodcialo'>
                                <div class='b1'>
                                    <input name='co' value='edit' style='display:none;'>
                                    <span class='b2 b3'>imię:</spaan>
                                    <input  class='b2' placeholder='imie' name='imie' value='".$wynik['name']."'>
                                    <span class='b2 b3'>nazwisko:</spaan>
                                    <input  class='b2' placeholder='nazwisko' name='surname' value='".$wynik['surname']."'>
                                    <span class='b2 b3'>e-mail:</spaan>
                                    <input  class='b2' placeholder='mail' name='mail' value='".$wynik['mail']."'>
                                    <span class='b2 b3'>nowe hasło:</spaan>
                                    <input  class='b2' placeholder='hasło' name='haslo'>
                                    <input  class='b2' placeholder='powtóż hasło' name='haslop'>
                                    <input type='submit' value='aktualizuj'>
                                </div>
                            </div>
                        </form>";
                    } 
                    mysqli_close($conect);
                }
                else{
                    mysqli_close($conect);
                    header("Location: ./loginChose.php");
                }
            }
           else{
            header("Location: ./loginChose.php");
            }
        ?>
        <form action="./logout.php" method="post">
            <div class="logout">
                <button type="submit" class="logout">wyloguj</button>
            </div>
        </form>
    </body>
</html>