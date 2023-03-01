<?php
$reCaptchaPublicKey = "6LcE4zAfAAAAAJqo8MheGrC1LnKqfgThVm49YdWb";
$reCaptchaSecretKey = "6LcE4zAfAAAAALtk1N6VKn4RGJijvpBWax1ALsTc";
$sent = false;
if (isset($_COOKIE['contact_sent']) && $_COOKIE['contact_sent'] == 'true') {
    setcookie ('contact_sent', 'false');
    $sent = true;
}
$recaptcha_error = '';
if (isset($_COOKIE['recaptcha_error'])) {
    $recaptcha_error = $_COOKIE['recaptcha_error'];
};
setcookie ('recaptcha_error', '');
if (isset($_POST['contact_firstname'], $_POST['contact_lastname'], $_POST['contact_email'])){
    $recaptcha = false;
    $recaptcha_input = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
    . $reCaptchaSecretKey . '&response=' . $recaptcha_input;
    $response = file_get_contents($url);
    $response = json_decode($response);
    if ($response->success == true) {
        $recaptcha = true;
    };
    setcookie('contact_sent', 'false');
    if ($recaptcha) {
        $firstname = $_POST['contact_firstname'];
        $lastname = $_POST['contact_lastname'];
        $email = $_POST['contact_email'];
        $phone = $_POST['contact_phone'] ?? "-";
        $message = $_POST['contact_message'] ?? "-";
        $to = "info@bluestonecm.com";
        // $to = "volcharo@gmail.com";
        $subject = "New contact message from Bluestone";
        $body = "First Name: " . $firstname . "\r\nLast Name: " . $lastname . "\r\nEmail: " . $email . "\r\nPhone: " . $phone . "\r\nMessage: " . $message;
        // $sent = mail (
        //     $to,
        //     $subject,
        //     $body,
        //     'From: info@bluestonecm.com' . "\r\n" .
        //     'Reply-To: info@bluestonecm.com' . "\r\n" .
        //     'Cc: volcharo@gmail.com' . "\r\n" .
        //     "MIME-Version: 1.0" . "\r\n" . 
        //     "Content-type:text/html;charset=UTF-8" . "\r\n"
        // );
        setcookie('contact_sent', 'true');
        unset($_POST);
        // header("Location: ".$_SERVER[REQUEST_URI]);
        exit;
    } else {
        setcookie('recaptcha_error', '<br>Please, confirm that You are not a robot.');
        unset($_POST);
        // header("Location: ".$_SERVER[REQUEST_URI]);
        exit;
    };
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="favicon.ico">
    <title>BlueStone</title>
</head>
<script>
    console.log ('<?=print_r($_dev1)?>');
</script>
<body>
    <div class="app">
        <div class="top">
            <div class="top-photo">
                <img src="./img/top-photo.svg" alt="">
            </div>
            <div class="wrapper">
                <div class="hamburger"></div>
                <div class="menu top-menu">
                    <div class="menu__close"></div>
                    <div class="menu__item">
                        <div class="menu__item__title">home</div>
                    </div>
                    <div class="menu__item">
                        <div class="menu__item__title">alternatives</div>
                        <div class="menu__item__options">
                            <div class="menu__item__option" window-open="Polaris Point">Polaris Point</div>
                            <div class="menu__item__option" window-open="Alt Strategies">Alt Strategies</div>
                        </div>
                    </div>
                    <div class="menu__item">
                        <div class="menu__item__title">etfs</div>
                        <div class="menu__item__options">
                            <div class="menu__item__option" window-open="Adaptive Investments">Adaptive Investments</div>
                        </div>
                    </div>
                    <div class="menu__item">
                        <div class="menu__item__title">separate accounts</div>
                        <div class="menu__item__options">
                            <div class="menu__item__option" window-open="Bluestone Adaptive Alpha">Bluestone Adaptive Alpha</div>
                            <div class="menu__item__option" window-open="Bluestone Elite">Bluestone Elite</div>
                            <div class="menu__item__option" window-open="Bluestone Income">Bluestone Income</div>
                            <div class="menu__item__option" window-open="Bluestone Income Plus">Bluestone Income Plus</div>
                        </div>
                    </div>
                    <div class="menu__item">
                        <div class="menu__item__title">about us</div>
                        <div class="menu__item__options">
                            <div class="menu__item__option" window-open="Access Us">Access Us</div>
                            <div class="menu__item__option" window-open="Contact">Contact</div>
                        </div>
                    </div>
                </div>
                <div class="top-logo">
                    <img src="./img/logo.svg" alt="">
                </div>
                <div class="top-slogan">
                    <div class="top-slogan__filler"></div>
                </div>
            </div>
        </div>
        <br>
        <div class="two-column wrapper">
            <div class="two-column__columns">
                <div class="about">
                    <div class="about__title">About Us</div>
                    <div class="about__text">
                        Bluestone is a boutique asset manager focused solely on providing our clients with differentiated sources of alpha. Our hybrid approach blends top-down analysis with bottom-up views under an integrated framework.
                        We build adaptive portfolios by combining quantitative analysis with fundamental insights and rigorous risk management.
                        <br><br>Our central purpose is to help improve the risk-adjusted performance for our clients over a full market cycle.
                    </div>
                </div>
                <div class="contacts">
                    <div class="contacts__item">
                        <div class="contacts__item__icon">
                            <img src="./img/icn_loc.svg" alt="">
                        </div>
                        <div class="contacts__item__data">
                            <div class="contacts__item__title">location</div>
                            <div class="contacts__item__text">37 West Avenue, Suite 301 Wayne, PA 19087</div>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="contacts__item__icon">
                            <img src="./img/icn_email.svg" alt="">
                        </div>
                        <div class="contacts__item__data">
                            <div class="contacts__item__title">email</div>
                            <div class="contacts__item__text"><a href="mailto:info@bluestonecm.com">info@bluestonecm.com</a></div>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="contacts__item__icon">
                            <img src="./img/icn_phone.svg" alt="">
                        </div>
                        <div class="contacts__item__data">
                            <div class="contacts__item__title">phone</div>
                            <div class="contacts__item__text">(610) 337-6500</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="line1">
            <img src="./img/line_1.png" alt="">
        </div>
        <div class="line2">
            <img src="./img/line_2.png" alt="">
        </div>
        <div class="strategies wrapper">
            <div class="strategies__title">
                <div class="strategies__title__filler"></div>
            </div>
            <div class="strategies__items">
                <div class="strategies__item">
                    <div class="strategies__item__title">BLUESTONE<br>ELITE</div>
                    <div class="strategies__item__text">Our objective is to improve the risk-adjusted return of a traditional all-equity portfolio over the course of a full market cycle utilizing tactical asset…</div>
                    <div href="#" class="strategies__item__link" window-open="Bluestone Elite">more<span></span></div>
                </div>
                <div class="strategies__item">
                    <div class="strategies__item__title">BLUESTONE<br>INCOME</div>
                    <div class="strategies__item__text">Bluestone Income aims to deliver superior current income versus traditional equity income strategies with reduced volatility…</div>
                    <a href="#" class="strategies__item__link" window-open="Bluestone Income">more<span></span></a>
                </div>
                <div class="strategies__item">
                    <div class="strategies__item__title">ADAPTIVE ALPHA<br>OPPORTUNITIES</div>
                    <div class="strategies__item__text">Bluestone sub-advises this ETF (AGOX) which seeks capital appreciation through data-driven decision…</div>
                    <a href="#" class="strategies__item__link" window-open="Adaptive Investments">more<span></span></a>
                </div>
                <div class="strategies__item">
                    <div class="strategies__item__title">BLUESTONE<br>ADAPTIVE ALPHA</div>
                    <div class="strategies__item__text">The Bluestone Adaptive Alpha Strategy uses a data-driven investment approach seeking to maximize risk-adjusted returns for our investors. Our approach…</div>
                    <a href="#" class="strategies__item__link" window-open="Bluestone Adaptive Alpha">more<span></span></a>
                </div>
                <div class="strategies__item">
                    <div class="strategies__item__title">BLUESTONE<br>INCOME PLUS</div>
                    <div class="strategies__item__text">This strategy is designed to deliver a risk-adjusted yield while reducing volatility over a full market cycle. Bluestone Income Plus seeks to achieve…</div>
                    <a href="#" class="strategies__item__link" window-open="Bluestone Income Plus">more<span></span></a>
                </div>
                <div class="strategies__item">
                    <div class="strategies__item__title">POLARIS POINT,<br>LP</div>
                    <div class="strategies__item__text">Polaris Point is a global multi-strategy fund designed to deliver attractive risk-adjusted returns through a combination of long and short positions across global markets…</div>
                    <a href="#" class="strategies__item__link" window-open="Polaris Point">more<span></span></a>
                </div>
                <div class="strategies__item">
                    <div class="strategies__item__title">ALTERNATIVE<br>INVESTMENTS</div>
                    <div class="strategies__item__text">Providing opportunistic strategies in real estate, infrastructure, private equity, debt and other alternative asset classes…</div>
                    <a href="#" class="strategies__item__link" window-open="Alt Strategies">more<span></span></a>
                </div>
                <div class="strategies__item"></div>
                <div class="strategies__item"></div>
            </div>
        </div>
        <div class="line3">
            <img src="./img/line_3.png" alt="">
        </div>
        <div class="two-column wrapper connect-wrapper">
            <div class="two-column__columns">
                <div class="connect wrapper">
                    <div class="connect__title">
                        <div class="connect__title__filler"></div>
                    </div>
                    <div class="connect__description">
                        Sign up with your email address
                        to receive news and updates.
                    </div>
                    <form action="/" method="POST" class="connect__form" id="connect-form">
                        <input type="text" name="contact_firstname" placeholder="First Name">
                        <input type="text" name="contact_lastname" placeholder="Last Name">
                        <input type="text" name="contact_email" placeholder="Email">
                        <div class="g-recaptcha"
                        data-sitekey="<?=$reCaptchaPublicKey?>"></div> 
                        <div class="recaptcha-error"><?=$recaptcha_error?></div>
                        <div class="connect__form__submit">
                            <!-- <input type="submit" value="Submit"> -->
                            <!-- <input
                            class="g-recaptcha" 
                            data-sitekey="6LdsdSofAAAAAHq2_6tfHZXEdw0yeA_SHvKmy8tt" 
                            data-callback='onSubmit' 
                            data-action='submit'
                            type="submit" value="Submit"> -->
                            <input type="submit" value="Submit">
                        </div> 
                    </form>
                </div>
                <div style="width: 30%"></div>
                <!-- <div class="feedback"> -->
                    <!-- <div class="feedback__photo"></div>
                    <div class="feedback__name">
                        Daniel Kahneman
                    </div>
                    <div class="feedback__text">
                        He weights losses about twice as much as gains, which is normal.
                    </div> -->
                <!-- </div> -->
            </div>
        </div>
        <div class="wrapper bottom-logo">
            <img src="./img/logo.svg" alt="">
        </div>
        <div class="line4">
            <img src="./img/line_3.png" alt="">
        </div>
        <div class="bottom">
            <div class="bottom-photo">
                <img src="./img/bottom-photo.jpg" alt="">
            </div>
            <div class="wrapper">
                <div class="menu">
                    <div class="menu__item">
                        <div class="menu__item__title">home</div>
                    </div>
                    <div class="menu__item">
                        <div class="menu__item__title">alternatives</div>
                        <div class="menu__item__options">
                            <div class="menu__item__option" window-open="Polaris Point">Polaris Point</div>
                            <div class="menu__item__option" window-open="Alt Strategies">Alt Strategies</div>
                        </div>
                    </div>
                    <div class="menu__item">
                        <div class="menu__item__title">etfs</div>
                        <div class="menu__item__options">
                            <div class="menu__item__option" window-open="Adaptive Investments">Adaptive Investments</div>
                        </div>
                    </div>
                    <div class="menu__item">
                        <div class="menu__item__title">separate accounts</div>
                        <div class="menu__item__options">
                            <div class="menu__item__option" window-open="Bluestone Adaptive Alpha">Bluestone Adaptive Alpha</div>
                            <div class="menu__item__option" window-open="Bluestone Elite">Bluestone Elite</div>
                            <div class="menu__item__option" window-open="Bluestone Income">Bluestone Income</div>
                            <div class="menu__item__option" window-open="Bluestone Income Plus">Bluestone Income Plus</div>
                        </div>
                    </div>
                    <div class="menu__item">
                        <div class="menu__item__title">about us</div>
                        <div class="menu__item__options">
                            <div class="menu__item__option" window-open="Access Us">Access Us</div>
                            <div class="menu__item__option" window-open="Contact">Contact</div>
                        </div>
                    </div>
                </div>
                <div class="bottom-credentials">
                    (610) 337-6500 | <a href="mailto:info@bluestonecm.com">info@bluestonecm.com</a><br>
                    37 West Avenue | Suite 301 | Wayne PA 19087<br>
                    <a href="assets/Bstone+Privacy+Policy.pdf">Privacy Policy</a>&nbsp;
                    | <a href="assets/ADV+2021+BCM.pdf">ADV Brochure</a>
                    | <a href="assets/Business+Continuity+Disclosure.pdf">Business Continuity Disclosure</a>
                    | <a href="assets/Relationship+Summary+Form.pdf">Form CRS</a><br>
                </div>
                <div class="bottom-social">
                    <a href="https://www.linkedin.com/company/bluestone-capital-management/" class="bottom-social__in">
                        <img src="./img/in.png" alt="">
                    </a>
                </div>
                <div class="bottom-security">
                    Securities offered through MCG Securities, LLC Member FINRA/SIPC. Investment Advisory services offered through Bluestone Capital, LLC. Bluestone Capital Management, LLC, does not offer tax or legal advice. This site is published for residents of the United States only. Registered Representatives and Investment Advisor Representatives may only conduct business with residents of the states and jurisdictions in which they are properly registered. Therefore, a response to a request for information may be delayed. Not all products and services referenced on this site are available in every state and through every representative or advisor listed. For additional information, please contact our Compliance Department at (610) 337-6500.
                </div>
            </div>
        </div>
    </div>

<!--  -->

<div class="window service-window" window="Bluestone Elite">
    <div class="wrapper">
        <div class="window__wrapper">
            <div class="window__close"></div>
            <div class="window__title">
                BLUESTONE<br>ELITE
            </div>
            <div class="window__content">
                <div class="window__content__h1">OBJECTIVE</div>
                Improve the risk-adjusted return of a traditional all equity portfolio over the course of a full market cycle utilizing tactical asset management.

                <div class="window__content__h1">INVESTMENT STRATEGY</div>
                The strategy utilizes equities and equity index/ETF securities to capture opportunities across assets, countries and sectors. The adaptive nature of the strategy enables Bluestone Elite to also employ fixed income instruments for the purposes of capital preservation. We employ a top-down approach to identify sectors that we believe will produce strong or weak relative performance to the overall market and makes investments to capitalize on these market opinions. When we deem it appropriate to position the portfolio defensively, this strategy considers cash to be an asset class and will allocate a significant percentage to cash and cash equivalents.

                <div class="window__content__h1">PORTFOLIO MANAGERS</div>
                Brian C. Shevland
            </div>
            <a href="https://www.bluestonecm.com/s/Bluestone-Elite-Fact-Sheet-May-2021.pdf" class="window__link">FACT&nbsp;SHEET<span></span></a>
        </div>
    </div>
</div>

<!--  -->

<div class="window service-window" window="Bluestone Income">
    <div class="wrapper">
        <div class="window__wrapper">
            <div class="window__close"></div>
            <div class="window__title">
                BLUESTONE<br>INCOME
            </div>
            <div class="window__content">
                <div class="window__content__h1">OBJECTIVE</div>
                Deliver superior current income versus traditional equity income strategies with reduced volatility and lower levels of interest rate risk compared to a debt strategy.

                <div class="window__content__h1">INVESTMENT STRATEGY</div>
                This strategy is designed to deliver a superior risk-adjusted yield while reducing volatility over a full market cycle. The strategy seeks to achieve this objective by investing in a broad basket of yield-producing assets including common and preferred equities, exchange traded debt, and ETFs/ETNs. This diversity allows us to produce a higher yield than a more traditional income product while still providing volatility reduction through active asset allocation model-based decision making. The strategy does not invest in junk bonds or distressed debt securities.
                
                <div class="window__content__h1">PORTFOLIO MANAGERS</div>
                Lee A. Calfo & Andrew Giannone
            </div>
            <a href="https://www.bluestonecm.com/s/202011-Bluestone-Income-Fact-Sheet.pdf" class="window__link">FACT&nbsp;SHEET<span></span></a>
        </div>
    </div>
</div>

<!--  -->

<div class="window service-window" window="Adaptive Investments">
    <div class="wrapper">
        <div class="window__wrapper">
            <div class="window__close"></div>
            <div class="window__title">
                ADAPTIVE ALPHA OPPORTUNITIES ETF
            </div>
            <div class="window__content">
                <div class="window__content__h1">AGOX</div>
                Bluestone serves as portfolio manager and subadvisor to the Adaptive Alpha Opportunities ETF. The Adaptive Alpha Opportunities ETF (ticker symbol: <a href="https://www.morningstar.com/etfs/arcx/agox/portfolio">AGOX</a>) is an adaptive portfolio designed as an equity replacement strategy focused on improving the risk-adjusted performance for our investors over the course of a full market cycle. The Fund seeks total return and seeks to navigate changing market environments by blending a top-down macro framework with bottom-up fundamental insights. When it is appropriate to position the portfolio defensively, this strategy considers cash to be an asset class and may allocate a significant percentage to cash and cash equivalents. For further information please click <a href="https://adaptiveetfs.squarespace.com/agox">here</a>.
                <br><br>
                Investors should consider the investment objective, management fees, risks, charges and expenses of the Fund carefully before investing or sending money. The Prospectus and Summary Prospectus contains this and other information about the Fund. For a current Prospectus and/or Summary Prospectus, call 800-773-3863. Please read the Prospectus and/or Summary Prospectus carefully before you invest. Current and future holdings are subject to change and risk. 
                <br><br>
                An investment in the Adaptive Alpha Opportunities ETF is subject to investment risks, including the possible loss of some or all of the principal amount invested. There can be no assurance that the Fund will be successful in meeting its investment objective. Generally, the Fund will be subject to the following additional risks: Common Stock Risk: The Fund's investments in shares of common stock, both directly and indirectly, through the Fund's investment in shares of other investment companies, may fluctuate in value response to many factors. Such price fluctuations subject the Fund to potential losses. Control of Portfolio Funds Risk: There is not guarantee that the Portfolio Funds will achieve their investment objectives and the Fund has exposure to the investment risks of the Portfolio Funds. While the shares of the Fund are tradable on secondary markets, they may not readily trade in all market conditions and may trade at significant discounts in periods of market stress. ETFs trade like stocks, are subject to investment risks, fluctuate in market value and may trade at prices above or below the ETFs net asset value. Brokerage commissions and ETF expenses will reduce returns. More information about these risks can be found in the Fund's prospectus.
                <br><br>
                The Adaptive Alpha Opportunities ETF is distributed by Capital Investment Group, Inc., Member FINRA/SIPC, 100 E Six Forks Road, Suite 200, Raleigh, NC 27609. There is no affiliation between Adaptive Investments, the investment advisor to the Fund, Bluestone Capital Management, LLC, the investment sub-advisor to the Fund, and Capital Investment Group, Inc.
                <br><br>
            </div>
            <a href="http://brokercheck.finra.org/" class="window__link">View firm's background on FINRA's BrokerCheck<span></span></a>
            <br><br>
            <b>RCADP1121003</b>
        </div>
    </div>
</div>

<!--  -->

<div class="window service-window" window="Bluestone Adaptive Alpha">
    <div class="wrapper">
        <div class="window__wrapper">
            <div class="window__close"></div>
            <div class="window__title">
                BLUESTONE<br>ADAPTIVE ALPHA STRATEGY
            </div>
            <div class="window__content">
                <div class="window__content__h1">DESCRIPTION</div>
                
                Adaptive Alpha is a long equity portfolio that is designed to systematically generate alpha. 
                
                <div class="window__content__h1">INVESTMENT PHILOSOPHY</div>
                At Bluestone, we believe market participants are fundamentally irrational, and this irrationality can be identified and exploited. Through an understanding and application of the Nobel Prize winning Prospect Theory of behavioral finance, our research process seeks to capitalize on the opportunities created by these behavioral biases.
                
                <div class="window__content__h1">INVESTMENT PROCESS</div>
                Our process is based on applications of Prospect Theory and is generalized to create an adaptive process and portfolio construction engine that evolves based on the changing behaviors of market participants. Bluestone deploys both Top-Down and Bottom-Up frameworks to inform investment decision making. Both frameworks are guided by the key components of behavioral finance. 
                
                <div class="window__content__h1">PORTFOLIO MANAGERS</div>
                Brian C. Shevland
                <br><br>
            </div>
            <a href="https://www.bluestonecm.com/s/Bluestone-Adaptive-Alpha-Factsheet-MAR-2021.pdf" class="window__link">FACT&nbsp;SHEET<span></span></a>
        </div>
    </div>
</div>

<!--  -->

<div class="window service-window" window="Bluestone Income Plus">
    <div class="wrapper">
        <div class="window__wrapper">
            <div class="window__close"></div>
            <div class="window__title">
                BLUESTONE<br>INCOME PLUS
            </div>
            <div class="window__content">
                <div class="window__content__h1">OBJECTIVE</div>
                Deliver superior current income versus traditional equity income strategies with reduced volatility and lower levels of interest rate risk compared to a traditional debt strategy.

                <div class="window__content__h1">INVESTMENT STRATEGY</div>
                This hybrid strategy is designed to deliver a superior risk-adjusted yield while reducing volatility over a full market cycle. The strategy seeks to achieve this objective by investing in a broad basket of yield-producing assets including common and preferred equities, exchange traded debt, and ETFs/ETNs. This strategy also uses covered call option writing to generate additional income by capitalizing on volatility in the underlying securities. Income Plus seeks a significantly higher yield than a more traditional income product while still providing volatility reduction through active asset allocation model-based decision making. 
                
                <div class="window__content__h1">PORTFOLIO MANAGERS</div>
                Lee A. Calfo & Andrew Giannone
            </div>
            <a href="https://www.bluestonecm.com/s/202011-Bluestone-Income-Fact-Sheet.pdf" class="window__link">FACT&nbsp;SHEET<span></span></a>
        </div>
    </div>
</div>

<!-- -->

<div class="window service-window" window="Polaris Point">
    <div class="wrapper">
        <div class="window__wrapper">
            <div class="window__close"></div>
            <div class="window__title">
                POLARIS POINT, LP
            </div>
            <div class="window__content">
                <div class="window__content__h1">Global Multi-Strategy</div>
                Polaris Point LP is an adaptive, quantitative investment vehicle seeking to provide superior returns while navigating changing market regimes. The strategy blends top-down macroeconomic models to generate Market Regime Indicators (MRIs) and bottom-up asset selection models to identify investment opportunities. Launched in January 2020, the fund is focused on delivering absolute risk-adjusted returns. For more information contact us at <a href="mailto:info@bluestonecm.com">info@bluestonecm.com</a>.
                
                <div class="window__content__h1">PORTFOLIO MANAGERS</div>
                Brian C. Shevland
            </div>
            <a href="/s/Polaris-Point-LP-Fact-Sheet-202107.pdf" class="window__link">FACT&nbsp;SHEET<span></span></a>
        </div>
    </div>
</div>

<!--  -->

<div class="window service-window" window="Alt Strategies">
    <div class="wrapper">
        <div class="window__wrapper">
            <div class="window__close"></div>
            <div class="window__title">
                ALTLERNATIVE<br>INVESTMENTS
            </div>
            <div class="window__content">
                <div class="window__content__h1">OBJECTIVE</div>
                Identify and maximize opportunities using alternative strategies to improve risk adjusted returns, generate income, provide diversification from traditional investments, and grow investment portfolios. 
                <div class="window__content__h1">INVESTMENT STRATEGY</div>
                Utilizing the background and experience of Bluestone team members we bring expertise to alternative investment options and broad access to capital and market data.  We look beyond public markets and traditional investments to find solutions in real estate, infrastructure, private equity, credit, hedge funds and other alternative asset classes. 
                <br><br>
                We focus on improving downside protection by creating low exposure alternative strategies, whether restructuring, acquiring, or operating. When resolving complex transactions creating, multiple options is key to successful outcomes.  We create winning strategies for our clients by providing clear paths to success underpinned with efficient execution and strategic decision making.  
                <br><br>
                We bring deep analytical and executional experience in complex transaction resolution, deal structuring and negotiations, fund raising, and operational oversight for debt and equity participants.
                <br><br>
                Through many years of deal generation, opportunity structuring, navigating operational challenges, and focusing on execution, our team members have cultivated strong relationships in both the public and private sector.  This allows us to navigate challenging environments while bringing the right resources to execute in all situations.
                <br><br>
                We specialize in infrastructure, debt opportunities and real assets taking an opportunist view across all sectors.
            </div>
        </div>
    </div>
</div>


<!--  -->


<div class="window<?=$sent?' open':''?>">
    <div class="wrapper">
        <div class="window__wrapper">
            <div class="window__close"></div>
            <div class="window__title">
                Thank you for contacting us.
            </div>
        </div>
    </div>
</div>

<!--  -->


<div class="window<?=($recaptcha_error != '')?' open':''?>">
    <div class="wrapper">
        <div class="window__wrapper">
            <div class="window__close"></div>
            <div class="window__title">
                Please, confirm that you are not a robot.
            </div>
        </div>
    </div>
</div>


<!--  -->


    <div class="window service-window" window="Access Us">
        <div class="wrapper">
            <div class="window__wrapper">
                <div class="window__close"></div>
                <div class="window__title">
                    WHERE TO ACCESS US
                </div>
                <div class="window__content">
                    <div class="window__content__h1">PLATFORMS</div>
                    <div class="access_us">
                        <img src="./img/logos/l1.png" alt=""> 
                        <img src="./img/logos/l2.png" alt=""> 
                        <img src="./img/logos/l3.png" alt=""> 
                        <img src="./img/logos/l4.png" alt=""> 
                        <img src="./img/logos/l5.png" alt=""> 
                        <img src="./img/logos/l6.png" alt=""> 
                        <img src="./img/logos/l7.png" alt=""> 
                        <img src="./img/logos/l8.png" alt=""> 
                        <img src="./img/logos/l9.png" alt=""> 
                        <img src="./img/logos/l10.png" alt=""> 
                        <img src="./img/logos/l11.png" alt=""> 
                        <img src="./img/logos/l12.png" alt=""> 
                    </div>
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </div>

    <!--  -->

    <div class="window service-window" window="Contact">
        <div class="wrapper">
            <div class="window__wrapper">
                <div class="window__close"></div>
                <div class="window__title">
                    CONTACT US
                </div>
                <div class="window__content__h1">Let's chat!</div>
                If you would like more information on a particular Bluestone product, please contact us below:
                <div class="window__content contact">
                    <div class="contact__left">
                        <form action="" method="POST" class="contact__form" id="popup-contact-form">
                            <input type="text" minlength="2" name="contact_firstname" placeholder="First Name">
                            <input type="text" minlength="2" name="contact_lastname" placeholder="Last Name">
                            <input type="email" name="contact_email" placeholder="Email">
                            <input name="contact_phone" placeholder="Phone">
                            <textarea name="contact_message" placeholder="Message"></textarea>
                            <div class="g-recaptcha"
                            data-sitekey="<?=$reCaptchaPublicKey?>"></div> 
                            <div class="recaptcha-error"><?=$recaptcha_error?></div>
                            <input  class="contact__form__submit" type="submit" value="Submit">
                        </form>
                    </div>
                    <div class="contact__right">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d763.5813270818275!2d-75.38972017078382!3d40.045840698713114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c694df73664f49%3A0x378e8b7ab0c529c2!2zMzcgV2VzdCBBdmUsIFdheW5lLCBQQSAxOTA4Nywg0KHQqNCQ!5e0!3m2!1sru!2sru!4v1643716722363!5m2!1sen!2sen" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        <br><br>37 West Avenue, Suite 301 Wayne, PA 19087
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>

    <!--  -->
    
</body>
</html>