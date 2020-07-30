<?php

/**
 *
 * Plugin Name: Saber
 * Plugin URI: https://eatbuildplay.com/plugins/saber
 * Description: Saber is a WordPress plugin that provides a saberwork for building apps.
 * Version: 1.1.0
 * Author: Casey Milne, Eat/Build/Play
 * Author URI: https://eatbuildplay.com/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 */

namespace Saber;

define( 'SABER_PATH', plugin_dir_path( __FILE__ ) );
define( 'SABER_URL', plugin_dir_url( __FILE__ ) );
define( 'SABER_VERSION', '1.1.0' );

class Plugin {

  public function __construct() {

    require_once( SABER_PATH . 'src/Template.php' );
    require_once( SABER_PATH . 'src/Shortcode.php' );
    require_once( SABER_PATH . 'src/post_lists/PostList.php' );
    require_once( SABER_PATH . 'src/post_types/PostType.php' );

    /*
     *
     * Component loading
     *
     */

    require_once( SABER_PATH . 'components/intel/src/IntelComponent.php' );
    new \Saber\Intel\IntelComponent();

    require_once( SABER_PATH . 'components/course/src/CourseComponent.php' );
    new \Saber\Course\CourseComponent();

    require_once( SABER_PATH . 'components/lesson/src/LessonComponent.php' );
    new \Saber\Lesson\LessonComponent();

    require_once( SABER_PATH . 'components/student/src/Student.php' );
    new \Saber\Student\Student();

    require_once( SABER_PATH . 'components/register/src/RegisterComponent.php' );
    new \Saber\Register\Register();

    require_once( SABER_PATH . 'components/exam/src/ExamComponent.php' );
    new \Saber\Exam\ExamComponent();

    require_once( SABER_PATH . 'components/access/src/Access.php' );
    new \Saber\Access\Access();

    foreach( $this->componentList() as $componentDef ) {
      $key = $componentDef['key'];
      require_once( SABER_PATH . 'components/' . $key . '/src/' . ucfirst($key) . 'Component.php' );
      $namespace = '\\Saber\\' . ucfirst($key) . '\\' . ucfirst($key) . 'Component';
      new $namespace();
    }

    /* admin menu */
    add_action('admin_menu', [$this, 'menu']);

    /* admin menu separators */
    add_filter( 'parent_file', [$this, 'menuSeparators'] );

    /* highlight saber menu */
    add_filter('parent_file', [$this, 'setParentMenu'], 10, 2 );

    /* script calls */
    add_action('wp_enqueue_scripts', [$this, 'scripts']);

  }

  public function componentList() {

    return [
      [
        'key' => 'dashboard'
      ]
    ];

  }

  public function setParentMenu( $parent_file ) {

    global $submenu_file, $current_screen;

    $cpts = [
      'exam',
      'exam_section',
      'exam_score',
      'exam_score_question',
      'question',
      'question_type',
      'question_option',
      'question_bank',
      'question_answer',
      'course',
      'lesson'
    ];

    if( in_array($current_screen->post_type, $cpts)) {
      $parent_file = 'saber-dashboard';
    }

    return $parent_file;

  }

  public function menu() {

    \add_menu_page(
      'Saber LMS',
      'Saber LMS',
      'edit_posts',
      'saber-dashboard',
      [$this, 'pageDashboard'],
      'dashicons-welcome-learn-more',
      2
    );

    \add_submenu_page(
      'saber-dashboard',
      'Dashboard',
      'Dashboard',
      'edit_posts',
      'saber-dashboard'
    );

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
      'Questions',
      'Questions',
      'edit_posts',
      'edit.php?post_type=question'
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
      'Reports',
      'Reports',
      'edit_posts',
      'saber-reports',
      [$this, 'pageReports']
    );

    \add_submenu_page(
      'saber-dashboard',
      'Settings',
      'Settings',
      'edit_posts',
      'saber-settings',
      [$this, 'pageSettings']
    );

  }

  public static function pageDashboard() {
    print 'this is the Saber dashboard page';
  }

  public static function pageReports() {
    print 'this is the Saber reports page';
  }

  public static function pageSettings() {
    print 'this is the Saber settings page';
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

  public function scripts() {

    wp_enqueue_script(
      'saber-js',
      SABER_URL . 'src/assets/saber.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

  }

}

new Plugin();
