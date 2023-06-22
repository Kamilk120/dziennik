<?php
    if(isset($_SESSION['log'])){
        $_SESSION['log']=null ;
        header("Location: ./loginChose.php");
    }
    else{
        header("Location: ./loginChose.php");
    }
?>