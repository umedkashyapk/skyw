<style>
#popup {
  display: none;
 }
 .circle{
     background:#fbec9f!important;
 }
.forex_meta {
   height: 100vh;
   }
h2.liverate {
    text-align: center;
    margin-bottom: 20px;
    text-transform: capitalize;
    color:var(--textColor);
    font-size: 38px;
}

.margin{
    margin-left: 20px;
}
</style>
<!-- Banner -->
<section class="banner-section">
    <div class="container-fluid">
        <div class="row">
            <div id="popup">
              <?php
      	$panel_pa=$this->conn->company_info('panel_directory');
	$this->load->view($panel_pa.'/pages/dashboard/alert');
    ?>  
    </div>
            <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                <div class="banner_content">
                    <h1 class="text-white">AI-powered Trading For Smarter Investments</h1>
                    <p class="text-white"><?= $this->conn->company_info('company_name');?> is an AI-powered robo-advisor and stock scanner for stock trading, opportunity detection and back-testing. </p>
                    <div class="banner-button">
                        <a class="button1 lets_talk text-decoration-none" href="#">Read More<i class="circle fa-regular fa-angle-right"></i></a>
                        <a class="lets_talk text-decoration-none" href="#">Download<i class="circle fa-regular fa-angle-right"></i></a>   
                    </div> 
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                <div class="banner_wrapper" data-aos="fade-right">
                    <figure class="mb-0 banner-image">
                        <!--<img src="<?= $panel_url;?>assets/images/banner-image%20(1).png" alt="" cl/ass="">-->
                        <img src="<?= $panel_url;?>assets/images/robot1.webp" alt="" class="margin">
                    </figure> 
                </div>
            </div>
        </div>
    </div>
    <figure class="banner-sideshape2 mb-0">
        <img src="<?= $panel_url;?>assets/images/banner-sideshape2.png" alt="" class="img-fluid">
    </figure>   
</section>
</div>
<!-- About us -->
<section class="about-section" style="background: #0a0a0a;" id="forex_chart">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                 <h2 class="liverate">forex market live rate </h2>
</div>
</div>
        <div class="row">
            <!-- <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="about_wrapper">
                    <figure class="mb-0 about-image1">
                        <img src="<?= $panel_url;?>assets/images/aboutpage-image.png" alt="" class="img-fluid">
                    </figure> 
                    <figure class="mb-0 about-image2">
                        <img src="<?= $panel_url;?>assets/images/about-image2.png" alt="" class="img-fluid">
                    </figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="about_content" data-aos="fade-right">
                    <h5>About us</h5>
                    <h2>The Future Of Candlestick Charts Analysis </h2>
                    <p class="text-size-18">Award-Wining,fast,modern,beautiful real-time charts-and a familiar drag and drop experience, for every kind of investor.</p>
                    <div class="about-lowercontent">
                        <div class="image">
                            <figure class="mb-0 icon">
                            <img src="<?= $panel_url;?>assets/images/counter-image1.png" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="content">
                            <h4>100% Customers Satisfaction</h4>
                            <p class="text-size-18">Achieving 100% customer satisfaction is a critical goal for any business that wants to succeed and grow. </p>
                        </div>
                        <div class="image">
                            <figure class="mb-0 icon">
                                <img src="<?= $panel_url;?>assets/images/counter-image2.png" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="content">
                            <h4>Specialized tools for technical traders</h4>
                            <p class="text-size-18 text">We provide the many specialized tools available for technical traders, which can help them analyze market data, identify trends, and make informed trading decisions.</p>
                        </div>
                    </div>
                    <a class="read_more text-decoration-none" href="#">Read More<i class="circle fa-regular fa-angle-right"></i></a>
                </div>
            </div> -->
            <div class="col-12">
      <div class="forex_meta">
   <!-- TradingView Widget BEGIN -->
  <div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
  {
  "colorTheme": "dark",
                            "dateRange": "1D",
                            "showChart": true,
                            "locale": "in",
                            "width": "100%",
                            "height": "100%",
                            "largeChartUrl": "",
                            "isTransparent": true,
                            "showSymbolLogo": true,
                            "showFloatingTooltip": false,
                            "plotLineColorGrowing": "rgba(255, 152, 0, 1)",
                            "plotLineColorFalling": "rgba(255, 152, 0, 1)",
                            "gridLineColor": "rgba(240, 243, 250, 0)",
                            "scaleFontColor": "rgba(106, 109, 120, 1)",
                            "belowLineFillColorGrowing": "rgba(66, 66, 66, 0.12)",
                            "belowLineFillColorFalling": "rgba(41, 98, 255, 0.12)",
                            "belowLineFillColorGrowingBottom": "rgba(66, 66, 66, 0)",
                            "belowLineFillColorFallingBottom": "rgba(41, 98, 255, 0)",
                            "symbolActiveColor": "rgba(41, 98, 255, 0.12)",
  "tabs": [
    {
      "title": "Indices",
      "symbols": [
        {
          "s": "FOREXCOM:SPXUSD",
          "d": "S&P 500"
        },
        {
          "s": "FOREXCOM:NSXUSD",
          "d": "US 100"
        },
        {
          "s": "FOREXCOM:DJI",
          "d": "Dow 30"
        },
        {
          "s": "INDEX:NKY",
          "d": "Nikkei 225"
        },
        {
          "s": "INDEX:DEU40",
          "d": "DAX Index"
        },
        {
          "s": "FOREXCOM:UKXGBP",
          "d": "UK 100"
        },
        {
          "s": "BSE:SENSEX",
          "d": " S&P BSE SENSEX"
        },
        {
          "s": "NSE:CNXAUTO",
          "d": "NIFTY AUTO"
        },
        {
          "s": "NSE:CNXMETAL",
          "d": "NIFTY AUTO"
        },
        {
          "s": "CAPITALCOM:DXY",
          "d": " US DOLLAR INDEX"
        },
        {
          "s": "PEPPERSTONE:US30",
          "d": " US DOLLAR INDEX"
        }
      ],
      "originalTitle": "Indices"
    },
    {
      "title": "Futures",
      "symbols": [
        {
          "s": "CME_MINI:ES1!",
          "d": "S&P 500"
        },
        {
          "s": "CME:6E1!",
          "d": "Euro"
        },
        {
          "s": "COMEX:GC1!",
          "d": "Gold"
        },
        {
          "s": "NYMEX:CL1!",
          "d": "Crude Oil"
        },
        {
          "s": "NYMEX:NG1!",
          "d": "Natural Gas"
        },
        {
          "s": "CBOT:ZC1!",
          "d": "Corn"
        },
        {
          "s": "MCX:NATURALGAS1!",
          "d": " US DOLLAR INDEX"
        },
        {
          "s": "MCX:SILVER1!",
          "d": " US DOLLAR INDEX"
        }
      ],
      "originalTitle": "Futures"
    },
    {
      "title": "Forex",
      "symbols": [
        {
          "s": "FX:EURUSD",
          "d": "EUR/USD"
        },
        {
          "s": "FX:GBPUSD",
          "d": "GBP/USD"
        },
        {
          "s": "FX:USDJPY",
          "d": "USD/JPY"
        },
        {
          "s": "FX:USDCHF",
          "d": "USD/CHF"
        },
        {
          "s": "FX:AUDUSD",
          "d": "AUD/USD"
        },
        {
          "s": "FX:USDCAD",
          "d": "USD/CAD"
        },
        {
          "s": "FX_IDC:USDINR",
          "d": "U.S. DOLLAR / INDIAN RUPEE"
        },
        {
          "s": "FX:EURUSD",
          "d": " EURO FX/U.S. DOLLAR"
        },
        {
          "s": "OANDA:GBPUSD",
          "d": "GBP/USD"
        },
        {
          "s": "FX:USDJPY",
          "d": "U.S. DOLLAR/JAPANESE YEN"
        },
        {
          "s": "FOREXCOM:EURUSD",
          "d": "U.S. DOLLAR/JAPANESE YEN"
        },
        {
          "s": "FOREXCOM:GBPUSD",
          "d": "BRITISH POUND / U.S. DOLLAR"
        },
        {
          "s": "FX:AUDUSD",
          "d": "BRITISH POUND / U.S. DOLLAR"
        },
        {
          "s": "OANDA:CADJPY",
          "d": "CAD/JPY"
        },
        {
          "s": "OANDA:NZDCAD",
          "d": "NZD/CAD"
        },
        {
          "s": "OANDA:EURNZD",
          "d": "NZD/CAD"
        },
        {
          "s": "FOREXCOM:USDCAD",
          "d": "U.S. DOLLAR / CANADIAN DOLLAR"
        },
        {
          "s": "EIGHTCAP:AUDUSD",
          "d": " AUSTRALIAN DOLLAR / US DOLLAR"
        },
        {
          "s": "OANDA:GBPCAD",
          "d": " GBP/CAD"
        },
        {
          "s": "FX:EURGBP",
          "d": " EURO FX/BRITISH POUND"
        },
        {
          "s": "FOREXCOM:EURCHF",
          "d": " EURO FX/BRITISH POUND"
        },
        {
          "s": "EASYMARKETS:NZDCAD",
          "d": "NEW ZEALAND DOLLAR / CANADIAN DOLLAR"
        },
        {
          "s": "OANDA:NZDUSD",
          "d": " NZD/USD"
        },
        {
          "s": "PEPPERSTONE:GBPUSD",
          "d": "BRITISH POUND VS US DOLLAR"
        },
        {
          "s": "FX:USDCNH",
          "d": "U.S. DOLLAR/CHINESE YUAN"
        },
        {
          "s": "FOREXCOM:EURCHF",
          "d": "U.S. DOLLAR/CHINESE YUAN"
        }
      ],
      "originalTitle": "Forex"
    },
    {
      "title": "Crypto",
      "symbols": [
        {
          "s": "BINANCE:BTCUSDT",
          "d": " BITCOIN / TETHERUS"
        },
        {
          "s": "BITSTAMP:BTCUSD",
          "d": " BITCOIN / TETHERUS"
        },
        {
          "s": "BINANCE:BTCUSDT.P",
          "d": "BITCOIN / TETHERUS PERPETUAL CONTRACT"
        },
        {
          "s": "BINANCE:ETHUSDT",
          "d": "ETHEREUM / TETHERUS"
        },
        {
          "s": "BINANCE:SOLUSDT",
          "d": " SOL / TETHERUS"
        },
        {
          "s": "BITSTAMP:LTCUSD",
          "d": "LITECOIN / U.S. DOLLAR"
        },
        {
          "s": "BINANCE:BTCUSD",
          "d": " BITCOIN / US DOLLAR"
        },
        {
          "s": "BINANCE:BCHUSDT",
          "d": " BITCOIN CASH / TETHERUS"
        },
        {
          "s": "BINANCE:BNBUSDT.P",
          "d": " BINANCE COIN / TETHERUS PERPETUAL CONTRACT"
        },
        {
          "s": "BINANCE:PEPEUSDT",
          "d": " PEPE / TETHERUS"
        },
        {
          "s": "BINANCE:SHIBUSDT",
          "d": "SHIB / TETHERUS"
        },
        {
          "s": "BINANCE:INJUSDT",
          "d": " INJ / TETHERUS"
        },
        {
          "s": "BINANCE:GALAUSDT",
          "d": " GALA / TETHERUS"
        },
        {
          "s": "BINANCE:ATOMUSDT",
          "d": " COSMOS / TETHERUS"
        },
        {
          "s": "BINANCE:OPUSDT",
          "d": " COSMOS / TETHERUS"
        },
        {
          "s": "BINANCE:ADAUSDT.P",
          "d": "CARDANO / TETHERUS PERPETUAL CONTRACT"
        },
        {
          "s": "BINANCE:SXPUSDT",
          "d": " SXP / TETHERUS"
        },
        {
          "s": "BINANCE:TOMOUSDT",
          "d": "TOMOCHAIN / TETHERUS"
        },
        {
          "s": "CRYPTO:BTCUSD",
          "d": " BITCOIN"
        },
        {
          "s": "BINANCE:ETHUSDT",
          "d": " ETHEREUM / TETHERUS"
        },
        {
          "s": "BITSTAMP:ETHUSD",
          "d": "ETHEREUM / U.S. DOLLAR"
        },
        {
          "s": "BINANCE:MATICUSDT",
          "d": "MATIC NETWORK / TETHERUS"
        },
        {
          "s": "BINANCE:DOTUSDT",
          "d": "MATIC NETWORK / TETHERUS"
        },
        {
          "s": "BINANCE:CHZUSDT",
          "d": " CHILIZ / TETHERUS"
        },
        {
          "s": "BINANCE:WAVESUSDT.P",
          "d": "WAVES / TETHERUS PERPETUAL CONTRACT"
        },
        {
          "s": "PYTH:XAUUSD",
          "d": " GOLD VS US DOLLAR"
        },
        {
          "s": "BINANCE:COMPUSDT",
          "d": "COMP / TETHERUS"
        },
        {
          "s": "BINANCE:ADAUSDT.P",
          "d": "COMP / TETHERUS"
        }
      ]
    }
  ]
}
  </script>
</div>
</div>
        </div>
    </div>
</section>
<!-- Services -->
<section class="service-section position-relative">
    <div class="container">
        <figure class="service-image mb-0">
            <img src="<?= $panel_url;?>assets/images/service-image.png" class="img-fluid" alt="">
        </figure>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="service_content" data-aos="fade-right">
                    <h5>Services we provide</h5>
                    <h2>Our Purpose is To Deliver Excellence in Service and Execution</h2>
                    <p class="text-size-18">As an AI language model,our bot provides you many best services that are always gives you the best results. </p>
                   
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="service_contentbox">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="service-box box-mb">
                                <figure class="service-reboticon">
                                    <img src="<?= $panel_url;?>assets/images/images%20(6).png" alt="" class="img-fluid">
                                </figure> 
                                <h4>Powerful Alerts</h4>
                                <p class="text-size-16 mb-2">Our bot is fully automated algorithm-based system that scans multiple stocks per second.</p>
                                <a class="read_more text-decoration-none" href="#">Read More</a>
                            </div>   
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="box-top">
                                <div class="service-box box-mb">
                                    <figure class="service-learningicon">
                                        <img src="<?= $panel_url;?>assets/images/images.png" alt="" class="img-fluid">
                                    </figure>
                                    <h4>Options Flow</h4>
                                    <p class="text-size-16 mb-2">The <?= $this->conn->company_info('company_name');?> Options Flow Scanner tracks large aggressive buying activity in specific options contracts.</p>
                                    <a class="read_more text-decoration-none" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="service-box">
                                <figure class="service-scienceicon">
                                    <img src="<?= $panel_url;?>assets/images/images%20(3).png" alt="" class="img-fluid">
                                </figure>
                                <h4>Trading Community</h4>
                                <p class="text-size-16 mb-2">No one trades alone. Chat directly with experienced and new traders alike on the <?= $this->conn->company_info('company_name');?> platform.</p>
                                <a class="read_more text-decoration-none" href="#">Read More</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="box-top">
                                <div class="service-box">
                                    <figure class="service-analysicon">
                                        <img src="<?= $panel_url;?>assets/images/images%20(5).png" alt="" class="img-fluid">
                                    </figure>
                                    <h4>Predictive Analysis</h4>
                                    <p class="text-size-16 mb-2">Predictive analysis, user can gain insights that can help them make more informed decisions, reduce costs, improve efficiency, and gain a competitive edge in their industry.</p>
                                    <a class="read_more text-decoration-none" href="#">Read More</a>
                                </div>
                            </div>
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
        <img src="<?= $panel_url;?>assets/images/choose-background-1.png" alt="" class="img-fluid">
    </figure>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-1 order-2">
                <div class="choose_wrapper">
                    <figure class="mb-0 choose-image">
                        <!--<img src="<?= $panel_url;?>assets/images/choose-image.png" alt="" class="">-->
                         <img src="<?= $panel_url;?>assets/images/robot3.webp" alt="" class="">
                    </figure> 
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
                <div class="choose_content" data-aos="fade-right">
                    <h5>Why Choose Us</h5>
                    <h2 class="text-white">Get Closer Look How <?= $this->conn->company_info('company_name');?> Develop in A.I. Data Analysis</h2>
                    <p class="text-white text-size-18">THE FUTURE OF BOT A.I. BASED ANALYSIS 
                  </p>
                    <ul class="list-unstyled mb-0">
                        <li class="text-white text text-size-18"><i class="circle fa-regular fa-angle-right"></i>Packed With Tools</li>
                        <li class="text-white text text-size-18"><i class="circle fa-regular fa-angle-right"></i>World-Class Charts</li>
                        <li class="text-white text text1 text-size-18"><i class="circle fa-regular fa-angle-right"></i>High-Speed Candlestick Charts Analysis</li>
                    </ul>
                    <a class="read_more text-decoration-none" href="#">Read More<i class="circle fa-regular fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <figure class="choose-sideshape2 mb-0">
        <img src="<?= $panel_url;?>assets/images/choose-sideshape2.png" alt="" class="img-fluid">

    </figure>   
</section>
<!-- Case Study -->
<section class="study-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="study_content">
                    <h5>Case Study</h5>
                    <h2>Explore Our Case Studies</h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="case-box overlay">
          
                        <img src="<?= $panel_url;?>assets/images/case.png" alt="" class="img-fluid">
          <h3>Bullish Harami Pattern</h3>
                   
                </div>
               
            </div>
            
            
            
            
            
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="case-box overlay">
                          <img src="<?= $panel_url;?>assets/images/3up.png" alt="" class="img-fluid">
                   <h3>Three Inside Up</h3>
                    
                   
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="case-box overlay">
                   
                        <img src="<?= $panel_url;?>assets/images/morningstar.png" alt="" class="img-fluid">
                    <h3>The Morning Star</h3></h3>
                   
                   
                </div>
            </div>
        </div>
        <div class="lower-images" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="case-box overlay">
                     
                            <img src="<?= $panel_url;?>assets/images/piercing.png" alt="" class="img-fluid">
                       <h3>Piercing Pattern</h3></h3>
                  
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="case-box overlay">
                      
                            <img src="<?= $panel_url;?>assets/images/hammer.png" alt="" class="img-fluid">
                          <h3>Hammer Pattern</h3></h3>
                  
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="case-box overlay">
                 
                            <img src="<?= $panel_url;?>assets/images/3white.png" alt="" class="img-fluid">
                       <h3>Three white Soldiers</h3></h3>
                    
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="button">
            <a class="view_all text-decoration-none" href="#">View All<i class="circle fa-regular fa-angle-right"></i></a>
        </div>
    </div>
</section>
<!-- Testimonial -->
<section class="testimonial-section">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12">
                <div class="heading">
                    <h5>Testimonials</h5>
                    <h2>Hear it From Our Clients</h2>
                </div>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testimonial_content">
                                <div class="content-box">
                                    <p class="h4">“As an active retail Tarder, I have used <?= $this->conn->company_info('company_name');?> to capture many wins in the market. If you are looking for possible trades, <?= $this->conn->company_info('company_name');?> will be the excellent Choice.”</p>
                                    <figure class="testimonial-image mb-0">
                                        <img src="<?= $panel_url;?>assets/images/testimonial-image.png" alt="" class="img-fluid">
                                    </figure>
                                    <span class="text-size-18">Peter Johns</span>

                                    <div class="box">
                                        <figure class="testimonial-comas mb-0">
                                            <img src="<?= $panel_url;?>assets/images/testimonial-comas.png" alt="" class="img-fluid">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testimonial_content">
                                <div class="content-box">
                                    <p> <?= $this->conn->company_info('company_name');?> is an excellent service worthy of praise. They provide top of line tools, helping novice to professional traders achieve their full potential.”</p>
                                    <figure class="testimonial-image mb-0">
                                        <img src="<?= $panel_url;?>assets/images/team-image5.png" alt="" width="70%" class="img-fluid">
                                    </figure>
                                    <span class="text-size-18">Michael Kim</span>
                                    
                                    <div class="box">
                                        <figure class="testimonial-comas">
                                            <img src="<?= $panel_url;?>assets/images/testimonial-comas.png" alt="" class="img-fluid">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-outer">
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <i class="fa-solid fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <i class="fa-solid fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <figure class="mb-0 testimonial-sideimage">
            <img src="<?= $panel_url;?>assets/images/testimonial-sideimage.png" alt="" class="img-fluid">
        </figure>
    </div>
    <!-- Partner -->
  <!--  <div class="partner-section"> 
        <div class="container">
            <div class="partner" data-aos="fade-up">
                <ul class="mb-0 list-unstyled">
                    <li>
                        <figure class="mb-0 partner1 img1">
                            <img class="img-fluid" src="<?= $panel_url;?>assets/images/partner1.png" alt="">
                        </figure>
                    </li>
                    <li>
                        <figure class="mb-0 partner1 partner2 img2">
                            <img class="img-fluid" src="<?= $panel_url;?>assets/images/partner2.png" alt="">
                        </figure>
                    </li>
                    <li class="img-mb">
                        <figure class="mb-0 partner1 partner3 img3">
                            <img class="img-fluid" src="<?= $panel_url;?>assets/images/partner3.png" alt="">
                        </figure>
                    </li>
                    <li>
                        <figure class="mb-0 partner1 partner4 img4">
                            <img class="img-fluid" src="<?= $panel_url;?>assets/images/partner4.png" alt="">
                        </figure>
                    </li>
                    <li>
                        <figure class="mb-0 partner1 partner5 img5">
                            <img class="img-fluid" src="<?= $panel_url;?>assets/images/partner5.png" alt="">
                        </figure>
                    </li>
                </ul>
            </div>
        </div>
    </div>-->
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

<script>
// Get the popup element
const popup = document.getElementById('popup');

// Show the popup
popup.style.display = 'block';

// Set a timeout to hide the popup after 20 seconds
setTimeout(() => {
  popup.style.display = 'none';
}, 20000);

</script>