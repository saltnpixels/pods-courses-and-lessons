<?php  
 /**
 *
 *  Template name: app-view 
 *
 */

get_header('logged-in');




get_template_part('content', 'app-view');

?>

 
      
      
 <?php if (have_posts()) : while (have_posts()) : the_post();?>
      
     
<?php $page_id = get_the_ID(); ?>

     <div class="col-4-5 nogutters main-area">
<div class="col-full">
     <h1 clas="interfacecolor"><strong><?php the_title(); ?></strong></h1>
         
  </div>
  
   
    <div class="col-full">
      
    
     <div class="the-content"> <article class="gutters"><?php the_content(); ?></article> </div>
     
       <?php endwhile; ?>

      
  </div>
  
 
    
</div>
<!--close module -->
  </div>

  <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>
  
  
  


  
  
  
 <?php get_footer(); ?>