<!-- Sub-Banner -->
    <section class="banner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-12">
                    <div class="banner_content" data-aos="fade-right">
                        <h1 class="text-white">Our Services</h1>
                        <p class="text-white">The AI Platform assesses more information in less time to deliver you custom and explainable portfolios at scale. </p>
                        <div class="box">
                            <span class="mb-0">Home</span><i class="first fa-regular fa-angle-right"></i><i class="second fa-regular fa-angle-right"></i><span class="mb-0 box_span">Services</span>
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
            <img src="<?= $panel_url;?>assets/images/choose.html" alt="" class="img-fluid">
        </figure>
    </section>
</div>
<!-- Service we provide -->
<section class="provide-section">
    <div class="container">
        <figure class="team-sideimage mb-0">
            <img src="<?= $panel_url;?>assets/images/team-sideimage.png" class="img-fluid" alt="">
        </figure>
        <div class="row">
            <div class="col-12">
                <div class="provide_content" data-aos="fade-right">
                    <h5>Services we provide</h5>
                    <h2>Our Purpose is To Deliver Excellence in Service and Execution</h2>
                </div>
            </div>
        </div>
        <div class="service_contentbox">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-box box-mb">
                        <div class="box-image">
                            <figure class="service-reboticon">
                                <img src="<?= $panel_url;?>assets/images/images%20(5).png" alt="" class="img-fluid">
                            </figure> 
                        </div>
                        <div class="box-content">
                            <h4>Powerful Alerts</h4>
                            <p class="text-size-16">Our fully automated algorithm-based system scans over 11,000 stocks multiple times per second to find the most volatile stocks and alert you to the biggest moves in the market before they occur. Historical trend alerts can help identify patterns or trends over time, which can be useful for predicting future events or making strategic decisions. </p>
                          <!--  <a class="read_more text-decoration-none" href="service.html">Read More</a> -->
                        </div>
                    </div> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-box box-mb">
                        <div class="box-image">
                            <figure class="service-learningicon">
                                <img src="<?= $panel_url;?>assets/images/images%20(3).png" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="box-content">
                            <h4>Options Flow</h4>
                            <p class="text-size-16">The <?= $this->conn->company_info('company_name');?> Options Flow Scanner tracks large aggressive buying activity in specific options contracts. Unusual options activity moves markets. Our proprietary logic gives our members a window into Wall Street to follow the smart money. This information is gold for options traders!</p>
   
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-box">
                        <div class="box-image">
                            <figure class="service-scienceicon">
                                <img src="<?= $panel_url;?>assets/images/download%20(2).png" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="box-content">
                            <h4>Trading Community</h4>
                            <p class="text-size-16">No one trades alone. Chat directly with experienced and new traders alike on the <?= $this->conn->company_info('company_name');?> platform. There’s no need to waste precious time switching between platforms and tabs.

Listen to Live Channels,
Collaborate and Share Ideas and
Interact with Seasoned Veterans in a Team Environment.</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-box">
                        <div class="box-image">
                            <figure class="service-analysicon">
                                <img src="<?= $panel_url;?>assets/images/images%20(6).png" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="box-content">
                            <h4>Predictive Analysis</h4>
                            <p class="text-size-16">Predictive analysis is a branch of data analytics that involves using statistical algorithms, machine learning techniques, and other methods to analyze historical data and make predictions about future Market Trades. By using predictive analysis, user can gain insights that can help them make more informed decisions, reduce costs, improve efficiency, and gain a competitive edge in their industry.</p>
                
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-box">
                        <div class="box-image">
                            <figure class="service-technologyicon">
                                <img src="<?= $panel_url;?>assets/images/images.png" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="box-content">
                            <h4>Indicators</h4>
                            <p class="text-size-16">We have one of the largest collections of institutional grade indicators and charting libraries. Do your due diligence in real time and support your trades with the full fundamental analysis.  It is important to use indicators in conjunction with other market analysis tools to make informed trading decisions.</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-box">
                        <div class="box-image">
                            <figure class="service-metalicon">
                                <img src="<?= $panel_url;?>assets/images/download%20(4).png" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="box-content">
                            <h4>Working with Candlestick Charts</h4>
                            <p class="text-size-16"><?= $this->conn->company_info('company_name');?> work with the daily candlestick chart shows the open, high, low and close price of a security
for the day. Candlestick patterns are technical trading tools that have been used for
centuries to predict price direction. </p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Choose -->
<section class="choose-section">
    <div class="container">
    <figure class="choose-sideshape mb-0">
        <img src="<?= $panel_url;?>assets/images/choose-sideshape.png" alt="" class="img-fluid">
    </figure>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-1 order-2">
                <div class="choose_wrapper">
                    <figure class="mb-0 choose-image">
                        <img src="<?= $panel_url;?>assets/images/choose-image.png" alt="" class="">
                    </figure> 
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
                <div class="choose_content" data-aos="fade-right">
                    <h5>Why Choose Us</h5>
                    <h2 class="text-white">Get Closer Look How <?= $this->conn->company_info('company_name');?> Develop in AI Data Analysis</h2>
                    <p class="text-white text-size-18">THE FUTURE OF BOT A.I BASED ANALYSIS  
                        </p>
                    <ul class="list-unstyled mb-0">
                        <li class="text-white text text-size-18"><i class="circle fa-regular fa-angle-right"></i>Packed With Tools</li>
                        <li class="text-white text text-size-18"><i class="circle fa-regular fa-angle-right"></i>World-Class Charts</li>
                        <li class="text-white text text1 text-size-18"><i class="circle fa-regular fa-angle-right"></i>High-Speed Elliott Wave Analysis</li>
                    </ul>
                    <a class="read_more text-decoration-none" href="about.html">Read More<i class="circle fa-regular fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <figure class="choose-sideshape2 mb-0">
        <img src="<?= $panel_url;?>assets/images/choose-sideshape2.png" alt="" class="img-fluid">
    </figure>   
</section>
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