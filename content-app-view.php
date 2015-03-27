  <?php 

/**
 *
 * 
 *  if on a single can be used inside loop.
 * else use before the loop.
 *
 *  what this page does:
 * 
 * displays the course logo
 * displays the course progress
 * displays user name
 * 
 * displays complete menu and links
 * 
 * NOTE: make sure to close app-view-odule with </div> after your loop
 * 
 * 
 * 
 */

//get the current user to show
$current_user = wp_get_current_user();
$username = $current_user->first_name . ' ' . $current_user->last_name;


//get course id from related lesson field
$course_id = 0;
if( get_post_type() == 'lesson'){
$related_course = get_related_pod_ids( "lesson", get_the_id(), 'lessons_course' );
$course_id = $related_course;
}


if(get_post_type() == 'resource'){
  $related_course = get_related_pod_ids( "resource", get_the_id(), 'resources_course' );
  $course_id = $related_course;
}
    

/**
 *
 *  if this is not a lesson or course page we get the course id from url param 
 *
 */

if(isset($_GET['coursenum']) && $course_id == 0 && is_numeric($_GET['coursenum']))
  $course_id = $_GET['coursenum'];



/**
 *
 * is this lesson is part of course with its own domain? 
 * if not we can show link to go back to other courses in menu
 *
 */

$show_other_courses = get_post_meta($course_id, 'has_domain', true);


//get all courses in this lesson from the course and next and rpev lessons
//now that we have the related course id we go through that course and get all the lessons      
$course = pods('course', $course_id);

$logo = $course->display('course_logo');
if ( '' == $logo )
{
  $logo = get_stylesheet_directory_uri() . '/images/color_logos.png';
}




$next_link_set = false;   //is the next link set right?
$prev_link_set = false;   //is the prev link set right?
$next_link = '';          //the next permalink  
$prev_link = '';          //the prev permlaink
$output= '';              //ul li outpout for menu
$current = '';            //holds class='current' 
$permalink = '#';
$lesson_id = 0;
$current_title = '';


/**
 *
 *  going through each lesson and setting up the lessons menu 
 *
 */

 
$related_lessons = $course->field( 'course_lessons.ID' );  //getting each lesson

//here is where you would pass $related lessons to et progress bar

$progress = get_progress_bar($course_id, $related_lessons);


if (! empty ($related_lessons) )
{
 foreach($related_lessons as $lesson)
 {
   
   $lesson_id = $lesson;  //getting each lesson id. 
  
   
   //setting class="fnished" for checkmark on lesson
   $finished = is_user_finished($lesson_id, $course_id) ? 'finished' : '';
   
   $lesson_alt_title = get_post_meta($lesson_id, 'alternative_title', true);  //alternative title for same name as other lessons problem of hard for us to find lesson in list of title all set to 'intro'.

if( $lesson_alt_title == '')
  $lesson_title = get_the_title($lesson_id);
else
  $lesson_title = $lesson_alt_title;
   
   $lesson_title = ucwords($lesson_title); 
   
      //if we already got the current lesson and now this is toggled true 
    if($next_link_set  && ! get_post_meta($lesson_id, 'topic_head', true))
    {
      $next_link = get_permalink($lesson_id);  //store this lesson as next lesson if its after current and not topic head
      $next_link_set = false; //shut off 
     }
      
       
     //check if this is current page viewing
       if(get_the_ID() == $lesson_id)
       {
         $current = ' current ';
         $current_title = $lesson_title;
         $prev_link_set = true; //will no longer set link.
         $next_link_set = true;  //will set next link.
         //this permlaink is #
       }
       else   //not current lesson
       {
         $current = '';
         $permalink = get_permalink($lesson_id);  //get this permalink 
       }
       
       if(! $prev_link_set && ! get_post_meta($lesson_id, 'topic_head', true))
       $prev_link = $permalink;  //store this non current lesson as previous lesson
       
      
       
   
   //the output
      //if topic head. make no link 
       if(get_post_meta($lesson_id, 'topic_head', true))
         $output .= '<li><a class="topic-head" href="#">'. $lesson_title . '</a></li>';
       else
       $output .= '<li><a class="' . $current . ' ' . $finished .  '" href="' . $permalink . '"> '. $lesson_title . '</a></li>';
     
 } //end foreach
        
     
}   //endif
        ?>
      
        
<?php 
/**
 *
 *  attach quiz at end 
 *
 */

$quiz_id = $course->display('quiz_form_id');
$quiz_url = home_url( $path = 'exam') . '/?quiz=' . $quiz_id;

if( is_user_finished_quiz($course_id) ){
 $output .= '<li><a class="quiz finished" href="' . $quiz_url . '">Quiz</a></li>';
 }
else{
    $output .= '<li><a class="quiz" href="' . $quiz_url . '">Quiz</a></li>';
}

?>            
<!--  beginning page        -->

  
   
 
   
 <style>
  
    
  .button, .quiz-button{ background: <?php echo get_post_meta($course_id, 'button_color', true); ?> ; } 
  .button-text{ color: <?php echo get_post_meta($course_id, 'button_text_color', true); ?> ; } 
    
  .highlight, .current, body .app-menu li a:hover, .app-menu li a.<?php echo get_post_type(); ?>{ color: <?php echo get_post_meta($course_id, 'highlight_color', true); ?> ; }
    
     .alt-highlight{ color: <?php echo get_post_meta($course_id, 'alt_highlight_color', true); ?> ; }
    
    .alt-background-highlight{ background: <?php echo get_post_meta($course_id, 'alt_highlight_color', true); ?> ; }
    
    
  .background-highlight, .fancybox-thumb:before, .progress-bar .percentage{ background: <?php echo get_post_meta($course_id, 'highlight_color', true); ?> ; 
  }
  .background-interface-color, .sidebar aside h2, .sidebar aside h3{ background: <?php echo get_post_meta($course_id, 'interface_color', true); ?> ; }
    
    .interface-color, article h2, article h3, article p{ color: <?php echo get_post_meta($course_id, 'interface_color', true); ?> ; }
  
  .text-on-interface-color{color: <?php echo get_post_meta($course_id, 'text_on_interface_color', true); ?> ; }
    
    <?php $backdrop =  get_post_meta($course_id, 'course_backdrop', true);
    $backdrop = $backdrop['guid']; ?>
    .app-view{ background: url('<?php echo $backdrop; ?>') }
    
    .progress-bar .percentage{ width: <?php echo $progress['percentage'] ?>% ; }
  
  </style>
  
  
  
  
  
  
  <div class="app-view-module wrap cf">
  <header>  
   
   
    <div class="logo col-1-5 background-highlight nogutters">
    <a  href="<?php echo get_permalink($course_id); ?>">
    <img src="<?php echo $logo; ?>" alt="">
    </a>
    </div>
    
    <div class="col-2-5 progress">
      <p>Course Status:</p>
      <div class="progress-bar"><div class="percentage"></div></div>
      <div class="progress-info highlight"><p class="left"><?php echo $progress['lessons_completed']; ?>/<?php echo $progress['lessons']; ?> lessons completed <p class="right">Quiz <?php  echo ($progress['quiz_status'] == '') ?  'not taken' : $progress['quiz_status']; ?>
      
      </span> </p></div>
    </div>
  
    
    
    <div class="col-2-5"><p class="text-right username"><strong>Welcome Back <?php echo $username; ?></strong></p></div>
    
    
  </header>
  
  
  
  
  <div class="col-1-5 app-menu background-interface-color cf m0 nogutters">
    
    <ul class="text-on-interface-color">
     
     
     <?php if(! $show_other_courses) : //check if we can show link to go back to all courses ?>
       <li><a href="<?php echo get_post_type_archive_link( 'course' ); ?>"><span class="icontau-courses"></span>Courses</a></li>
     <?php endif; ?>
     
     
      <li class="current"><a href="#"><span class="icontau-lessons"></span>Course:</a>
        
      <ul>
        <?php echo $output; ?>
      </ul>
      
      </li>
      
     <?php $resources_permalink = $course->field('resources_page.permalink'); ?>
      
       <li><a class="resource" href="<?php echo end($resources_permalink);?>"><span class="icontau-bolt"></span> Resources</a></li>
      <li><a class="reward" href="#"><span class="icontau-rewards"></span> Rewards</a></li>
      <li><a class="webinar" href="#"><span class="icontau-desktop"></span> Webinars</a></li>
      <li><a class="settings" href="#"><span class="icontau-person"></span> Settings</a></li>
      <li><a href="<?php echo get_edit_post_link( $course_id); ?>">edit course</a></li>
    </ul>
  </div>
  
    
    
    
<!--    end app view module-->
 
<?php  
  if(is_singular('lesson'))
  {
    include(locate_template('content-lesson.php'));
  }

   

    