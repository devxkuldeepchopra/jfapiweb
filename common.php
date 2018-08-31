<?php
    require_once('server/PostClass.php');
    require_once('server/conn.php');
 
    $ads = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- devx -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-5876716835770345"
         data-ad-slot="3438846476"
         data-ad-format="auto"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>';
    $uploadImgPath = "web/src/assets/uploads/";
	$Post = new Post($conn);
    $httpRequest= (object) array(
        'apiUrl'=>'http://jiofox.com/server/post.php',
        'Post'=>'POST', 'Get'=>'GET'
    );
    $content= (object) array(
        'page'=>1,
        'limit'=>4,
        'randPage'=>''
    );
    $headContent = (object) array(
        'title'=>'jiofox',
        'websiteName'=>'jiofox.com',
        'description'=>'',
        'keyword'=>'',
        'baseUrl'=>'http://jiofox.com/',
        'favicon'=>'',
        'thumbImage'=>'jiofox.jpg',
        'url'=>''
    ); 
    $html = (object) array(
        'head'=>'',
        'header'=>'',
        'content'=>'',
        'sidebar'=>'',
        'footer'=>'',
    );
    function Head( $headContent) {
        return $head = '   <title>'.$headContent->title.'</title>
        <meta name="description" content="'.$headContent->description.'"/>
        <meta name="title" content="'.$headContent->title.'"/>
        <meta property="og:url" content="'.$headContent->baseUrl.$headContent->url.'"/>
        <meta property="og:site_name" content="'.$headContent->websiteName.'"/>
        <meta property="og:locale" content="en_US" />                
        <meta property="og:title" content="'.$headContent->title.'"/>
        <meta property="og:description" content="'.$headContent->description.'"/>
        <meta property="og:image" content="'.$headContent->baseUrl.$headContent->thumbImage.'"/>
        <link rel="alternate" href="'.$headContent->baseUrl.$headContent->url.'" hreflang="en-us" />
        <link rel="canonical" href="'.$headContent->baseUrl.$headContent->url.'"/>
        <meta name="robots" content=" index, follow "/>
        <link rel="icon" href="images/favicon.png" sizes="16x16 32x32" type="image/png"> 
    ';
    }
    $totalRows = $Post->PostPagination();
    $totalRows = $totalRows[0]['total'];
    
    // $ads='';
   
    

?>