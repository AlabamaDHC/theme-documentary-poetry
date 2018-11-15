<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

$author_category_id = get_field( "author_post" );
// $author_post = new Timber\Post( $author_id );
$author_post = Timber::get_post(array('post_type' => 'author_post', 'cat' => $author_category_id)); 

$context['author_id'] = $author_category_id;
$context['author_post'] = $author_post;


if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
