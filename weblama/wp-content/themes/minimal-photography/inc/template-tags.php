<?php
/**
 * Custom Functions
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Minimal Photography
 * @since 1.0.0
 */
if( !function_exists('minimal_photography_site_logo') ):

    /**
     * Logo & Description
     */
    /**
     * Displays the site logo, either text or image.
     *
     * @param array $args Arguments for displaying the site logo either as an image or text.
     * @param boolean $echo Echo or return the HTML.
     *
     * @return string $html Compiled HTML based on our arguments.
     */
    function minimal_photography_site_logo( $args = array(), $echo = true ){

        $logo = get_custom_logo();
        $site_title = get_bloginfo('name');
        $contents = '';
        $classname = '';

        $defaults = array(
            'logo' => '%1$s<span class="screen-reader-text">%2$s</span>',
            'logo_class' => 'site-logo',
            'title' => '<a href="%1$s">%2$s</a>',
            'title_class' => 'site-title',
            'home_wrap' => '<h1 class="%1$s">%2$s</h1>',
            'single_wrap' => '<div class="%1$s site-branding">%2$s</div>',
            'condition' => (is_front_page() || is_home()) && !is_page(),
        );

        $args = wp_parse_args($args, $defaults);
        /**
         * Filters the arguments for `minimal_photography_site_logo()`.
         *
         * @param array $args Parsed arguments.
         * @param array $defaults Function's default arguments.
         */
        $args = apply_filters('minimal_photography_site_logo_args', $args, $defaults);
        if( has_custom_logo() ){

            $contents = sprintf($args['logo'], $logo, esc_html($site_title));
            $classname = $args['logo_class'];

        }else{

            $contents = sprintf($args['title'], esc_url(get_home_url(null, '/')), esc_html($site_title));
            $classname = $args['title_class'];

        }

        $wrap = $args['condition'] ? 'home_wrap' : 'single_wrap';
        $html = sprintf($args[$wrap], $classname, $contents);
        /**
         * Filters the arguments for `minimal_photography_site_logo()`.
         *
         * @param string $html Compiled html based on our arguments.
         * @param array $args Parsed arguments.
         * @param string $classname Class name based on current view, home or single.
         * @param string $contents HTML for site title or logo.
         */
        $html = apply_filters('minimal_photography_site_logo', $html, $args, $classname, $contents);
        if( !$echo ){
            return $html;
        }

        echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }

endif;

if( !function_exists('minimal_photography_site_description') ):

    /**
     * Displays the site description.
     *
     * @param boolean $echo Echo or return the html.
     *
     * @return string $html The HTML to display.
     */
    function minimal_photography_site_description($echo = true){

        $description = get_bloginfo('description');
        if (!$description) {
            return;
        }
        $wrapper = '<div class="site-description">%s</div><!-- .site-description -->';
        $html = sprintf($wrapper, esc_html($description));
        /**
         * Filters the html for the site description.
         *
         * @param string $html The HTML to display.
         * @param string $description Site description via `bloginfo()`.
         * @param string $wrapper The format used in case you want to reuse it in a `sprintf()`.
         * @since 1.0.0
         *
         */
        $html = apply_filters('minimal_photography_site_description', $html, $description, $wrapper);
        if( !$echo ){
            return $html;
        }
        echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }

endif;

if( !function_exists('minimal_photography_posted_on') ):

    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function minimal_photography_posted_on(){

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $ed_post_date = absint( get_theme_mod( 'ed_post_date',$minimal_photography_default['ed_post_date'] ) );

        if( $ed_post_date ){

            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf($time_string,
                esc_attr(get_the_date(DATE_W3C)),
                esc_html(get_the_date()),
                esc_attr(get_the_modified_date(DATE_W3C)),
                esc_html(get_the_modified_date())
            );

            $year = get_the_date('Y');
            $month = get_the_date('m');
            $day = get_the_date('d');
            $link = get_day_link($year, $month, $day);
            $posted_on = '<a href="' . esc_url($link) . '" rel="bookmark">' . $time_string . '</a>';

            echo '<div class="entry-meta-item entry-meta-date">';
            echo '<div class="entry-meta-wrapper">';
            echo '<span class="entry-meta-icon calendar-icon"> ';
            minimal_photography_the_theme_svg('calendar');
            echo '</span>';

            echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
            echo '</div>';
            echo '</div>';

        }

    }

endif;

if( !function_exists('minimal_photography_posted_by') ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function minimal_photography_posted_by(){   

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $ed_post_author = absint( get_theme_mod( 'ed_post_author',$minimal_photography_default['ed_post_author'] ) );

        if( $ed_post_author ){

            echo '<div class="entry-meta-item entry-meta-author">';
            echo '<div class="entry-meta-wrapper">';
            echo '<span class="entry-meta-icon author-icon"> ';
            minimal_photography_the_theme_svg('user');
            echo '</span>';
            $byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
            echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
            echo '</div>';
            echo '</div>';

        }

    }

endif;

if( !function_exists('minimal_photography_entry_footer') ):

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function minimal_photography_entry_footer( $cats = true, $tags = true, $edits = true ){   

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $ed_post_category = absint( get_theme_mod( 'ed_post_category',$minimal_photography_default['ed_post_category'] ) );
        $ed_post_tags = absint( get_theme_mod( 'ed_post_tags',$minimal_photography_default['ed_post_tags'] ) );

        // Hide category and tag text for pages.
        if( 'post' === get_post_type() ){

            if( $cats && $ed_post_category ){

                /* translators: used between list items, there is a space after the comma */
                $categories = get_the_category();
                echo '<div class="entry-meta-item entry-meta-categories">';
                echo '<div class="entry-meta-wrapper">';
                /* translators: 1: list of categories. */
            
                echo '<span class="cat-links">';
                    foreach( $categories as $category ){

                        $cat_name = $category->name;
                        $cat_slug = $category->slug;
                        $cat_url = get_category_link( $category->term_id ); ?>

                        <a class="minimal-photography-cat-color-<?php echo esc_attr( $cat_slug ); ?>" href="<?php echo esc_url( $cat_url ); ?>" rel="category tag"><?php echo esc_html( $cat_name ); ?></a>

                    <?php }
                echo '</span>';

                echo '</div>';
                echo '</div>';
            }

            if( $tags && $ed_post_tags ){
                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'minimal-photography'));
                if( $tags_list ){

                    echo '<div class="entry-meta-item entry-meta-tags">';
                    echo '<div class="entry-meta-wrapper">';
                    echo '<span class="entry-meta-icon tags-icon"> ';
                    minimal_photography_the_theme_svg('tag');
                    echo '</span>';

                    echo '<span class="entry-meta-label tags-label">';
                    esc_html_e('In', 'minimal-photography');
                    echo '</span>';

                    /* translators: 1: list of tags. */
                    echo '<span class="tags-links">';
                    echo wp_kses_post($tags_list) . '</span>'; // WPCS: XSS OK.
                    echo '</div>';
                    echo '</div>';

                }

            }

            if( $edits ){

                edit_post_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Edit <span class="screen-reader-text">%s</span>', 'minimal-photography'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            }

        }
    }

endif;

if( !function_exists('minimal_photography_is_comment_by_post_author') ):

    /**
     * Comments
     */
    /**
     * Check if the specified comment is written by the author of the post commented on.
     *
     * @param object $comment Comment data.
     *
     * @return bool
     */
    function minimal_photography_is_comment_by_post_author( $comment = null ){

        if( is_object($comment) && $comment->user_id > 0 ){

            $user = get_userdata($comment->user_id);
            $post = get_post($comment->comment_post_ID);

            if (!empty($user) && !empty($post)) {
                return $comment->user_id === $post->post_author;
            }
        }

        return false;

    }

endif;

add_filter( 'get_the_archive_title','minimal_photography_archive_title_callback');

if( !function_exists('minimal_photography_archive_title_callback') ) :

    /**
     * Minimal Photography Archive title filter
     */
    function minimal_photography_archive_title_callback($comment = null){
    
    $title  = '';
 
    if ( is_category() ) {

        $title  = single_cat_title( '', false );

    } elseif ( is_tag() ) {

        $title  = single_tag_title( '', false );

    } elseif ( is_author() ) {

        $title  = get_the_author();

    } elseif ( is_year() ) {

        $title  = get_the_date( 'Y' );

    } elseif ( is_month() ) {

        $title  = get_the_date( 'F Y' );

    } elseif ( is_day() ) {

        $title  = get_the_date( 'F j, Y' );

    } elseif ( is_tax( 'post_format' ) ) {

        if ( is_tax( 'post_format', 'post-format-aside' ) ) {

            $title = esc_html__( 'Asides','minimal-photography' );

        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {

            $title = esc_html__( 'Galleries', 'minimal-photography' );

        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {

            $title = esc_html__( 'Images', 'minimal-photography' );

        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {

            $title = esc_html__( 'Videos', 'minimal-photography' );

        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {

            $title = esc_html__( 'Quotes', 'minimal-photography' );

        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {

            $title = esc_html__( 'Links', 'minimal-photography' );

        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {

            $title = esc_html__( 'Statuses', 'minimal-photography' );

        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {

            $title = esc_html__( 'Audio', 'minimal-photography' );

        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {

            $title = esc_html__( 'Chats', 'minimal-photography' );

        }

    } elseif ( is_post_type_archive() ) {

        $title  = post_type_archive_title( '', false );

    } elseif ( is_tax() ) {

        $title = single_term_title( '', false );

    }

        return $title;  

    }

endif;

if( !function_exists('minimal_photography_archive_title') ) :

    /**
     * Minimal Photography Breadcrumb
     */
    function minimal_photography_archive_title($comment = null){

        
        if( is_search() ){ ?>
            <div class="twp-banner-details">
                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        /* translators: %s: search query. */
                        printf( esc_html__( 'Search Results for: %s', 'minimal-photography' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
                        ?>
                    </h1>
                </header><!-- .page-header -->
            </div>
        <?php } ?>

        <?php
        if( is_archive() && !is_author() ){ ?>

            <div class="twp-banner-details">
                <header class="page-header">
                    <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                </header><!-- .page-header -->
            </div>
        <?php }

        if( is_author() ){ ?>
            <div class="twp-banner-details">
                <header class="page-header">
                    <?php $author_img = get_avatar( get_the_author_meta('ID'),200, '', '', array('class' => 'avatar-img') ); ?>

                    <div class="author-image">
                        <?php echo wp_kses_post( $author_img ); ?>
                    </div>

                    <div class="author-title-desc">
                        <?php
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="archive-description">', '</div>' );
                        ?>
                    </div>
                </header><!-- .page-header -->
            </div>
        <?php }

    }

endif;


if( !function_exists('minimal_photography_breadcrumb') ) :

    /**
     * Minimal Photography Breadcrumb
     */
    function minimal_photography_breadcrumb($comment = null){

        echo '<div class="entry-breadcrumb">';
        breadcrumb_trail();
        echo '</div>';

    }

endif;
