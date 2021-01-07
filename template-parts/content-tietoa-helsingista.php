<script type="text/javascript">
    var thisNewsCategory = '';
    function getFilteredNews(categoryName = '', newsOffset = 0) {
        console.log(categoryName);
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "") {
                    if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".newsCards").removeChild(document.querySelector("#loadMessage"));
                    }
                    document.querySelector(".newsCards").innerHTML = "There is not any news under that category :(";
                }else{
                    if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".newsCards").removeChild(document.querySelector("#loadMessage"));
                    }
                    if (!!document.querySelector("#loadMoreNews")) {
                        document.querySelector(".newsCards").removeChild(document.querySelector("#loadMoreNews"));
                    }
                    document.querySelector(".newsCards").innerHTML += this.responseText;

                    if (this.responseText.includes("id='loadMoreNews'")) {
                        checkIfLoadMoreButtonIsLoaded();
                    }
                }
            }else if(this.status == 404 || this.status == 400) {
                if (!!document.querySelector("#loadMessage")) {
                    document.querySelector(".newsCards").removeChild(document.querySelector("#loadMessage"));
                }
                document.querySelector(".newsCards").innerHTML = "There was an error...";
            }else{
                if (!!document.querySelector("#loadMessage")) {
                    document.querySelector(".newsCards").removeChild(document.querySelector("#loadMessage"));
                }
                document.querySelector(".newsCards").innerHTML += "<p id='loadMessage'>Loading news...</p>";
            }
        }

        request.open("POST", '<?php echo get_site_url() . "/wp-admin/admin-ajax.php"; ?>', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
        request.send("action=getFilteredNews&categoryName=" + categoryName + "&newsOffset=" + newsOffset + "&newsLimit=4" + "&loadMoreButton=no");
    }

    function unselectAllFilterButtons() {
        document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
            filterButton.classList.remove("palvelu-filter-selected");
        });
    }

    document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
        filterButton.onclick = function() {
            document.querySelector('.newsCards').innerHTML = '';
            getFilteredNews(filterButton.dataset.filter);
            unselectAllFilterButtons();
            filterButton.classList.add("palvelu-filter-selected");
        }
    });

    function checkIfLoadMoreButtonIsLoaded() {
        if (!!!document.querySelector("#loadMoreNews")) {
            setTimeout(function() {
                checkIfLoadMoreButtonIsLoaded();
            }, 200);
        }else{
            document.querySelector("#loadMoreNews").onclick = function() {
                if (!!document.querySelector(".palvelu-filter-selected")) {
                    getFilteredNews(document.querySelector(".palvelu-filter-selected").dataset.filter, document.querySelector("#loadMoreNews").dataset.offset);
                }else{
                    getFilteredNews(thisNewsCategory, document.querySelector("#loadMoreNews").dataset.offset);
                }
            }
        }
    }
    checkIfLoadMoreButtonIsLoaded();
</script>
<!-- Header image with upsidedown wave -->
<div class="container">
	<img class="wideImage" src="<?php echo esc_url( get_field( 'header_image' ) ); ?>"/>    
    <div class="newPageTitleText bluePageTitleBackground">
        <h1><?php the_title(); ?></h1>
        <p><?php echo get_bloginfo('title'); ?> &#187; <?php the_title(); ?></p>
    </div>   
</div>
<?php if ( have_rows( 'tietoa_meista_content' ) ): ?>
	<?php while ( have_rows( 'tietoa_meista_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'heading_text_&_buttons' ) : ?>
        <div class="contentText">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
			<?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
            </div>            
		<?php elseif ( get_row_layout() == 'statistics_box' ) : ?>
        <div class="wavemotif-loader waveUIGREY waveTyrsky"></div>
        <div class="statisticbox">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h4 class="statisticTitle"><?php echo esc_html($title); ?></h4>
            <?php endif; ?>
            <div class="Statistics">
			<?php if ( have_rows( 'statistics' ) ) : ?>
            
				<?php while ( have_rows( 'statistics' ) ) : the_row(); ?>
                <div class="statistic">
                <?php if ( $number = get_sub_field('number') ): ?>
                    <h3><?php echo esc_html($number); ?></h3>
                <?php endif; ?>
                <?php if ( $text = get_sub_field('text') ): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
                </div>
				<?php endwhile; ?>
                
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
            </div>
        </div>
        <div class="wavemotif-loader waveUIGREY waveTyrsky Upsidedown"></div>
        <?php elseif ( get_row_layout() == 'quote_carousel' ) : ?>
        <div class="quoteCarousel">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h3><?php echo esc_html($title); ?></h3>
            <?php endif; ?>
            <div class="slider">
                <?php if ( have_rows( 'quote_carousel_message' ) ) : ?>
                    <?php while ( have_rows( 'quote_carousel_message' ) ) : the_row(); ?>
                    <div class="quoteMessage">
                        <?php the_sub_field( 'message' ); ?>
                    </div> 
                    <?php endwhile; ?>
            </div>
			<?php else : ?>
				<?php // no rows found ?>
            <?php endif; ?>
        </div>
        <?php elseif ( get_row_layout() == 'news' ) : ?>
        <div class="wavemotif-loader waveUIGREY waveSyke"></div>
<div class="newsContainer">
            <?php if ( $news_section_title = get_sub_field('news_section_title') ): ?>
                <h4 class="guideTitle"><?php echo esc_html($news_section_title); ?></h4>
            <?php endif; ?>
            
            <div class="newsCards">
                    <script type="text/javascript">
                        <?php 
                        $news = get_sub_field("load_news_from_category");

                        foreach ($news as $newsCat) {
                            ?>
                                thisNewsCategory = <?php echo "'" . $newsCat->name . "'"; ?>;
                                getFilteredNews(thisNewsCategory);
                            <?php

                        }
                        ?>
                    </script>
                </div>
                


            
            <?php
            $link = get_sub_field('link_to_all_news');
            if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?><div style="text-align: center;margin: 48px auto;">
                <a class="tietoaMeista_link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                </div><?php endif; ?>
</div>
        
        
        <div class="wavemotif-loader waveUIGREY waveSykeUpsidedown"></div>
        <?php elseif ( get_row_layout() == 'text_box_with_square_image_right' ) : ?>
    <div class="imageContainer2">
        <div class="newImage2left" style="background-image: url(<?php echo esc_url( get_sub_field( 'image' ) ); ?>)"></div>
            <div class="textBox3" style="background-color:var(--Kupari-light-50);">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
                <div class=""><?php
                    $link = get_sub_field('link');
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="readMoreBox3" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo mb_strimwidth($link_title, 0, 35, '...'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
		<?php elseif ( get_row_layout() == 'wide_image_with_text_box_on_the_right' ) : ?>
        <!-- Wide image with Text box on the right -->
<div class="imageContainer2">
        <div class="newImage1" style="background-image: url(<?php echo esc_url( get_sub_field( 'image' ) ); ?>)"></div>
    <div class="textBox2" style="background-color: white;">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
                <div class=""><?php
                        $link = get_sub_field('link');
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="readMoreBox2" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo mb_strimwidth($link_title, 0, 35, '...'); ?></a>
                        <?php endif; ?>
                </div>
    </div>
</div>

	
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>

