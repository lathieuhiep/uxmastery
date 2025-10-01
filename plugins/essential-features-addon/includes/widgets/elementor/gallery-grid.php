<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class EFA_Widget_Gallery_Grid extends Widget_Base {

    // widget name
    public function get_name(): string {
        return 'efa-gallery-grid';
    }

    // widget title
    public function get_title(): string {
        return esc_html__( 'Gallery Grid', 'essential-features-addon' );
    }

    // widget icon
    public function get_icon(): string {
        return 'eicon-gallery-grid';
    }

    // widget categories
    public function get_categories(): array {
        return array( 'efa-addons' );
    }

    // widget keywords
    public function get_keywords(): array {
        return ['gallery', 'grid', 'image', 'efa'];
    }

    // widget controls
    protected function register_controls(): void {
        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('gallery', [
            'label'   => esc_html__('Ảnh', 'efa-elementor-gallery'),
            'type'    => Controls_Manager::GALLERY,
            'default' => [],
        ]);

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

        $this->end_controls_section();

        // layout
        $this->start_controls_section(
            'layout_section',
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

    // widget output on the frontend
    protected function render(): void {
        $settings = $this->get_settings_for_display();
        $images = $settings['gallery'] ?? [];
        $image_size = $settings['image_size'];

        if ( empty( $images ) ) return;
    ?>
        <div class="efa-addon-gallery efa-grid-layout">
            <?php foreach ( $images as $image ) : ?>
                <div class="item">
                    <?php echo wp_get_attachment_image( $image['id'], $image_size ); ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php
    }

    // widget output in the editor
    protected function content_template() {
    ?>
        <#
        var images = settings.gallery || [];
        if ( ! images.length ) { return; }

        // Chuẩn hoá image_size: có thể là chuỗi ('large') hoặc object { size: 'large', ... }
        var sizeSetting = settings.image_size;
        var size = sizeSetting;
        if ( _.isObject( sizeSetting ) && sizeSetting.size ) {
        size = sizeSetting.size;
        }

        // Nếu dùng 'custom' và có nhập kích thước, lấy thêm để set width/height (không resize thực)
        var customDim = settings.image_custom_dimension || {},
        customW   = customDim.width  || '',
        customH   = customDim.height || '';
        #>

        <div class="efa-addon-gallery efa-grid-layout">
            <# _.each( images, function( image ){
            var src = elementor.imagesManager.getImageUrl( image, size ) || image.url || '';
            var alt = image.alt || '';
            #>
            <div class="item">
                <img class="efa-img"
                     src="{{ src }}"
                     alt="{{ alt }}"
                <# if ( size === 'custom' && customW ) { #> width="{{ customW }}" <# } #>
                <# if ( size === 'custom' && customH ) { #> height="{{ customH }}" <# } #>
                />
            </div>
            <# }); #>
        </div>
    <?php
    }
}