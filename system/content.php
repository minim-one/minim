<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
if($category=='post'||$category=='site'||$category=='tag'||$category=='rss'){
	$path='posts';
}
if($category=='page'){
	$path='pages';
}
$content=preg_replace('/\[meta\](.*?)\[\/meta\]/s','',file_get_contents('./'.$path.'/'.$post));
if(strstr(file_get_contents('./'.$path.'/'.$post),'[meta]')&&strstr(file_get_contents('./'.$path.'/'.$post),'[/meta]')){
	$meta_content=preg_match_all('/\[meta\](.*?)\[\/meta\]/s',file_get_contents('./'.$path.'/'.$post),$meta);
	$meta=str_replace(array('[meta]'.PHP_EOL,PHP_EOL.'[/meta]'),'',$meta[0][0]);
	$meta=preg_split('/((\r(?!\n))|((?<!\r)\n)|(\r\n))/',$meta);
	$meta_date=preg_grep('/date:(.*)/',$meta);
	if(count($meta_date)!=0){
		$post_date=str_replace(array('date: ','date:'),'',implode(',',$meta_date));
	}else{
		$post_date=date($date,filemtime('./'.$path.'/'.$post));
	}
	$meta_title=preg_grep('/title:(.*)/',$meta);
	if(count($meta_title)!=0){
		$post_title=str_replace(array('title: ','title:'),'',implode(',',$meta_title));
	}else{
		$post_title=pathinfo($post,PATHINFO_FILENAME);
	}
	$meta_description=preg_grep('/description:(.*)/',$meta);
	if(count($meta_description)!=0){
		$post_description=str_replace(array('description: ','description:'),'',implode(',',$meta_description));
	}
	$meta_robots=preg_grep('/robots:(.*)/',$meta);
	if(count($meta_robots)!=0){
		$post_robots=str_replace(array('robots: ','robots:',' '),'',implode(',',$meta_robots));
	}
	$meta_tags=preg_grep('/tags:(.*)/',$meta);
	if(count($meta_tags)!=0){
		$tags=str_replace(array('tags: ','tags:',', '),array('','',','),implode(',',$meta_tags));
		$tags_link=explode(',',$tags);
		$post_tags='<span class="tags">';
		for($j=0;$j<count($tags_link);$j++){
			$post_tags.='<a href="?tag-'.$tags_link[$j].'">#'.$tags_link[$j].'</a>';
		}
		$post_tags.='</span> | ';
	}
}else{
	$post_date=date($date,filemtime('./'.$path.'/'.$post));
	$post_title=pathinfo($post,PATHINFO_FILENAME);
	$post_tags='';
}
?>
