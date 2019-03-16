<?php
/*
Add:
<form action="./?search" method="post"><input type="search" name="item" placeholder="'.translation('Search').'" required><input type="submit" name="search" value="'.translation('Search').'"></form>
to the place where you want to have the search form.
*/
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
if(parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY)=='search'){
	$category='search';
	require_once('./system/header.php');
	echo'<article>';
	if($language=='de'){
		$translation=array_merge($translation,array(
			'Empty search item'=>'Kein Suchbegriff eingegeben',
			'hits'=>'Treffer',
			'Only characters, numbers and spaces allowed'=>'Es sind nur Buchstaben, Nummern und Leerzeichen erlaubt',
			'Search'=>'Suchen')
		);
	}
	if($language=='en'){
		$translation=array_merge($translation,array(
			'Empty search item'=>'Empty search item',
			'hits'=>'hits',
			'Only characters, numbers and spaces allowed'=>'Only characters, numbers and spaces allowed',
			'Search'=>'Search')
		);
	}
	$posts=array();
	$source=new RecursiveDirectoryIterator('./posts/');
	foreach(new RecursiveIteratorIterator($source)as$post){
		if(($post->IsFile())&&(substr($post->getFilename(),0,1)!='.')){
			$post->getFilename();
			$post=str_replace($_SERVER['DOCUMENT_ROOT'],'',$post);
			array_push($posts,$post);
		}
	}
	if(isset($posts)){
		sort($posts);
	}
	$error=false;
	if(isset($_POST['search'])){
		if($_POST['item']==''){
			$error=true;
			$error_description=translation('Empty search item');
		}else if(!preg_match('/^[a-zA-Z0-9 ]+$/',$_POST['item'])){
			$error=true;
			$error_description=translation('Only characters, numbers and spaces allowed');
		}else{
			$search=array();
			$search_count=0;
			$search_match=false;
			$search_item=strtolower($_POST['item']);
			for($i=0;$i<count($posts);$i++){
				if(preg_match('/\b'.$search_item.'\b/i',strtolower(file_get_contents($posts[$i])))){
					array_push($search,$posts[$i]);
					$search_match=true;
					$search_count++;
				}
			}
			if(!$search_match){
				echo'<p><i>'.$_POST['item'].'</i> 0 '.translation('hits').'. <a href="./">'.translation('To the main page').'</a></p>';
			}else{
				echo'<p><i>'.$_POST['item'].'</i> <b>'.$search_count.'</b> '.translation('hits').':</p><ul>';
				for($i=0;$i<count($search);$i++){
					echo'<li><a href="./?post-'.str_replace('./posts/','',$search[$i]).'" target="_blank">'.str_replace('./posts/','',$search[$i]).'</a></li>';
				}
				echo'</ul>';
			}
		}
	}
	if($error){
		echo'<p>'.$error_description.'</p>';
	}
	echo'</article>';
	require_once('./system/footer.php');
}
?>
