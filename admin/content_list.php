
 <div class="box">
  <div class="box-header">
    <h3 class="box-title" style="padding-right:20px;">Article</h3>
    <a href="kd-admin.php?page=content" class="btn btn-primary btn-sm"> <i class="fa fa-fw fa-plus-circle"></i>Add new</a>
    <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-fw fa-navicon"></i>Sort By Categories</button>
                  <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                 <?php
					$parent_sql =$user_home->runQuery("SELECT c_id, c_title FROM menu WHERE c_type =:num and c_main_id=:main_id");
					$parent_sql->execute(array(':num'=>2, ':main_id' =>1 ));
                    while($result_parent=$parent_sql->fetch(PDO::FETCH_ASSOC)){
                ?>

                 <li>
                 		<a href="kd-admin.php?page=content_list&cat=<?php echo $result_parent['c_id']; ?>" >
               		 <?php echo $result_parent['c_title'];?> 
               		 </a>
                </li>
                
                <?php	
                    }
				 ?>
                    

                    <li class="divider"></li>
                    <li><a href="kd-admin.php?page=content_list">All Article</a></li>
                  </ul>
                </div>
    <div class="box-tools pull-right" style="width:20%;">
      
      	<form action="kd-admin.php?page=content_list" method="post">
        	<div class="input-group pull-right">
	        	<input type="text" name="search" class="form-control input-sm pull-right" placeholder="Search">
	       
	        	<div class="input-group-btn">
	          		<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
	        	</div>
       		 </div>
        </form>
      
    </div>
  </div><!-- /.box-header -->
  <div class="box-body table-responsive">
    
    <?php
	$title_article = @$_REQUEST["search"];
	if ($row['level']==3) {
		$con = "WHERE content.member_id=:user_id and content.delete_statue != 1";
	}elseif (isset($_REQUEST["search"])) {
		$con = "WHERE content.text_title LIKE '%".$title_article."%' and content.delete_statue != 1";
		$search_p_target = "&search=".$title_article;
	
	}elseif (isset($_REQUEST["cat"])) {
		$con = "WHERE content.delete_statue != 1 and content.cat_id=".$_REQUEST["cat"];
		$search_p_target = "&cat=".$_REQUEST["cat"];	

	}else{
		$con = "WHERE content.delete_statue != 1";
	}
	
	$tbl_name="content 
				LEFT JOIN menu ON content.cat_id=menu.c_id 
				LEFT JOIN tbl_users on content.member_id = tbl_users.userID
				 $con ORDER BY content.id DESC";		//your table name
	$tbl_fiel='content.id, content.text_title, content.count, content.publish_date, content.media, content.create_date,  content.display, menu.c_id,  menu.c_title, tbl_users.userName';
	
	
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;

	$query = $user_home->runQuery("SELECT COUNT(*) as num FROM $tbl_name");
	if ($row['level']==3) {
           $query->execute(array(':user_id' => $_SESSION['userSession']));
         }else{
           $query->execute();
         }
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$total_pages = $query -> fetch(PDO::FETCH_ASSOC);
	$total_pages = $total_pages['num'];

	
	/* Setup vars for query. */
	$targetpage = "kd-admin.php?page=content_list".@$search_p_target; 


		//your file name  (the name of this file)
	$limit = 15; 								//how many items to show per page
	$page =@$_GET['pagging'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$result=$user_home->runQuery("SELECT $tbl_fiel FROM $tbl_name LIMIT $start, $limit");
    if ($row['level']==3) {
            $result->execute(array(':user_id' => $_SESSION['userSession'], ':start'=>$start));
         }else{
           $result->execute();
         }
     
          
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage&pagging=$prev\">Previous</a>";
		else
			$pagination.= "<span class=\"disabled\">Previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&pagging=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&pagging=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&pagging=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&pagging=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage&pagging=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&pagging=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&pagging=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&pagging=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&pagging=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage&pagging=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&pagging=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&pagging=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage&pagging=$next\">Next</a>";
		else
			$pagination.= "<span class=\"disabled\">Next</span>";
		$pagination.= "</div>\n";		
	}
?>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>No</th>
                                            <th>Images</th>
                                            <th>Title </th>
                                      
                                            <th colspan="2">Action</th>

                                        </tr>
                                  		<?php
											$i=$start +1;


								
                               while($row=$result->fetch(PDO::FETCH_ASSOC)){
                                       ?>
                 <tr>
                                                <td><?php echo $i ?></td>
                                                <td>  <?php if(!empty($row['media'])){
       					echo '<img src="img/thumbs/'.$row['media'].'" class="img-size">';
		}else{  echo $row['media'];} ?></td>
                                                 <td>
                                                    <h4><?php echo $row['text_title'];?></h4>
                                                    <span class="help-block">
                                                        <i class="fa fa-fw fa-calendar-plus-o"></i>&nbsp;<?php echo date('d-F-Y h:i A', strtotime($row['create_date']));?>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-fw fa-calendar-check-o"></i>&nbsp;<?php echo  date('d-F-Y h:i A', strtotime($row['publish_date']));?>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-fw fa-list-ul"></i>&nbsp; <?php echo $row['c_title'];?>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-fw fa-user">&nbsp;</i> <?php echo $row['userName'];?>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-fw fa-eye"></i>  <?php echo $row['count'];?>
                                                      	&nbsp;&nbsp;&nbsp;
                                                         <?php if($row['display']==0) echo '<span class="label label-danger"><i class="fa fa-fw fa-caret-square-o-right"></i>&nbsp; Unpublish</span>'; else echo '<i class="fa fa-fw fa-caret-square-o-right"></i>&nbsp;published';?>

                                                        
                                                       </span>
                                                 </td>
                                              

                                                <td>
                                                   
                                                    <a href="#" data-href="admin/content_delete.php?id_article=<?php echo $row['id']; ?>" class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete">
                                                    <i class="fa fa-fw fa-times"></i>
                                                    </a>
                                                    <!-- confirm delete-->
                                                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												        <div class="modal-dialog">
												            <div class="modal-content">
												            
												                <div class="modal-header">
												                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
												                </div>
												            
												                <div class="modal-body">
												                    <p>You are about to delete one track, this procedure is irreversible.</p>
												                    <p>Do you want to proceed?</p>
												                    <p class="debug-url"></p>
												                </div>
												                
												                <div class="modal-footer">
												                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
												                    <a class="btn btn-danger btn-ok">Delete</a>
												                </div>
												            </div>
												        </div>
												    </div>
												    <!--./ modal confirm delete-->
                                                </td>
                                                <td>
                                                   
                                                    <a href="kd-admin.php?page=content&action=edit&id_article=<?php echo $row['id']; ?>" class="btn btn-block btn-primary btn-sm">
                                                    <i class="fa fa-fw fa-pencil-square-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        $i++;

                               }?>



                                    </table>
                                
                              


  </div><!-- /.box-body -->
  <div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
      <?php echo $pagination; ?>
    </ul>
  </div>
</div><!-- /.box -->
