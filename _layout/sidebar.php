<?php
function sidebar($httpRequest, $totalRows, $Post, $uploadImgPath){
    $randPage = rand(0,$totalRows-2);
    $Data = $Post->GetPost(0,2, $randPage);
    $sidebar='';
    if($Data) {
   
            foreach($Data['post'] as $post){
                $sidebar.='<div class="side-box">
                                <a href="'.$post['Url'].'">
                                <img src="'.$uploadImgPath.$post['ImageUrl'].'" alt="'.$post['Title'].'"/>
                                <li class="title" title="'.$post['Title'].'">'.$post['Title'].'</li>
                            </a></div>';
            }
        }
    return  $sidebar;
}

$html->sidebar = '<ul class="col-2" id="col-2"><div class="ads" id="ads">'.$ads.'</div>'.sidebar($httpRequest, $totalRows, $Post,$uploadImgPath).sidebar($httpRequest, $totalRows, $Post,$uploadImgPath).'<div class="ads">'.$ads.'</div></ul>';

?>