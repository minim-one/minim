<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
echo'<article>';
if(strlen($content)>=$preview){
	echo markdown(preg_replace('/\s+?(\S+)?$/','',substr($content,0,$preview)).'…').'<p><a href="?post-'.$post.'">'.translation('Continue reading').'</a></p>';
}else{
	echo markdown($content);
}
echo'<div class="information">'.$post_tags.'<time>'.$post_date.'</time> | <a href="?post-'.$post.'">#'.$post_number.'</a></div></article>';
?>
