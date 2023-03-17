<?php

namespace WPGraphQL\Extensions\PreviousNextPost;

use WPGraphQL\AppContext;
use WPGraphQL\Data\DataSource;
use WPGraphQL\Model\Post;

/**
 * Class Loader
 *
 * This class allows you to see the previousPost and nextPost.
 *
 * @package PreviousNextPost
 * @since   0.1.0
 */
class Loader
{
    public static function init()
    {
        define('WP_GRAPHQL_PREVIOUS_NEXT_POST', 'initialized');
        (new Loader())->bind_hooks();
    }

    public function bind_hooks()
    {
        add_action(
            'graphql_register_types',
            [$this, 'wgpnp_action_register_types'],
            9,
            0
        );
    }

    public function wgpnp_action_register_types()
    {

        register_graphql_field('Post', 'previousPost', [
            'type' => 'Post',
            'args' => array(
                'inSameTerm' => array(
                    'type' => 'Boolean',
                    'description' => __('Whether to show posts from the same category', 'wpgraphql-previous-next-post'),
                ),
            ),
            'description' => __(
                'Previous post'
            ),

            'resolve' => function (Post $post, array $args, AppContext $context) {
                global $post;

                // get post
                $post = get_post($post->ID, OBJECT);

                // setup global $post variable
                setup_postdata($post);

                // Get Post for same category
                $in_same_term = isset($args['inSameTerm']) ? $args['inSameTerm'] : false;

                $post_args = array(
                    'in_same_term' => $in_same_term
                );

                $prev = get_previous_post($post_args);

                wp_reset_postdata();

                if (!$prev) {
                    return null;
                }

                return DataSource::resolve_post_object($prev->ID, $context);
            },
        ]);

        register_graphql_field('Post', 'nextPost', [
            'type' => 'Post',
            'description' => __(
                'Next post'
            ),
            'resolve' => function (Post $post, array $args, AppContext $context) {
                global $post;

                // get post
                $post = get_post($post->ID, OBJECT);

                // setup global $post variable
                setup_postdata($post);

                // Get Post for same category
                $in_same_term = isset($args['inSameTerm']) ? $args['inSameTerm'] : false;

                $post_args = array(
                    'in_same_term' => $in_same_term
                );

                $next = get_next_post($post_args);

                wp_reset_postdata();

                if (!$next) {
                    return null;
                }

                return DataSource::resolve_post_object($next->ID, $context);
            },
        ]);
    }
}
