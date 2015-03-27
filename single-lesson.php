<?php 



//need to be in loop right away to get course logo and top stuff


get_header('logged-in');
?>


 <?php if (have_posts()) : while (have_posts()) : the_post();?>
      
     
     
     <?php get_template_part( 'content', 'app-view'); ?>
     
     
       <?php endwhile; ?>

     

  <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>
  
  
  


  
  
  
 <?php get_footer(); ?>