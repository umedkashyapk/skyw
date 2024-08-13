    <div class=""  style="height:200px;">
        <?php 
            $get_alert0=$this->conn->runQuery('*','notice_board',"type='marquee' and status='1' order by id desc");
                if($get_alert0){
                    ?>
                    <h3>News</h3>
                    <marquee class="" style="height:180px;" direction = "up"  scrollamount="5">
                        <?php
                        foreach($get_alert0 as $get_alert){
                            ?>
                                
                                <p> <h5><?= $get_alert->title;?></h5>
                                <?= $get_alert->description;?></p>
                            <?php 
                        }
                        ?>
                    </marquee>
                    <?php
                }
        ?>
    
    </div>
