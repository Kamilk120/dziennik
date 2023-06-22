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
        <form class="form-oceny o2">
            <div class="cialo"> 
                <div class="podcialo" id="podcialo">
                    <div class="podpodcialo">
                        <div class="b1">uczeń </div>
                        <div>|</div>
                        <div class="b1">klasa</div>
                        <div>|</div>
                        <div class="b1">edycja</div>
                    </div>
                    <?php
                        require_once "./database.php";
                        $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                        $qerry ="SELECT students.id_student, students.name, students.surname , class.name_class FROM students INNER JOIN class ON students.id_class=class.id_class;";
                        $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                        foreach($students as $wynik){
                            echo "<div class='podpodcialo'>
                            <div class='b1'>". $wynik['name']."   ". $wynik['surname']. "</div>
                            <div>|</div>
                            <div class='b1'>". $wynik['name_class']. "</div>
                            <div>|</div>
                            <div class='b1'><a href='./edit.php?id=". $wynik['id_student']."' class='edit'>edytuj</a><a href='./adddell.php?id=". $wynik['id_student']."&co=usun' class='edit'> usuń</a></div>
                        </div>";
                        } 
                        mysqli_close($conect);
                    ?>
                    <div class="podpodcialo">
                        <a href="./add.php">dodaj ucznia</a>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>