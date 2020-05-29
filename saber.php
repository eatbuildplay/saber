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

    require_once( SABER_PATH . 'components/phrase/src/Phrase.php' );
    new \Saber\Phrase\Phrase();

    require_once( SABER_PATH . 'components/word/src/Word.php' );
    new \Saber\Word\Word();

    /* admin menu */
    add_action('admin_menu', [$this, 'menu']);

    /* admin menu separators */
    add_filter( 'parent_file', [$this, 'menuSeparators'] );

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

    \add_submenu_page(
      'saber-dashboard',
      'Courses',
      'Courses',
      'edit_posts',
      'edit.php?post_type=course'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Lessons',
      'Lessons',
      'edit_posts',
      'edit.php?post_type=lesson'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Phrases',
      'Phrases',
      'edit_posts',
      'edit.php?post_type=phrase'
    );

    \add_submenu_page(
      'saber-dashboard',
      'Words',
      'Words',
      'edit_posts',
      'edit.php?post_type=word'
    );

    \add_submenu_page(
      'saber-dashboard',
      'wp-menu-separator',
      '',
      'read',
      'separator1',
      ''
    );

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
      'wp-menu-separator',
      '',
      'read',
      'separator3',
    );

    \add_submenu_page(
      'saber-dashboard',
      'Question Types',
      'Question Types',
      'edit_posts',
      'edit.php?post_type=question_type',
      '',
      130
    );

    acf_add_options_sub_page(array(
      'page_title' 	=> 'Settings',
      'menu_title'	=> 'Settings',
      'parent_slug'	=> 'saber-dashboard',
      'position'    => 1
    ));

  }

  function menuSeparators( $parent_file ) {

  	$submenu = &$GLOBALS['submenu'];

  	foreach( $submenu as $key => $item ) {
  		foreach ( $item as $index => $data ) {
  			if ( in_array( 'wp-menu-separator', $data, true ) ) {
  				$data[0] = '<div class="separator"><hr /></div>';
  				$submenu[ $key ][ $index ] = $data;
  			}
  		}
  	}

  	return $parent_file;

  }

}

new Plugin();
