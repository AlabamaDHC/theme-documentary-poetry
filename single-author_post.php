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

$author_cat = get_field('author_post_category');
$posts = Timber::get_posts(array('post_type' => 'post', 'cat' => $author_cat, 'posts_per_page' => -1));

$context['post'] = $post;
$context['posts'] = $posts;

Timber::render( 'single-author_post.twig', $context );
