<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class EFA_Widget_Dual_Post_Block extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efa-dual-post-block';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Cặp bài viết nổi bật', 'essential-features-addon' );
	}

	// widget icon
	public function get_icon(): string {
		return 'eicon-post-list';
	}

	// widget categories
	public function get_categories(): array {
		return array( 'efa-addons' );
	}

	// widget keywords
	public function get_keywords(): array
	{
		return ['post', 'grid'];
	}

	// widget controls
	protected function register_controls(): void {
		// Content query
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Thiết lập bài viết', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'select_cat',
			[
				'label'       => esc_html__( 'Chọn danh mục', 'essential-features-addon' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => efa_check_get_cat( 'category' ),
				'multiple'    => true,
				'label_block' => true
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
				'default' => 'id',
				'options' => [
					'id'    => esc_html__( 'ID', 'essential-features-addon' ),
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

		$this->end_controls_section();

		// Content layout
		$this->start_controls_section(
			'content_layout',
			[
				'label' => esc_html__( 'Thiết lập giao diện', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'   => esc_html__( 'Hiên thị nôi dung tóm tắt', 'essential-features-addon' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'show' => [
						'title' => esc_html__( 'Có', 'essential-features-addon' ),
						'icon'  => 'eicon-check',
					],

					'hide' => [
						'title' => esc_html__( 'Không', 'essential-features-addon' ),
						'icon'  => 'eicon-ban',
					]
				],
				'default' => 'show'
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'     => esc_html__( 'Số lượng từ hiển thị', 'essential-features-addon' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '10',
				'condition' => [
					'show_excerpt' => 'show',
				],
			]
		);

		$this->end_controls_section();

		// Style title
		$this->start_controls_section(
			'style_title',
			[
				'label' => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .efa-addon-post-grid .item .title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__( 'Màu thay đổi', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .efa-addon-post-grid .item .title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .efa-addon-post-grid .item .title',
			]
		);

		$this->add_responsive_control(
			'title_align',
			[
				'label'     => esc_html__( 'Căn chỉnh', 'essential-features-addon' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => esc_html__( 'Trái', 'essential-features-addon' ),
						'icon'  => 'eicon-text-align-left',
					],

					'center' => [
						'title' => esc_html__( 'Giữa', 'essential-features-addon' ),
						'icon'  => 'eicon-text-align-center',
					],

					'right' => [
						'title' => esc_html__( 'Phải', 'essential-features-addon' ),
						'icon'  => 'eicon-text-align-right',
					],

					'justify' => [
						'title' => esc_html__( 'Căn đều hai lề', 'essential-features-addon' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .efa-addon-post-grid .item .title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style excerpt
		$this->start_controls_section(
			'style_excerpt',
			[
				'label'     => esc_html__( 'Nôi dung tóm tắt', 'essential-features-addon' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_excerpt' => 'show',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .efa-addon-post-grid .item .desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .efa-addon-post-grid .item .desc',
			]
		);

		$this->add_responsive_control(
			'excerpt_align',
			[
				'label'     => esc_html__( 'Căn chỉnh', 'essential-features-addon' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => esc_html__( 'Trái', 'essential-features-addon' ),
						'icon'  => 'eicon-text-align-left',
					],

					'center' => [
						'title' => esc_html__( 'Giữa', 'essential-features-addon' ),
						'icon'  => 'eicon-text-align-center',
					],

					'right' => [
						'title' => esc_html__( 'Phải', 'essential-features-addon' ),
						'icon'  => 'eicon-text-align-right',
					],

					'justify' => [
						'title' => esc_html__( 'Căn đều hai lề', 'essential-features-addon' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .efa-addon-post-grid .item .desc' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	// widget output on the frontend
	protected function render(): void {

		$settings      = $this->get_settings_for_display();
		$cat_post      = $settings['select_cat'];
		$limit_post    = $settings['limit'];
		$order_by_post = $settings['order_by'];
		$order_post    = $settings['order'];

		// Query
		$args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $limit_post,
			'orderby'             => $order_by_post,
			'order'               => $order_post,
			'cat'                 => $cat_post,
			'ignore_sticky_posts' => 1,
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
			?>
			<div class="efa-addon-post-grid efa-addon-dual-post">
				<?php while ( $query->have_posts() ): $query->the_post(); ?>
					<div class="item">
						<div class="box-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
								if ( has_post_thumbnail() ) :
									the_post_thumbnail( $settings['image_size'] );
								else:
									?>
									<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>"
									     alt="<?php the_title(); ?>"/>
								<?php endif; ?>
							</a>
						</div>

						<div class="box-content">
							<h2 class="title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>

							<?php if ( $settings['show_excerpt'] == 'show' ) : ?>
								<div class="desc">
									<p>
										<?php
										if ( has_excerpt() ) :
											echo esc_html( wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], '...' ) );
										else:
											echo esc_html( wp_trim_words( get_the_content(), $settings['excerpt_length'], '...' ) );
										endif;
										?>
									</p>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile;wp_reset_postdata(); ?>
			</div>
		<?php
		endif;
	}
}