<?php
/**
 * Header file for the Minimal Photography WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Minimal Photography
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if( function_exists('wp_body_open') ){
    wp_body_open();
} ?>


<div class="preloader hide-no-js <?php if( isset( $_COOKIE['MinimalPhotographyNightDayMode'] ) && $_COOKIE['MinimalPhotographyNightDayMode'] == 'true' ){ echo 'preloader-night-mode'; } ?>">
    <div class="preloader-wrapper">
        <div class="loader">
            <span></span><span></span><span></span><span></span><span></span>
        </div>
    </div>
</div>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#site-contentarea"><?php esc_html_e('Skip to the content', 'minimal-photography'); ?></a>

    <div id="content" class="site-content">