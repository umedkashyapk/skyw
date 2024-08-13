
<!-- Sub-Banner -->
    <section class="banner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-12">
                    <div class="banner_content" data-aos="fade-right">
                        <h1 class="text-white">Contact Us</h1>
                        <p class="text-white">"Have a question or concern? Contact us today and let us provide you with the support you need."</p>
                        <div class="box">
                            <span class="mb-0">Home</span><i class="first fa-regular fa-angle-right"></i><i class="second fa-regular fa-angle-right"></i><span class="mb-0 box_span">Contact</span>
                        </div> 
                    </div>
                </div> 
                <div class="col-lg-5 col-md-6 col-sm-12 col-12">
                    <div class="banner_wrapper">
                        <figure class="mb-0 sub-bannerimage">
                            <img src="<?= $panel_url;?>assets/images/sub-bannerimage.png" alt="" class="">
                        </figure> 
                    </div>  
                </div>
            </div>
        </div> 
        <figure class="sub-bannersideshape2 mb-0">
            <img src="<?= $panel_url;?>assets/images/banner-sideshape2.png" alt="" class="img-fluid">
        </figure>
    </section>
</div>
<!--Contact section-->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="contact_content" data-aos="fade-right">
                    <h5>Our Details</h5>
                    <h2>Contact Information</h2>
                    <div class="contact-box">
                        <div class="box-image">
                            <figure class="contact-location">
                                <img src="<?= $panel_url;?>assets/images/contact-location.png" alt="" class="img-fluid">
                            </figure> 
                        </div>
                        <div class="box-content">
                            <h4>Location:</h4>
                            <p class="text-size-18"><?= $this->conn->company_info('company_address');?> </p>
                        </div>
                    </div>
                    <div class="contact-box box-mb">
                        <div class="box-image">
                            <figure class="contact-phone">
                                <img src="<?= $panel_url;?>assets/images/contact-phone.png" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="box-content">
                            <h4 class="heading">Phone:</h4>
                            <p>
                               <a href="tel:<?= $this->conn->company_info('company_mobile');?>" class="text-decoration-none text text-size-18"><?= $this->conn->company_info('company_mobile');?></a>
                            </p>
                            <p>
                                <!--<a href="tel:+80023456789" class="mb-0 text-decoration-none text text-size-18">(+800 2345 6789)</a> -->
                            </p>
                        </div>
                    </div>
                    <div class="contact-box">
                        <div class="box-image">
                            <figure class="contact-email">
                                <img src="<?= $panel_url;?>assets/images/contact-email.png" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="box-content">
                            <h4 class="heading">Email:</h4>
                            <p>
                                <a href="mailto:<?= $this->conn->company_info('company_email');?>" class="text-decoration-none text-size-18"><?= $this->conn->company_info('company_email');?></a>
                            </p>
                            <p>
                                <a href="mailto:<?= $this->conn->company_info('company_email');?>" class="mb-0 text-decoration-none text-size-18"><?= $this->conn->company_info('company_email');?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="need-section">
                    <div class="need_content"> 
                        <h3>Need any Help!</h3>
                        <p class="text-size-16">Complete the following form and an <?= $this->conn->company_info('company_name');?> representative will contact you about our suite of solutions</p>
                        <form id="contactpage" method="POST" action="#">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-0">    
                                    <input type="text" class="form_style" placeholder="Your Name:" name="name"> 
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                    <input type="email" class="form_style" placeholder="Your Email:" name="emailid">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                    <input type="tel" class="form_style" placeholder="Phone:" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class=" form-group mb-0">    
                                    <textarea class="form_style" placeholder="Message" rows="3" name="msg"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="manage-button text-center">
                                <button type="submit" class="submit_now text-decoration-none">Submit Now<i class="circle fa-regular fa-angle-right"></i></button>
                            </div>
                        </form>
                        <figure class="faq-image mb-0">
                            <img src="<?= $panel_url;?>assets/images/faq-image.png" alt="" class="img-fluid">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="contact_map_section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3152.3329737833114!2d144.96011341590386!3d-37.80566904135444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2s!4v1669200882885!5m2!1sen!2s"
            width="1920" height="556" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>