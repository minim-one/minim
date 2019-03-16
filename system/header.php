<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
header('Content-Type:text/html;charset='.$encoding);
require_once('./system/language.php');
if(isset($post_title)){
	$title=$title.' | '.$post_title;
}
if(isset($post_description)){
	$description=$post_description;
}
if(isset($post_robots)){
	$robots=$post_robots;
}
echo'<!doctype html><html lang="'.$language.'"><head>';
if(is_file('./config/head.php')){
	include('./config/head.php');
}else{
	echo'<title>'.$title.'</title><meta charset="'.$encoding.'"><meta name="robots" content="'.$robots.'"><meta name="viewport" content="width=device-width,initial-scale=1.0"><meta name="description" content="'.$description.'"><link rel="stylesheet" type="text/css" href="./themes/'.$theme.'/style.css"><link rel="icon" type="image/png" href="./themes/'.$theme.'/logo.png"><link rel="alternate" type="application/rss+xml" title="'.$title.'" href="./?rss">';
}
echo'</head><body class="'.$category.'">';
require_once('./system/markdown.php');
echo'<header>';
echo markdown(file_get_contents('./config/header.md'));
echo'</header>';
include('./system/pages.php');
if(count($pages)>0){
	echo'<input type="checkbox" id="menu" class="menu"><label for="menu"></label><nav><ul><li><a href="./">'.$menu.'</a></li>';
	for($i=1;$i<count($pages);$i++){
		echo'<li><a href="?page-'.$pages[$i].'">'.pathinfo($pages[$i],PATHINFO_FILENAME).'</a></li>';
	}
	echo'</ul></nav>';
}
echo'<main>';
?>
