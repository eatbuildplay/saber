<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5e7744a03a18f',
	'title' => 'Course',
	'fields' => array(
		array(
			'key' => 'field_5e90755a83bee',
			'label' => 'Display Order',
			'name' => 'display_order',
			'type' => 'number',
			'instructions' => 'Enter a number used for sorting the courses on the main Course List. The courses will be sorted in ASC (ascending) lowest to highest.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 1,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_5e90c51bc16a1',
			'label' => 'Intro',
			'name' => 'intro',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5edb92e8ce7a8',
			'label' => 'Access Permissions',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5edb9301ce7a9',
			'label' => 'Course Access',
			'name' => 'course_access',
			'type' => 'button_group',
			'instructions' => 'If selected everybody will be able to enroll in this course.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				1 => 'Public Access',
				2 => 'All Registered Users',
				3 => 'Course Registered Only',
			),
			'allow_null' => 0,
			'default_value' => 0,
			'layout' => 'horizontal',
			'return_format' => 'value',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'course',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
