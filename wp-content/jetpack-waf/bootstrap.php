<?php
define( 'DISABLE_JETPACK_WAF', false );
if ( defined( 'DISABLE_JETPACK_WAF' ) && DISABLE_JETPACK_WAF ) return;
define( 'JETPACK_WAF_MODE', 'silent' );
define( 'JETPACK_WAF_SHARE_DATA', false );
define( 'JETPACK_WAF_DIR', '/home/900667.cloudwaysapps.com/btvrqaxggb/public_html/wp-content/jetpack-waf' );
define( 'JETPACK_WAF_WPCONFIG', '/home/900667.cloudwaysapps.com/btvrqaxggb/public_html/wp-content/../wp-config.php' );
require_once '/home/900667.cloudwaysapps.com/btvrqaxggb/public_html/wp-content/plugins/jetpack/vendor/autoload.php';
Automattic\Jetpack\Waf\Waf_Runner::initialize();
