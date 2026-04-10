---
name: rest-api-endpoint
description: >
  Trigger when: creating custom REST API endpoints, extending WP REST API,
  building headless WordPress APIs, AJAX alternatives
triggers:
  - "REST API"
  - "API endpoint"
  - "custom endpoint"
  - "wp_ajax alternative"
---

## REST API Endpoint Protocol

### Standard Endpoint Template
<?php
declare(strict_types=1);

add_action('rest_api_init', function(): void {
    register_rest_route('site/v1', '/resource/(?P<id>\d+)', [
        'methods'             => WP_REST_Server::READABLE,
        'callback'            => 'site_get_resource_handler',
        'permission_callback' => 'site_resource_permission_check',
        'args'                => [
            'id' => [
                'validate_callback' => fn($param) => is_numeric($param),
                'sanitize_callback' => 'absint',
                'required'          => true,
            ],
        ],
    ]);
});

function site_resource_permission_check(WP_REST_Request $request): bool|WP_Error {
    if (!current_user_can('read')) {
        return new WP_Error(
            'rest_forbidden',
            __('You do not have permission.', 'site-theme'),
            ['status' => 403]
        );
    }
    return true;
}

function site_get_resource_handler(WP_REST_Request $request): WP_REST_Response|WP_Error {
    $id   = $request->get_param('id');
    $post = get_post($id);
    
    if (!$post instanceof WP_Post) {
        return new WP_Error('not_found', __('Resource not found.', 'site-theme'), ['status' => 404]);
    }
    
    return new WP_REST_Response([
        'id'      => $post->ID,
        'title'   => get_the_title($post),
        'content' => apply_filters('the_content', $post->post_content),
        'meta'    => site_get_resource_meta($post->ID),
    ], 200);
}
