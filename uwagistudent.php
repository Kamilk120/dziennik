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
                        <div class="b1">kiedy</div>
                        <div>|</div>
                        <div class="b1">od kogo</div>
                        <div>|</div>
                        <div class="b1">czemu </div>
                    </div>
                    <?php
                        require_once "./database.php";
                        $id = $_SESSION['id'];
                        $conect = mysqli_connect($host, $user, $pass, $db) or die('nie połączono bazy danych');
                        $qerry ="SELECT  obiections.thema, administration.name, administration.surname, obiections.date_obiection FROM obiections INNER JOIN administration ON obiections.id_person = administration.id_person INNER JOIN students ON obiections.id_student = students.id_student WHERE obiections.id_student = $id;";
                        $students = mysqli_query($conect, $qerry) or die("nie udało sie wykonać");
                        foreach($students as $wynik){
                            echo "<div class='podpodcialo'>
                            <div class='b1'>". $wynik['date_obiection']. "</div>
                            <div>|</div>
                            <div class='b1'>". $wynik['name']."   ". $wynik['surname']. "</div>
                            <div>|</div>
                            <div class='b1'>". $wynik['thema']. "</div>
                            </div>";
                        }
                        echo "</div>";
                        mysqli_close($conect);
                    ?>
                </div>
            </div>
        </form>
    </body>
</html>