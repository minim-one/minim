<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
if(preg_match('/\?tag-*/',$_SERVER['REQUEST_URI'])){
	$category='tag';
	include('./system/posts.php');
	$tag=explode('?',$_SERVER['REQUEST_URI']);
	$tag=substr(urldecode($tag[1]),4);
	if(preg_match('/\?tag-[0-9]-*/',$_SERVER['REQUEST_URI'])){
		$tag_page=explode('-',$tag);
		$tag_page=$tag_page[0];
		$tag=str_replace($tag_page.'-','',$tag);
	}else{
		$tag_page=1;
	}
	$meta_posts=array();
	$tag_posts=array();
	$tag_posts_number=array();
	$tag_found=false;
	for($i=count($posts)-1;$i>=0;$i--){
		$post=$posts[$i];
		if(strstr(file_get_contents('./posts/'.$post),'[meta]')&&strstr(file_get_contents('./posts/'.$post),'[/meta]')){
			include('./system/content.php');
			if(in_array($tag,$tags_link)){
				$tag_found=true;
				$post_number=array_search($post,$posts);
				array_push($tag_posts,$post);
				array_push($tag_posts_number,$post_number);
			}
		}
	}
	if(count($tag_posts)>0){
		sort($tag_posts);
		array_unshift($tag_posts,'');
	}
	require_once('./system/header.php');
	if(!$tag_found){
		echo'<article><p>'.translation('Tag doesn\'t exist').'. <a href="./">'.translation('to the main page').'</a></p></article>';
	}else{
		echo'<section class="tag"><a href="./">&#8617;</a> #'.$tag.'</section>';
		$count_segmentation=count($tag_posts);
		if(preg_match('/\?tag-[0-9]-*/',$_SERVER['REQUEST_URI'])){
			$current=$tag_page;
		}else{
			$current=1;
		}
		include('./system/segmentation.php');
		if($site_found){
			for($i=$count;$i>=$end;$i--){
				if(isset($tag_posts[$i])&&$i!=0){
					$post=$tag_posts[$i];
					$post_number=array_search($post,$posts);
					include('./system/content.php');
					include('./system/preview.php');
				}
			}
			echo'<section class="sites">';
			if($current!=$previous){
				echo'<a href="./?tag-'.$previous.'-'.$tag.'" class="left">&#9664;</a>';
			}
			echo $tag_page.' / '.$sites;
			if($current!=$next){
				echo'<a href="./?tag-'.$next.'-'.$tag.'" class="right">&#9654;</a>';
			}
			echo'</section>';
		}
	}
	require_once('./system/footer.php');
}
?>
