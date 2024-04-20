<?php include_once 'helpers/helper.php'; ?>
<?php require 'sub-views/header.php'; ?>
<?php require 'helpers/init_conn_db.php'; ?>
<style>
    footer {
        /* position: absolute; */
        bottom: 0;
        width: 100%;
        height: 2.5rem;
        /* Footer height */
    }

    form.logout_form {
        background: transparent;
        padding: 10px !important;
    }

    body {
        /* background:url('assets/images/bg2.jpg') no-repeat 0px 0px;
	background-size: cover;
	font-family: 'Open Sans', sans-serif;
	background-attachment: fixed;
    background-position: center; */
        /* background: #bdc3c7;  fallback for old browsers */
        /* background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7); Chrome 10-25, Safari 5.1-6 */
        /* background: linear-gradient(to right, #2c3e50, #bdc3c7);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        background-color: #EBF9FF;
        height: 100%;
        width: 100%;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: Poppins;
    }

    h5.text-light {
        margin-top: 10px;
    }

    @font-face {
        font-family: 'product sans';
        src: url('assets/css/Product Sans Bold.ttf');
    }

    h1 {
        font-family: 'product sans' !important;
        color: cornflowerblue;
        font-size: 50px;
        margin-top: 50px;
        text-align: center;
    }

    .main-agileinfo {
        margin: 50px auto;
        width: 50%;
    }

    /*--SAP--*/
    .sap_tabs {
        clear: both;
        padding: 0;
    }

    .tab_box {
        background: #fd926d;
        padding: 2em;
    }

    .top1 {
        margin-top: 2%;
    }

    .resp-tabs-list {
        list-style: none;
        padding: 15px 0px;
        margin: 0 auto;
        text-align: center;
        /* background: rgb(33, 150, 243); */
        background: rgb(78 103 114);
    }

    .resp-tab-item {
        font-size: 1.1em;
        font-weight: 500;
        cursor: pointer;
        display: inline-block;
        margin: 0;
        text-align: center;
        list-style: none;
        outline: none;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        -ms-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
        text-transform: uppercase;
        margin: 0 1.2em 0;
        color: #b1b1b1;
        padding: 7px 15px;
    }

    .resp-tab-active {
        color: #fff;
    }

    .resp-tabs-container {
        padding: 0px;
        clear: left;
    }

    h2.resp-accordion {
        cursor: pointer;
        padding: 5px;
        display: none;
    }

    .resp-tab-content {
        display: none;
    }

    .resp-content-active,
    .resp-accordion-active {
        display: block;
    }

    /* form {
    background:rgba(3, 3, 3, 0.57);
    padding: 25px 5px 50px 25px;
} */

    h3 {
        font-size: 16px;
        color: rgb(255, 255, 255);
        margin-bottom: 7px;
    }

    .from,
    .to,
    .date,
    .depart,
    .return {
        width: 48%;
        float: left;
    }

    .from,
    .to,
    .date {
        margin-bottom: 40px;
    }

    .from,
    .date,
    .depart {
        margin-right: 4%;
    }

    input[type="text"] {
        padding: 10px;
        width: 93%;
        float: left;
    }

    input#datepicker,
    input#datepicker1,
    input#datepicker2,
    input#datepicker3 {
        width: 85%;
        margin-bottom: 10px;
    }

    select#w3_country1 {
        padding: 10px;
        float: left;
    }

    label.checkbox {
        display: inline-block;
    }

    .checkbox {
        position: relative;
        font-size: 0.95em;
        font-weight: normal;
        color: #dedede;
        padding: 0em 0.5em 0em 2em;
    }

    .checkbox i {
        position: absolute;
        bottom: 1px;
        left: 2px;
        display: block;
        width: 18px;
        height: 18px;
        outline: none;
        background: #fff;
        border: 1px solid #6A67CE;
    }

    .checkbox i {
        font-size: 20px;
        font-weight: 400;
        color: #999;
        font-style: normal;
    }

    .checkbox input:checked+i:after {
        opacity: 1;
    }

    .checkbox input+i:after {
        position: absolute;
        opacity: 0;
        transition: opacity 0.1s;
        -o-transition: opacity 0.1s;
        -ms-transition: opacity 0.1s;
        -moz-transition: opacity 0.1s;
        -webkit-transition: opacity 0.1s;
    }

    .checkbox input+i:after {
        content: '';
        background: url("assets/images/tick.png") no-repeat 5px 5px;
        top: -1px;
        left: -1px;
        width: 15px;
        height: 15px;
        font: normal 12px/16px FontAwesome;
        text-align: center;
    }

    input[type="checkbox"] {
        opacity: 0;
        margin: 0;
        display: none;
    }

    .quantity-select .entry.value-minus {
        margin-left: 0;
    }

    .value-minus,
    .value-plus {
        height: 40px;
        line-height: 24px;
        width: 40px;
        margin-right: 3px;
        display: inline-block;
        cursor: pointer;
        position: relative;
        font-size: 18px;
        color: #fff;
        text-align: center;
        -webkit-user-select: none;
        -moz-user-select: none;
        border: 1px solid #b2b2b2;
        vertical-align: bottom;
    }

    .value {
        cursor: default;
        width: 40px;
        height: 33px;
        color: #000;
        line-height: 24px;
        border: 1px solid #E5E5E5;
        background-color: #fff;
        text-align: center;
        display: inline-block;
        margin-right: 3px;
        padding-top: 7px;
    }

    .quantity-select .entry.value-minus:hover,
    .quantity-select .entry.value-plus:hover {
        background: rgba(0, 0, 0, 0.6);
        ;
    }

    .value-minus,
    .value-plus {
        height: 40px;
        line-height: 24px;
        width: 40px;
        margin-right: 3px;
        display: inline-block;
        cursor: pointer;
        position: relative;
        font-size: 18px;
        text-align: center;
        -webkit-user-select: none;
        -moz-user-select: none;
        border: 1px solid #b2b2b2;
        vertical-align: bottom;
    }

    .quantity-select .entry.value-minus:before,
    .quantity-select .entry.value-plus:before {
        content: "";
        width: 13px;
        height: 2px;
        background: #fff;
        left: 50%;
        margin-left: -7px;
        top: 50%;
        margin-top: -0.5px;
        position: absolute;
    }

    .quantity-select .entry.value-plus:after {
        content: "";
        height: 13px;
        width: 2px;
        background: #fff;
        left: 50%;
        margin-left: -1.4px;
        top: 50%;
        margin-top: -6.2px;
        position: absolute;
    }

    .numofppl,
    .adults,
    .child {
        width: 50%;
        float: left;
    }

    .class {
        width: 48%;
        float: left;
    }

    input[type="submit"] {
        font-size: 18px;
        color: #fff;
        background: #4caf50;
        border: none;
        outline: none;
        padding: 10px 20px;
        margin-top: 50px;
        cursor: pointer;
        transition: 0.5s all ease;
        -webkit-transition: 0.5s all ease;
        -moz-transition: 0.5s all ease;
        -o-transition: 0.5s all ease;
        -ms-transition: 0.5s all ease;
    }

    input[type="submit"]:hover {
        background: #212121;
        color: #fff;
    }

    /*-- load-more --*/
    ul#myList {
        margin-bottom: 2em;
    }

    #myList li {
        display: none;
        list-style-type: none;
    }

    #loadMore,
    #showLess {
        display: inline-block;
        cursor: pointer;
        padding: 7px 20px;
        background: #fff;
        font-size: 14px;
        color: #fff;
        transition: 0.5s all ease;
        -webkit-transition: 0.5s all ease;
        -moz-transition: 0.5s all ease;
        -o-transition: 0.5s all ease;
        -ms-transition: 0.5s all ease;
        background: rgb(33, 150, 243);
    }

    #loadMore:hover {
        background: #212121;
        color: #fff;
    }

    .spcl {
        position: relative;
    }

    .ui-datepicker {
        width: 16.2%;
        padding: 0 0em 0;
    }

    .ui-datepicker .ui-datepicker-header {
        position: relative;
        padding: .56em 0;
        background: rgb(33, 150, 243);
        ;
        text-transform: uppercase;
    }

    form.blackbg {
        background: rgba(3, 3, 3, 0.57);
    }

    /*-- //load-more --*/
    .footer-w3l {
        margin: 50px 0 15px 0;
    }

    .footer-w3l p {
        font-size: 14px;
        text-align: center;
        color: #000;
        line-height: 27px;
    }

    .footer-w3l p a {
        color: #000;
    }

    .footer-w3l p a:hover {
        text-decoration: underline;
    }

    /*-- responsive --*/
    @media (max-width:1440px) {
        .checkbox {
            font-size: 0.9em;
        }
    }

    @media (max-width:1366px) {
        .main-agileinfo {
            width: 53%;
        }
    }

    @media (max-width:1280px) {
        .main-agileinfo {
            width: 57%;
        }
    }

    @media (max-width:1080px) {
        h1 {
            color: #fff;
            font-size: 47px;
        }

        .main-agileinfo {
            width: 68%;
        }
    }


    @media (max-width:375px) {
        h1 {
            font-size: 32px;
        }

        h3 {
            font-size: 15px;
        }

        .from,
        .to,
        .date,
        .depart,
        .return {
            width: 100%;
            float: left;
            margin-bottom: 25px;
        }

        .date {
            margin-bottom: 0;
        }

        .resp-tab-item {
            padding: 7px 7px;
            margin: 0 0em 0;
            font-size: 15px;
        }

        .class {
            width: 100%;
            float: left;
            margin-bottom: 40px;
        }

        input[type="text"] {
            padding: 10px;
            width: 91.5%;
        }

        input#datepicker,
        input#datepicker1,
        input#datepicker2,
        input#datepicker3 {
            width: 91.5%;
        }
    }

    /* 
@font-face {
  font-family: 'product sans';
  src: url('assets/css/Product Sans Bold.ttf');
} */
    h1 {
        font-family: 'product sans';
        /* font-style: italic; */
        font-size: 40px !important;
    }
</style>

<style>
    .intro {
        width: 100%;
        background: #fff;
        z-index: 1
    }

    .intro_background {
        top: -128px;
        left: 0;
        width: 100%;
        height: 20px;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center
    }

    .intro_container {
        width: 100%;
        border-bottom: solid 2px #e4e6e8;
        padding-top: 100px;
        padding-bottom: 100px
    }

    .intro_icon {
        width: 70px;
        height: 71px
    }

    .intro_icon img {
        max-width: 100%
    }

    .intro_content {
        padding-left: 28px
    }

    .intro_title {
        font-family: 'Oswald', sans-serif;
        font-size: 18px;
        color: #343b41;
        font-weight: bold;
    }

    .destinations {
        width: 100%;
        background: #fff;
        padding-top: 115px;
        padding-bottom: 116px
    }

    div.card {
        -webkit-transition: 0.4s ease;
        transition: 0.4s ease;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .col-lg-6:hover div.card {
        -webkit-transform: scale(1.08);
        transform: scale(0.89);
    }

    /* .card {
  width: 100%;
  height:200px;
  border-top-left-radius:2px;
  border-top-right-radius:2px;
  display:block;
    overflow: hidden;
} */
    .card img {
        width: 100%;
        height: 370px;
        object-fit: cover;
        transition: all .25s ease;
    }

    .title-landingpage-main {
        padding-top: 120px;
        padding-left: 15px;
        font-size: 3.2em;
        margin: 0;
        font-family: Poppins;
        color: #343b41;
        font-weight: bold;
    }



    .body-landingpage {
        font-size: 1.05em;
        padding-left: 15px;
        font-family: Poppins;
        position: relative;
    }

    .title-brand {
        font-size: 1em;
        padding-left: 15px;
        font-family: Poppins;
        position: relative;
    }

    .landing-pic {
        padding-left: 55%;
        position: absolute;
        width: 76rem;

    }

    @media (max-width:1024px) {
        .main-agileinfo {
            width: 71%;
        }

        .landing-pic {

            width: 63rem;
        }

        /* Position the title, body, and brand below the picture */
        .title-landingpage-main {
            font-size: 2.5em;
        }

        .body-landingpage {
            font-size: .95em;
        }

        .title-brand {
            font-size: .90em;
        }
    }
</style>
<div class="container-fluid">
    <div> <img src="assets/images/landingpage-main-pic.png" alt="landing-pic" class="landing-pic"></div>
    <!-- <div class="bglandscape" style="background-image: url('assets/images/landing.page1.png'); height: 38em; width: 78em"> -->
    <div class="title-landingpage-main"><strong>Don't just dream it, live it</strong></div><br>
    <div class="body-landingpage"> Life is meant to be lived to the fullest. Experience new cultures, <br> discover hidden wonders, and create memories that will last a lifetime.</div>

    <br>
    <div class="title-brand">Book your flight and start your adventure with us!</div><br>


</div>
</div>


<div class="container-fluid p-4" style="background-color: #88B8CD; margin: 15% 0 1% 0; position:relative">

    <!-- Intro -->
    <div class="intro">
        <div class="intro_background" style="background-image:url(images/intro.png)"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="intro_container">
                        <div class="row">
                            <!-- Intro Item -->
                            <div class="col-lg-4  intro_col">
                                <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                                    <div class="intro_icon"><img src="assets/images/beach.svg" alt=""></div>
                                    <div class="intro_content">
                                        <div class="intro_title">Top Destinations</div>
                                        <div class="intro_subtitle">
                                            <p>What's on your travel bucket list?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Intro Item -->
                            <div class="col-lg-4 intro_col">
                                <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                                    <div class="intro_icon"><img src="assets/images/wallet.svg" alt=""></div>
                                    <div class="intro_content">
                                        <div class="intro_title">The Best Prices</div>
                                        <div class="intro_subtitle">
                                            <p>Visit your favourite places at a reasonable price</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Intro Item -->
                            <div class="col-lg-4 intro_col">
                                <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                                    <div class="intro_icon"><img src="assets/images/suitcase.svg" alt=""></div>
                                    <div class="intro_content">
                                        <div class="intro_title">Amazing Services</div>
                                        <div class="intro_subtitle">
                                            <p>Great interactions begin with knowing your customers wants and needs.</p>
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
    <!-- <div class="conatiner-fluid p-4" style="background-color: whitesmoke;margin-top:150px;"> -->

</div>

<div class="promo">

            <div class="promo-image" style="margin: 0 1rem">
                <img src="assets/images/landing.promo.final.png" alt="promo" width="100%">
            </div>

</div>

<footer class="mt-4">
    <div style="background-color: #343b41;">

        <h6 class="text-light text-center" style="padding: .3em 0 0 0"><img src="assets/images/footer.logo.png" height="30px" width="30px" alt=""><strong>Faire un</strong> <span class="text-light" style="
        font-weight: 400;
        font-size: 20px;
        font-family: Poppins;
        padding: 0;
        margin: 0;">Voyage</span></h6>

        <div class="text-light text-center" style="padding: 0 0 .3em 0">&copy; <?php echo date('Y') ?></div>
    </div>
</footer>

<?php subview('footer.php'); ?>

<script src="assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default',
            width: 'auto',
            fit: true
        });
    });
</script>
<script>
    $('.value-plus').on('click', function() {
        var divUpd = $(this).parent().find('.value'),
            newVal = parseInt(divUpd.text(), 10) + 1;
        divUpd.text(newVal);
        $('.input_val').val(newVal);
    });

    $('.value-minus').on('click', function() {
        var divUpd = $(this).parent().find('.value'),
            newVal = parseInt(divUpd.text(), 10) - 1;
        if (newVal >= 1) {
            divUpd.text(newVal);
            $('.input_val').val(newVal);
        }
    });
</script>
<!--//quantity-->
<!--load more-->
<script>
    $(document).ready(function() {
        size_li = $("#myList li").size();
        x = 1;
        $('#myList li:lt(' + x + ')').show();
        $('#loadMore').click(function() {
            x = (x + 1 <= size_li) ? x + 1 : size_li;
            $('#myList li:lt(' + x + ')').show();
        });
        $('#showLess').click(function() {
            x = (x - 1 < 0) ? 1 : x - 1;
            $('#myList li').not(':lt(' + x + ')').hide();
        });
    });
</script>