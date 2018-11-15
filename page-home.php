<?php
/**
 * Template Name: Home Page Template
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$posts = Timber::get_posts(array('post_type' => 'author_post', 'posts_per_page' => -1));

$context['post'] = $post;
$context['posts'] = $posts;
Timber::render( 'page-home.twig', $context );
