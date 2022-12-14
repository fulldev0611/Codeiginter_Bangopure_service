<!DOCTYPE html>
<html>
    <?php
    $this->website_name = 'TazzerGroup';
    $this->website_logo_front = 'assets/img/'.TEMPLATE_THEME.'/logo_slogan.png?v1.01';
    $this->website_logo_footer = 'assets/img/'.TEMPLATE_THEME.'/logo_slogan_footer.png';
    if ($website_logo_front) {
        $this->website_logo_front = $website_logo_front;
    }
    if ($website_logo_footer) {
        $this->website_logo_footer = $website_logo_footer;
    }
    $fav = base_url() . 'assets/img/favicon.png';

    if (array_key_exists('favicon', $settings)) {
        $favicon = $settings['favicon'];
    }

    $this->meta_title = "TazzerGroup";
    if(array_key_exists('meta_description', $settings)){
        $this->meta_description =  $settings['meta_description'];
    }
    if(array_key_exists('meta_keywords', $settings)){
        $this->meta_keywords =  $settings['meta_keywords'];
    }

    if (!empty($favicon)) {
        $fav = base_url() . 'uploads/logo/' . $favicon;
    }
    $lang = (!empty($this->session->userdata('lang'))) ? $this->session->userdata('lang') : 'en';

    $this->stripeKeys = stripeKeys();

    # upgraded by maksimU for white list labeled site
    if($tazzer_whitelabeled)
    {
        $this->website_logo_front = 'assets/' . $tazzer_logoimage;
        $this->website_name = $tazzer_brandname;
        $this->meta_title = $tazzer_brandname;
        $fav = base_url() . 'assets/' . $tazzer_favicon .'?v1.0';
    }
    # maksimU end

      ?>

    <head>
        <!-- added by maksimU for Test. Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-203998874-1">
        </script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-203998874-1');
        </script>
        <!-- maksimU end -->

        <script type="text/javascript">
        (function() {
        window.__insp = window.__insp || [];
        __insp.push(['wid', 1819856247]);
        var ldinsp = function(){
        if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js?wid=1819856247&r=' + Math.floor(new Date().getTime()/3600000); var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
        setTimeout(ldinsp, 0);
        })();
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $this->meta_title;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $this->meta_description; ?>">
        <meta name="keywords" content="<?php echo $this->meta_keywords; ?>">
        
        <meta name="robots" content="<?php echo $this->meta_robots; ?>" />
        <meta name="googlebot" content="<?php echo $this->meta_googlebot; ?>" />
        <meta http-equiv="content-language" content="<?php echo $this->meta_language; ?>">
        
        <META NAME="geo.position" CONTENT="<?php echo $this->meta_geo_position; ?>">
        <META NAME="geo.placename" CONTENT="<?php echo $this->meta_geo_placename; ?>">
        <META NAME="geo.region" CONTENT="<?php echo $this->meta_geo_region; ?>">
        
        <!--for fb-->
        <meta property="og:url" content="<?php echo $this->fb_og_url; ?>" />
        <meta property="og:type" content="<?php echo $this->fb_og_type; ?>" />
        <meta property="og:title" content="<?php echo $this->fb_og_title; ?>" />
        <meta property="og:description" content="<?php echo $this->fb_og_description; ?>" />
        <meta property="og:image" content="<?php echo $this->fb_og_img; ?>" />
        
        <!--for Google + -->
        <meta property="og:url" content="<?php echo $this->google_og_url; ?>" />
        <meta property="og:type" content="<?php echo $this->google_og_type; ?>" />
        <meta property="og:title" content="<?php echo $this->google_og_title; ?>" />
        <meta property="og:description" content="<?php echo $this->google_og_description; ?>" />
        <meta property="og:image" content="<?php echo $this->google_og_img; ?>" />
        
        <!--for Twitter -->
        <meta property="og:url" content="<?php echo $this->twitter_og_url; ?>" />
        <meta property="og:type" content="<?php echo $this->twitter_og_type; ?>" />
        <meta property="og:title" content="<?php echo $this->twitter_og_title; ?>" />
        <meta property="og:description" content="<?php echo $this->twitter_og_description; ?>" />
        <meta property="og:image" content="<?php echo $this->twitter_og_img; ?>" />

        <meta name="author" content="Tazzerclean">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $fav; ?>">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/datatables.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cropper.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/avatar.css">
        <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/owlcarousel/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/owlcarousel/owl.theme.default.min.css"> -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.theme.default.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/common.css">
        
        <!-- Leo: add ImgUploader-->
        <link rel="stylesheet" href="<?=base_url()?>assets/plugins/ImgUploader/croppie.css">

        <!-- ========================= update maksimU ============================== -->
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/select2.min.css">
        <!-- ========================= #end maksimU ================================ -->

        <?php // if ($module == 'home' || $module == 'services') { ?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.css">
        <?php // } ?>

        <?php if ($module == 'service') { ?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tagsinput.css">
        <?php } ?>    

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toaster/toastr.min.css">

        <link rel="stylesheet" href="<?=base_url()?>assets/css/<?=TEMPLATE_THEME?>/style.css?v1.22">
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/slick/css/slick.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/slick/css/slick-theme.css?v1.4">
        
        <script src="<?php echo $base_url; ?>assets/plugins/jquery/jquery-3.6.0.min.js"></script>

        <!-- for home banner slide show -->
        <script src="<?php echo $base_url; ?>assets/js/tt_slideshow.js?v1.0"></script>

        <script src="<?php echo $base_url; ?>assets/js/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $base_url; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrapValidator.min.js"></script>
        <script src="<?php echo $base_url; ?>assets/plugins/slick/js/slick.min.js"></script>

        <script src="<?php echo $base_url; ?>assets/js/ckeditor/ckeditor.js"></script>

        <script src="<?php echo $base_url; ?>assets/js/index_old_tazzer.js?v1.0"></script>
        
        <!-- <script src="https://checkout.stripe.com/checkout.js"></script> -->
        <script src="https://js.stripe.com/v3/"></script>

        <script type="text/javascript">
            var base_url = "<?php echo base_url();?>";
            var stripe = Stripe("<?php echo $this->stripeKeys['pub_key']; ?>");
        </script>
    </head>

<script src="<?php echo $base_url; ?>assets/js/embed.tawk.js?v1.02"></script>

<body>
    <div id="coverScreen"  class="LockOn"></div>