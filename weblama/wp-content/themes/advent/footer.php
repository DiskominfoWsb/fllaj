<?php $advent_options = get_option('advent_theme_options'); ?>
<footer>
    <div class="webpage-container text-center center-block">
        <div class="social-media col-md-12">
            <?php if(get_theme_mod ( 'footerCopyright_icon_switch',1)==1){ 
                $TopHeaderSocialIconDefault = array(array('url'=>$advent_options['email'],'icon'=>'fa-envelope'),array('url'=>$advent_options['facebook'],'icon'=>'fa-facebook'),array('url'=>$advent_options['twitter'],'icon'=>'fa-twitter'),array('url'=>$advent_options['pinterest'],'icon'=>'fa-pinterest'),);?>                
                    <ul class="list-unstyled list-inline">
                        <?php for($i=1; $i<=4; $i++) : 
                                if(get_theme_mod('TopHeaderSocialIconLink'.$i,$TopHeaderSocialIconDefault[$i-1]['url'])!= '' && get_theme_mod('TopHeaderSocialIcon'.$i,$TopHeaderSocialIconDefault[$i-1]['icon'])!= ''){     ?>
                                   <li><a href="<?php echo esc_url(get_theme_mod('TopHeaderSocialIconLink'.$i,$TopHeaderSocialIconDefault[$i-1]['url'])); ?>" class="social-icon btn" title="" target="_blank">
                                        <i class="fa <?php echo esc_attr(get_theme_mod('TopHeaderSocialIcon'.$i,$TopHeaderSocialIconDefault[$i-1]['icon'])); ?>"></i>
                                    </a></li>                                            
                        <?php } endfor; ?>
                    </ul>               
            <?php }  ?>   
            <p>
                <?php 
                if (get_theme_mod ( 'copyright_url_setting',$advent_options['footertext'])!='') {
                    echo esc_attr(get_theme_mod ( 'copyright_url_setting',$advent_options['footertext'])) . '. ';
                }
                printf(/* translators: 1 is theme info*/esc_html__('Powered by %1$s', 'advent'),'<a href="'.esc_url("https://fruitthemes.com/wordpress-themes/advent").'" target="_blank">'.esc_html__("Advent WordPress Theme",'advent').'</a>'); ?></p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>