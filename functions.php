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
 * Add custom fields for Equipment.
 */
function my_spec_add_equipment_meta_boxes() {
    add_meta_box(
        'equipment_details',
        'Equipment Details',
        'my_spec_equipment_meta_box_callback',
        'equipment',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'my_spec_add_equipment_meta_boxes');


function my_spec_equipment_meta_box_callback($post) {

    wp_nonce_field(
        'my_spec_save_equipment_details',
        'my_spec_equipment_nonce'
    );

    $price = get_post_meta($post->ID, '_equipment_price', true);
    $availability = get_post_meta(
        $post->ID,
        '_equipment_availability',
        true
    );
    ?>

    <p>
        <label for="equipment_price">
            <strong>Price per hour</strong>
        </label>
        <br>

        <input
            type="number"
            id="equipment_price"
            name="equipment_price"
            value="<?php echo esc_attr($price); ?>"
            min="0"
            step="1"
        >
    </p>

    <p>
        <label for="equipment_availability">
            <strong>Availability</strong>
        </label>
        <br>

        <select
            id="equipment_availability"
            name="equipment_availability"
        >
            <option
                value="В наличии"
                <?php selected($availability, 'В наличии'); ?>
            >
                В наличии
            </option>

            <option
                value="Под заказ"
                <?php selected($availability, 'Под заказ'); ?>
            >
                Под заказ
            </option>

            <option
                value="Недоступно"
                <?php selected($availability, 'Недоступно'); ?>
            >
                Недоступно
            </option>
        </select>
    </p>

    <?php
}

/**
 * Save Equipment custom fields.
 */
function my_spec_save_equipment_details($post_id) {

    // Verify nonce.
    if (
        ! isset($_POST['my_spec_equipment_nonce']) ||
        ! wp_verify_nonce(
            $_POST['my_spec_equipment_nonce'],
            'my_spec_save_equipment_details'
        )
    ) {
        return;
    }

    // Prevent saving during autosave.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions.
    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save price.
    if (isset($_POST['equipment_price'])) {
        update_post_meta(
            $post_id,
            '_equipment_price',
            absint($_POST['equipment_price'])
        );
    }

    // Save availability.
    if (isset($_POST['equipment_availability'])) {

        $allowed_values = array(
            'В наличии',
            'Под заказ',
            'Недоступно'
        );

        $availability = sanitize_text_field(
            $_POST['equipment_availability']
        );

        if (in_array($availability, $allowed_values, true)) {
            update_post_meta(
                $post_id,
                '_equipment_availability',
                $availability
            );
        }
    }
}

add_action(
    'save_post_equipment',
    'my_spec_save_equipment_details'
);


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
                'price' => (int) get_post_meta(
                    get_the_ID(),
                    '_equipment_price',
                    true
                ),
                
                'availability' => get_post_meta(
                    get_the_ID(),
                    '_equipment_availability',
                    true
                ),
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
