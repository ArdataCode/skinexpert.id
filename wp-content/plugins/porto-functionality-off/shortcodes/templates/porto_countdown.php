<?php

$count_style    = $datetime = $porto_tz = $countdown_opts = $tick_col = $tick_size = $tick_line_height = $tick_style = $tick_sep_col = $tick_sep_size = $tick_sep_line_height = '';
$tick_sep_style = $el_class = '';
$string_days    = $string_weeks = $string_months = $string_years = $string_hours = $string_minutes = $string_seconds = '';
$string_days2   = $string_weeks2 = $string_months2 = $string_yers2 = $string_hours2 = $string_minutes2 = $string_seconds2 = '';
extract(
	shortcode_atts(
		array(
			'count_style'                      => 'porto-cd-s1',
			'enable_dynamic_date'              => '',
			'dynamic_datetime'                 => '',
			'datetime'                         => '',
			'porto_tz'                         => 'porto-wptz',
			'countdown_opts'                   => '',
			'tick_col'                         => '',
			'tick_size'                        => '',
			'tick_line_height'                 => '',
			'tick_style'                       => '',
			'tick_sep_col'                     => '',
			'tick_sep_size'                    => '',
			'tick_sep_line_height'             => '',
			'tick_sep_style'                   => '',
			'el_class'                         => '',
			'string_days'                      => esc_html__('Day', 'porto-functionality'),
			'string_days2'                     => esc_html__('Days', 'porto-functionality'),
			'string_weeks'                     => esc_html__('Week', 'porto-functionality'),
			'string_weeks2'                    => esc_html__('Weeks', 'porto-functionality'),
			'string_months'                    => esc_html__('Month', 'porto-functionality'),
			'string_months2'                   => esc_html__('Months', 'porto-functionality'),
			'string_years'                     => esc_html__('Year', 'porto-functionality'),
			'string_years2'                    => esc_html__('Years', 'porto-functionality'),
			'string_hours'                     => esc_html__('Hour', 'porto-functionality'),
			'string_hours2'                    => esc_html__('Hours', 'porto-functionality'),
			'string_minutes'                   => esc_html__('Minute', 'porto-functionality'),
			'string_minutes2'                  => esc_html__('Minutes', 'porto-functionality'),
			'string_seconds'                   => esc_html__('Second', 'porto-functionality'),
			'string_seconds2'                  => esc_html__('Seconds', 'porto-functionality'),
			'css_countdown'                    => '',

			// dynamic field
			'enable_field_dynamic'             => false,
			'field_dynamic_source'             => '',
			'field_dynamic_content'            => '',
			'field_dynamic_content_meta_field' => '',
			'field_dynamic_before'             => '',
			'field_dynamic_after'              => '',
			'field_dynamic_fallback'           => '',
			'date_format'                      => '',
		),
		$atts
	)
);

wp_enqueue_script( 'countdown' );
wp_enqueue_script( 'porto_shortcodes_countdown_loader_js' );

//dynamic WPB Field
if ( $enable_field_dynamic ) {
	if ( ( 'meta_field' == $field_dynamic_source ) && ! empty( $field_dynamic_content_meta_field ) ) {
		$dynamic_datetime = Porto_Func_Dynamic_Tags_Content::get_instance()->dynamic_get_data( $field_dynamic_source, $field_dynamic_content_meta_field, 'field' );
	}
	if ( ! empty( $field_dynamic_content ) ) {
		if ( ! empty( $date_format ) ) {
			$field_dynamic_content = array(
				'field_dynamic_content' => $field_dynamic_content,
				'date_format'           => $date_format,
			);
		}
		$dynamic_datetime = Porto_Func_Dynamic_Tags_Content::get_instance()->dynamic_get_data( $field_dynamic_source, $field_dynamic_content, 'field' );
	}
	if ( empty( $dynamic_datetime ) ) {
		$dynamic_datetime = $field_dynamic_fallback;
	}

	$dynamic_datetime = $field_dynamic_before . $dynamic_datetime . $field_dynamic_after;
}
if ( ! empty( $shortcode_class ) ) {
	if ( empty( $el_class ) ) {
		$el_class = $shortcode_class;
	} else {
		$el_class .= ' ' . $shortcode_class;
	}
}

if ( 'yes' == $enable_dynamic_date || $enable_field_dynamic ) {
	$datetime = str_replace( '-', '/', $dynamic_datetime );
}
if ( ! strtotime( $datetime ) ) {
	return;
}
$count_frmt = $labels = $countdown_design_style = '';
$labels     = $string_years2 . ',' . $string_months2 . ',' . $string_weeks2 . ',' . $string_days2 . ',' . $string_hours2 . ',' . $string_minutes2 . ',' . $string_seconds2;
$labels2    = $string_years . ',' . $string_months . ',' . $string_weeks . ',' . $string_days . ',' . $string_hours . ',' . $string_minutes . ',' . $string_seconds;
if ( $countdown_opts && ! is_array( $countdown_opts ) ) {
	$countdown_opt = explode( ',', $countdown_opts );
} else {
	$countdown_opt = $countdown_opts;
}
if ( is_array( $countdown_opt ) ) {
	foreach ( $countdown_opt as $opt ) {
		if ( 'syear' == $opt ) {
			$count_frmt .= 'Y';
		}
		if ( 'smonth' == $opt ) {
			$count_frmt .= 'O';
		}
		if ( 'sweek' == $opt ) {
			$count_frmt .= 'W';
		}
		if ( 'sday' == $opt ) {
			$count_frmt .= 'D';
		}
		if ( 'shr' == $opt ) {
			$count_frmt .= 'H';
		}
		if ( 'smin' == $opt ) {
			$count_frmt .= 'M';
		}
		if ( 'ssec' == $opt ) {
			$count_frmt .= 'S';
		}
	}
}

if ( defined( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' ) ) {
	$countdown_design_style = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css_countdown, ' ' ), 'porto_countdown', $atts );
}
$data_attr = '';
if ( '' == $count_frmt ) {
	$count_frmt = 'DHMS';
}


$tick_style_css     = '';
$tick_sep_style_css = '';

if ( $tick_size ) {
	$unit = trim( preg_replace( '/[0-9.]/', '', $tick_size ) );
	if ( ! $unit ) {
		$tick_size .= 'px';
	}
	$tick_style_css .= 'font-size:' . esc_attr( $tick_size ) . ';';
}
if ( $tick_line_height ) {
	$unit = trim( preg_replace( '/[0-9.]/', '', $tick_line_height ) );
	if ( ! $unit && (int) $tick_line_height > 3 ) {
		$tick_line_height .= 'px';
	}
	$tick_style_css .= 'line-height:' . esc_attr( $tick_line_height ) . ';';
}

if ( $tick_sep_size ) {
	$unit = trim( preg_replace( '/[0-9.]/', '', $tick_sep_size ) );
	if ( ! $unit ) {
		$tick_sep_size .= 'px';
	}
	$tick_sep_style_css .= 'font-size:' . esc_attr( $tick_sep_size ) . ';';
}
if ( $tick_sep_line_height ) {
	$unit = trim( preg_replace( '/[0-9.]/', '', $tick_sep_line_height ) );
	if ( ! $unit && (int) $tick_sep_line_height > 3 ) {
		$tick_sep_line_height .= 'px';
	}
	$tick_sep_style_css .= 'line-height:' . esc_attr( $tick_sep_line_height ) . ';';
}

$count_down_id = 'count-down-wrap-' . rand( 1000, 9999 );

$data_attr .= ' data-tick-style="' . esc_attr( $tick_style ) . '" ';
$data_attr .= ' data-tick-p-style="' . esc_attr( $tick_sep_style ) . '" ';

if ( $tick_style ) {
	$tick_style_css .= 'font-weight: ' . esc_attr( $tick_style ) . ';';
}
if ( $tick_sep_style ) {
	$tick_sep_style_css .= 'font-weight: ' . esc_attr( $tick_sep_style ) . ';';
}

$output = '<div class="porto_countdown ' . esc_attr( $countdown_design_style ) . ' ' . esc_attr( $el_class ) . ' ' . esc_attr( $count_style ) . '">';
if ( ! isset( $atts['page_builder'] ) ) {

	$output .= '<style>';
	$output .= '#' . $count_down_id . ' .porto_countdown-amount { ';
	$output .= $tick_style_css;
	if ( $tick_col ) {
		$output .= '   color: ' . esc_attr( $tick_col ) . ';';
	}
	$output .= ' } ';
	$output .= '#' . $count_down_id . ' .porto_countdown-period, #' . $count_down_id . ' .porto_countdown-row:before {';
	if ( $tick_sep_col ) {
		$output .= '   color: ' . esc_attr( $tick_sep_col ) . ';';
	}
	$output .= $tick_sep_style_css;
	$output .= '}';

	$output .= '</style>';
}
if ( $datetime ) {
	if ( ! isset( $content ) ) {
		$content = '';
	}
	if ( ! $content && is_array( $countdown_opt ) ) {
		$inttime  = strtotime( $datetime );
		$now      = strtotime( 'now' );
		$difftime = $inttime - $now;
		if ( $difftime > 0 ) {
			if ( in_array( 'syear', $countdown_opt ) ) {
				$years   = date( 'Y', $inttime ) - date( 'Y' );
				$inttime = mktime( date( 'H', $inttime ), date( 'i', $inttime ), date( 's', $inttime ), date( 'm', $inttime ), date( 'd', $inttime ), date( 'Y' ) );
			}
			if ( in_array( 'smonth', $countdown_opt ) ) {
				$months = ( date( 'Y', $inttime ) - date( 'Y' ) ) * 12 + date( 'n', $inttime ) - date( 'n' );
				if ( $months < 0 ) {
					$months += 12;
				}
				$inttime = mktime( date( 'H', $inttime ), date( 'i', $inttime ), date( 's', $inttime ), date( 'm' ), date( 'd', $inttime ), date( 'Y' ) );
			}
			if ( in_array( 'sweek', $countdown_opt ) ) {
				$weeks = ( date( 'Y', $inttime ) - date( 'Y' ) ) * 12 + date( 'W', $inttime ) - date( 'W' );
				if ( $weeks < 0 ) {
					$weeks += 52;
				}
				$inttime = $now + $difftime % ( 24 * 3600 * 7 );
			}
			if ( in_array( 'sday', $countdown_opt ) ) {
				$days    = (int) ( ( $inttime - $now ) / 24 / 3600 );
				$inttime = $now + $difftime % ( 24 * 3600 );
			}
			if ( in_array( 'shr', $countdown_opt ) ) {
				if ( in_array( 'smin', $countdown_opt ) || in_array( 'ssec', $countdown_opt ) ) {
					$hours = floor( ( $inttime - $now ) / 3600 );
				} else {
					$hours = round( ( $inttime - $now ) / 3600 );
				}
				$inttime = $now + $difftime % 3600;
				if ( $hours < 10 ) {
					$hours = '0' . $hours;
				}
			}
			if ( in_array( 'smin', $countdown_opt ) ) {
				if ( in_array( 'ssec', $countdown_opt ) ) {
					$minutes = floor( ( $inttime - $now ) / 60 );
				} else {
					$minutes = round( ( $inttime - $now ) / 60 );
				}
				$inttime = $now + $difftime % 60;
				if ( $minutes < 10 ) {
					$minutes = '0' . $minutes;
				}
			}
			if ( in_array( 'ssec', $countdown_opt ) ) {
				$seconds = $inttime - $now;
				if ( $seconds < 10 ) {
					$seconds = '0' . $seconds;
				}
			}
		}

		$section_arr = array(
			'year'   => 'syear',
			'month'  => 'smonth',
			'week'   => 'sweek',
			'day'    => 'sday',
			'hour'   => 'shr',
			'minute' => 'smin',
			'second' => 'ssec',
		);
		$content     = '<span class="porto_countdown-row porto_countdown-show4">';
		foreach ( $section_arr as $section => $section_key ) {
			if ( in_array( $section_key, $countdown_opt ) ) {
				if ( ! isset( ${$section . 's'} ) ) {
					${$section . 's'} = '';
				}
				$content .= '<span class="porto_countdown-section"><span class="porto_time-mid"><span class="porto_countdown-amount">' . ( ${$section . 's'} ? ${$section . 's'} : '00' ) . '</span><span class="porto_countdown-period">' . ( ( (int) ${$section . 's'} ) === 1 ? ${'string_' . $section . 's'} : ${'string_' . $section . 's2'} ) . '</span></span></span>';
			}
		}
		$content .= '</span>';
	}
	$output .= '<div id="' . esc_attr( $count_down_id ) . '"  class="porto_countdown-div porto_countdown-dateAndTime ' . esc_attr( $porto_tz ) . '" data-labels="' . esc_attr( $labels ) . '" data-labels2="' . esc_attr( $labels2 ) . '"  data-terminal-date="' . esc_attr( $datetime ) . '" data-countformat="' . esc_attr( $count_frmt ) . '" data-time-zone="' . esc_attr( get_option( 'gmt_offset' ) ) . '" data-time-now="' . esc_attr( str_replace( '-', '/', current_time( 'mysql' ) ) ) . '"  data-tick-col="' . esc_attr( $tick_col ) . '" data-tick-p-col="' . esc_attr( $tick_sep_col ) . '" ' . $data_attr . '>' . ( $content ? do_shortcode( $content ) : esc_html( $datetime ) ) . '</div>';
}
$output .= '</div>';

echo porto_filter_output( $output );

global $porto_shortcode_countdown_use;
if ( ! isset( $porto_shortcode_countdown_use ) || ! $porto_shortcode_countdown_use ) :
	if ( wp_script_is( 'countdown', 'registered' ) ) :
		$porto_shortcode_countdown_use = true;
		?>
<script>
	(function(){
		var porto_inc_countdown_js = function() {
			(function($) {
				'use strict';

				if (!$.fn.porto_countdown) {
					var js_src = "<?php echo wp_scripts()->registered['countdown']->src; ?>";
					if (!$('script[src="' + js_src + '"]').length) {
						var js = document.createElement('script');
						$(js).appendTo('body').on('load', function() {
							var c = document.createElement("script");
							c.src = "<?php echo wp_scripts()->registered['porto_shortcodes_countdown_loader_js']->src; ?>";
							if (!$('script[src="' + c.src + '"]').length) {
								document.getElementsByTagName("body")[0].appendChild(c);
							}
						}).attr('src', js_src);
					}
				}
			})(jQuery);
		};

		if ( window.theme && theme.isLoaded ) {
			porto_inc_countdown_js();
		} else {
			window.addEventListener( 'load', porto_inc_countdown_js );
		}
	})();
</script>
	<?php endif; ?>
<?php endif; ?>
