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
                        echo "
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='ocenystudent.php' class='menu-a'>
                                    <div class='menu-span'>oceny</div>
                                </a>
                            </span>
                        </div>
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='presentstudent.php' class='menu-a'>
                                    <div class='menu-span'>frekwencja</div>
                                </a>
                            </span>
                        </div>
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='uwagistudent.php' class='menu-a'>
                                    <div class='menu-span'>uwagi</div>
                                </a>
                            </span>
                        </div>
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='planstudent.php' class='menu-a'>
                                    <div class='menu-span'>plan lekcji</div>
                                </a>
                            </span>
                        </div>";
                    }
                    else if($who == "teacher"){
                    }
                    else if($who == "headteacher"){
                    }
                    else if($who == "admin"){
                        echo "
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
                                    <div class='menu-span'>frekwencja</div>
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
                        </div>
                        <div class='menu-block'>
                            <span class='menu-imie'>
                                <a href='usersadmin.php' class='menu-a'>
                                    <div class='menu-span'>urzytkownicy</div>
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
                            ?>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </header>
    <body>
        <div class="body-container">
            <div class="body-box plan">
                <span>Plan Lekcji na dziś</span>
                <div class="body-box plan-box">
                    <div class='podpodcialo'>
                        <div class='b1'>przedmiot</div>
                        <div class='b1'>|</div>
                        <div class='b1'>od</div>
                        <div class='b1'>|</div>
                        <div class='b1'>do</div>
                    </div>
                    <?php
                        require_once "./database.php";
                        $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                        $date=date('Y-m-d');
                        if($_SESSION['who']=='student'){
                            $id = $_SESSION['id'];
                            $qerry ="SELECT id_class FROM students WHERE id_student = $id;";
                            $id_class = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                            if(isset(mysqli_fetch_array($id_class)['id_class'])){
                                foreach($id_class as $ss){
                                    $id_class = $ss['id_class'];
                                }
                            } 
                            else{
                                echo '<script>alert("nie zostałeś przydzielony do żadnej klasy skontaktuj się z administratorem")</script>';
                                header("Location: ./loginchose.php");
                            }
                            $qerry ="SELECT subject.name_subject, day_leson.start_haur, day_leson.stop_hour FROM day_leson INNER JOIN subject ON day_leson.id_subject = subject.id_subject WHERE day_leson.id_class = $id_class AND day_leson.data_day='$date' ORDER BY day_leson.start_haur;";
                            $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                            foreach($wynik as $w){
                                echo "<div class='podpodcialo'>
                                <div class='b1'>". $w['name_subject']."</div>
                                <div class='b1'>|</div>
                                <div class='b1'>". $w['start_haur']. "</div>
                                <div class='b1'>|</div>
                                <div class='b1'>". $w['stop_hour']."</div>
                                </div>";
                            }
                        } 
                        else if($_SESSION['who']=='admin'){
                            $id = $_SESSION['id'];
                            $qerry ="SELECT subject.name_subject, day_leson.start_haur, day_leson.stop_hour FROM day_leson INNER JOIN subject ON day_leson.id_subject = subject.id_subject WHERE subject.id_teacher= $id AND day_leson.data_day='$date' ORDER BY day_leson.start_haur;";
                            $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                            foreach($wynik as $w){
                                echo "<div class='podpodcialo'>
                                <div class='b1'>". $w['name_subject']."</div>
                                <div class='b1'>|</div>
                                <div class='b1'>". $w['start_haur']. "</div>
                                <div class='b1'>|</div>
                                <div class='b1'>". $w['stop_hour']."</div>
                                </div>";
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="body-box uwaga">
                <?php
                    $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                    $date=date('Y-m-d');
                    if($_SESSION['who']=='student'){
                        echo "
                            <span>nieobecność</span>
                            <div class='body-box uwaga-box'>
                                <div class='podpodcialo'>
                                    <div class='b1'>nieobecnosc</div>
                                    <div class='b1'>|</div>
                                    <div class='b1'>kiedy</div>
                                </div>";
                        $id = $_SESSION['id'];
                        $qerry ="SELECT presence.presence, presence.leate, day_leson.data_day FROM presence INNER JOIN day_leson ON day_leson.id_day_leson = presence.id_day_leson WHERE presence.presence = 0 OR presence.leate = 0 LIMIT 10;";
                        $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                        foreach($wynik as $w){
                            if($w['presence'] == 0){
                                echo "<div class='podpodcialo'>
                                <div class='b1'>NB</div>
                                <div class='b1'>|</div>
                                <div class='b1'>". $w['data_day']. "</div>
                                </div>";
                            }
                            else if($w['leate'] == 0){
                                echo "<div class='podpodcialo'>
                                <div class='b1'>SP</div>
                                <div class='b1'>|</div>
                                <div class='b1'>". $w['data_day']. "</div>
                                </div>";
                            }
                        }
                        echo "</div>";
                    }
                ?>
                <span>uwagi</span>
                <div class="body-box uwaga-box">
                    <div class='podpodcialo'>
                        <div class='b1'>nieobecnosc</div>
                        <div class='b1'>|</div>
                        <div class='b1'>kiedy</div>
                    </div>
                    <?php
                        if($_SESSION['who']=='student'){
                            $qerry ="SELECT * FROM `obiections` WHERE id_student = $id LIMIT 10;";
                            $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                            foreach($wynik as $w){
                                echo "<div class='podpodcialo'>
                                <div class='b1'>Uwaga</div>
                                <div class='b1'>|</div>
                                <div class='b1'>". $w['date_obiection']. "</div>
                                </div>";
                            }
                        }
                        else if($_SESSION['who']=='admin'){
                            $id = $_SESSION['id'];
                            $qerry ="SELECT * FROM `obiections` WHERE id_person = $id LIMIT 10;";
                            $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                            foreach($wynik as $w){
                                echo "<div class='podpodcialo'>
                                <div class='b1'>Uwaga</div>
                                <div class='b1'>|</div>
                                <div class='b1'>". $w['date_obiection']. "</div>
                                </div>";
                            }
                        }
                    ?>
                </div>
            </div>
            <?php
                if($_SESSION['who']=='student'){
                    echo " 
                    <div class='body-box oceny'>
                        <span>Oceny</span>
                        <div class='body-box oceny-box'>
                            <div class='podpodcialo'>
                                <div class='b1'>ocena</div>
                                <div class='b1'>|</div>
                                <div class='b1'>przedmiot</div>
                                <div class='b1'>|</div>
                                <div class='b1'>data</div>
                            </div>
                        ";
                    $qerry ="SELECT  marks.value_mark, marks.date_mark, subject.name_subject FROM `marks` INNER JOIN subject ON marks.id_subject = subject.id_subject WHERE marks.id_student = $id LIMIT 30;";
                    $wynik = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                    foreach($wynik as $w){
                        echo "<div class='podpodcialo'>
                        <div class='b1'>".$w['value_mark']."</div>
                        <div class='b1'>|</div>
                        <div class='b1'>".$w['name_subject']."</div>
                        <div class='b1'>|</div>
                        <div class='b1'>". $w['date_mark']. "</div>
                        </div>";
                    }
                    echo "
                        </div>
                    </div>";
                }
            ?>
        </div>
    </body>
</html>