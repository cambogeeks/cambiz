<?php
    $sql_detail=$views->runQuery("SELECT content.id, content.text_title, content.publish_date, content.display,
                      content.full_text, menu.c_id, content.count, menu.c_title, content.media, content.media_title
                     
    FROM content LEFT JOIN menu ON content.cat_id=menu.c_id 
    WHERE content.id=:id_article");     
    $sql_detail->execute(array(":id_article"=>$_REQUEST['id_article']));
    $result_detail= $sql_detail->fetch(PDO::FETCH_ASSOC);

    $stmt_count = $views ->runQuery("update content set count = :count_plus where id=:id_article");
    $stmt_count->execute(array(":id_article"=>$_REQUEST['id_article'], ':count_plus' =>  $result_detail["count"]+1));
?>

<section id="subpage">
    <div class="container">
        
        <div class="box-detail">
            <div class="subpage-body">
                <div class="row">
                     <div class="col-md-8">

                        <div class="detail_news_section">
                            <?php //$arrayline = array('2' => 'sub-page-bar-news', '3' => 'sub-page-bar-biz', '4'=> 'sub-page-bar-life_style', 
           // '13' => 'sub-page-bar-tech', '4' => 'sub-page-bar-sport', '3' => 'sub-page-bar-art', '15' => 'sub-page-bar-photo'); ?>
                            
                            <div id="page-detail-bar" class="sub-page-bar-news">
                                <h1><?php echo $result_detail["c_title"];?></h1>
                             </div>
                            <div class="detail_new-title">
                                <h1><?php echo $result_detail["text_title"];?></h1>
                            </div>
                        
                            <div class="more_info"><?php echo date("d-m-Y h:i A", strtotime($result_detail['publish_date'])); 
                                    echo " | <i class='glyphicon glyphicon-eye-open'></i> "; echo $result_detail['count'];?>
                            </div>
                          
                            <div class="detail_paragraph">
                               <?php echo $result_detail['full_text']; ?>
                            </div>

                        </div>
                                                
                        <div class="social_share">
                            <div class="col-md-3" style="padding:0 0 10px 0">
                                <div class="fb-like" data-href="<?php echo PAGE_URL; ?>" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>
                                
                            </div>
                             <div class="col-md-3">
                                <div class="fb-share-button" data-href="<?php echo PAGE_URL; ?>" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
                            </div>
                             <div class="col-md-6">
                                   <div class="comment-bar"> <a href="#fb-comment-article"> <b>Comment</b> </a></div>
                             </div>

                             <div style="clear:both"></div>
                          
                        </div>
                        <div id="fb-comment-article">
                        
                            <div class="fb-comments" data-href="<?php echo PAGE_URL; ?>" data-numposts="5"></div>
                       </div>
                        <!--

                        <div class="banner-button-ads">
                            <img src="img/sub-banner-750x100.png">
                        </div>-->
                        <div class="read-other">
                             <div class="latest-news">
                                   
                                    <div class="row">

                                        <?php   
                                            
                                            $sql_thumnail_article=$views->runQuery("SELECT content.id, content.text_title,  content.publish_date, 
                                                  menu.c_id,  content.media
                                            FROM content
                                            LEFT JOIN menu ON content.cat_id=menu.c_id 
                                            
                                            WHERE content.display=:d_num and id!=:id_article and date(content.publish_date)<=date(:c_date) and content.delete_statue = 0 order by publish_date DESC LIMIT 4");
                                             
                                            $sql_thumnail_article->execute(array(':d_num'=>1, ':id_article' => $_REQUEST['id_article'], ':c_date'=>$c_date));
                                            while($result_article=$sql_thumnail_article->fetch(PDO::FETCH_ASSOC)){ 
                                         ?>
                                            
                                        <div  class="col-md-6">
                                            <div class="news-thumnail">
                                                
                                                <div class="news-img-thumbs">
                                                    <a href="index.php?views=detail_news&id_article=<?php echo $result_article['id'];?>">
                                                        <img src="img/thumbs/<?php echo $result_article["media"];?>"/>
                                                    </a>
                                                </div>
                                                <div class="news-title">
                                                    <div class="date-release"> 
                                                <i class="fa fa-calendar" aria-hidden="true"></i> <span><?php echo date("d-m-Y h:i A", strtotime($result_article['publish_date']));?></span>
                                                </div>
                                                    <h1 class="box dot1">
                                                        <a href="index.php?views=detail_news&id_article=<?php echo $result_article['id'];?>">
                                                            <?php echo $result_article['text_title'];?>   
                                                        </a>
                                                    </h1>
                                                </div>
                                            </div> 
                                            
                                        </div>
                                        <?php } ?>
                                    </div>

                                </div>
                        </div>
                        
                        
                    </div><!--col-md-8-->
                    
                    <?php include "views/side_bar.php"; ?>
                    
                </div>
            </div>
        </div>
    </div>
        </section>
        
