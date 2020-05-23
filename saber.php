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

define( 'SABER_PATH', plugin_dir_path( __FILE__ ) );
define( 'SABER_URL', plugin_dir_url( __FILE__ ) );
define( 'SABER_VERSION', '1.0.0' );

class Plugin {

  public function __construct() {

    require_once( SABER_PATH . 'src/Template.php' );
    require_once( SABER_PATH . 'src/Shortcode.php' );
    require_once( SABER_PATH . 'src/post_lists/PostList.php' );
    require_once( SABER_PATH . 'src/post_types/PostType.php' );

    require_once( SABER_PATH . 'components/course/src/Course.php' );
    new \Saber\Course\Course();

    require_once( SABER_PATH . 'components/lesson/src/Lesson.php' );
    new \Saber\Lesson\Lesson();

    require_once( SABER_PATH . 'components/student/src/Student.php' );
    new \Saber\Student\Student();

    require_once( SABER_PATH . 'components/register/src/Register.php' );
    new \Saber\Register\Register();

    require_once( SABER_PATH . 'components/exam/src/Exam.php' );
    new \Saber\Exam\Exam();

    add_action('admin_menu', [$this, 'menu']);

  }

  public function menu() {

    acf_add_options_page(array(
      'page_title' 	=> 'Saber LMS',
      'menu_title'	=> 'Saber LMS',
      'menu_slug' 	=> 'saber-dashboard',
      'icon_url'    => 'dashicons-welcome-learn-more',
      'capability'	=> 'edit_posts',
      'position'    => 2,
      'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
      'page_title' 	=> 'Components',
      'menu_title'	=> 'Components',
      'parent_slug'	=> 'saber-dashboard',
    ));

    \add_submenu_page(
      'saber-dashboard',
      'Exams',
      'Exams',
      'edit_posts',
      'edit.php?post_type=exam'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Exam Section',
      'Exam Section',
      'edit_posts',
      'edit.php?post_type=exam_section'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Questions',
      'Questions',
      'edit_posts',
      'edit.php?post_type=question'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Question Options',
      'Question Options',
      'edit_posts',
      'edit.php?post_type=question_option'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Question Banks',
      'Question Banks',
      'edit_posts',
      'edit.php?post_type=question_bank'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Question Answers',
      'Question Answers',
      'edit_posts',
      'edit.php?post_type=question_answer'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Exam Scores',
      'Exam Scores',
      'edit_posts',
      'edit.php?post_type=exam_score'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Exam Score Questions',
      'Exam Score Questions',
      'edit_posts',
      'edit.php?post_type=exam_score_question'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Question Types',
      'Question Types',
      'edit_posts',
      'edit.php?post_type=question_type'
    );

  }

}

new Plugin();
