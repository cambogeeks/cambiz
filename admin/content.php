<?php
$id_article=@$_GET['id_article'];
?>
<?php
      $sql_article= $user_home->runQuery(
                "SELECT
                  content.id,
                  content.text_title,
                  content.description,
                  content.display,
                  content.feature,
                  content.full_text,
                  content.cat_id,
                  menu.c_id,
                  menu.c_title,
                  content.media,
                  content.media_publish, 
                  content.type,
                  content.icon,
                  content.publish_date,
                  content.create_date,
                  content.media_title
            FROM content
             LEFT JOIN tbl_users  ON content.member_id=tbl_users .userID
            LEFT JOIN menu ON content.cat_id=menu.c_id
            where content.id=:id_article");
$sql_article->execute(array(":id_article"=>$id_article ));
$result_article=$sql_article->fetch(PDO::FETCH_ASSOC);
$id_cat =$result_article['cat_id'];
            ?>
									<?php
									// alert message check
									if(@$_GET["msg"]=='insert'){?>
                                        <div class="alert alert-success alert-dismissable">
                                            <i class="fa fa-check"></i>
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Alert!</b> Success Insert your article, please review text in form below!
                                        </div>
                                    <?php
									}elseif(@$_GET["msg"]=='update'){
									?>
										<div class="alert alert-success alert-dismissable">
                                        	<i class="fa fa-check"></i>
                                        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        	<b>Alert!</b> Success Update you article!
                                   	 	</div>
									<?php }elseif(@$_GET["msg"]=='require'){?>
										<div class="alert alert-danger alert-dismissable">
                                            <i class="fa fa-ban"></i>
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Alert!</b> Title Article and Full Text is Reqiure
                                    	</div>
									<?php
										}
									?>

<div class="box box-solid box-primary ">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-fw fa-newspaper-o"></i> Add New Article</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
     <a href="kd-admin.php?page=content_list" class="btn btn-block btn-primary btn-sm"> <i class="fa fa-fw fa-navicon"></i>View all Article</a>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
<form method="post" enctype="multipart/form-data" action="<?php
if(@$_GET['action']=="edit"){
	echo 'admin/content_update.php';
}else{
	echo 'admin/content_save.php';
	}

?>">

	<div class="form-group">
        <label>Content Categories</label>
        <select class="form-control" name="article_type">
          <option value="parent"> -- Please Select -- </option>
				<?php
					$parent_sql =$user_home->runQuery("SELECT c_id, c_title FROM menu WHERE c_type =:num and c_main_id=:main_id");
					$parent_sql->execute(array(':num'=>2, ':main_id' =>1 ));
                    while($result_parent=$parent_sql->fetch(PDO::FETCH_ASSOC)){
                if($result_parent['c_id']==$result_article['cat_id']){$select= "selected";}else{$select="";};
                ?>

                <option value="<?php echo $result_parent['c_id']; ?>" <?php echo $select; ?> >
               		 <?php echo $result_parent['c_title'];?> 
                </option>
                
                <?php	
                    }
				 ?>
        </select>
	</div>
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="article_title" class="form-control" value="<?php echo @$result_article["text_title"]; ?>"/>
	</div>
	<div class="form-group">
     	<label>Short Description</label>
    	<textarea class="form-control"  name="short_article" style="width:100%; height: 100px;"><?php echo @$result_article["description"]; ?></textarea>
	</div>
     <div class="form-group">
		<label>Detail Conetnt</label>
		<textarea class="textarea1" name="full_article" class="form-control tinymce"  rows="15"><?php echo @$result_article["full_text"]; ?></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Images</label>
        <input type="file" name="media_img" id="media_img">
        <p class="help-block">max width: 720</p>
        <?php if(!empty($result_article['media'])){
        echo '<img src="img/thumbs/'.$result_article['media'].'"/>';
		}else{echo "";}?>
    </div>

     <div class="form-group">
      <label>Images title</label>
      <input type="text" name="media_title" class="form-control" value="<?php echo @$result_article['media_title']; ?>"/>
	   </div>
     <div class="row"> 
        <div class="col-md-3"> 
          <div class="checkbox">
              <label>
              	<?php if($result_article['media_publish']==1) $check='checked="checked"'; else $check='';?>
                  <input type="checkbox" name="img_check" <?php echo $check; ?> />Display Images in article<span class="help-block">(Check=show, Uncheck=unshow)</span>
              </label>
          </div>
        </div>
        <div class="col-md-3">
          <?php if($row['level']==2 or $row['level']==1){ ?>
          <div class="checkbox">
              <label>
                <?php if($result_article['icon']==1) $check='checked="checked"'; else $check='';?>
                  <input type="checkbox" name="icon_check" <?php echo $check; ?> /> Video Icon<span class="help-block">(Check=show, Uncheck=unshow)</span>
              </label>
          </div>
          <?php } ?>
        </div>

        <div class="col-md-3">
          <?php if($row['level']==2 or $row['level']==1){ ?>
          <div class="checkbox">
              <label>
                <?php if($result_article['feature']==1) $check='checked="checked"'; else $check='';?>
                  <input type="checkbox" name="txt_feature" <?php echo $check; ?> /> Feature Article<span class="help-block">(Check=show, Uncheck=unshow)</span>
              </label>
          </div>
          <?php } ?>
        </div>
        <div class="col-md-3">
          <?php if($row['level']==2 or $row['level']==1){ ?>
          <div class="checkbox">
              <label>
                <?php if($result_article['display']==1) $check='checked="checked"'; else $check='';?>
                  <input type="checkbox" name="article_publishing" <?php echo $check; ?> /> publishing Article<span class="help-block">(Check=show, Uncheck=unshow)</span>
              </label>
          </div>
          <?php } ?>
        </div>
   </div> 
         
    <div class="row">
      
         <div class="col-md-6">
              <!-- Date -->
              <div class="form-group">
                <label>Post date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="post_date" value="<?php if(isset($_REQUEST['id_article'])){ echo date("d-m-Y", strtotime($result_article['create_date']));} ?>" id="datepicker1">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
          </div>
          <div class="col-md-6">
              <!-- time Picker -->
              <div class="bootstrap-timepicker pull-left">
                <div class="form-group">
                  <label>Post Time:</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker" value="<?php if(isset($_REQUEST['id_article'])){ echo date("h:i A", strtotime($result_article['create_date']));}else{ echo date("h:i A");} ?>" name="post_time">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!--./ time picker-->
          </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <!-- Date -->
              <div class="form-group">
                <label>Published Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker2" name="publish_date" value="<?php if(isset($_REQUEST['id_article'])){ echo date('d-m-Y', strtotime($result_article['publish_date']));} ?>" >
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
            <div class="col-md-6">

              <!-- time Picker -->
              <div class="bootstrap-timepicker pull-left">
                <div class="form-group">
                  <label>Publish Time</label>

                  <div class="input-group"> 
                    <input type="text" class="form-control timepicker" value="<?php if(isset($_REQUEST['id_article'])){ echo date("h:i A", strtotime($result_article['publish_date']));}else{ echo date("h:i A");} ?>"name="publish_time" >

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
            </div>
          </div>

            <div class="form-group">
      <label>TAG</label>
      <select class="form-control select2" multiple="multiple" data-placeholder="Select a Destination" name="article_tag[]">
        <?php

          // GeT DATA
        $stmt_op= $user_home->runQuery("SELECT tag_cat_id FROM tag WHERE article_id =:article_id");
        $stmt_op ->execute(array(':article_id'=>$_REQUEST['id_article']));            
            $item_id = []; 
            while ($rs_op = $stmt_op->fetch(PDO::FETCH_ASSOC)){
              $item_id[$rs_op['tag_cat_id']] = $rs_op['tag_cat_id'];
            }

          // select option
          $dest_sql =$user_home->runQuery("SELECT c_id, c_title FROM menu WHERE c_type =:num and c_main_id =:main_id");
          $dest_sql->execute(array(':num'=>2,':main_id' => 1));
                    while($result_tag=$dest_sql->fetch(PDO::FETCH_ASSOC)){
                    
                    if($result_tag['c_id']==$item_id[$result_tag['c_id']]){ $select= "selected"; }else{ $select="";};
                ?>
                <option value="<?php echo $result_tag['c_id']; ?>" <?php echo $select; ?> >
                        <?php echo $result_tag['c_title'];?>
                </option>
                <?php
                      
                    }
         ?>
        
      </select>
    </div>

  <input type="hidden" value="<?php echo $result_article['id'];?>" name="id_article" />
  <input type="hidden" value="<?php echo $_SESSION['userSession'];?>" name="user_id" />

  </div><!-- /.box-body -->
  <div class="box-footer">
    <button type="submit" class="btn btn-primary"><?php if(@$_GET['action']!='edit') echo 'Submit'; else echo 'Save'; ?></button>
    
  </div><!-- box-footer -->
  </form>
</div><!-- /.box -->
