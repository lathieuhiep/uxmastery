<?php
/**
 * Thêm bộ lọc phân loại tùy chỉnh vào trang quản trị CPT.
 *
 * @param string $post_type Tên của loại bài đăng tùy chỉnh (CPT) muốn thêm bộ lọc.
 * @param string $taxonomy Tên của phân loại tùy chỉnh (Custom Taxonomy) muốn thêm.
 */
function uxmastery_add_custom_taxonomy_filter_to_cpt(string $post_type, string $taxonomy): void
{
    // Lắng nghe sự kiện 'restrict_manage_posts' để thêm dropdown
    add_action('restrict_manage_posts', function() use ($post_type, $taxonomy) {
        global $typenow;
        if ($typenow === $post_type) {
            $terms = get_terms([
                'taxonomy'   => $taxonomy,
                'hide_empty' => false,
            ]);

            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<select name="' . esc_attr($taxonomy) . '" id="' . esc_attr($taxonomy) . '" class="postform">';
                echo '<option value="">' .esc_html__('Tất cả danh mục', 'uxmastery') . '</option>';
                $selected_term = $_GET[$taxonomy] ?? '';

                foreach ($terms as $term) {
                    printf(
                        '<option value="%1$s" %2$s>%3$s (%4$s)</option>',
                        esc_attr($term->slug),
                        selected($selected_term, $term->slug, false),
                        esc_html($term->name),
                        esc_html($term->count)
                    );
                }
                echo '</select>';
            }
        }
    });

    // Lắng nghe sự kiện 'parse_query' để sửa đổi truy vấn chính
    add_action('parse_query', function($query) use ($post_type, $taxonomy) {
        if (is_admin() && $query->is_main_query() && $query->get('post_type') === $post_type && !empty($_GET[$taxonomy])) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET[$taxonomy]),
                ),
            ));
        }
    });
}