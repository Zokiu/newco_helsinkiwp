
<div class="container">
<?php $header_image = get_field( 'header_image' ); ?>
<?php if ( $header_image ) { ?>
	<img class="wideImage" src="<?php echo $header_image['url']; ?>" alt="<?php echo $header_image['alt']; ?>" />
<?php } ?>
    
    <div class="newPageTitleText">
        <h1><?php the_title(); ?></h1>
        <p><?php echo get_bloginfo('title'); ?> &#187; <?php the_title(); ?></p>
    </div>   
</div>


<style>

</style>
