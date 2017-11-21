<?php session_start();
date_default_timezone_set('Asia/Bangkok');
require_once 'class.user.php';
$user_home = new USER();
include("resize-class.php");

// Variable
$user_id = $_POST["user_id"];
$article_type 	= @$_POST["article_type"];
$article_title	=@$_POST["article_title"];
$short_article	=@$_POST["short_article"];
$full_article 	=@$_POST["full_article"];


// check box
if(isset($_POST['article_publishing'])){$article_publishing=1;}else{$article_publishing=0;}
if(isset($_POST['txt_feature'])){$feature=1;}else{$feature=0;}
if(isset($_POST["img_check"])){$img_check=1;}else{ $img_check=0;}
if(isset($_POST["icon_check"])){ $icon_check=1;}else{ $icon_check =0;}

// Date Times
$post_date 		= $_POST["post_date"];
$post_time		= $_POST["post_time"];
$publish_date	= $_POST["publish_date"];
$publish_time	= $_POST["publish_time"];

//start date
$post_date_time = $post_date.' '.date("H:i:s", strtotime($post_time)); 
$post_date_time = date("Y-m-d H:i:s", strtotime($post_date_time));

//end date
$publish_date_time = $publish_date.' '.date("H:i:s", strtotime($publish_time));  
$publish_date_time  = date("Y-m-d H:i:s", strtotime($publish_date_time));


// Media file 
$media= @$_FILES['media_img']["name"];
$filetype=@$_FILES['media_img']["type"];
$filenametemp=@$_FILES['media_img']["tmp_name"];
$fileerror=@$_FILES['media_img']["error"];

// Media title
$media_title=@$_POST['media_title'];
$media_type = 1;


// function moving images
	function moveFile($fullname, $filename, $filetype, $filenametemp, $fileerror){// fullname = path + filename
		if($filename!=null){
			if(($filetype=="image/jpg")
			 ||($filetype=="image/jpeg")
			 ||($filetype=="image/png")
			 ||($filetype=="image/gif")
			 ||($filetype=="application/x-shockwave-flash") && $_FILES[$filename]["size"]<200000)
			 {
					if($fileerror>0){
						echo "Error: ".$filename. "<br />";
					}elseif(file_exists($fullname))
						echo $filename." already exists. ";
					else
						move_uploaded_file($filenametemp, $fullname);

			}else{
							echo "Invalid file!";
			}
		}
	}

if(!empty($media)){
	// move files to upload folfer
	$media_large="../img/uploads/".$media;

	// resize and move thums folder.
	$media_thumbnail= "../img/thumbs/".$media;

	// move image function
	moveFile($media_large, $media, $filetype, $filenametemp, $fileerror);

	// *** 1) Initialise / load image
	$resizeObj = new resize($media_large);
	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$resizeObj -> resizeImage(550,'auto', 'auto');
	// *** 3) Save image
	$resizeObj -> saveImage($media_thumbnail, 100);
	// insert images
}

//insert article query
  $sql=$user_home->runQuery("INSERT INTO 
  	content(description, full_text, text_title, cat_id, create_date, member_id, display, feature, publish_date, media, media_publish, type, icon, media_title) 
  	value(:description, :full_text, :text_title, :cat_id, :create_date, :member_id, :display, :feature, :publish_date, :media, :media_publish, :type, :icon, :media_title)");

  $sql->execute(array(':description'=> $short_article, ':full_text'=>$full_article, ':text_title'=>$article_title, 
  	':cat_id'=>$article_type, ':create_date'=> $post_date_time, ':member_id'=> $user_id, ':display'=>$article_publishing, ':feature'=>$feature, ':publish_date'=>$publish_date_time, 'media'=> $media, ':media_publish'=>$img_check, ':type'=> $media_type, ':icon'=> $icon_check, ':media_title' => $media_title));


 //GET LAST INSERT ID
 $last_id = $user_home->lasdID();

 foreach ($_POST['article_tag'] as $tag)
{
    //print "You are selected $destination<br/>";
    $stmt = $user_home->runQuery("INSERT INTO tag(tag_cat_id, article_id) VALUES (:tag,  :last_id)");
    $stmt -> execute(array(':tag' =>  $tag, ':last_id' => $last_id));
}

//Redirect to form page
echo "<script type='text/javascript'>window.location='../kd-admin.php?page=content&action=edit&msg=insert&id_article=".$last_id ."'</script>";
?>
