<?php 



get_header('logged-in');


get_template_part( 'content', 'app-view'); ?>

<?php 
/**
 *
 *  after getting the ap view whihc pulls in the lessons and head of this page and progress bar.
 * we can show content in main section of app view for post type resource
 *
 */

?>
 
<div class="col-4-5 nogutters main-area">
<div class="col-full">
     <h1 clas="interfacecolor"><strong>Resources</strong></h1>
         
  </div>
  
   
    <div class="col-2-3 resource-list">
      
      
      
 <?php if (have_posts()) : while (have_posts()) : the_post();?>
 <?php 
if(is_date_turn_off_past(get_the_ID()) )
{
  // Update post 37
  $my_post = array(
      'ID'           => get_the_ID(),
      'post_status' => 'Draft',
  );

// Update the post into the database
  wp_update_post( $my_post );
}
      
      ?>
     
    
     <?php get_template_part('content', 'resource'); ?>
     
       <?php endwhile; ?>

      
  </div>
  
   <div class="col-1-3 sidebar">
     
      <?php echo get_post_meta($coursenum, 'resource_sidebar', true); ?>
      
    </div>
    
</div>
<!--close module -->
  </div>

  <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>
  
  
  


  
  
  
 <?php get_footer(); ?>