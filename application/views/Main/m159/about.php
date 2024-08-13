<!-- About -->
<section class="aboutpage-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="aboutpage_wrapper">
                    <figure class="mb-0 aboutpage-image">
                        <img src="<?= $panel_url;?>assets/images/aboutpage-image.png" alt="" class="">
                    </figure> 
                    <figure class="mb-0 aboutpage-image2">
                        <img src="<?= $panel_url;?>assets/images/faq-image.png" alt="" class="img-fluid">
                    </figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="aboutpage_content" data-aos="fade-right">
                    <h5>About us</h5>
                    <h2>Empowering People By Keeping Them Well</h2>
                    <p class="text-size-18">Our unique Smart Tools and powerful Wave Count Scanner help identify potential trading opportunities with clearly-defined risk, and unlock keys to price pattern-based risk management, all in real time..</p>
                    <ul class="list-unstyled mb-0">
                        <li class="text text-size-18"><i class="circle fa-regular fa-angle-right"></i>With our one-of-a-kind collection of interactive tools, novices can rapidly improve their Candlestick charts and skill. </li>
                        <li class="text text-size-18"><i class="circle fa-regular fa-angle-right"></i>Whether you trade stocks, forex, futures, cryptocurrencies or other, <?= $this->conn->company_info('company_name');?> will help you make smarter trading decisions and take control of your trading. </li>
                       
                    </ul>
                    <a class="read_more text-decoration-none" href="<?= base_url();?>about">Read More<i class="circle fa-regular fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>  
</section>
<!-- Counter -->
<section class="counter-section position-relative">
    <div class="container">
        <figure class="counter-sideimage mb-0">
            <img src="<?= $panel_url;?>assets/images/counter-sideimage.png" class="img-fluid" alt="">
        </figure>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                <div class="counter-box">
                    <figure class="counter-image1">
                        <img src="<?= $panel_url;?>assets/images/images.png" alt="" class="img-fluid">
                    </figure> 
                    <h3 class="mb-0 counter">398</h3>
                    <span class="mb-0 plus">+</span>
                    <span class="mb-0 text1 text-size-16">Completed Projects</span>
                </div>   
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                <div class="counter-box">
                    <figure class="counter-image2">
                        <img src="<?= $panel_url;?>assets/images/images.jpg" alt="" class="img-fluid">
                    </figure> 
                    <h3 class="mb-0 counter">120</h3>
                    <span class="mb-0 plus">+</span>
                    <span class="mb-0 text1 text-size-16">Satisfied  Clients</span>
                </div>   
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                <div class="counter-box">
                    <figure class="counter-image3">
                        <img src="<?= $panel_url;?>assets/images/download%20(2).png" alt="" class="img-fluid">
                    </figure> 
                    <h3 class="mb-0 counter">86</h3>
                    <span class="mb-0 plus">%</span>
                    <span class="mb-0 text1 text-size-16">Website Analysis</span>
                </div>   
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                <div class="counter-box">
                    <figure class="counter-image4">
                        <img src="<?= $panel_url;?>assets/images/images%20(6).png" alt="" class="img-fluid">
                    </figure> 
                    <h3 class="mb-0 counter">240</h3>
                    <span class="mb-0 plus">+</span>
                    <span class="mb-0 text1 text-size-16">Support Done</span>
                </div>   
            </div>
        </div>
    </div>
</section>
<!-- Info video -->
<div class="videosection" data-aos="fade-up">
    <div class="container">
        <div class="row position-relative">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="position-relative">
                    <a class="popup-vimeo" href="https://www.youtube.com/watch?v=3SYzmqj9inY">
                        <figure class="mb-0 vediosession">
                            <img class="thumb img-fluid" style="cursor: pointer" src="<?= $panel_url;?>assets/images/image-vediosession.png" alt="">
                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--FAQ / Need section-->
<section class="faq-section">
    <div class="container">
        <div class="row">
             <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="faq_content" data-aos="fade-right">
                    <h5>faq,s</h5>
                    <h2>Frequently Asked Questions</h2>
                    <div class="faq">
                        <div class="row">
                            <div class="col-12">
                                <div class="accordian-section-inner position-relative">
                                    <div class="accordian-inner">
                                        <div id="accordion1">
                                            <div class="accordion-card">
                                                <div class="card-header" id="headingOne">
                                                    <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                        <h4>What is the Trading Bots Account?</h4>
                                                    </a>
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                                                    <div class="card-body">
                                                        <p class="text-size-18 text-left mb-0"><?= $this->conn->company_info('company_name');?> introduced a unified Trading Bots Account to enhance the user experience for Spot and Futures grid trading users. You can easily access and manage all your trading bot activities in this account.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-card">
                                                <div class="card-header" id="headingTwo">
                                                    <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <h4>when i can begin Trading?</h4>
                                                    </a>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                                                    <div class="card-body">
                                                        <p class="text-size-18 text-left mb-0">You can begin immediately after your payment is received. Upon receipt you will be given a download link so you can immediately download our charting software with all necessary indicators and instruction manuals and begin watching the forex markets in real time. The system is designed so you can open trades on each signal simultaneously at the current market prices. You will also be given instructions on how to download your own free demo account to place practice trades immediately using the automated signals from the robot.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-card">
                                                <div class="card-header" id="headingThree">
                                                    <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        <h4>What is demo account trading?</h4>
                                                    </a>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                                                    <div class="card-body">
                                                        <p class="text-size-18 text-left mb-0">A demo account looks and acts just like a real trading account except it does not contain any real money. It is set up with "play" money for the purpose of practicing & sharpening your trading skills within real market conditions without risking any of your own real money. If you are a novice trader we recommend that you trade on a demo account until you have had at least 1 or 2 consecutive profitable months in a row. This is our way of being responsible to you and it's a vital and essential part of the learning process. Most brokers offer demo accounts for free.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-card">
                                                <div class="card-header" id="headingFour">
                                                    <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        <h4>What is Auto-Trading or Automatic Trading?</h4>
                                                    </a>
                                                </div>
                                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour">
                                                    <div class="card-body">
                                                        <p class="text-size-18 text-left mb-0">Auto-Trading or Automatic Trading is a form of trading that uses computer algorithms and software programs to execute trades automatically. This type of trading is also known as algorithmic trading or black-box trading. The software uses a set of pre-determined rules and mathematical models to analyze market data and make trades based on the conditions it encounters. Auto-trading can be used to buy and sell stocks, options, futures, currencies, and other financial instruments. It is becoming more and more popular as it allows traders to execute trades faster, more consistently and with a higher degree of accuracy, which can help to improve trading performance. However, it is important to note that it also has its own set of risks and it is important for the traders to have a good understanding of the system and the underlying assets before using it.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-card faq-mb">
                                                <div class="card-header" id="headingFive">
                                                    <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                        <h4>Can I trade multiple scrips together?</h4>
                                                    </a>
                                                </div>
                                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive">
                                                    <div class="card-body">
                                                        <p class="text-size-18 text-left mb-0">Yes, it is possible to trade multiple scrips (i.e. stocks, bonds, or other securities) at the same time. This is known as portfolio diversification, and it can help spread risk across different types of investments. It is important to note that trading multiple scrips may also require a larger investment and a more active management of your portfolio. It is always recommended to do your own research and consult with a financial advisor before making any investment decisions.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<!--<body onload="process()">
   <img src='' id='QRCode' ...>
</body>-->
<script>
function process()
{
   var url=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data==" + window.location.href;
   document.getElementById('QRCode').src = url;
}
</script>
