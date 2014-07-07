<?php
/**
 * Created by Rafique Mohammed
 * ar.rafiq@live.com
 */
define("DB_HOST","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","");
define("DB_NAME","song_db"); //Database Name

define("TAB_AUDIO","audio"); //Table Name of audio data
define("COVER_PATH","cover/"); //directory path of mp3 thumbnail
define("MP3_PATH","mp3/"); //directory path of mp3 files


$DB=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die("Error occurred while connecting to database");
