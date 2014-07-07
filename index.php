<?php
/**
 * Created by Rafique Mohammed
 * ar.rafiq@live.com
 */

require_once("config.php");

$qry=$DB->query("SELECT * FROM `".TAB_AUDIO."` ORDER BY RAND() LIMIT 10");
if($qry->num_rows >0){
    $playlist="";
    while($info=$qry->fetch_assoc()){
        $path=MP3_PATH.$info['mp3_path'];
        $playlist.="<li class='audio_playlist_item' audiourl='$path' cover='".COVER_PATH."{$info['thumbnail']}' artist='{$info['artist']}'>
        <span class='title_name'>{$info['title']}</span>
        <br>
        <span style='color:red;font-size:10px'>{$info['artist']} </span> | <span style='color:orange;font-size:10px'>{$info['album']}</span>
        </li>";
    }
}else{
    $playlist= "<div class='notfound'><img src='images/sad.png' /> <div style='margin-top:5px'>No songs found in our database </div></div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Music Player</title>

    <!-- add styles and scripts -->
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <style>

        .playlist{
            font-family: "Arial";
            font-size: 12px;

        }
        .audio_playlist_item{
            padding-bottom: 5px;
        }
        .notfound{
            color: #ccc;text-align: center;

            font-style: italic;
            font-size: 13px;

        }
        .coverbox{

            background: #3B3B3B;
            float: right;
            -moz-border-radius: 7px;
            -webkit-border-radius: 7px;
            border-radius: 7px;
            height: 159px;
            width: 144px;
        }
        .audio_search_box{
            margin-top: 5px;
            margin-bottom: 18px;
            min-height: 35px
        }
        .audio_search_txt{
            min-height: 20px;
            width: 46%;
            padding: 7px;
            margin-right: 3px;
        }
        .audio_search_button{
            background: #333333;
            border: 1px solid #3B3B3B;
            cursor: pointer;
            min-height: 34px;
            color: #ffffff;
            min-width: 29.9%;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;


        }
        .audio_search_option{
            padding: 9px;
            max-width: 88px;
        }
    </style>
    <script>
    $(document).ready(function(){

    	  $('#search').on('click',function(){
        var key=$('.audio_search_txt').val();
        var type=$('.audio_search_option').val();
        
        if(key==""){
            alert("Enter album name or song name to search");
        }else{
               $.get("GetSong.php?keyword="+key+"&type="+type,function(data){
                $(".playlist").html(data);
        });
        }
    });
    });
    </script>
</head>
<body>
    <div class="example">

        <div class="player">
            <div class="pl"></div>
            <div class="title"></div>
            <div class="artist"></div>

            <div class="controls">
                <div class="play"></div>
                <div class="pause"></div>
                <div class="rew"></div>
                <div class="fwd"></div>
            </div>
            <div class="volume"></div>
            <div class="tracker"></div>

        </div>
        <div class="coverbox"> <div class="cover"></div></div>
        <div style="clear: both"></div>
        <div class="audio_search_box">
           <select class="audio_search_option"><option value="movie">Album </option><option value="song"> Song </option><option value="music_director"> Music Director </option>
           <option value="singer"> Singer </option>
           
           </select> <input class="audio_search_txt" type="text" placeholder="type any artist,movie or song name" /><button class="audio_search_button" id="search">Search</button></div>

        <ul class="playlist ">
        
         <?php echo $playlist; ?>

        </ul>

    </div>
</body>
</html>