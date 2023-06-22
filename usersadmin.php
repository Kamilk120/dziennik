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
        <link rel="stylesheet" type="text/css" href="style/glowna.css" />
    </head>
    <header>
        <div class="logo">
            <a href="loginChose.php">
                <img src="images/open-book.png" class="logo-img" alt="książka tu była"/>
            </a>   
            <p class="logo-text">Szkoula</p>
        </div>
        <div class="menu">
            <?php
                session_start();
                if(isset($_SESSION['class'])){
                    $who=$_SESSION['class'];
                    if($who == "student"){
                        header("Location: ./loginChose.php");
                    }
                    else if($who == "teacher"){
                    }
                    else if($who == "headteacher"){
                    }
                    else if($who == "admin"){
                        echo "
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='main.php' class='menu-a'>
                                    <div class='menu-span'>główna</div>
                                </a>
                            </span>
                        </div>
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='ocenyadmin.php' class='menu-a'>
                                    <div class='menu-span'>oceny</div>
                                </a>
                            </span>
                        </div>
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='presentadmin.php' class='menu-a'>
                                    <div class='menu-span'>frekfencja</div>
                                </a>
                            </span>
                        </div>
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='uwagiadmin.php' class='menu-a'>
                                    <div class='menu-span'>uwagi</div>
                                </a>
                            </span>
                        </div>
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='planadmin.php' class='menu-a'>
                                    <div class='menu-span'>plan lekcji</div>
                                </a>
                            </span>
                        </div>";
                    }
                    else{
                        header("Location: ./loginChose.php");
                    }
                }
                else{
                  header("Location: ./loginChose.php");
                }
            ?>
            <div class="menu-block">
                <div class="menu-block2">
                    <img src="./images/login-ikonka.png" class="login-ikonka"/><br>
                    <span class="menu-imie">
                        <a href="./profil.php" class="menu-a">
                            <?php
                                if($_SESSION['name']!=null && $_SESSION['log']=='zalogowano'){
                                    echo $_SESSION['name'];
                                } 
                                else{
                                    header("Location: ./loginchose.php");
                                }
                                require_once "./database.php";
                                $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                            ?>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </header>
    <body>
        <form class="form-oceny o2">
            <div class="ind">
                <?php
                    $qerry ="SELECT * FROM `industry`";
                    $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                    foreach($wynik as $w){
                        echo "<button type='submit' onClick='industry(this.value)' value='".$w['name_industry']."' class='industry'>".$w['name_industry']."</button>";
                    }
                ?>
                <button type='submit' onClick='industry(this.value);clasy(this.value)' value='null' class='industry'>wyczyść</button>
            </div>
            <div class="ind">
                <?php
                    if(isset($_SESSION['industr']) && $_SESSION['industr']!='null'){
                        $qerry ="SELECT * FROM `class` WHERE id_industry = '".$_SESSION['industr']."';";
                        $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                        foreach($wynik as $w){
                            echo "<button type='submit' onClick='clasy(this.value)' value='".$w['name_class']."' class='industry'>".$w['name_class']."</button>";
                        }
                        echo "<button type='submit' onClick='clasy(this.value)' value='null' class='industry'>wyczyść</button>";
                    }
                ?>
            </div>
            <div class="cialo"> 
                <div class="podcialo" id="podcialo">
                    <div class="podpodcialo">
                        <div class="b1">osoba </div>
                        <div>|</div>
                        <div class="b1">klasa</div>
                        <div>|</div>
                        <div class="b1">edycja</div>
                    </div>
                    <div class="podpodcialo">
                    <?php
                        if(isset($_SESSION['industr']) && $_SESSION['industr']!=''){
                            echo '
                                <span><b>Nauczyciele</b></span>
                            </div>';
                            $qerry ="SELECT * FROM `administration` WHERE id_industry = '".$_SESSION['industr']."'";
                            $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                            foreach($students as $wynik){
                                echo "<div class='podpodcialo'>
                                <div class='b1'>". $wynik['name']."   ". $wynik['surname']. "</div>
                                <div>|</div>
                                <div class='b1'>". $wynik['id_industry']. "</div>
                                <div>|</div>
                                <div class='b1'><a href='./edit.php?id=". $wynik['id_person']."&class=".$wynik['permision']."' class='edit'>edytuj</a><a href='./adddell.php?id=". $wynik['id_person']."&class=".$wynik['permision']."&co=usun' class='edit'> usuń</a></div>
                            </div>";
                            } 
                        }
                        if(isset($_SESSION['clas']) && $_SESSION['clas']!=''){
                            echo '<div class="podpodcialo">
                                <span><b>uczniowie</b></span>
                            </div>';
                            $qerry ="SELECT students.id_student, students.name, students.surname , class.name_class FROM students INNER JOIN class ON students.id_class=class.id_class WHERE name_class = '".$_SESSION['clas']."';";
                            $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                            foreach($students as $wynik){
                                echo "<div class='podpodcialo'>
                                <div class='b1'>". $wynik['name']."   ". $wynik['surname']. "</div>
                                <div>|</div>
                                <div class='b1'>". $wynik['name_class']. "</div>
                                <div>|</div>
                                <div class='b1'><a href='./edit.php?id=". $wynik['id_student']."&class=student' class='edit'>edytuj</a><a href='./adddell.php?id=". $wynik['id_student']."&class=student&co=usun' class='edit'> usuń</a></div>
                            </div>";
                            } 
                        }    
                    ?>
                    <div class="podpodcialo">
                        <a href="./add.php">dodaj urzytkownika</a>
                    </div>
                </div>
            </div>
            <div style="font-size: 2vw; margin:2vw;">Inni</div>
            <div class="cialo"> 
                <div class="podcialo" id="podcialo">
                    <div class="podpodcialo">
                        <div class="b1">osoba </div>
                        <div>|</div>
                        <div class="b1">klasa</div>
                        <div>|</div>
                        <div class="b1">edycja</div>
                    </div>
                    <?php
                        $qerry ="SELECT * FROM `administration` WHERE permision  is NULL ";
                        $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                        foreach($students as $wynik){
                            echo "<div class='podpodcialo'>
                            <div class='b1'>". $wynik['name']."   ". $wynik['surname']. "</div>
                            <div>|</div>
                            <div class='b1'> </div>
                            <div>|</div>
                            <div class='b1'><a href='./edit.php?id=". $wynik['id_person']."&class=".$wynik['permision']."&er=error' class='edit'>edytuj</a><a href='./adddell.php?id=". $wynik['id_person']."&class=".$wynik['permision']."&co=usun' class='edit'> usuń</a></div>
                        </div>";
                        }
                        $qerry ="SELECT students.id_student, students.name, students.surname FROM students  WHERE id_class is NULL ;";
                        $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                        foreach($students as $wynik){
                            echo "<div class='podpodcialo'>
                            <div class='b1'>". $wynik['name']."   ". $wynik['surname']. "</div>
                            <div>|</div>
                            <div class='b1'> </div>
                            <div>|</div>
                            <div class='b1'><a href='./edit.php?id=". $wynik['id_student']."&class=student&er=error' class='edit'>edytuj</a><a href='./adddell.php?id=". $wynik['id_student']."&class=student&co=usun' class='edit'> usuń</a></div>
                        </div>";
                        }
                        mysqli_close($conect);
                    ?>
                </div>
            </div>
        </form>
    <script src="./script/AJAX.js"></script>
    </body>
</html>