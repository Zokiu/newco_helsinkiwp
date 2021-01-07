<?php
	$postMeta = get_post_meta(get_the_ID());
	$isEventbrite = false;

	if (isset($postMeta['eventbrite'])) {
		$isEventbrite = true;
		$eventbriteMeta = unserialize($postMeta['eventbrite'][0]);
	}
?>
<div class="container" style="height:30vh;">	   
    <div class="newPageTitleText grayPageTitleBackground">
        <h1><?php the_title(); ?></h1>
        <p><?php echo get_bloginfo('title'); ?>  &#187; <?php the_title(); ?></p>
    </div>   
</div>

<div class="eventContent" style="text-align: left">
	<div class="eventText" style="text-align: left; margin-bottom: 8rem;">
		<h4 class="eventDate"><?php echo $postMeta['_event_start_date'][0]; ?></h4>		
		<h1><?php the_title() ?></h1>
		<span><?php echo $post->post_content ?></span>
		<?php if ($isEventbrite) { ?>
			<a class="linktoEB" href="<?php echo $eventbriteMeta['url'] ?>" style='background: purple; color: white; padding: 20px'><?php echo pll__('Link to event'); ?></a>
		<?php }else if (!empty($postMeta['_event_tickets_url'][0])) { ?>
			<a href="<?php echo $postMeta['_event_tickets_url'][0] ?>" style='background: purple; color: white; padding: 20px'><?php echo pll__('Link to event'); ?></a>
		<?php } ?>
	</div>



</div>
<div class="wavemotif-loader waveUIGREY waveTyrsky"></div>
<div class="eventInfoContainer1">
<?php
			$startString = $postMeta['_event_start_date'][0];
	        $startDateAndTime = explode(" ", $startString);
	        $startDate = implode(".", array_reverse(explode("-", $startDateAndTime[0])));
			$startTime = substr($startDateAndTime[1], 0, 5);
			$endString = $postMeta['_event_end_date'][0];;
	        $endDateAndTime = explode(" ", $endString);
	        $endDate = implode(".", array_reverse(explode("-", $endDateAndTime[0])));
			$endTime = substr($endDateAndTime[1], 0, 5);
			$eventLocation = em_get_locations_for(get_the_ID())[0]->location_meta;
			if ($isEventbrite && !empty($eventbriteMeta['venue']['address']['localized_address_display'])) {
				$eventbriteLocation = explode(', ', $eventbriteMeta['venue']['address']['localized_address_display']);
				$eventbriteName = $eventbriteMeta['venue']['name'];
			}
			?>
        <H1><?php echo pll__('Event info') ?></H1>
        <div class="eventInfoGrid">
            <div class="datetime">
                <h5><?php echo $startDate ?></h5>
                <p><?php echo $startTime ?></p>
            </div>
            <div class="titleInfo">
                <h5><?php the_title() ?></h5>
                <p><?php echo wp_trim_words($post->post_content, 30) ?></p>
            </div>
            <div class="location">
				<h5><?php echo pll__('Event location') ?></h5>
						<?php if ($isEventbrite) { ?>
							<p><?php echo $eventbriteName ?></p>
							<p><?php echo $eventbriteLocation[0] ?></p>
							<p><?php echo $eventbriteLocation[1] ?></p>
						<?php }else{ ?>
							<p><?php echo em_get_locations_for(get_the_ID())[0]->name ?></p>
							<p><?php echo (!empty($eventLocation['address']) ? $eventLocation['address'] : '') ?></p>
							<p><?php echo (!empty($eventLocation['zip']) ? $eventLocation['zip'] : '') ?></p>
							<p><?php echo (!empty($eventLocation['city']) ? $eventLocation['city'] : '') ?></p>
						<?php } ?>
            </div>
		</div>
		
	</div>
	<div class="wavemotif-loader waveUIGREY waveTyrsky Upsidedown"></div>
	<div style="margin:45px auto;"></div>
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