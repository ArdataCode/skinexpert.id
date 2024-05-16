<?php
/**
 * Porto Elementor Single Builder Image Widget
 *
 * @author     P-THEMES
 * @since      2.3.0
 */
defined( 'ABSPATH' ) || die;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

class Porto_Elementor_Single_Image_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'porto_single_image';
	}

	public function get_title() {
		return esc_html__( 'Featured Image', 'porto-functionality' );
	}

	public function get_icon() {
		return 'eicon-image';
	}

	public function get_categories() {
		return array( 'porto-single' );
	}

	public function get_keywords() {
		return array( 'single', 'custom', 'layout', 'post', 'image', 'thumbnail', 'gallery', 'member', 'portfolio', 'event', 'fap' );
	}

	public function get_script_depends() {
		if ( ( isset( $_REQUEST['action'] ) && 'elementor' == $_REQUEST['action'] ) || isset( $_REQUEST['elementor-preview'] ) ) {
			return array( 'porto-elementor-widgets-js', 'isotope' );
		} else {
			return array();
		}
	}

	protected function register_controls() {

		$slider_options = porto_vc_product_slider_fields();
		unset( $slider_options[9] );
		unset( $slider_options[8] );
		$slider_options                              = porto_update_vc_options_to_elementor( $slider_options );
		$slider_options['navigation']['condition']   = array(
			'follow_meta' => '',
			'show_type'   => 'images',
		);
		$slider_options['pagination']['condition']   = array(
			'follow_meta' => '',
			'show_type'   => 'images',
		);
		$slider_options['nav_pos']['options']        = array(
			''                       => __( 'Middle', 'porto-functionality' ),
			'nav-center-images-only' => __( 'Middle of Images', 'porto-functionality' ),
			'nav-pos-inside'         => __( 'Middle Inside', 'porto-functionality' ),
			'nav-pos-outside'        => __( 'Middle Outside', 'porto-functionality' ),
		);
		$slider_options['nav_type']['condition']     = $slider_options['nav_pos']['condition'] = $slider_options['show_nav_hover']['condition'] = array(
			'follow_meta' => '',
			'show_type'   => 'images',
			'navigation'  => 'yes',
		);
		$slider_options['nav_pos2']['condition']     = array(
			'follow_meta' => '',
			'show_type'   => 'images',
			'nav_pos'     => array( '', 'nav-center-images-only' ),
		);
		$slider_options['dots_pos']['condition']     = $slider_options['dots_style']['condition'] = array(
			'follow_meta' => '',
			'show_type'   => 'images',
			'pagination'  => 'yes',
		);
		$slider_options['show_nav_hover']['default'] = 'yes';
		$slider_options['pagination']['default']     = 'yes';
		$slider_options['nav_type']['default']       = 'nav-style-2';
		$slider_options['dots_pos']['default']       = 'nav-inside nav-inside-center';

		$this->start_controls_section(
			'section_single_image',
			array(
				'label' => __( 'Featured Media', 'porto-functionality' ),
			)
		);

		$this->add_control(
			'follow_meta',
			array(
				'type'  => Controls_Manager::SWITCHER,
				'label' => __( 'Follow Post Meta Box', 'porto-functionality' ),
			)
		);

		$this->add_control(
			'meta',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'To set Single Post Meta options.', 'porto-functionality' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'description'     => __( 'To check this option, image depends on Meta Options.', 'porto-functionality' ),
				'condition'       => array(
					'follow_meta' => 'yes',
				),
			)
		);
			$this->add_control(
				'show_type',
				array(
					'type'        => Controls_Manager::SELECT,
					'label'       => __( 'Slideshow Type', 'porto-functionality' ),
					'options'     => array(
						'grid'    => __( 'Grid', 'porto-functionality' ),
						'images'  => __( 'Images', 'porto-functionality' ),
						'masonry' => __( 'Masonry', 'porto-functionality' ),
						'video'   => __( 'Video', 'porto-functionality' ),
					),
					'description' => __( 'To choose the way to show type.', 'porto-functionality' ),
					'default'     => 'images',
					'condition'   => array(
						'follow_meta' => '',
					),
				)
			);

			$this->add_control(
				'grid_column',
				array(
					'type'        => Controls_Manager::SELECT,
					'label'       => __( 'Columns', 'porto-functionality' ),
					'default'     => '3',
					'options'     => array(
						'6' => __( '6 columns', 'porto-functionality' ),
						'4' => __( '4 columns', 'porto-functionality' ),
						'3' => __( '3 columns', 'porto-functionality' ),
						'2' => __( '2 columns', 'porto-functionality' ),
						'1' => __( '1 columns', 'porto-functionality' ),
					),
					'condition'   => array(
						'follow_meta' => '',
						'show_type'   => array( 'grid' ),
					),
					'description' => __( 'Control the column count.', 'porto-functionality' ),
				)
			);

			$this->add_group_control(
				Elementor\Group_Control_Image_Size::get_type(),
				array(
					'name'      => 'thumbnail',
					'exclude'   => array( 'custom' ),
					'default'   => 'full',
					'condition' => array(
						'follow_meta' => '',
						'show_type'   => 'images',
					),
				)
			);

			$this->add_control(
				'popup',
				array(
					'type'        => Controls_Manager::SWITCHER,
					'label'       => __( 'Popup Image', 'porto-functionality' ),
					'condition'   => array(
						'follow_meta' => '',
						'show_type'   => 'images',
					),
				)
			);

			$this->add_control(
				'share_position',
				array(
					'type'        => Controls_Manager::SWITCHER,
					'label'       => __( 'Advanced Post Share?', 'porto-functionality' ),
					'description' => __( 'To show Share Icons near the image.', 'porto-functionality' ),
					'condition'   => array(
						'follow_meta' => '',
						'show_type'   => 'images',
					),
				)
			);

			$this->add_control(
				'image_radius',
				array(
					'type'        => Controls_Manager::SLIDER,
					'label'       => __( 'Border Radius', 'porto-functionality' ),
					'selectors'   => array(
						'.elementor-element-{{ID}} img' => 'border-radius: {{SIZE}}px;',
					),
					'condition'   => array(
						'follow_meta' => '',
						'show_type'   => 'images',
					),
					'description' => __( 'Control the border radius of image.', 'porto-functionality' ),
				)
			);

			$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			array(
				'label' => __( 'Slider Options', 'porto-functionality' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
	
		foreach ( $slider_options as $key => $opt ) {
			$this->add_control( $key, $opt );
		}
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_options',
			array(
				'label' => __( 'Style Options', 'porto-functionality' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'overlay_bgc',
			array(
				'label'     => __( 'Overlay Background Color', 'porto-functionality' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'follow_meta' => '',
					'show_type'   => array( 'grid', 'masonry' ),
				),
				'selectors' => array(
					'.elementor-element-{{ID}} .thumb-info.thumb-info-no-borders .thumb-info-wrapper:after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_cl',
			array(
				'type'                   => Controls_Manager::ICONS,
				'label'                  => __( 'Overlay Icon', 'porto-functionality' ),
				'fa4compatibility'       => 'icon',
				'skin'                   => 'inline',
				'exclude_inline_options' => array( 'svg' ),
				'condition'              => array(
					'follow_meta' => '',
					'show_type'   => array( 'grid', 'masonry' ),
				),
			)
		);

		$this->add_control(
			'icon_bgc',
			array(
				'label'     => __( 'Overlay Icon Background Color', 'porto-functionality' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'follow_meta' => '',
					'show_type'   => array( 'grid', 'masonry' ),
				),
				'selectors' => array(
					'.elementor-element-{{ID}} .thumb-info .thumb-info-action .thumb-info-action-icon-light' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_clr',
			array(
				'label'     => __( 'Overlay Icon Color', 'porto-functionality' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'follow_meta' => '',
					'show_type'   => array( 'grid', 'masonry' ),
				),
				'selectors' => array(
					'.elementor-element-{{ID}} .thumb-info .thumb-info-action-icon-light i' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'image_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => __( 'Image height', 'porto-functionality' ),
				'selectors'   => array(
					'.elementor-element-{{ID}} img' => 'height: {{SIZE}}px;',
				),
				'condition'   => array(
					'follow_meta' => '',
					'show_type'   => array( 'images', 'grid' ),
				),
				'description' => __( 'Control the height of image.', 'porto-functionality' ),
			)
		);

		$this->add_control(
			'image_padding',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => __( 'Image Padding', 'porto-functionality' ),
				'selectors'   => array(
					'.elementor-element-{{ID}} .lightbox>div' => 'padding: {{SIZE}}px !important;',
				),
				'condition'   => array(
					'follow_meta' => '',
					'show_type'   => 'grid',
				),
				'description' => __( 'Control the padding of image.', 'porto-functionality' ),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$atts                 = $this->get_settings_for_display();
		$atts['page_builder'] = 'elementor';
		echo PortoBuildersSingle::get_instance()->shortcode_single_image( $atts );
	}
}
