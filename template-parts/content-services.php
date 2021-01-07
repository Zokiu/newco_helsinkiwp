        <!-- Header image with horizontal swirl -->
        <div class="container">
            <img class="wideImage" src="<?php the_field( 'header_image' ); ?>" alt="Placeholder">
            
            <div class="newPageTitleText yellowPageTitleBackground">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_bloginfo('title'); ?> &#187; <?php the_title(); ?></p>
            </div>
        </div>
<?php if ( have_rows( 'services_page_content' ) ): ?>
	<?php while ( have_rows( 'services_page_content' ) ) : the_row(); ?>

        <?php if ( get_row_layout() == 'content_cards' ) : ?>
        <div style="width: 70%; margin: auto; text-align: center;">
			<h1><?php the_sub_field( 'title' ); ?></h1>
			<p><?php the_sub_field( 'description' ); ?></p>
            <br>
            <p class="palvelut-headline"><?php the_sub_field( 'filter_services_text' ); ?></p>
        </div>
            <div class="container" style="height: auto">
    <div class="palvelurajaus">
        <?php
                        $serviceCats = get_sub_field("filter");
                        foreach($serviceCats as $serviceCat) {
                            echo "<a class='tietoaMeista_link' style='margin: 15px 15px;' href='javascript:void(0)' data-filter='" . $serviceCat->slug . "'>" . ucwords($serviceCat->name) . "</a>";
                        }
        ?>
    </div>
</div>



    <div class="contentCards">
    </div>
	
	
    
<?php elseif ( get_row_layout() == 'text_box_with_image_on_left' ) : ?>            
<div class="imageContainer2" >
    <div class="newImage1" style="background-image: url(<?php echo esc_url( get_sub_field( 'image' ) ); ?>)"></div>
         <div class="textBox2" style="background-color: white;">
			<h1><?php the_sub_field( 'title' ); ?></h1>
			<p><?php the_sub_field( 'description' ); ?></p>
            <div class=""><?php
                                    $link = get_sub_field('read_more_link');
                                    if( $link ):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <a class="readMoreBox2" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo mb_strimwidth( $link_title, 0, 30, '...' ); ?></a>
                                    <?php endif; ?>
            </div>
        </div>
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


        

 


			<?php // warning: layout 'email_subscription' has no sub fields ?>
<?php elseif ( get_row_layout() == 'square_box_with_image' ) : ?>
    <div class="imageContainer2">
        <div class="newImage2" style="background-image: url(<?php echo esc_url( get_sub_field( 'image' ) ); ?>)">
        </div>
        <div class="textBox1" style="background-color:rgb(128, 235, 211);">
            <h1><?php the_sub_field( 'title' ); ?></h1>
			<p><?php the_sub_field( 'description' ); ?></p>
            <?php $read_more_link = get_sub_field( 'read_more_link' ); ?>
            <div class="">
            <?php if ( $read_more_link ) { ?>                
				<a class="readMoreBox3" href="<?php echo $read_more_link['url']; ?>" target="<?php echo $read_more_link['target']; ?>"><?php echo mb_strimwidth($read_more_link ['title'], 0, 35,'...'); ?></a>
            <?php } ?>
            </div>
        </div>

    </div>            
			
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>


<style type="text/css">
    .palvelu-filter-selected {
        background: var(--Bussi);
        color: white;
    }
</style>

<script type="text/javascript">
    function getFilteredServices(categoryName = '') {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "") {
                    document.querySelector(".contentCards").innerHTML = "There is not any services under that category :(";
                }else{
                    document.querySelector(".contentCards").innerHTML = this.responseText;
                }
            }else if(this.status == 404 || this.status == 400) {
                document.querySelector(".contentCards").innerHTML = "There was an error...";
            }else{
                document.querySelector(".contentCards").innerHTML = "Loading services...";
            }
        }

        request.open("POST", '<?php echo get_site_url() . "/wp-admin/admin-ajax.php"; ?>', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
        request.send("action=getFilteredServices&categoryName=" + categoryName);
    }

    function unselectAllFilterButtons() {
        document.querySelectorAll(".tietoaMeista_link").forEach(filterButton => {
            filterButton.classList.remove("palvelu-filter-selected");
        });
    }

    document.querySelectorAll(".tietoaMeista_link").forEach(filterButton => {
        filterButton.onclick = function() {
        	if (filterButton.classList.contains("palvelu-filter-selected")) {
        		getFilteredServices();
        		unselectAllFilterButtons();
            	filterButton.classList.remove("palvelu-filter-selected");
        	}else{
        		getFilteredServices(filterButton.dataset.filter);
        		unselectAllFilterButtons();
            	filterButton.classList.add("palvelu-filter-selected");
        	}
        }
    });

    getFilteredServices();
</script>
