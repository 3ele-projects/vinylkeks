<?php

/**
 * Registers the `disc` post type.
 */
function disc_init() {
	register_post_type( 'disc', array(
		'labels'                => array(
			'name'                  => __( 'Discs', 'vinylkeks' ),
			'singular_name'         => __( 'Disc', 'vinylkeks' ),
			'all_items'             => __( 'All Discs', 'vinylkeks' ),
			'archives'              => __( 'Disc Archives', 'vinylkeks' ),
			'attributes'            => __( 'Disc Attributes', 'vinylkeks' ),
			'insert_into_item'      => __( 'Insert into disc', 'vinylkeks' ),
			'uploaded_to_this_item' => __( 'Uploaded to this disc', 'vinylkeks' ),
			'featured_image'        => _x( 'Featured Image', 'disc', 'vinylkeks' ),
			'set_featured_image'    => _x( 'Set featured image', 'disc', 'vinylkeks' ),
			'remove_featured_image' => _x( 'Remove featured image', 'disc', 'vinylkeks' ),
			'use_featured_image'    => _x( 'Use as featured image', 'disc', 'vinylkeks' ),
			'filter_items_list'     => __( 'Filter discs list', 'vinylkeks' ),
			'items_list_navigation' => __( 'Discs list navigation', 'vinylkeks' ),
			'items_list'            => __( 'Discs list', 'vinylkeks' ),
			'new_item'              => __( 'New Disc', 'vinylkeks' ),
			'add_new'               => __( 'Add New', 'vinylkeks' ),
			'add_new_item'          => __( 'Add New Disc', 'vinylkeks' ),
			'edit_item'             => __( 'Edit Disc', 'vinylkeks' ),
			'view_item'             => __( 'View Disc', 'vinylkeks' ),
			'view_items'            => __( 'View Discs', 'vinylkeks' ),
			'search_items'          => __( 'Search discs', 'vinylkeks' ),
			'not_found'             => __( 'No discs found', 'vinylkeks' ),
			'not_found_in_trash'    => __( 'No discs found in trash', 'vinylkeks' ),
			'parent_item_colon'     => __( 'Parent Disc:', 'vinylkeks' ),
			'menu_name'             => __( 'Discs', 'vinylkeks' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'disc',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'disc_init' );

/**
 * Sets the post updated messages for the `disc` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `disc` post type.
 */
function disc_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['disc'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Disc updated. <a target="_blank" href="%s">View disc</a>', 'vinylkeks' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'vinylkeks' ),
		3  => __( 'Custom field deleted.', 'vinylkeks' ),
		4  => __( 'Disc updated.', 'vinylkeks' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Disc restored to revision from %s', 'vinylkeks' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Disc published. <a href="%s">View disc</a>', 'vinylkeks' ), esc_url( $permalink ) ),
		7  => __( 'Disc saved.', 'vinylkeks' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Disc submitted. <a target="_blank" href="%s">Preview disc</a>', 'vinylkeks' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Disc scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview disc</a>', 'vinylkeks' ),
		date_i18n( __( 'M j, Y @ G:i', 'vinylkeks' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Disc draft updated. <a target="_blank" href="%s">Preview disc</a>', 'vinylkeks' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'disc_updated_messages' );
