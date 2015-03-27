<?php 
/**
 *
 *  showing grid of courses. this file is inside loop of archive-course.php 
 *
 * 
 * so for each course:
 * 
 * get logo for hover overlay
 * show article
 */


$course_pod = pods('course', get_the_ID() );
$logo = $course_pod->display('course_logo');

if ( '' == $logo )
{
  $logo = get_stylesheet_directory_uri() . '/images/color_logos.png';
}

?>


<article <?php post_class('col-1-3'); ?>>
  <a href="<?php the_permalink(); ?>">
   <h2 style="background: <?php echo get_post_meta(get_the_ID(), 'interface_color', true); ?>"><?php the_title(); ?></h2>
   <?php the_post_thumbnail(); ?>

   <div class="overlay">
    <img src="<?php echo $logo; ?>" alt=""> 
  <div class="description center-text"><?php  the_content(); ?></div>

   </div>
    </a>
</article>




<!--testing more of them. delete-->

<article <?php post_class('col-1-3'); ?>>
  <a href="<?php the_permalink(); ?>">
   <h2 style="background: <?php echo get_post_meta(get_the_ID(), 'interface_color', true); ?>"><?php the_title(); ?></h2>
   <?php the_post_thumbnail(); ?>

   <div class="overlay">
    <img src="<?php echo $logo; ?>" alt=""> 
  <div class="description center-text"><?php  the_content(); ?></div>

   </div>
    </a>
</article><article <?php post_class('col-1-3'); ?>>
  <a href="<?php the_permalink(); ?>">
   <h2 style="background: <?php echo get_post_meta(get_the_ID(), 'interface_color', true); ?>"><?php the_title(); ?></h2>
   <?php the_post_thumbnail(); ?>

   <div class="overlay">
    <img src="<?php echo $logo; ?>" alt=""> 
  <div class="description center-text"><?php  the_content(); ?></div>

   </div>
    </a>
</article><article <?php post_class('col-1-3'); ?>>
  <a href="<?php the_permalink(); ?>">
   <h2 style="background: <?php echo get_post_meta(get_the_ID(), 'interface_color', true); ?>"><?php the_title(); ?></h2>
   <?php the_post_thumbnail(); ?>

   <div class="overlay">
    <img src="<?php echo $logo; ?>" alt=""> 
  <div class="description center-text"><?php  the_content(); ?></div>

   </div>
    </a>
</article>