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
            <a href="loginchose.php">
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
                                <a href='main.php' class='menu-a'>
                                    <div class='menu-span'>głowna</div>
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
                    else if($who != "student"){
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
        <form class="form-oceny o2">
            <div class="cialo"> 
                <div class="podcialo" id="podcialo">
                    <div class="podpodcialo">
                        <div class="b1">przedmiot </div>
                        <div>|</div>
                        <div class="b1">nauczyciel</div>
                        <div>|</div>
                        <div class="b1">oceny</div>
                        <div>|</div>
                        <div class="b1">data</div>
                    </div>
                    <?php
                        require_once "./database.php";
                        $id = $_SESSION['id'];
                        $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                        $qerry ="SELECT subject.name_subject, marks.value_mark, administration.name, administration.surname, marks.date_mark FROM marks INNER JOIN administration ON marks.id_teacher = administration.id_person INNER JOIN subject ON marks.id_subject = subject.id_subject WHERE marks.id_student = $id Order BY subject.name_subject;";
                        $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                        foreach($students as $wynik){
                            echo "<div class='podpodcialo'>
                                <div class='b1'>". $wynik['name_subject']."</div>
                                <div>|</div>
                                <div class='b1'>". $wynik['name']."   ". $wynik['surname']. "</div>
                                <div>|</div>
                                <div class='b1'>".$wynik['value_mark']."</div>
                                <div>|</div>
                                <div class='b1'>".$wynik['date_mark']."</div>
                                </div>";
                        } 
                        mysqli_close($conect);
                    ?>
                </div>
            </div>
        </form>
    </body>
</html>