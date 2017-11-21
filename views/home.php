<div class="main-slide-show">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <!-- start flexslider -->
                <div class="flexslider">
                    <ul class="slides">
                        <?php 
                            $stmt_slide=$views->runQuery("SELECT slide_id, s_title, link, s_img, ordering, s_description,
                            (SELECT count(*) from slide) as slide_num  from slide order by ordering limit 5");
                            $stmt_slide->execute();
                            $i=1;
                            while($rs_slide=$stmt_slide->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <li>
                             <a href="<?php echo $rs_slide['link']; ?>">
                                <img src="img/slide/<?php echo $rs_slide['s_img']; ?>" title="<?php echo $rs_slide['s_title']; ?>">
                            </a>
                            <div class="flex-caption">
                                <h2 class="slider-title dot1">   
                                    <?php echo $i."/".$rs_slide['slide_num']; ?> |  <a  href="<?php echo $rs_slide['link']; ?>">
                                       <?php echo $rs_slide['s_title']; ?>
                                    </a>
                                </h2> 
                            </div>
                        </li>
                        <?php $i++;} ?>
                    </ul>
                </div>
                <!-- end flexslider -->
            </div>
            <div class="col-md-5">
               <div class="row">
                    <div class="js-video [vimeo, widescreen]">
                        <iframe width="560" height="250" src="https://www.youtube.com/embed/xQzM8TPK2wc" frameborder="0" allowfullscreen></iframe>
                    </div>
               </div>
               <div class="row">
                    <img src="img/ads/follow-us-banner.png">
               </div>
            </div> 
        </div>
    </div>
</div>
    
<div class="lastest-news-feed"> 
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                Hellow asasas
            </div>
            <!--./col-7-->
            <div class="col-md-5">
                <div class="most-read-item"> 
                        <div class="row">
                      
                        <?php   
                            $sql_feature_article=$views->runQuery("SELECT id, text_title, publish_date, count, cat_id, media 
                                FROM content WHERE display=:is_show and feature =:d_num and date(publish_date)<=date(:c_date) 
                                and delete_statue = 0
                                 order by publish_date DESC LIMIT 4"); 
                            $sql_feature_article->execute(array(':d_num'=>'1', ':is_show' =>'1', ':c_date'=>$c_date));
                            while($result_feature=$sql_feature_article->fetch(PDO::FETCH_ASSOC)){ 
                        ?>  
                        <div class="col-xs-12 col-sm-6 col-md-12">
                            <div class="news-thumnail">
                                <div class="news-img-thumbs">
                                   <a href="index.php?views=detail_news&page_id=<?php echo $result_feature["cat_id"]; ?>&id_article=<?php echo $result_feature['id'];?>">
                                        <img src="img/thumbs/<?php echo $result_feature["media"];?>"/>
                                    </a>
                                </div>
                                <div class="news-title">
                                    <div class="date-release"> 
                                             <i class="fa fa-calendar" aria-hidden="true"></i> <span><?php echo date("d-m-Y h:i A", strtotime($result_feature['publish_date'])); echo " <i class='glyphicon glyphicon-eye-open'></i> ".$result_feature['count']; ?></span>
                                         </div>
                                    <h1 class="box dot1" >
                                         
                                         <a href="index.php?views=detail_news&page_id=<?php echo $result_feature["cat_id"]; ?>&id_article=<?php echo $result_feature['id'];?>">
                                            <?php echo $result_feature['text_title'];?>   
                                        </a>
                                    </h1>
                                </div>
                            </div>
                        

                            <div class="item-space"> 
                            <!--date-->
                            </div> 
                        </div>                                 
                    <?php $i++; } ?>
                    </div>
                </div><!--./ most read-->
            </div>
            <!--col-5-->
                  
        </div><!--.row-->
    </div><!--./conatiner.-->>
</div><!-- ./ feed-->

        <section id="home">   
            <div class="container">
                    <div class="page-body">
                        <div class="row">
                             <div class="col-md-8">
                                <div class="latest-news">
                                    
                                    <div class="row">
                                         <?php 
                                            
                                            // BIG DATA QUERY
                                            $stmt_menu = $views->runQuery("SELECT c_id, c_title FROM menu WHERE c_type = :menu_type and c_main_id = :main_id ORDER BY ordering limit 4");
                                            $stmt_menu -> execute(array(':menu_type' => 2, ':main_id' => 1));
                                           
                                            while($rs_menu = $stmt_menu -> fetch(PDO::FETCH_ASSOC)){
                                           ?>
                                               
                                           
                                          
                                        <div  class="col-md-6 col-sm-6">
                                             <div class="news-cat-item">
                                                <a href="index.php?views=subpage&page_id=<?php echo $rs_menu['c_id'];?>"  class="btn btn-default btn-sm"><?php echo $rs_menu['c_title'];?></a>
                                             </div>
                                        <?php   
                                            $sql_thumnail_article=$views->runQuery("SELECT content.id, content.count, content.text_title, content.publish_date, content.cat_id,
                                                   content.media, menu.c_title FROM content LEFT JOIN menu ON content.cat_id  = menu.c_id  
                                           
                                            WHERE content.display=:d_num and c_id = :cat_id and date(content.publish_date)<=date(:c_date) and content.delete_statue = 0 order by publish_date DESC LIMIT 4"); 
                                            $sql_thumnail_article->execute(array(':d_num'=>1,  ':cat_id'=>$rs_menu['c_id'], ':c_date'=>$c_date));
                                            $i=0;
                                            while($result_article=$sql_thumnail_article->fetch(PDO::FETCH_ASSOC)){ 
                                         ?>
                                        <?php if($i==0){ ?>
                                                <div class="row">
                                                    <div  class="col-md-12 col-sm-12">
                                                        <div class="larg-lastet-thumnail">
                                                            <div class="img-larg-thumnail">
                                                            <a href="index.php?views=detail_news&page_id=<?php echo $result_article["cat_id"]; ?>&id_article=<?php echo $result_article['id'];?>">
                                                                <img src="img/thumbs/<?php echo $result_article["media"];?>"/>
                                                            </a>
                                                            </div>
                                                     
                                                       
                                                              <div class="date-release"> 
                                                                 <i class="fa fa-calendar" aria-hidden="true"></i> <span><?php echo date("d-m-Y h:i A", strtotime($result_article['publish_date'])); echo "  <i class='glyphicon glyphicon-eye-open'></i> ".$result_article['count'];?></span>
                                                             </div>
                                                            <h1 class="box dot1">
                                                                <a href="index.php?views=detail_news&page_id=<?php echo $result_article["cat_id"]; ?>&id_article=<?php echo $result_article['id'];?>">
                                                                    <?php echo $result_article['text_title'];?>   
                                                                </a>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div> 
                                          

                                        <?php }else{ ?>  
                                        <div class="row">    
                                            <div  class="col-md-12 col-sm-12">
                                                <div class="news-thumnail">
                                                    <div class="news-img-thumbs">
                                                        <a href="index.php?views=detail_news&page_id=<?php echo $result_article["cat_id"]; ?>&id_article=<?php echo $result_article['id'];?>">
                                                            <img src="img/thumbs/<?php echo $result_article["media"];?>"/>
                                                        </a>
                                                    </div>
                                                    <div class="news-title">
                                                          <div class="date-release"> 
                                                             <i class="fa fa-calendar" aria-hidden="true"></i> <span><?php echo date("d-m-Y h:i A", strtotime($result_article['publish_date'])); echo "  <i class='glyphicon glyphicon-eye-open'></i> ".$result_article['count'];?></span>
                                                         </div>
                                                        <h1 class="box dot1">
                                                            <a href="index.php?views=detail_news&page_id=<?php echo $result_article["cat_id"]; ?>&id_article=<?php echo $result_article['id'];?>">
                                                                <?php echo $result_article['text_title'];?>   
                                                            </a>
                                                        </h1>
                                                    </div>

                                                </div> 
                                            </div>
                                        </div>


                                        <?php } $i++;} ?>
                                         <div style="text-align:right; margin:0 0 20px 0; font-family: 'Nokora', serif; font-size: 14px;">
                                             <a href="index.php?views=subpage&page_id=<?php echo $rs_menu['c_id'];?>"  class="btn btn-primary btn-sm"><?php echo 'មើល'.$rs_menu['c_title'].'បន្ថែមទៀត'; ?></a>
                                        </div>
                                        </div>
                                       
                                         <?php  } ?>
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
                               <!-- <div class="banner-button-ads">
                                    <img src="img/home_button_banner_730x100.png">
                                </div>-->
                                
                            </div>
                              <?php include "views/side_bar.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        