<?php 
	$events = get_posts(array(
		"post_type" => "event",
		'posts_per_page' => -1,
		'lang' => ''
	));

	var_dump(count($events));

	foreach ($events as $event) {
		$endString = get_post_meta($event->ID)['_event_end_date'][0];
		$endDateAndTime = explode(" ", $endString);
		$endDate = implode(".", array_reverse(explode("-", $endDateAndTime[0])));
		$endTime = substr($endDateAndTime[1], 0, 5);
		
		if (strtotime($endDate . ' ' . $endTime) < time()) {
			wp_trash_post($event->ID);
		}
	}
?>

<?php if ( have_rows( 'events_page_content' ) ): ?>
	<?php while ( have_rows( 'events_page_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'top_page_text' ) : ?>
            <?php
            $headerImage = get_sub_field( 'header_image' );
            $title = get_sub_field('page_title') ;
            $subtitle = get_sub_field('page_subtitle');
            $secondHeading = get_sub_field('second_heading');
            $secondParagraph = get_sub_field('second_paragraph');
            ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>


<div class="container">
            <img class="wideImage" src="<?php echo $headerImage ?>" alt="Placeholder">            
            <div class="newPageTitleText grayPageTitleBackground">
                <h1><?php echo $title ?></h1>
                <p><?php echo get_bloginfo('title'); ?> &#187; <?php the_title(); ?></p>
            </div>
        </div>

        <div class="contentText">
            <h2><?php echo $secondHeading ?></h2>
            <p><?php echo $secondParagraph ?></p>
        </div>

        <!--Events -->
        <style type="text/css">
            @media screen and (max-width: 950px) {
                .EventCards {
                    width: 80%;
                }
            }
        </style>

        <div class="EventContainer">
            <div class="wavemotif-loader waveUIGREY waveTyrsky"></div>
            <!--Events Categories-->
            <div class="bgGrey">
                <header style="letter-spacing: 2px;margin: 15px;"><?php echo pll__('Events'); ?></header>
                <h4><?php echo pll__('Filter events'); ?></h4>
                <div class="EventCategories">
                    <?php
                        $eventCats = get_terms(array(
                            'taxonomy' => 'event-category'
                        ));

                        foreach($eventCats as $eventCat) {
                            echo "<a class='tietoaMeista_link palvelu-filter' href='javascript:void(0)' data-filter='" . $eventCat->slug . "'>" . ucwords($eventCat->name) . "</a>";
                        }
                    ?>
                </div>

                <style type="text/css">
                    .EventCard {
                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                        margin-bottom: 50px;
                        height: auto;
                    }
                </style>

                <?php
                $EBEvents = eventbrite_get_events()->events;

                foreach ($EBEvents as $EBEvent) {
                    $exists = new WP_Query(array(
                        's' => $EBEvent->post_title
                    ));

                    if (!$exists->have_posts()) {
                        sanitize_post(wp_insert_post(array(
                            'post_content'          => $EBEvent->post_content,
                            'post_title'            => $EBEvent->post_title,
                            'post_type'             => 'event',
                            'post_status'           => 'publish',
                            'meta_input'            => array(
                                "eventbrite"        => json_decode(json_encode($EBEvent), true),
                                "_event_start_date"     => implode(' ', explode('T', $EBEvent->start->local)),
                                "_event_end_date"       => implode(' ', explode('T', $EBEvent->end->local)),
                                "event_occurrence_start_date" => implode(' ', explode('T', $EBEvent->start->local)),
                                "event_occurrence_end_date" => implode(' ', explode('T', $EBEvent->end->local))
                            )
                        ), true));
                    }
                }
                ?>

                <!--Events Cards-->

                <div class="EventCards" style="display: unset">
                    
                </div>

                
                
            </div>
            <div class="wavemotif-loader waveUIGREY waveTyrsky Upsidedown"></div>
        </div>
        

        <!--Swirly Divider-->

<?php if ( have_rows( 'events_page_content' ) ): ?>
	<?php while ( have_rows( 'events_page_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'square_image_with_text_box_on_the_right' ) : ?>
        <!-- Square image with Text box on the right-->


        <div class="imageContainer2">
        <div class="newImage2" style="background-image: url(<?php echo esc_url( get_sub_field( 'box_right_image' ) ); ?>)"></div>
            <div class="textBox1" style="background-color: var(--UI-grey);">
            <?php if ( $title = get_sub_field('box_on_right_title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('box_on_right_description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
                <div class=""><?php
                    $link = get_sub_field('box_on_right_button__link');
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
        <?php elseif ( get_row_layout() == 'square_image_with_text_box_on_the_left' ) : ?>
             <!-- Square image with Text box on the left -->
        <div class="imageContainer2">
        <div class="newImage2left" style="background-image: url(<?php echo esc_url( get_sub_field( 'box_left_image' ) ); ?>)"></div>
            <div class="textBox3" style="background-color: rgb(128, 235, 211);">
            <?php if ( $title = get_sub_field('box_on_left_title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('box_on_left_description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
                <div class=""><?php
                    $link = get_sub_field('box_on_left_button__link');
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

		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>






<script type="text/javascript">
    function getFilteredEvents(categoryName = '', eventsOffset = 0) {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "") {
                    if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMessage"));
                    }
                    document.querySelector(".EventCards").innerHTML = "<p id='loadMessage'>There is not any events under that category :(</p>";
                }else{
                    console.log(this.responseText);
                    if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMessage"));
                    }
                    if (!!document.querySelector("#loadMoreEvents")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMoreEvents"));
                    }
                    document.querySelector(".EventCards").innerHTML += this.responseText;

                    if (this.responseText.includes("id='loadMoreEvents'")) {
                        checkIfLoadMoreButtonIsLoaded();
                    }
                }
            }else if(this.status == 404 || this.status == 400) {
                if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMessage"));
                    }
                document.querySelector(".EventCards").innerHTML = "There was an error...";
            }else{
                if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".EventCards").removeChild(document.querySelector("#loadMessage"));
                    }
                document.querySelector(".EventCards").innerHTML += "<p id='loadMessage'>Loading events...</p>";
            }
        }

        request.open("POST", '<?php echo get_site_url() . "/wp-admin/admin-ajax.php"; ?>', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
        request.send("action=getFilteredEvents&categoryName=" + categoryName + "&eventsOffset=" + eventsOffset);
    }

    function unselectAllFilterButtons() {
        document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
            filterButton.classList.remove("palvelu-filter-selected");
        });
    }

    document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
        filterButton.onclick = function() {
            document.querySelector(".EventCards").innerHTML = "<p id='loadMessage'>Loading...</p>";
            if (filterButton.classList.contains("palvelu-filter-selected")) {
                getFilteredEvents();
                unselectAllFilterButtons();
                filterButton.classList.remove("palvelu-filter-selected");
            }else{
                getFilteredEvents(filterButton.dataset.filter);
                unselectAllFilterButtons();
                filterButton.classList.add("palvelu-filter-selected");
            }
        }
    });

    function checkIfLoadMoreButtonIsLoaded() {
        if (!!!document.querySelector("#loadMoreEvents")) {
            setTimeout(function() {
                checkIfLoadMoreButtonIsLoaded();
            }, 200);
        }else{
            document.querySelector("#loadMoreEvents").onclick = function() {
                if (!!document.querySelector(".palvelu-filter-selected")) {
                    getFilteredEvents(document.querySelector(".palvelu-filter-selected").dataset.filter, document.querySelector("#loadMoreEvents").dataset.offset);
                }else{
                    getFilteredEvents('', document.querySelector("#loadMoreEvents").dataset.offset);
                }
            }
        }
    }

    getFilteredEvents();
    checkIfLoadMoreButtonIsLoaded();
</script>
<style>
.eventInfoContainer1 h1{
	background-color: var(--UI-grey);
	text-align: center;
	padding: 50px;
}
.eventInfoContainer1 {
	background-color: var(--UI-grey);
	height: 550px;
	width: var(--width);
	display: flex;
    flex-direction: column;
	align-items: center;
	
}
.eventInfoGrid{
    padding: 40px;
    margin: 0 auto 75px auto;
    width: 70%;
    height: auto;
    display: grid;
    grid-template-columns: 0.3fr 1fr 0.5fr;
    grid-template-rows: 1fr;
	background-color: white;
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
.location{
    text-align: end;
}
.location h5, .titleInfo h5{
	font-size: 1.3rem;
    margin-bottom: 10px;
}
.datetime{
	font-size: 1.1rem;
}
.titleInfo{
	margin-bottom: 25px;
}
.datetime{
        text-align: center;
    }
@media only screen and (max-width: 860px){
	.location h5, .titleInfo h5{
		text-align: center;
}
	.eventInfoContainer1{
		height:auto;
	}
    .eventInfoGrid{
        width: 80%;
        grid-template-columns: 1fr;
		grid-template-rows: auto auto auto;
		grid-gap: 15px;	
	}
    .location{
        text-align: start;
    }
}
	</style>