<?php
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
	die('Access denied.');
}
echo'</main><footer>';
echo markdown(file_get_contents('./config/footer.md'));
echo'</footer>';
if(is_file('./config/foot.php')){
	include('./config/foot.php');
}
echo'</body></html>';
?>
