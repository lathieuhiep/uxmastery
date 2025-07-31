<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) exit;

class EFA_Widget_Tab_Posts extends Widget_Base
{
    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name(): string
    {
        return 'efa-tab-posts';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title(): string
    {
        return esc_html__('Bài viết theo Tab danh mục', 'essential-features-addon');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-posts-grid';
    }

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     */
    public function get_categories(): array
    {
        return ['efa-addons'];
    }

    /**
     * Get widget keywords.
     *
     * @return array Widget keywords.
     */
    public function get_keywords(): array
    {
        return ['tab', 'posts'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        // tab posts
        $this->start_controls_section(
            'tab_cat_section',
            [
                'label' => esc_html__('Thiết lập bài viết theo tab', 'essential-features-addon'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'cat_id',
            [
                'label' => esc_html__('Chọn danh mục', 'essential-features-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => efa_check_get_cat( 'category' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title',
            [
                'label' => esc_html__('Tiêu đề tab', 'essential-features-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Tab',
                'placeholder' => 'Ví dụ: Tin tức, Review...',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab_items',
            [
                'label' => esc_html__('Danh sách tab', 'essential-features-addon'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        // Content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Thiết lập bài viết', 'essential-features-addon'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'   => esc_html__( 'Số bài lấy ra', 'essential-features-addon' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => esc_html__( 'Sắp xếp theo', 'essential-features-addon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ID',
                'options' => [
                    'ID'    => esc_html__( 'ID', 'essential-features-addon' ),
                    'title' => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
                    'date'  => esc_html__( 'Ngày đăng', 'essential-features-addon' ),
                    'rand'  => esc_html__( 'Ngẫu nhiên', 'essential-features-addon' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Sắp xếp', 'essential-features-addon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC'  => esc_html__( 'Tăng dần', 'essential-features-addon' ),
                    'DESC' => esc_html__( 'Giảm dần', 'essential-features-addon' ),
                ],
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => esc_html__( 'Độ phân giải ảnh', 'lpbcolor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'large',
                'options' => efa_image_size_options(),
                'label_block' => true
            ]
        );

        $this->add_responsive_control(
            'height_image',
            [
                'label'      => esc_html__( 'Chiều cao ảnh', 'essential-features-addon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.1,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0.1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 250,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .box-thumbnail a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content layout
        $this->start_controls_section(
            'content_layout',
            [
                'label' => esc_html__( 'Thiết lập giao diện', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'column_number',
            [
                'label' => esc_html__( 'Số cột', 'essential-features-addon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 3,
                'selectors' => [
                    '{{WRAPPER}} .efa-grid-layout' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label' => esc_html__( 'Khoảng cách cột', 'essential-features-addon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'default' => [
                    'size' => 2.4,
                    'unit' => 'rem',
                ],
                'selectors' => [
                    '{{WRAPPER}} .efa-grid-layout' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label' => esc_html__( 'Khoảng cách hàng', 'essential-features-addon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'default' => [
                    'size' => 2.4,
                    'unit' => 'rem',
                ],
                'selectors' => [
                    '{{WRAPPER}} .efa-grid-layout' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        $tabs = $settings['tab_items'];
        $limit_post = $settings['limit'];
        $order_by_post = $settings['order_by'];
        $order_post = $settings['order'];
        $image_size = $settings['image_size'];

        if (empty($tabs)) return;

        $tab_first = $tabs[0];
        $cat_id_first = $tab_first['cat_id'];
    ?>
        <div class="efa-addon-tab-posts">
            <div class="tab-header">
                <ul class="tab-nav"
                    data-limit="<?php echo esc_attr($limit_post) ?>"
                    data-order-by="<?php echo esc_attr($order_by_post) ?>"
                    data-order="<?php echo esc_attr($order_post) ?>"
                    data-image-size="<?php echo esc_attr($image_size) ?>"
                >
                    <?php
                    foreach ( $tabs as $index => $tab ) :
                        $cat_id = $tab['cat_id'];
                        $title = $tab['tab_title'];

                        if (empty($cat_id)) continue;

                        $active = $index === 0 ? 'active' : '';
                    ?>
                    <li class="tab-item <?php echo esc_attr($active); ?>"
                        data-cat="<?php echo esc_attr($cat_id) ?>"
                        data-url-cat="<?php echo esc_url( get_category_link( $cat_id ) ) ?>"
                    >
                        <a href="#">
                            <?php echo esc_html($title); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <?php if ( !wp_is_mobile() && $cat_id_first ) : ?>
                    <div class="action-box">
                        <a href="<?php echo esc_url( get_category_link( $cat_id_first ) ) ?>" class="cat-link-open">
                            <span><?php esc_html_e('Xem thêm', 'essential-features-addon'); ?></span>
                            <i class="efa-icon-mask efa-icon-mask-arrow-right"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="tab-content">
                <?php
                foreach ( $tabs as $index => $tab ) :
                    $cat_id = $tab['cat_id'];

                    if (empty($cat_id)) continue;

                    $active = $index === 0 ? 'active' : '';
                ?>
                <div class="pane-warp <?php echo esc_attr( $active ) ?>"
                     data-cat="<?php echo esc_attr( $cat_id ) ?>"
                     data-loaded="<?php echo esc_attr( $index === 0 ? 'true' : 'false' ) ?>">

                    <?php
                    if ( $index === 0 ) :
                        $args = [
                            'post_type'      => 'post',
                            'posts_per_page' => $limit_post,
                            'orderby'        => $order_by_post,
                            'order'          => $order_post,
                            'cat'            => $cat_id,
                            'post_status'    => 'publish',
                            'ignore_sticky_posts' => true,
                        ];

                        $query = new \WP_Query($args);

                        if ( $query->have_posts() ) :
                            efa_render_tab_post_item($query, $cat_id, $image_size);
                         else:
                            esc_html_e('Không có bài viết nào trong danh mục này.', 'essential-features-addon');
                        endif;
                    endif;
                    ?>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if ( wp_is_mobile() && $cat_id_first ) : ?>
                <div class="action-box is-mobile">
                    <a href="<?php echo esc_url( get_category_link( $cat_id_first ) ) ?>" class="cat-link-open">
                        <span><?php esc_html_e('Xem thêm', 'essential-features-addon'); ?></span>
                        <i class="efa-icon-mask efa-icon-mask-arrow-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }
}