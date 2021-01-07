<div class="container">
            <img class="wideImage" src="<?php the_field( 'header_image' ); ?>" alt="Placeholder">
            
            <div class="newPageTitleText lightRedPageTitleBackground">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_bloginfo('title'); ?> &#187; <?php the_title(); ?></p>
            </div>
</div>
<?php if ( have_rows( 'materials_content' ) ): ?>
	<?php while ( have_rows( 'materials_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'heading_text' ) : ?>
        <!-- Content Cards -->
        <div class="contentText">
        <?php if ( $title = get_sub_field('title') ): ?>
            <h1><?php echo esc_html($title); ?></h1>
        <?php endif; ?>
        <?php if ( $description = get_sub_field('description') ): ?>
            <p><?php echo esc_html($description); ?></p>
        <?php endif; ?>
        </div>
		<?php elseif ( get_row_layout() == 'pdf_materials' ) : ?>
        <div class="wavemotif-loader waveUIGREY waveSyke"></div>
        <div>
            <?php if ( $title = get_sub_field('title') ): ?>
                <h4 class="guideTitle"><?php echo esc_html($title); ?></h4>
            <?php endif; ?>
            <?php $downloadlinktext = get_sub_field( 'download_button_text' ); ?>
			<?php if ( have_rows( 'pdf_materials' ) ) : ?>
            <div class="guideDownloads">
				<?php while ( have_rows( 'pdf_materials' ) ) : the_row(); ?>
                <div class="Guide">
                    <img class="guidePhoto" src="<?php echo esc_url(get_sub_field('image')); ?>"
                        alt="placeholder icon">
                    <div class="guideText">
                    <?php if ( $title = get_sub_field('title') ): ?>
                        <h4><?php echo esc_html($title); ?></h4>
                    <?php endif; ?>
                    <?php if ( $description = get_sub_field('description') ): ?>
                        <p><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                    <?php if ( get_sub_field( 'pdf_file' ) ) { ?>
                        <div class="downloadGuideButton"><a href="<?php the_sub_field( 'pdf_file' ); ?>"><?php echo $downloadlinktext ?></a></div>
					<?php } ?>
                    </div>
                </div>				
				<?php endwhile; ?>
            </div>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
        </div>
        <div class="wavemotif-loader waveUIGREY waveSykeUpsidedown"></div>
		<?php elseif ( get_row_layout() == 'video_materials' ) : ?>
            <div class="wavemotif-loader waveUIGREY waveSyke"></div>
            <div>
            <h4 class="videoTitle">Videomateriaalia</h4>
        </div>
        <?php if ( have_rows( 'videos' ) ) : ?>
            <div class="videoList">
				<?php while ( have_rows( 'videos' ) ) : the_row(); ?>
                <?php
                    $url = get_sub_field('video');
                    $thumb = get_sub_field('custom_thumbnail'); // this is an array
                    $title = get_sub_field('title');
                    $desc = get_sub_field('description');
                    $parsedURL = parse_url($url);
                    $host = $parsedURL['host'];
                    if (strpos($host, 'youtube') !== false) {
                        // if is hosted on youtube, extract ID from the query property  
                        $vidQuery = $parsedURL['query'];
                        // remove the 'v='  
                        $vidID = str_replace('v=','',$vidQuery); 
                        // pass ID into url  
                        $defaultThumb = 'https://img.youtube.com/vi/'.$vidID.'/maxresdefault.jpg';
                        }
                    elseif (strpos($host, 'vimeo') !== false) {
                        // if is hosted on vimeo, extract ID from the path property  
                        $vidQuery = $parsedURL['path']; 
                        // remove the backslash
                        $vidID = str_replace('/','',$vidQuery);
                        // all data about vimeo videos is stored in api, like so:
                        $hash = simplexml_load_file("https://vimeo.com/api/v2/video/$vidID.xml");
                        // grab url for large thumb
                        $defaultThumb = $hash->video[0]->thumbnail_large;
                    }
                    if(!empty($thumb)) {
                        $vid_img = get_sub_field('custom_thumbnail');
                        }
                    elseif(!empty($defaultThumb)) {
                        $vid_img = $defaultThumb;
                        }?>

<div class="Video">
  <a href="<?php echo $url; ?>" class="test-popup-link"> 
    <img class="videoPhoto" src="<?php echo $vid_img; ?>" alt="<?php echo $title; ?>" class="img">    
    <span class="video-trigger"></span>
  </a>
  <div class="videoText ">
  <?php 
  
  if(!empty($title)) { echo '<h4 class="title">' . $title . '</h4>'; }
  if(!empty($desc)) { echo '<p>' . $desc . '</p>'; } ?>
  </div>
</div><!-- /video-card -->
				<?php endwhile; ?>
            </div>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>






        <div class="wavemotif-loader waveUIGREY waveSykeUpsidedown"></div>
        <?php elseif ( get_row_layout() == 'text_box_with_square_image_right' ) : ?>
            <div class="imageContainer2">
        <div class="newImage2left" style="background-image: url(<?php echo esc_url( get_sub_field( 'image' ) ); ?>)"></div>
            <div class="textBox3" style="background-color: rgb(246, 246, 248);">
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
                        <a class="readMoreBox3" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php elseif ( get_row_layout() == 'wide_image_with_text_box_on_the_right' ) : ?>
          <!-- Square image with Text box on the right-->
    <div class="imageContainer2">
        <div class="newImage2" style="background-image: url(<?php echo esc_url( get_sub_field( 'image' ) ); ?>)">
        </div>
        <div class="textBox1" style="background-color:rgb(246, 246, 248);">
            <h1><?php the_sub_field( 'title' ); ?></h1>
			<p><?php the_sub_field( 'description' ); ?></p>
            <?php $read_more_link = get_sub_field( 'link' ); ?>
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
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/jquery-3.5.0.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/magnific-popup.js'; ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('.test-popup-link').magnificPopup({type:'iframe'});
    });
</script>