<?php
$profile=$this->session->userdata("profile");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-175669691-1"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

   <section class="invite_page" style="margin-top:100px;">
       <div class="container">
          <div class="row">
             <div class="col-md-6">
                <div class="invite_page_content">
                    <lottie-player src="  https://assets10.lottiefiles.com/packages/lf20_9ti102vm.json" background="transparent" speed="2"
                        class="error_content" loop autoplay></lottie-player>
                </div>
             </div>
            <div class="col-md-6">
                <div class="invite_page_content_text">
                    <div class="invite_inner_side">
                        <h1>Invite Your <b>Friends</b><br>And Earn <b>Money</b></h1>
                        <img src="<?= $panel_url;?>assets/images/invite_user.png" alt="invite">
                        <div class="text_user_referal">
                            <input type="text" class="linkToCopy" value="<?php echo $left_link=base_url('register?ref='.$profile->username);?>">
                           <button class="copyButton"> <i class="fa fa-files-o" aria-hidden="true"></i></button>
                        </div>
                        <div class="social_icons">
                            <ul>
                                <li>
                                   
                                    <a href="whatsapp://send?text=<?php echo $left_link; ?>" target="_blank"  data-action="share/whatsapp/share">
                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa fa-telegram" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </div>
       </div>
   </section>
<script>
    $('button.copyButton').click(function(){
    $(this).siblings('input.linkToCopy').select();      
    document.execCommand("copy");
});
    
</script>

<br><br><br>
