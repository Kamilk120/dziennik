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
        <form class="form-oceny o2" method="get" action="./adddell.php?co=add">
            <div class="cialo"> 
                <div class="podcialo" id="podcialo">
                    <div class="podpodcialo">
                        <div class="b1">podstawowe dane</div>
                    </div>
                    <div class='podpodcialo'>
                        <div class='b1'>
                            <input name='co' value='dodaj' style='display:none;'>
                            <input name='id' value='' style='display:none;'>
                            <input  class='b2' placeholder='imie' name='imie'>
                            <input  class='b2' placeholder='nazwisko' name='surname' >
                            <input  class='b2' placeholder='mail' name='mail' >
                            <input  class='b2' placeholder='haslo' name='haslo' >
                        </div>
                        <div class='b1'>
                            <input  class='b2' placeholder='klasa' name='class'>
                            <input  class='b2' placeholder='industry' name='industry'>
                        </div>
                    </div>
                    <div class='podpodcialo'>
                        <button class="hir-bro" type="submit">dodaj</button>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>