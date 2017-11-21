<?php

    
    $type=$_GET['page_id'];
    $show = 1;
    
    $tbl_name="content WHERE cat_id=:type and content.display=:show and date(content.publish_date)<=date(:c_date) and content.delete_statue = 0 order  by content.id DESC";        //your table name
    $tbl_fiel='content.text_title, content.cat_id, content.count, content.description, content.id, content.publish_date, content.media';
    // How many adjacent pages should be shown on each side?
    $adjacents = 2;
    
    /* 
       First get total number of rows in data table. 
       If you have a WHERE clause in your query, make sure you mirror it here.
    */

    $query = $views->runQuery("SELECT COUNT(*) as num FROM $tbl_name");
    $query->execute(array(':type'=>$type, ':show'=>$show, ':c_date'=> $c_date));
    
    $total_pages = $query -> fetch(PDO::FETCH_ASSOC);
    $total_pages = $total_pages['num'];
    
    /* Setup vars for query. */
    $targetpage = "index.php?views=subpage&page_id=".$type;  //your file name  (the name of this file)
    $limit = 15;                                //how many items to show per page
    $page =@$_GET['page'];
    if($page) 
        $start = ($page - 1) * $limit;          //first item to display on this page
    else
        $start = 0;                             //if no page var is given, set start to 0
    
    /* Get data. */
    $result=$views->runQuery("SELECT $tbl_fiel FROM $tbl_name LIMIT $start, $limit");
    $result->execute(array(':type'=>$type, ':show'=>$show, ':c_date'=> $c_date));
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
    $prev = $page - 1;                          //previous page is page - 1
    $next = $page + 1;                          //next page is page + 1
    $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                      //last page minus 1
    
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
            $pagination.= "<a href=\"$targetpage&page=$prev\">Previous</a>";
        else
            $pagination.= "<span class=\"disabled\">Previous</span>";   
        
        //pages 
        if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
            }
            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
            }
            //close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage&page=$next\">Next</a>";
        else
            $pagination.= "<span class=\"disabled\">Next</span>";
        $pagination.= "</div>\n";       
    }
?>

<section id="subpage">
    <div class="container">
       
        <div class="box-subpage">
            <?php //$arrayline = array('1' => 'sub-page-bar-news', '17' => 'sub-page-bar-biz', '18'=> 'sub-page-bar-life_style', 
            //'13' => 'sub-page-bar-tech', '4' => 'sub-page-bar-sport', '3' => 'sub-page-bar-art', '15' => 'sub-page-bar-photo'); ?>
            <div id="sub-page-bar" class="sub-page-bar-news">
                <h1> 
                <?php

                    $stmt_cat = $views->runQuery("SELECT c_title FROM menu where c_id =:news_cat"); 
                    $stmt_cat -> execute(array(':news_cat' => $_REQUEST['page_id']));
                    $rs_cat = $stmt_cat -> fetch(PDO::FETCH_ASSOC); 
                    echo $rs_cat['c_title'];
                ?>
                </h1>
            </div>
            <div class="subpage-body">
                <div class="row">
                     <div class="col-md-8">
                        <div class="latest-news">
                            <div class="row">

                                <?php
                                    while($row = $result ->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <div  class="col-md-12">
                                    <div class="news-thumnail-sub">
                                        <div class="news-img-thumbs-sub">
                                            <a href="index.php?views=detail_news&page_id=<?php echo $row["cat_id"]; ?>&id_article=<?php echo $row['id'];?>"><img src="img/thumbs/<?php echo $row['media']; ?>" /></a>
                                        </div>
                                        <div class="news-title-sub">
                                           
                                            <h1><a href="index.php?views=detail_news&page_id=<?php echo $row["cat_id"]; ?>&id_article=<?php echo $row['id'];?>"><?php echo $row["text_title"];?></a></h1>
                                             <i class="fa fa-calendar" aria-hidden="true"></i> <span><?php echo date("d-m-Y h:i A", strtotime($row['publish_date'])); echo "  <i class='glyphicon glyphicon-eye-open'></i> ".$row['count']; ?></span>
                                            <p>
                                                <?php echo $row['description']; ?>
                                            </p>

                                        </div>

                                        <div style="clear:both;"></div>
                                         <div style="text-align:right; margin:5px 0 0 0; font-family: 'Nokora', serif; font-size: 14px;">
                                             <a href="index.php?views=detail_news&page_id=<?php echo $row["cat_id"]; ?>&id_article=<?php echo $row['id'];?>"  class="btn btn-primary btn-sm"><?php echo 'អានព័ត៌មានលំអិត'; ?></a>
                                        </div>
                                    </div>

                                </div>
                                <?php } ?>
                            </div>

                        </div>
                        <!---                               
                        <div class="read-other">
                            <div class="btn-group">
                              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                អានព័ត៌មានផ្សេងទៀត <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                            </div>
                        </div>
                        -->
                        <div class="pagging-container">
                            <?php echo $pagination; ?>
                        </div>
                        <!--<div class="banner-button-ads">
                            <img src="img/footer-banner.jpg">
                        </div>-->
                        
                    </div><!--col-md-8-->
                    <?php include "views/side_bar.php"; ?>
                    
                </div>
            </div>
        </div>
    </div>
        </section>
        
