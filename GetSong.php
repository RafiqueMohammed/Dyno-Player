<?php
require_once("config.php");

if(isset($_GET['keyword'],$_GET['type'])){
    $key=trim($DB->real_escape_string($_GET['keyword']));
    $type=trim($DB->real_escape_string($_GET['type']));
    //$qry=$DB->query("SELECT * FROM `".TAB_AUDIO."` WHERE `title` LIKE '%".$key."%'");
    switch($type){
        case 'movie':
        $qry=$DB->query("SELECT * FROM `".TAB_AUDIO."` WHERE `album` LIKE '%".$key."%'") or die($DB->error);
         ; break;
        case 'song':
       $qry=$DB->query("SELECT * FROM `".TAB_AUDIO."` WHERE `title` LIKE '%".$key."%'") or die($DB->error);
         ; break;
        case 'artist': 
       $qry=$DB->query("SELECT * FROM `".TAB_AUDIO."` WHERE `artist` LIKE '%".$key."%'") or die($DB->error);
        ; break;
        case 'music_director': 
       $qry=$DB->query("SELECT * FROM `".TAB_AUDIO."` WHERE `music_director` LIKE '%".$key."%'") or die($DB->error);
        ; break;
        default:
       $qry=$DB->query("SELECT * FROM `".TAB_AUDIO."` WHERE `title` LIKE '%".$key."%'") or die($DB->error);
         ;break;
        
    }




if($qry->num_rows >0){
    $playlist="";

    while($info=$qry->fetch_assoc()){
        $playlist.="<li class='audio_playlist_item' audiourl='".MP3_PATH."{$info['mp3_path']}' cover='".COVER_PATH."{$info['thumbnail']}' artist='{$info['artist']}'>
        <span class='title_name'>{$info['title']}</span>
        <br>
        <span style='color:red;font-size:10px'>{$info['artist']} </span> | <span style='color:orange;font-size:10px'>{$info['album']}</span>
        </li>";
    }
}else{
    $playlist= "<div class='notfound'><img src='images/sad.png' /> <div style='margin-top:5px'>No songs found in our database </div></div>";
}

echo $playlist;
}
?>