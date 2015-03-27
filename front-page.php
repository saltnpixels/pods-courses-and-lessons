<?php 
//template name: front page. logged out view

get_header();
?>


 <?php if (have_posts()) : while (have_posts()) : the_post();?>
      
     
     
      <div class="front-splash">
          <?php echo get_post_meta(get_the_ID(),'hero_area', true); ?>
          
</div>
     
     <?php get_template_part( 'content', 'page'); ?>
      <?php endwhile; ?>

     

  <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>
  
  
  <?php //get all courses logos
       $course_logos = new WP_Query(array(
        'post_status' => 'publish',
        'post_type' => 'course',
        'order' => 'ASC',
        'posts_per_page' => '-1'
        ));
        
//loop

if ( $course_logos->have_posts() ) : ?>
	
	<h2 class="center-text">Our Partners</h2>
		<div class="wrap cf">
		<?php while ( $course_logos->have_posts() ) : $course_logos->the_post(); ?>
		
		
		<div class="col-1-4"><?php $logo = get_post_meta(get_the_ID(), 'course_logo', true); 
 ?>
 <img src="<?php echo $logo['guid'] ?>" alt="">
 </div>
		
	<?php endwhile; ?>
</div>

<?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>


<?php wp_reset_postdata(); ?>


  
  
  
 <?php get_footer(); ?>