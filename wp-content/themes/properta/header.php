<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class( ( ! is_front_page() ) ? 'has-breadcrumb' : '' ); ?>>

<div class="page-wrapper">
    <div class="header">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="header-block clearfix">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-menu" aria-expanded="false">
                            <span class="sr-only"><?php echo __( 'Toggle navigation', 'properta' ); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php if ( get_theme_mod( 'properta_general_logo' ) ) : ?>
                                <img src="<?php echo get_theme_mod( 'properta_general_logo' ); ?>" alt="<?php echo __( 'Home', 'properta' ); ?>">
                            <?php endif; ?>
                            <div class="navbar-title"><?php bloginfo( 'name' ); ?></div>
                        </a>

                        <p class="navbar-text"><?php bloginfo( 'description' ); ?></p>

                        <?php if (is_user_logged_in()) : ?>
                            <?php $menu = wp_nav_menu( array(
                                'theme_location' => 'authenticated',
                                'menu_class' => 'header-bar-nav nav navbar-right navbar-nav collapse navbar-collapse',
                                'fallback_cb' => false,
                                'echo' => false,
                            ) ); ?>

                            <?php if ( substr_count( $menu, 'class="menu-item' ) > 0 ) : ?>
                                <?php echo $menu; ?>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php $menu = wp_nav_menu( array(
                                'theme_location' => 'anonymous',
                                'menu_class' => 'header-bar-nav nav navbar-right navbar-nav collapse navbar-collapse',
                                'fallback_cb' => false,
                                'echo' => false,
                            ) ); ?>

                            <?php if ( substr_count( $menu, 'class="menu-item' ) > 0 ) : ?>
                                <?php echo $menu; ?>
                            <?php endif ?>
                        <?php endif; ?>
                    </div><!-- /.navbar-header -->

                    <div class="navigation">
                        <?php $menu = wp_nav_menu( array(
                            'menu_class'        => 'nav navbar-nav collapse navbar-collapse',
                            'walker'            => new Properta_Menu_Walker(),
                            'theme_location'    => 'primary',
                            'menu_id'           => 'primary-menu',
                            'fallback_cb' 		=> false,
                            'echo'              => false,
                        ) ); ?>

                        <?php if ( substr_count( $menu, 'class="menu-item' ) > 0 ) : ?>
                            <?php echo $menu; ?>
                        <?php endif ?>


                        <div class="header-action">
                            <?php $action_text = get_theme_mod( 'properta_general_action_text' ); ?>
                            <?php if ( ! empty ( $action_text ) ) : ?>
                                <a href="<?php echo get_the_permalink( get_theme_mod( 'properta_general_action' ) ); ?>" class="ribbon-text"><?php echo $action_text; ?></a>
                            <?php endif; ?>

                            <?php $action_icon = get_theme_mod( 'properta_general_action_icon' ); ?>
                            <?php if ( ! empty ( $action_icon ) ) : ?>
                                <a href="<?php echo get_the_permalink( get_theme_mod( 'properta_general_action' ) ); ?>" class="ribbon"><i class="fa <?php echo $action_icon; ?>"></i></a>
                            <?php endif; ?>
                        </div>
                    </div><!-- /.navigation -->

                    <?php if ( ! is_front_page() ) : ?>
                        <?php echo do_shortcode('[realia_breadcrumb]'); ?>
                    <?php endif; ?>

                </div><!-- /.header-block -->
            </div><!-- /.container -->
        </nav>
    </div><!-- /.header -->

    <div class="main">
        <?php dynamic_sidebar( 'sidebar-top-fullwidth' ); ?>

        <div class="container">
            <?php get_sidebar( 'top' ); ?>

            <?php if ( ! empty( $_SESSION['messages'] ) && is_array( $_SESSION['messages'] ) ) : ?>
                <?php $_SESSION['messages'] = Realia_Utilities::array_unique_multidimensional( $_SESSION['messages'] );?>

                <div class="alerts">
                    <?php foreach ( $_SESSION['messages'] as $message ) : ?>
                        <div class="alert alert-dismissible alert-<?php echo esc_attr( $message[0] ); ?>">
                            <div class="alert-inner">
                                <?php echo wp_kses( $message[1], wp_kses_allowed_html( 'post' ) ); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="pp pp-normal-circle-cross"></i></button>
                            </div><!-- /.alert-inner -->
                        </div><!-- /.alert -->
                    <?php endforeach; ?>
                </div><!-- /.alerts -->

                <?php unset( $_SESSION['messages'] ); ?>
            <?php endif; ?>
