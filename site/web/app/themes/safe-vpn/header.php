<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/layout.css">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">


		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
      <div class="header">
        <div class="row">
          <div class="columns">
            <a class="header__logo" href="/">
              <img src="https://static.safevpn.com/img//layout/_safevpn/news/logo.png?build-8.88">
            </a>
            <span class="header__slogan">
      Security News
    </span>
            <div class="header__links-container">
              <a class="header__button" href="https://secure.safevpn.com/">Get SafeVPN</a>
              <a class="header__button header--login-button mr-1" href="/">Login</a>
            </div>
            <div news-mobile-menu="" data-action="click:toggleMenu" class="header__burger" id="component2"
                 ss-component="true">
              <span class="one"></span>
              <span class="two"></span>
              <span class="three"></span>
            </div>

            <div news-mobile-menu-dropdown="" class="header__mobile-nav">
              <a class="header__mobile-nav-link" href="https://secure.safevpn.com/">Get SafeVPN</a>
              <a class="header__mobile-nav-link" href="https://www.safevpn.com/#login">Login</a>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function () {
          $("[news-mobile-menu]").on("click", () => {
            $("[news-mobile-menu-dropdown]").toggleClass("header__mobile-nav--show")
          })
        });
      </script>
			<!-- /header -->
