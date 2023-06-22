<!DOCTYPE html>
<html>
    <head>
        <title>szkoula</title>
        <meta charset="utf-8">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="script/logowanie.js"></script>
        <script type="text/javascript" src="script/AJAX_marks.js"></script>
        <link rel="shortcut icon" type="image/ico" href="images/open-book.ico"/>
        <link rel="stylesheet" type="text/css" href="style/background.css " />
        <link rel="stylesheet" type="text/css" href="style/login.css" />
        <link rel="stylesheet" type="text/css" href="style/glowna.css" />
    </head>
    <header>
        <div class="logo">
            <a href="loginThema.php">
                <img src="images/open-book.png" class="logo-img" alt="książka tu była"/>
            </a>   
            <p class="logo-text">Szkoula</p>
        </div>
    </header>
    <body>
        <form class="form-oceny o1" id="ocenywpis" action="javascript:sprawdzanie();">
            <div class="klasa">
                <div>Klasy</div>
                <div name="klasy" class="klasy">
                    <?php
                        require_once "./database.php";
                        $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                        $qerry ="SELECT `name_class` FROM `class`";
                        $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                        foreach($klasy as $wynik){
                            echo "<div class='k'><input type='radio' class='k' name='k' value='". $wynik['name_class']. "''>". $wynik['name_class']. "</div>";
                        } 
                        mysqli_close($conect);
                    ?>
                </div>
            </div>
            <div class="przedmioty">
                <div>PRZEDMIOTY</div>
                <div name="przedmioty" class="przedmiot">
                    <?php
                        require_once "./database.php";
                        $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                        $qerry ="SELECT `name_subject` FROM `subject`";
                        $klasy = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                        foreach($klasy as $wynik){
                            echo "<div class='k'><input type='radio' class='k' name='p' value='". $wynik['name_subject']. "'>". $wynik['name_subject']. "</div>";
                        } 
                        mysqli_close($conect);
                    ?>
                </div>
            </div>
            <button type="submit" class="sherch" >szukaj</button>
        </form>
        <form class="form-oceny o2">
            <div class="cialo"> 
                <div class="podcialo" id="podcialo">
                    <div class="podpodcialo">
                        <div class="b1">uczniowie </div>
                        <div>|</div>
                        <div class="b1">oceny</div>
                        <div>|</div>
                        <div class="b1">edycja</div>
                    </div>
                    <div class="podpodcialo">
                        <div class="b1">ANTUAN MSID </div>
                        <div>|</div>
                        <div class="b1">4,3,2,4,3,2,34,4</div>
                        <div>|</div>
                        <div class="b1"><span class="edit">edytuj</span><span class="edit"> usuń</span></div>
                    </div>
                </div>
            </div>
        </form>
        <!--<div class="podpodcialo">
            <div class="b1"><input type="txt" placeholder="imie"/><input type="txt" placeholder="nazwisko"/></div>
            <div class="b1"><input type="txt" placeholder="ocena"/></div>
            <div class="b1"><button>dodaj</button></div> -->
        </div>
    </body>
</html>