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
            <div class="menu"></div>
        </div>
    </header>
    <body>
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
        ?>
        <form action="./loginThema.php" method="post">
            <div class="logo who">
                <p>
                    <input type="radio" name="who" value="admin" class="who-radio"/><span>Nauczyciel</span><br>
                    <input type="radio" name="who" value="student" class="who-radio" checked/><span>Uczeń</span>
                    <button type="submit" class="who-submit">Dalej</button>
                </p>
            </div>
        </form>
    </body>
</html>