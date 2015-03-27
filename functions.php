<?php
/**
 * TAU v1.0 functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes

 */

/**
 * Basic setup. 
 * 
 * add theem support 
 * add scripts
 */


if ( ! function_exists( 'tau_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function tau_setup() {

	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'tau' ),
		'dashboard'  => __( 'Dashboard Menu', 'tau' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
//	add_theme_support( 'post-formats', array(
//		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
//	) );

	


	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );
}



endif; // tau_setup
//run the function
add_action( 'after_setup_theme', 'tau_setup' );

/**
 * Register widget area.
 * not being used yet...
 * @since snp 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tau_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'snp' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'snp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tau_widgets_init' );






/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function tau_scripts() {
	

	// Load our main stylesheet.
	wp_enqueue_style( 'tau-style', get_stylesheet_uri() );

  
  wp_enqueue_style( 'jquery-ui-custom-theme', get_template_directory_uri() . '/js/jquery-ui.theme.min.css');
  
   wp_enqueue_style( 'jquery-ui-custom', get_template_directory_uri() . '/js/jquery-ui.min.css');
  
   wp_enqueue_style( 'jquery-ui-custom-structure', get_template_directory_uri() . '/js/jquery-ui.structure.min.css');
  
  
	// Load the Internet Explorer specific stylesheet.
//	wp_enqueue_style( 'snp-ie', get_template_directory_uri() . '/css/ie.css', array( 'tau-style' ), '20141010' );
//	wp_style_add_data( 'tau-ie', 'conditional', 'lt IE 9' );

  
   //fancy box js
   wp_enqueue_script( 'fancy-script', get_template_directory_uri() . '/js/fancybox/source/jquery.fancybox.pack.js', array( 'jquery' ), '20842', true );
  
  
  //fancy box thumb js
   wp_enqueue_script( 'fancy-thumb-script', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-thumbs.js', array( 'fancy-script' ), '25242', true );
  
  
  
  //hover course lsiting sript
   wp_enqueue_script( 'hover-dir-script', get_template_directory_uri() . '/js/jquery.hoverdir.js', array( 'jquery' ), '2542', true );

  //fancybox css
  wp_enqueue_style( 'fancybox-styles', get_template_directory_uri() . '/js/fancybox/source/jquery.fancybox.css', array( 'tau-style' ), '20144010' );
  
  //fancybox thumb css
  wp_enqueue_style( 'fancybox-thumb-styles', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-thumbs.css', array( 'tau-style' ), '20171010' );
	
  
  
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


  wp_enqueue_script( 'tau-script', get_template_directory_uri() . '/js/tau.js', array( 'jquery', 'fancy-script'), '20212', true );
  
  wp_enqueue_script( 'retina-script', get_template_directory_uri() . '/js/retina.min.js', array( 'jquery' ), '20212', true );
	
 
}
add_action( 'wp_enqueue_scripts', 'tau_scripts' );




/**
 * 
 * # shamais custom functions # 
 * 
 * Checks if a particular user has a role. 
 * Returns true if a match was found.
 */



/**
 * @param string $role Role name.
 * @param int $user_id (Optional) The ID of a user. Defaults to the current user.
 * @return bool
 * 
 * example use for the current user
 * if ( check_user_role( 'customer' )
 */


function check_user_role( $role, $user_id = null ) {
 
    if ( is_numeric( $user_id ) )
	$user = get_userdata( $user_id );
    else
        $user = wp_get_current_user();
 
    if ( empty( $user ) )
	return false;
 
    return in_array( $role, (array) $user->roles );
}
 

/**
 * hide admin bar
 */
function disable_admin_bar() { 
	if( check_user_role('subscriber') )
		add_filter('show_admin_bar', '__return_false');	
}

add_action( 'after_setup_theme', 'disable_admin_bar' );
 



/**
 * Redirect back to homepage and not allow access to 
 * WP admin for Subscribers.
 */
function redirect_admin(){
	if( check_user_role('subscriber') ){
		wp_redirect( site_url() );
		exit;		
	}
}
add_action( 'admin_init', 'redirect_admin' );






/**
 * Lesson Redirects
 * 
 * redirect not logged in user based on locations
 * 
 * if user is on a lesson and not logged in, go back to course front, if there is one.
 * 
 * if user is logged in and on a course page with no domian go to first lesson of that course.
 * 
 * if user is not logged in and its a course front, but has no domain go to front of tau.
 * 
 * 
 */

function not_logged_template_redirect()
{
  
 if(get_post_type() == 'lesson' && is_user_logged_in() && get_post_meta(get_the_ID(), 'topic_head', true))
 {
   $lesson = pods( 'lesson', get_the_id() );
	$related_course = $lesson->field( 'lessons_course.ID' );  //returns one course
	
	if ( ! empty( $related_course ) )
    {
      $course_id = $related_course;
      wp_redirect( get_permalink( $course_id ) );
         exit();
    }
   
 }
 
  if(get_post_type() == 'lesson' && ! is_user_logged_in())
  {
    $lesson = pods( 'lesson', get_the_id() );

	$related_course = $lesson->field( 'lessons_course.ID' );  //returns one course
	
	if ( ! empty( $related_course ) )
    {
      $course_id = $related_course[0];
      
      if( get_post_meta($course_id, 'has_domain', true) )
      {
         wp_redirect( get_permalink( $course_id ) );
         exit();
      }
      else
      {
        wp_redirect( home_url() );
        exit();
      }
  
	} //endif ! empty ( $related )
       
  }  
  
    //go to first lesson if user is logged in and trying to get to a course that has no domain.
  if(is_user_logged_in() && get_post_type() == 'course' && ! is_post_type_archive('course') && ! is_front_page() && ! get_post_meta(get_the_ID(), 'has_domain', true) )
  {
   
    $course = pods('course', get_the_ID() );
    $lessons = $course->field( 'course_lessons.ID' );
    if(get_post_meta($lessons[0], 'topic_head', true)){
      wp_redirect(get_permalink($lessons[1]) );
    exit();
    }
    else{
    wp_redirect(get_permalink($lessons[0]) );
    exit();
    }
 
 }
  
  
  
  
  //user is logged out and on any other page than logged out
   if(! is_front_page() && ! is_user_logged_in() )
    {
        wp_redirect( home_url() );
        exit();
    }
  
  //user is logged in and on logged out page
  if(is_front_page() && is_user_logged_in()  )
  {
    wp_redirect( home_url('/courses/') );
        exit();
  }
  

}
add_action( 'template_redirect', 'not_logged_template_redirect' );




//add style to editor for lessons
function my_theme_add_editor_styles() {
    global $post;

    $my_post_type = 'lesson';

    // New post (init hook).
    if ( stristr( $_SERVER['REQUEST_URI'], 'post-new.php' ) !== false
            && ( isset( $_GET['post_type'] ) === true && $my_post_type == $_GET['post_type'] ) ) {
        add_editor_style( get_stylesheet_directory_uri()
            . '/css/editor-style-' . $my_post_type . '.css' );
    }

    // Edit post (pre_get_posts hook).
    if ( stristr( $_SERVER['REQUEST_URI'], 'post.php' ) !== false
            && is_object( $post )
            && $my_post_type == get_post_type( $post->ID ) ) {
        add_editor_style( get_stylesheet_directory_uri()
            . '/css/editor-style-' . $my_post_type . '.css' );
    }
}
add_action( 'init', 'my_theme_add_editor_styles' );
add_action( 'pre_get_posts', 'my_theme_add_editor_styles' );




function set_custom_queries($query){
  
  
  if(get_query_var('coursenum') !== '' && $query-> is_post_type_archive('resource') && $query->is_main_query() && ! is_admin()  )
  {
    $course_id = get_query_var('coursenum');
   
      $related_resources = get_related_pod_ids('course', $course_id, 'resources_page');
 
    if(! empty($related_resources) ){
    $query->set('post__in', $related_resources);
    }
    
    else{
      $query->set('post__in', array(0));
    }
    
  }
  
  elseif(get_query_var('coursenum') == '' && $query-> is_post_type_archive('resource') && $query->is_main_query() && ! is_admin()  )
  {
    $query->set('post__in', array(0));
   
  }
  
  
  
}

add_action( 'pre_get_posts', 'set_custom_queries' );

/**
 *
 *  puts my query arg into the query var and makes it avaloiable in pre_get_posts 
 *
 */

function add_query_vars_filter( $vars ){
  $vars[] = "coursenum";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );













//check if user completed this leson by shamai. using a new tracking pod
//if user did not complete lesson show gform. if returns false show form
function check_lesson_completed($lesson_id = 0, $course_id = 0)
{
  if($lesson_id == 0 || $course_id == 0)
    return false;


  //get tracking pod that matches this logged in user and this course
 $tracking_pods = pods('tracking', array(
 'where' => 'enrolled_user.ID = "' . get_current_user_id() . '" AND completed_lessons.ID = "' . $lesson_id . '" '
));
  

  
 
  
    if ( is_object( $tracking_pods ) && 0 < $tracking_pods->total() ) //should return one. one per user
    {
     
     return true;
      
    }
  
  
  return false;
    
}




/**
 *
 * Brilliant form for tracking users.
 * After 'next lesson' is pressed, form is submitted.
 * Check if the tracking pod with this user and this course already exists using Where filter. 
 * if it does, add this lesson.
 * 
 * the form does not show up if this lesson was completed already due to another function 
 * check_lesson_completed
 * 
 * if it doesnt exists it creates it. 
 *
 */


//using form:  gravity_form( 1, false, false, false, array('course' => $course_id, 'lesson' => get_the_ID(), 'next_lesson' => $next_link ), true);
//saving the hidden fields to pods current user fields suing add to, to push onto the array
add_action("gform_after_submission_1", "enroll_and_complete", 10, 2);
function enroll_and_complete($entry, $form)
{
 
  //get the current user
  $current_user_id = get_current_user_id();
  
 //get user name for a new pod item if needed
  $user = get_user_by( 'id', $current_user_id);
  $user = $user->first_name . ' ' . $user->last_name;
  
  //get gravity form fields
  $course_id = $entry['1'];
  $lesson_id = $entry['2'];

  //does a tracking for this user exist
   $tracking_pods = pods('tracking', array(
 'where' => 'enrolled_user.ID = "' . $current_user_id . '" AND enrolled_course.ID = "' . $course_id . '" '
));
  
  if ( is_object( $tracking_pods ) && 0 < $tracking_pods->total() ) //if pod exists
  {  
      $tracking_pods->add_to( 'completed_lessons', $lesson_id);
      $tracking_pods->save( 'enrolled_course', $course_id);
      
    }
  else
  {
    $tracking_pods = pods('tracking');
    // To add a new item.
$data = array( 
    'name' => $user, 
    'completed_lessons'=> $lesson_id,
    'enrolled_course' => $course_id,
    'enrolled_user' => $current_user_id,
    'post_status' => 'publish'
); 
  
   $tracking_pods->save( $data ); 
    
  }
  
}
  


/**
 *
 * Progress bar.
 * takes related lesson ids from current course
 * Gets all real lessons (no topic heads). Add 1 for quiz. 
 * -and match what the user has completed 
 * 
 * returns array with info on tracking
 *
 */

function get_progress_bar($course_id = 0, $related_lessons = 0){
  $num_of_lessons = 0;
  $num_of_finished_lessons = 0;
  $quiz_status = '';
  
  if($course_id !== 0){
    
  foreach($related_lessons as $id){
    if(! get_post_meta($id, 'topic_head', true) ){
      $num_of_lessons++;
    }
    
  }
// //add the quiz
//  $num_of_lessons++;  //total of all lessons and the quiz.
//  
  
  //get current users lessons by getting tracking pod and its related lessons
    $tracking_pod = get_current_user_tracking_pod($course_id);
  if($tracking_pod !== 0)
     while ($tracking_pod->fetch())
     {
//        if($tracking_pod->field('quiz_status') == '1' ){
//          $num_of_finished_lessons++;  //finished quiz add to lesson
//          $finished_quiz = true;
//        }
        $quiz_status = $tracking_pod->display('quiz_status');
         $completed_lessons =  $tracking_pod->field("completed_lessons.ID");
        if (! empty ($completed_lessons) )
        {
         foreach($completed_lessons as $lesson_id)
         {
           $num_of_finished_lessons++;
           
         }
        }
        
     }
   
  
  //now we compare
  $percentage = ($num_of_finished_lessons/$num_of_lessons) * 100; //quiz included in percentage
  

  
   $arr = array();
   $arr['quiz_status'] = $quiz_status;
   $arr['percentage'] = $percentage;
   $arr['lessons_completed'] = $num_of_finished_lessons ; 
   $arr['lessons'] = $num_of_lessons ;
  
  return $arr;
  }
  else 
    return 0;
}


/**
 *
 *  is user finished this lesson
 *
 */
function is_user_finished($lesson_id, $course_id){
   
   $tracking_pods = pods('tracking', array(
 'where' => 'enrolled_user.ID = "' . get_current_user_id() . '" AND enrolled_course.ID = "' . $course_id . '" AND completed_lessons.ID =  "' . $lesson_id . '"'
));
  if ( is_object( $tracking_pods ) && 0 < $tracking_pods->total() ) //if pod exists
  {
    return true;
  }
  else
  {
    return false;
  }
}


/**
 *
 *  user finish quiz? 
 *
 */
function is_user_finished_quiz($course_id){
   
   $tracking_pod = get_current_user_tracking_pod($course_id);
  if ($tracking_pod !== 0 ) //if pod is returned
  {
    return $tracking_pod->field('quiz_status') == '1' ? true: false;
  }
  else
  {
    return false;
  }
  
}


/**
 *
 *  I keep getting relted field id's. i might as well make it a function 
 *
 * @param $the_pod the original pod
 * @param $id the pods id
 * @param related_field. the related field of id's to get
 * 
 * reutns 1 number or an array of numbers 
 */
function get_related_pod_ids($the_pod, $id, $related_field)
{
  //get the pod
  $pod = pods($the_pod, $id );
  
  //get the pod related field id's. return
  $related_ids =  $pod->field("$related_field.ID");
  if (! empty ($related_ids) )
  {
  return $related_ids;   //might return 1 or an array... beware
  }
  else
  {
    return 0;
  }
  
  
}

/**
 *
 *  getting the tracking pod. using over and over might as well make a function 
 *
 */

function get_current_user_tracking_pod($course_id = 0){
  
   $tracking_pods = pods('tracking', array(
 'where' => 'enrolled_user.ID = "' . get_current_user_id() . '" AND enrolled_course.ID = "' . $course_id . '"'
));
  
   if ( is_object( $tracking_pods ) && 0 < $tracking_pods->total() ) //if pod exists
  {
    return $tracking_pods; 
   }
  else{
    return 0;
  }
  
  
}


/**
 *
 *  allow clients to edit resources by pre-filling the resource and savign to resource
 *
 */

add_filter('gform_field_value_resource_content', 'populate_content_function');
function populate_content_function($value){
  
  if(isset($_GET['resource_id']))
  {
    $resource_id = $_GET['resource_id']; 
    $resource = pods('resource', $resource_id);
    $resource_content = $resource->field('content');
    return $resource_content;
  }
  return '';
  
}


add_filter('gform_field_value_resource_title', 'populate_title_function');
function populate_title_function($value){
  
  if(isset($_GET['resource_id']))
  {
    $resource_id = $_GET['resource_id']; 
    $resource = pods('resource', $resource_id);
    $resource_content = $resource->field('title');
    return $resource_content;
  }
  return '';
  
}


add_filter('gform_field_value_resource_publish', 'populate_publish_function');
function populate_publish_function($value){
  
  if(isset($_GET['resource_id']))
  {
    $resource_id = $_GET['resource_id']; 
    $resource = pods('resource', $resource_id);
    $date = new DateTime($resource->display('post_date'));
    $resource_content = $date->format('m/d/Y');
    return $resource_content;
  }
  return '';
  
}

add_filter('gform_field_value_resource_delete', 'populate_delete_function');
function populate_delete_function($value){
  
  if(isset($_GET['resource_id']))
  {
    $resource_id = $_GET['resource_id']; 
    $resource = pods('resource', $resource_id);
    $resource_content = $resource->display('delete_resource');
    return $resource_content;
  }
  return '';
  
}



/**
 *
 *  restrict media library to authors images only 
 *
 */
//restrict authors to only being able to view media that they've uploaded
function ik_eyes_only( $wp_query ) {
	//are we looking at the Media Library or the Posts list?
	if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) !== false
	|| strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
		//user level 5 converts to Editor
		if ( !current_user_can( 'level_5' ) ) {
			//restrict the query to current user
			global $current_user;
			$wp_query->set( 'author', $current_user->id );
		}
	}
}

//filter media library & posts list for authors
add_filter('parse_query', 'ik_eyes_only' );

add_action('pre_get_posts','ml_restrict_media_library');

function ml_restrict_media_library( $wp_query_obj ) {
    global $current_user, $pagenow;
    if( !is_a( $current_user, 'WP_User') )
    return;
    if( 'admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments' )
    return;
    if( !current_user_can('manage_media_library') )
    $wp_query_obj->set('author', $current_user->ID );
    return;
}




/**
 *
 *  overwrite the resource if editing
 *
 */

add_action( 'gform_after_submission_3', 'save_existing_resource', 10, 2 );

function save_existing_resource($entry, $form){
  $resource_id = $entry['8'];
 $resource = pods('resource', $resource_id);
  
  $data = array( 
    'title' =>          $entry['6'], 
    'content' =>        $entry['7'], 
    'post_date'=>    $entry['1'],
    'delete_resource'=> $entry['2'],
); 
  
  $resource->save($data);
}



/**
 *
 *  check if resource date turn off has passed 
 *
 */

function is_date_turn_off_past($post_id){
  
  $turn_off = strtotime( get_post_meta($post_id, 'delete_resource', true) );
  $today = strtotime( date('m/d/Y'));
  
  if($turn_off <= $today)
   return true;
  else
    return false;
}