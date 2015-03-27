
<?php 
/**
 *
 *  for lessons, the app view model continues to get and check next and prev links 
 *
 */
?>

  
  <div class="col-4-5 nogutters main-area">
  
  
 <div class="col-full">
     <h1 clas="interfacecolor"><strong><a href="<?php the_permalink();  ?>"><?php echo $current_title; ?></a></strong></h1>
         
  </div>
  
   
  
    <div class="col-2-3">
      <div class="the-content">
       
        <?php
//get the thumbnail url so i can use it on the url of outter anchor
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);

?>
      <a class="fancybox-thumb featured" title="something" rel="fancybox-thumb" href="<?php echo $thumb_url[0]; ?>"><?php the_post_thumbnail('full'); ?></a>
       
        <article><?php the_content(); ?></article>
      </div>
      
      
      
      <div class="nav-links">
      
     
      <?php if($prev_link == ''): ?>
      <div class="col-1-2 nogutters">
      </div>
      
      <?php else: ?>
      <div class="col-1-2 nogutters left-skew">
      <div class="skewed">
        <a href="<?php echo $prev_link ?>">Previous Lesson</a>
      </div>
      </div>
      <?php endif; ?>
      
      <?php if(! $next_link == ''): ?>
      <div class="col-1-2 nogutters text-right right-skew">
       <div class="skewed ">
         <?php if(check_lesson_completed(get_the_ID(), $course_id) ): ?>
           <a href="<?php echo $next_link ?>">Next Lesson</a>
           
           <?php
  else:
  gravity_form( 1, false, false, false, array('course' => $course_id, 'lesson' => get_the_ID(), 'next_lesson' => $next_link ), true); endif; ?>
       
        </div>
      </div>
      
      <?php else: ?>
      <div class="col-1-2 nogutters text-right right-skew">
       <div class="skewed quiz-button button-text">
           <a href="#">Take The Quiz</a>
        </div>
      </div>
      
      <?php endif; ?>
      
      </div>
      
    </div>
    
    
    
    <div class="col-1-3 lesson-sidebar">
     
      <?php echo get_post_meta(get_the_ID(), 'lesson_sidebar', true); ?>
      
    </div>
  </div>
  
  
  
  
  
<!--  closing module-->
</div>