
<style>
    .news_blog {
    padding: 15px;
    border: 1px solid #d6cccc59;
    border-radius: 10px;
}
 h4.news_head {
   text-align: center;
    -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(90deg,#462523 0,#cb9b51 22%,#ffa419 45%,#c58625 50%,#ffa419 55%,#cb9b51 78%,#462523);
   color: transparent;
    font-family: Times New Roman,serif;
    font-size: 34px;
    font-weight: 700;
    letter-spacing: 3px;
    margin-bottom: 25px;
text-transform: uppercase;
}
.imge_blog img {
    width: 100%;
    border-radius: 10px;
    object-fit: cover;
}
.news_content {
    margin-top: 10px;
}
p.news_data {
    background: none !important;
    border: none;
    margin: 0px !important;
    padding: 0px;
    
}
h4.link_news {
    color: #fff;
    font-size: 18px;
    margin: 15px 0px;
}

.news_content span {
    color: #fff !important;
    font-size: 12px;
    font-weight: 400;
}
</style>
   <div class="news_event_page">
      <div class="container">
      <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
                  
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
         </ol>
	   </div>
	 
</div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="recent_new">
                  <h4 class="news_head">Blog </h4>
                  
                  <div class="news_page mb-2 ">
                       
                  <div class="row ">
                       <?php
                        $blogs=$this->conn->runQuery('*','ad_blogs',"status='1'");
                            if($blogs){
                                foreach($blogs as $blog){
                                    ?>  
                       <div class="col-md-6">
                           <div class="news_blog">
                               <div class="imge_blog">
                                    <img src="<?= base_url($blog->img);?>" alt="images">
                               </div>
                               
                               <div class="news_content">
                                   
                                    <span><?= $blog->added_on;?> </span>
                                    <h4 class="link_news" ><?= $blog->title;?></h4>
                                   <p class="news_data"><?= $blog->description;?></p>
                               </div>
                           </div>
                       </div>
                        <?php 
                                    
                                }
                            }
                   ?>
                     <!-- <div class="col-md-6">
                           <div class="news_blog">
                               <div class="imge_blog">
                                    <img src="<?= $pri['articles'][$i]['urlToImage'];?>" alt="images">
                               </div>
                               
                               <div class="news_content">
                                    <span><?= $pri['articles'][$i]['publishedAt'];?></span>
                                    <h4 class="link_news"><?= $pri['articles'][$i]['title'];?></h4>
                                   <p class="news_data"><?= $pri['articles'][$i]['description'];?></p>
                               </div>
                           </div>
                       </div>-->
                      
               
                 
                  </div>
                 
                 </div>
                  
               </div>
            </div>
           
         </div>
      </div>
   </div>