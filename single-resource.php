<?php 



get_header('logged-in');

include(locate_template('content-app-view.php'));

$resource_id = 0;  //for the extra pod resources to list

/**
 *
 *  after getting the ap view whihc pulls in the lessons and head of this page and progress bar.
 * we can show content in main section of app view for post type resource
 * also gets additional resources
 *
 */

?>
 
<div class="col-4-5 nogutters main-area">
<div class="col-full">
     <h1 clas="interfacecolor"><strong>Resources</strong></h1>
         
  </div>
  
   
    <div class="col-2-3 resource-list">
      
      
      
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
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


<?php  pods_view( 'content-resource.php', compact( array( 'resource_id', $resource_id ) ) ); ?>

<?php endwhile; ?>


<?php 
 //get the other resources via pods
//course id already gotten in the app-view
  
  

  $resource_ids = get_related_pod_ids('course', $course_id, 'resources_page');

 if(! empty($resource_ids) && is_array($resource_ids) )
 {
   $resource_ids = array_reverse($resource_ids); //last first
   foreach($resource_ids as $resource)
   {
    
     $resource_id = $resource;
     if( $resource_id == get_the_ID() )
       continue;
     
     pods_view( 'content-resource.php', compact( array( 'resource_id', $resource_id ) ) );
   }
 }

?>

      
  </div>
  
   <div class="col-1-3 sidebar">
     
      <?php echo get_post_meta($course_id, 'resource_sidebar', true); ?>
      
    </div>
    
</div>
<!--close module -->
  </div>

  <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>
  
  
  


  
  
  
 <?php get_footer(); ?>