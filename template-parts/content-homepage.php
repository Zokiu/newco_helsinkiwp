
<?php if ( have_rows( 'front_page_content' ) ): ?>
	<?php while ( have_rows( 'front_page_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'header_image_with_diagonal_swirl' ) : ?>
            <div class="container homePageH">
            <img class="wideImage" src="<?php the_sub_field('image_background'); ?>" alt="Placeholder">
            <img src="<?php echo get_stylesheet_directory_uri()?>/Images/Blue overlay.png" class="diagonal-overlay">
            <div style="bottom: 0px;" class="diagonal-overlay-mobile wavemotif-loader waveKupari wavePerus"></div>
                <div class="HeaderText">
                    <?php if ( $title = get_sub_field('title') ): ?>
                        <h1><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <?php if ( $description = get_sub_field('description') ): ?>
                        <p><?php echo $description; ?></p>
                    <?php endif; ?>                    
                </div>
            </div>
			<?php // warning: layout 'header_image_with_diagonal_swirl' has no sub fields ?>
		<?php elseif ( get_row_layout() == 'content_cards' ) : ?>
    <div class="contentText">
        <?php if ( $title = get_sub_field('title') ): ?>
            <h1><?php echo $title; ?></h1>
        <?php endif; ?>
        <?php if ( $description = get_sub_field('description') ): ?>
        <p><?php echo $description; ?></p>
        <?php endif; ?>
    </div>
    <?php if ( have_rows( 'single_card' ) ): ?>
        <div class="contentCards">
			<?php while ( have_rows( 'single_card' ) ) : the_row(); ?>
					<?php if ( get_row_layout() == 'card_layout' ) : ?>
                        <div class="Card">
                        <img class="cardIcon" src="<?php the_sub_field('card_icon'); ?>" alt="placeholder icon">
                        <?php if ( $card_title = get_sub_field('card_title') ): ?>
                            <p><?php echo $card_title; ?></p>
                        <?php endif; ?>
                        <hr>
                        <?php if ( $card_description = get_sub_field('card_description') ): ?>
                            <p><?php echo $card_description; ?></p>
                        <?php endif; ?>
                        
                        <?php
                            $link = get_sub_field('card_read_more_link');
                            if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?><div class="readMoreh">
                            <a style="color:var(--Bussi);" class="dropbtn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?>
                            <img class="cardArrow" src="<?php echo get_stylesheet_directory_uri()?>/Icons/keyboard_arrow_right-24px.svg" alt="placeholder icon"></a>
                            </div><?php endif; ?>                      
                        
                        </div>
					
					<?php endif; ?>
			<?php endwhile; ?>
        </div>
	<?php else: ?>
				<?php // no layouts found ?>
	<?php endif; ?>
    
    
    <?php
        $link = get_sub_field('all_services_link');
        if( $link ):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?><div class="linkContainer">
            <a class="tietoaMeista_link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            </div><?php endif; ?>
    
    <!--- end of section !-->
			<?php // warning: layout 'content_cards' has no sub fields ?>
		<?php elseif ( get_row_layout() == 'wide_image_with_text_box_on_the_right' ) : ?>
            <!-- Wide image with Text box on the right -->
        <div class="imageContainer2">
            <div class="newImage1" style="background-image: url(<?php echo esc_url( get_sub_field( 'background' ) ); ?>)"></div>
                <div class="textBox2" style="background-color: white;">
                    <?php if ( $title = get_sub_field('title') ): ?>
                        <h1><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <?php if ( $description = get_sub_field('description') ): ?>
                        <p><?php echo $description; ?></p>
                    <?php endif; ?>
                    <div class=""><?php
                        $link = get_sub_field('link_for_more');
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="readMoreBox2" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
        </div>
			<?php // warning: layout 'wide_image_with_text_box_on_the_right' has no sub fields ?>
		<?php elseif ( get_row_layout() == 'square_image_with_text_box_on_the_left' ) : ?>
        <!-- Square image with Text box on the left -->
        <div class="imageContainer2">
        <div class="newImage2left" style="background-image: url(<?php echo esc_url( get_sub_field( 'background' ) ); ?>)"></div>
            <div class="textBox3" style="background-color: var(--Suomenlinna-light-50);">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
                <div class=""><?php
                    $link = get_sub_field('link_for_more');
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="readMoreBox3" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
			<?php // warning: layout 'square_image_with_text_box_on_the_left' has no sub fields ?>

<?php elseif ( get_row_layout() == 'quote_carousel' ) : ?>

    <div class="carouselContainer">
            <h3 class="carouselTitle"><?php the_sub_field( 'quote_carousel_title' ); ?></h3>
            <?php if ( have_rows( 'quote_carousel' ) ): ?>
                <div class="slider">
                    <?php while ( have_rows( 'quote_carousel' ) ) : the_row(); ?>
                        <?php if ( get_row_layout() == 'quote_carousel_layout' ) : ?>
                    <div class="quoteContainer">
                        <div class="quoteText">
                            <?php if ( $quote_text = get_sub_field('quote_text') ): ?>                           
                                <p class="quoteText_p"><?php echo $quote_text; ?></p>
                            <?php endif; ?>
                                <?php if ( $author_name = get_sub_field('author_name') ): ?>
                                    <p class="quoteText_author"><?php echo $author_name; ?></p>
                                <?php endif; ?> <?php if ( $authors_title = get_sub_field('authors_title') ): ?>
                                    <p class="quoteText_title"><?php echo $authors_title; ?></p>
                                <?php endif; ?>
                                
                        </div>
                        <img class="quotePerson" src="<?php the_sub_field('author_image'); ?>" alt="">
                        
                    </div>
            <?php endif; ?>                    
                    <?php endwhile; ?>

        </div>
        <?php else: ?>
				<?php // no layouts found ?>
			<?php endif; ?>
</div>






        <?php elseif ( get_row_layout() == 'email_subscription' ) : ?>
<div class="mailSubscription mailSubscription1">
    <div class="mailIcon">
            <img src="<?php echo get_template_directory_uri(); ?>/Images/pngguru.com.png" alt="">
    </div>
    <div class="mailSubscription_text">
            <?php if ( $section_title = get_sub_field( 'section_title' ) ) : ?>
                <h3><?php echo esc_html( $section_title ); ?></h3>
            <?php endif; ?>
            <?php if ( $section_description = get_sub_field( 'section_description' ) ) : ?>
                <p><?php echo $section_description; ?></p>
            <?php endif; ?>
    </div>
    <div class="mmForm">
            <?php
            if ( get_sub_field('shortcode') ) {
                echo do_shortcode( get_sub_field('shortcode') );
            }
            ?>
                
    </div>
</div>

<?php elseif ( get_row_layout() == 'email_subscription_with_image' ) : ?>
<div class="mailSubscription mailSubscription2">
            <div>
			<?php if ( get_sub_field( 'image' ) ) { ?>
				<img style="width: 100%;height: 100%;display: block;" src="<?php the_sub_field( 'image' ); ?>" />
            <?php } ?>
            </div>
			
        <div class="mmForm mmForm2">
            <h3><?php the_sub_field( 'section_title' ); ?></h3>
            <p style="margin-bottom: 25px;"><?php the_sub_field( 'section_description' ); ?></p>
            
            <?php
            if ( get_sub_field('shortcode') ) {
                echo do_shortcode( get_sub_field('shortcode') );
            }
            ?> 
                            
        </div>
</div>

            <?php // warning: layout 'email_subscriptionbox' has no sub fields ?>
            
<?php elseif ( get_row_layout() == 'square_image_with_text_box_on_the_right' ) : ?>
<!-- Square image with Text box on the right-->
<div class="imageContainer2">
    <div class="newImage2" style="background-image: url(<?php echo esc_url( get_sub_field( 'background_image' ) ); ?>)"></div>
    <div class="textBox1" style="background-color:rgb(128, 235, 211);">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
                <div class=""><?php
                                            $link = get_sub_field('link_for_more');
                                            if( $link ):
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                $link_target = $link['target'] ? $link['target'] : '_self';
                                                ?>
                                                <a class="readMoreBox3" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                            <?php endif; ?>
                </div>
        </div>
</div>



			<?php // warning: layout 'square_image_with_text_box_on_the_right' has no sub fields ?>
<?php elseif ( get_row_layout() == 'wide_image_with_text_box_on_the_left' ) : ?>
            <!-- Wide image with Text box on the left -->
<div class="imageContainer2">
    <div class="newImage1" style="background-image: url(<?php echo esc_url( get_sub_field( 'background_image' ) ); ?>)"></div>
    <div class="textBox22" style="background-color: white;">
        <?php if ( $title = get_sub_field('title') ): ?>
            <h1><?php echo $title; ?></h1>
        <?php endif; ?>
        <?php if ( $description = get_sub_field('description') ): ?>
            <p><?php echo $description; ?></p>
        <?php endif; ?>
            <div class=""><?php
                    $link = get_sub_field('link_for_more');
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="readMoreBox2" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
            </div>
    </div>
</div>

    <?php endif; ?>
    <?php endwhile; ?>  
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>


