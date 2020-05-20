<?php

/**
 *
 * Plugin Name: Saber
 * Plugin URI: https://eatbuildplay.com/plugins/saber
 * Description: Saber is a WordPress plugin that provides a saberwork for building apps. It requires ACF Pro, and integrates with Elementor.
 * Version: 1.0.0
 * Author: Casey Milne, Eat/Build/Play
 * Author URI: https://eatbuildplay.com/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 */

namespace Saber;

define( 'Saber_PATH', plugin_dir_path( __FILE__ ) );
define( 'Saber_URL', plugin_dir_url( __FILE__ ) );
define( 'Saber_VERSION', '1.0.0' );

class Plugin {

  public function __construct() {

    require_once( Saber_PATH . 'src/Template.php' );
    require_once( Saber_PATH . 'src/Shortcode.php' );
    require_once( Saber_PATH . 'src/post_lists/PostList.php' );
    require_once( Saber_PATH . 'src/post_types/PostType.php' );

    require_once( Saber_PATH . 'components/course/src/Course.php' );
    new \Saber\Course\Course();

    require_once( Saber_PATH . 'components/lesson/src/Lesson.php' );
    new \Saber\Lesson\Lesson();

    require_once( Saber_PATH . 'components/student/src/Student.php' );
    new \Saber\Student\Student();

    require_once( Saber_PATH . 'components/register/src/Register.php' );
    new \Saber\Register\Register();

    require_once( Saber_PATH . 'components/exam/src/Exam.php' );
    new \Saber\Exam\Exam();




    add_action('admin_menu', [$this, 'menu']);


  }

  public function menu() {

    acf_add_options_page(array(
      'page_title' 	=> 'Saber',
      'menu_title'	=> 'Saber',
      'menu_slug' 	=> 'saber-dashboard',
      'capability'	=> 'edit_posts',
      'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
      'page_title' 	=> 'Components',
      'menu_title'	=> 'Components',
      'parent_slug'	=> 'saber-dashboard',
    ));

    \add_submenu_page(
      'saber-dashboard',            // parent slug
      'Exams',             // page title
      'Exams',             // sub-menu title
      'edit_posts',                 // capability
      'edit.php?post_type=exam' // your menu menu slug
  );

  }

}

new Plugin();
