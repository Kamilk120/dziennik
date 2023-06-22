<!DOCTYPE html>
<html>
    <head>
        <title>szkoula</title>
        <meta charset="utf-8">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="script/logowanie.js"></script>
        <link rel="shortcut icon" type="image/ico" href="images/open-book.ico"/>
        <link rel="stylesheet" type="text/css" href="style/background.css " />
        <link rel="stylesheet" type="text/css" href="style/login.css" />
    </head>
    <header>
        <div class="logo">
            <a href="loginChose.php">
                <img src="images/open-book.png" class="logo-img" alt="książka tu była"/>
            </a>   
            <p class="logo-text">Szkoula</p>
        </div>
    </header>
    <body>
        <?php
            session_start();
            if(isset($_POST['who'])){
                $_SESSION['who'] = $_POST['who'];
            }
            if(!isset($_SESSION['who'])){
                header("Location: ./loginChose.php");
            }
        ?>
        <form action="./loginscript.php" method="post">
            <div class="logowanie blok">
                <p class="dopisek">podaj mail:</p>
                <input type="text" name="maill" class="login " placeholder="mail">
                <p class="dopisek">podaj hasło:</p>
                <input type="password" name="haslol" class="haslo " placeholder="hasło">
                <p class="antylog"> 
                    <?php 
                        if(isset($_SESSION['log']) && $_SESSION['log'] == "error"){
                            echo "<b>niepoprawny mail lub haslo</b>";
                        }
                    ?>
                </p>
                <div class="login-button">
                    <div class="rejestruj " id="rejestr">zarejestruj</div>
                    <div class="zaloguj">
                        <button type="submit">zaloguj</button>
                    </div>
                </div>
                <input name="action" value="login" hidden>
            </div>
        </form>
        <form action="./loginscript.php" method="post">
            <div class="rejestracja blok">
                <p class="dopisek">podaj imie:</p>
                <input type="text" name="imier" class="login " placeholder="imie">
                <p class="dopisek">podaj nazwisko:</p>
                <input type="text" name="nazwiskor" class="login " placeholder="nazwisko">
                <p class="dopisek">podaj mail:</p>
                <input type="text" name="mailr" class="mail " placeholder="mail">
                <p class="dopisek">podaj hasło:</p>
                <input type="password" name="haslor" class="haslo " placeholder="hasło">
                <p class="dopisek">powtórz hasło:</p>
                <input type="password" name="haslorp" class="haslo " placeholder="hasło">
                <p class="antyrej">
                    <?php 
                        if(isset($_SESSION['reg']) && $_SESSION['reg'] == "error"){
                            echo "<b>błędne dane do rejestracji</b>";
                        }
                        else if(isset($_SESSION['rege']) && $_SESSION['rege'] == "error"){
                            echo "<b>mail już jest w użyciu</b>";
                        }
                        else if(isset($_SESSION['regp']) && $_SESSION['regp'] == "1"){
                            echo "<b>pomyślnie zarejestrowano</b>";
                        }
                    ?>
                </p>
                <div class="login-button">
                    <div class="rejestruj" id="log">zaloguj</div>
                    <div class="zaloguj">
                        <button type="submit">zarejestruj</button>
                    </div>
                </div>
                <input name="action" value="rejestr" hidden>
            </div>
        </form>
    </body>
</html>