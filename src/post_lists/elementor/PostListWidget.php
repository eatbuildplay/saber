<?php

namespace Saber;

class PostListWidget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'saber_post_list';
	}

	public function get_title() {
		return __( 'Post List', 'saber' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return [ 'general' ];
	}

  protected function _register_controls() {



		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'saber' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    /*
     * List of Elementor Templates
     */
    $elTemplates = get_posts([
     'posts_per_page' => -1,
     'post_type' => 'elementor_library'
    ]);
    $options = [];
    foreach( $elTemplates as $templatePost ) {
      $options[$templatePost->ID] = $templatePost->post_title;
    }

    $this->add_control(
			'item_template',
			[
				'label' => __( 'Item Template', 'saber' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'input_type' => 'select',
        'options' => $options
			]
		);

    $this->add_control(
			'post_type',
			[
				'label' => __( 'Post Type', 'saber' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text'
			]
		);

		$this->end_controls_section();

	}

  protected function render() {

		$settings = $this->get_settings_for_display();

		$postType = $settings['post_type'];

		$posts = get_posts([
			'posts_per_page' => -1,
      'post_type' => $postType
		]);



		if( !empty( $posts )) :

			global $post;
			$originalPost = $post;

			foreach( $posts as $postItem ) {

				print '<div class="post-list-item">';
				$templatePost = get_post( $settings['item_template'] );

				$post = $postItem;
				setup_postdata($post);
				print \ElementorPro\Plugin::elementor()->frontend->get_builder_content_for_display( $templatePost->ID );
				print '</div>';

			}

			// reset post so rest of page works normally
			$post = $originalPost;

		endif;

    /*
    $template = new Template();
    $template->path = 'src/post_lists/templates/';
    $template->name = 'post-list-item';
    $template->data = [
      'post' => $post
    ];

    $template->render();
    */

	}

}
