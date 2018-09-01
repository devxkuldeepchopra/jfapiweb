<?php 

    require_once("common.php");
    require_once("_layout/header.php");
    require_once("_layout/sidebar.php");
    require_once("_layout/footer.php");
    require_once("js/homejs.php");
    if(isset($_POST['page'])){

        $content->page = $_POST['page'];

    }

    $url = $_SERVER["REQUEST_URI"];

    $urlExplode = explode("/",$url);

    $urlLength = sizeof($urlExplode);

    $path = $urlExplode[1];

    if($path !="admin" && $path != ""){ 

        require_once("postview.php");

    }   

    else if($path == "admin"){

        include 'admin.php';

    }

    else if(!$path) {

        require_once("home.php");  

    }

    else{    

        echo 'Not Found.........';

      // header('Location: /');

    }

if($path != "admin"){

echo '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <html lang="en-US" prefix="og: http://ogp.me/ns#">   
        <meta name="viewport" content="width=device-width, initial-scale=1">
           '.head($headContent).' 
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Rubik:500|Roboto:100,400,500,900|Sawarabi+Gothic|Economica:700|Yanone+Kaffeesatz" rel="stylesheet">
    </head>
    <body>
        <div class="container">';
                if($html->content) {
                    echo $html->header.
                        $html->content.
                        $html->sidebar.
                        $html->footer;
                }        
       echo' </div>
    </body>
    </html><script> function showMenu() {
        var x = document.getElementById("menu-list").style ;
        var m = document.getElementById("menu").style;
        var c = document.getElementById("close").style;
        x.display == "block" ? (x.display = "none",c.display = "none", m.display = "block") : (x.display = "block", c.display = "block", m.display = "none");
    } </script>';
}
echo'<script>'.jscode().'<script>';
?>





