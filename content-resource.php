<?php 

/**
 *
 *  gets the resource content.
 * also used to get aidditional resources, as there is no real singulalr resource page.
 * pods uses this to list the other ones from related course
 *
 */

?>

 

<?php if($resource_id == 0): ?>
 <article class="the-content">
  
 <h2 style="background: <?php echo get_post_meta($course_id, 'interface_color', true); ?>"><label for="<?php echo get_the_ID(); ?>"><?php the_title(); ?> <span class="right">+</span></label></h2>
<input type="checkbox" id="<?php echo get_the_ID(); ?>" class="hidden">
  <div class="bottom-content"><?php the_content(); ?></div>
  
  </article>
   
<?php else: //its another resource via pods ?>


<article class="the-content">
  
 <h2 style="background: <?php echo get_post_meta($resource_id, 'interface_color', true); ?>"><label for="<?php echo $resource_id; ?>"><?php echo get_the_title($resource_id); ?> <span class="right">+</span></label></h2>
<input type="checkbox" id="<?php echo $resource_id; ?>" class="hidden">
  <div class="bottom-content"><?php echo get_post_field('post_content', $resource_id); ?></div>
  
  </article>

<?php endif; ?>