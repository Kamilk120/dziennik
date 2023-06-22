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
        <form class="form-oceny o2" method="get" action="./adddell.php?co=edit">
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
                        session_start();
                        require_once "./database.php";
                        $id = $_GET['id'];
                        $class=$_GET['class'];
                        $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                        if($class=="student"){
                            if($_GET['er']="error"){
                                $qerry ="SELECT * FROM students WHERE students.id_student=$id;";
                                $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                                foreach($students as $wynik){
                                    echo "<div class='podpodcialo'>
                                    <div class='b1'>
                                        <input name='id' value='".$wynik['id_student']."' style='display:none;'>
                                        <input name='co' value='edit' style='display:none;'>
                                        <input name='class' value='student' style='display:none;'>
                                        <input name='idclass' value='useless' style='display:none;'>
                                        <span>imie</span>
                                        <input  class='b2' placeholder='imie' name='imie' value='".$wynik['name']."'>
                                        <span>nazwisko</span>
                                        <input  class='b2' placeholder='nazwisko' name='surname' value='".$wynik['surname']."'>
                                        <span>e-mail</span>
                                        <input  class='b2' placeholder='mail' name='mail' value='".$wynik['mail']."'>
                                        <span>hasło</span>
                                        <input  class='b2' placeholder='haslo' name='haslo' value='".$wynik['haslo']."'>
                                    </div>
                                    <div>|</div>
                                    <div class='b1'><input  class='b2' placeholder='klasa' name='clas' ></div>
                                    <div>|</div>
                                    <div class='b1'><button>zmien</button><a href='./adddell.php?id=". $wynik['id_student']."&class=$class&co=usun' class='edit'> usuń</a></div>
                                </div>";
                                }
                            }
                            else{
                                $qerry ="SELECT * FROM students INNER JOIN class ON students.id_class=class.id_class WHERE students.id_student=$id;";
                                $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                                foreach($students as $wynik){
                                    echo "<div class='podpodcialo'>
                                    <div class='b1'>
                                        <input name='id' value='".$wynik['id_student']."' style='display:none;'>
                                        <input name='co' value='edit' style='display:none;'>
                                        <input name='class' value='student' style='display:none;'>
                                        <input name='idclass' value='".$wynik['id_class']."' style='display:none;'>
                                        <span>imie</span>
                                        <input  class='b2' placeholder='imie' name='imie' value='".$wynik['name']."'>
                                        <span>nazwisko</span>
                                        <input  class='b2' placeholder='nazwisko' name='surname' value='".$wynik['surname']."'>
                                        <span>e-mail</span>
                                        <input  class='b2' placeholder='mail' name='mail' value='".$wynik['mail']."'>
                                        <span>hasło</span>
                                        <input  class='b2' placeholder='haslo' name='haslo' value='".$wynik['haslo']."'>
                                    </div>
                                    <div>|</div>
                                    <div class='b1'><input  class='b2' placeholder='klasa' name='clas' value='".$wynik['name_class']."'></div>
                                    <div>|</div>
                                    <div class='b1'><button>zmien</button><a href='./adddell.php?id=". $wynik['id_student']."&class=$class&co=usun' class='edit'> usuń</a></div>
                                </div>";
                                }
                            }
                        }
                        else if($class!="student"){
                            $qerry ="SELECT * FROM administration WHERE id_person=$id;";
                            $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                            foreach($students as $wynik){
                                echo "<div class='podpodcialo'>
                                <div class='b1'>
                                    <input name='id' value='".$wynik['id_person']."' style='display:none;'>
                                    <input name='co' value='edit' style='display:none;'>
                                    <input name='class' value='".$wynik['permision']."' style='display:none;'>
                                    <span>imie</span>
                                    <input  class='b2' placeholder='imie' name='imie' value='".$wynik['name']."'>
                                    <span>nazwisko</span>
                                    <input  class='b2' placeholder='nazwisko' name='surname' value='".$wynik['surname']."'>
                                    <span>e-mail</span>
                                    <input  class='b2' placeholder='mail' name='mail' value='".$wynik['mail']."'>
                                    <span>hasło</span>
                                    <input  class='b2' placeholder='haslo' name='haslo' value='".$wynik['haslo']."'>
                                    <span>rola</span>
                                    <input  class='b2' placeholder='permision' name='permis' value='".$wynik['permision']."'>
                                </div>
                                <div>|</div>
                                <div class='b1'><input  class='b2' placeholder='klasa' name='clas' value='".$wynik['id_industry']."'></div>
                                <div>|</div>
                                <div class='b1'><button>zmien</button><a href='./adddell.php?id=". $wynik['id_person']."&class=$class&co=usun' class='edit'> usuń</a></div>
                            </div>";
                            }
                        }
                        else{
                            echo "<script>alert('coś poszło nie tak')</script>";
                        }
                        mysqli_close($conect);
                    ?>
                </div>
            </div>
        </form>
    </body>
</html>