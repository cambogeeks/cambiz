 <!-- Your Page Content Here -->
      <!--info box-->
      <div class="row">
        
       

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-fw fa-newspaper-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Number Of Article</span>
              <span class="info-box-number">
                 <?php 
                    $stmt_anum= $user_home->runQuery("SELECT count(*) AS anum FROM content"); 
                    $stmt_anum->execute();
                    $rs_anum = $stmt_anum->fetch(PDO::FETCH_ASSOC);
                    echo $rs_anum['anum'];
                  ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">User Registered</span>
              <span class="info-box-number">
                  <?php 
                    $stmt_unum= $user_home->runQuery("SELECT count(*) AS unum FROM tbl_users"); 
                    $stmt_unum->execute();
                    $rs_unum = $stmt_unum->fetch(PDO::FETCH_ASSOC);
                    echo $rs_unum['unum'];
                  ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">
            <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Article</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <?php 
                  $stmt_article = $user_home->runQuery("SELECT content.media, content.count, content.create_date, content.display, content.publish_date, content.text_title, menu.c_title, tbl_users.displayName  FROM content 
                  LEFT JOIN menu ON content.cat_id=menu.c_id 
                  LEFT JOIN tbl_users on content.member_id = tbl_users.userID WHERE content.delete_statue = 0
                  ORDER BY content.id DESC LIMIT 20");
                  $stmt_article->execute();

                  while ($rs_article = $stmt_article->fetch(PDO::FETCH_ASSOC)){
                ?>
                <li class="item">
                  <div class="product-img">
                   
                   <?php  if(!empty($rs_article['media'])) {echo '<img src="img/thumbs/'.$rs_article['media'].'" alt="Image">';}else{echo '<img src="img/default-50x50.gif" alt="default image">';} ?>
                    
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title"><?php echo $rs_article['text_title'];?>
                   
                         <span class="help-block">
                            <i class="fa fa-fw fa-calendar-plus-o"></i>&nbsp;
                            <?php echo date('d-F-Y h:i A', strtotime($rs_article['create_date']));?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-fw fa-calendar-check-o"></i>&nbsp;<?php echo date('d-F-Y h:i A', strtotime($rs_article['publish_date']));?>
                            &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-fw fa-list-ul"></i>&nbsp; <?php echo $rs_article['c_title'];?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-fw fa-user">&nbsp;</i> <?php echo $rs_article['displayName'];?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-fw fa-eye"></i>  <?php echo $rs_article['count'];?>
                            &nbsp;&nbsp;&nbsp;
                             <?php if($rs_article['display']==0) echo '<span class="label label-danger"><i class="fa fa-fw fa-caret-square-o-right"></i>&nbsp; Unpublish</span>'; else echo '<i class="fa fa-fw fa-caret-square-o-right"></i>&nbsp;published';?>
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <?php } ?>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="kd-admin.php?page=content_list" class="uppercase">View all article</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

        </div><!--/col-->
        
      </div><!--/row-->
