<?php 
switch(PAGE){
	
	//-- introduction page --
	case 1:
		
		define('PAGE_TITLE','Dr. Business Cambodia');
		define('PAGE_DESC','The Leading Business News in Cambodia');
		define('PAGE_KEY','Entertainment, Leadership, Marketing');
		define('PAGE_URL', 'http://dr-cambiz.com/');
		define('PAGE_IMG', 'http://dr-cambiz.com/img/free_space_for_ads.png');
	
	break;
	
	case 2:
	
	$stmt_header =$views-> runQuery("SELECT id, text_title, description, media, cat_id FROM content WHERE id =:id_article");
	$stmt_header -> execute(array(':id_article' => $_REQUEST["id_article"]));
	$rs_header = $stmt_header ->fetch(PDO::FETCH_ASSOC);

		define('PAGE_TITLE', $rs_header['text_title']);
		define('PAGE_DESC', $rs_header['description']);
		define('PAGE_KEY','Entertainment, Leadership, Marketing');
		define('PAGE_IMG', 'http://keiladaily.com/img/uploads/'.$rs_header['media']);
		define('PAGE_URL', 'http://keiladaily.com/index.php?views=detail_news&page_id='.$rs_header['cat_id'].'&id_article='.$rs_header['id']);
	
	break;

}
?>