<?php
/**
 * Register Equipment custom post type.
 */
function my_spec_register_equipment_post_type() {

    $labels = array(
        'name'          => 'Equipment',
        'singular_name' => 'Equipment',
        'menu_name'     => 'Equipment',
        'add_new'       => 'Add New',
        'add_new_item'  => 'Add New Equipment',
        'edit_item'     => 'Edit Equipment',
        'new_item'      => 'New Equipment',
        'view_item'     => 'View Equipment',
        'search_items'  => 'Search Equipment',
        'not_found'     => 'No equipment found',
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-hammer',
        'supports'     => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt'
        ),
    );

    register_post_type('equipment', $args);
}

add_action('init', 'my_spec_register_equipment_post_type');

/**
 * Register a custom REST API endpoint for equipment
 * This allows external apps (like our AI agent) to get equipment data
 */

// Hook into WordPress REST API initialization
add_action('rest_api_init', function () {
    // Register the route: /wp-json/my-spec/v1/equipment
    register_rest_route('my-spec/v1', '/equipment', array(
        'methods' => 'GET',
        'callback' => 'get_equipment_data',
        'permission_callback' => '__return_true' // Allow public access
    ));
});

/**
 * Callback function that returns equipment data
 */
function get_equipment_data() {
    // 1. Query WordPress for equipment posts
    $args = array(
        'post_type' => 'equipment',
        'posts_per_page' => -1, // Get all equipment
        'post_status' => 'publish'
    );
    $query = new WP_Query($args);
    
    // 2. Prepare the data array
    $equipment_data = array();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Get the featured image
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_url($image_id, 'medium');
            
            // Build the equipment object
            $item = array(
                'id' => get_the_ID(),
                'name' => get_the_title(),
                'description' => wp_trim_words(get_the_content(), 20),
                'price' => 2500, // You can replace with ACF field later
                'availability' => 'В наличии', // You can replace with ACF field later
                'image_url' => $image_url ? $image_url : null,
                'permalink' => get_permalink()
            );
            
            $equipment_data[] = $item;
        }
        wp_reset_postdata();
    }
    
    // 3. Return the data as JSON
    return new WP_REST_Response(array(
        'status' => 'success',
        'count' => count($equipment_data),
        'data' => $equipment_data
    ), 200);
}
?>
