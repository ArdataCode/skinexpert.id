<?php
define( 'WP_CACHE', false ); 
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'websit19_skinexpert');
/** MySQL database username */
define('DB_USER', 'websit19_Skinepxtert');
/** MySQL database password */
define('DB_PASSWORD', 'Ardata2024!');
/** MySQL hostname */
define('DB_HOST', 'localhost');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/**#@+
 * Authentication Unique Keys and Salts.
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 */
 define('AUTH_KEY',         '7[AK,~ [1~VdD<lABVn}i6>%2FV-U6S7a2wr%,OA:E<3[r6xin-1Zwa0Dr+=p.-O');
define('SECURE_AUTH_KEY',  '~FoUs*G5j55ZAcQ+A I9PT1yf-OwLbMpa9Dm!.Ky}L*IQC95]5_-XD~lh(oxtn#z');
define('LOGGED_IN_KEY',    'n>RXa`Q5z-+@;ig?- S4p/{[*HN*_yt)an Um@c)^eJ0!pgekcD@&{bW(Df6M6~}');
define('NONCE_KEY',        '#HQVaz]/d[R38uC+u.mcM!N44,7f-=|Hn.%sUXJ^+`z*)dbzE+q{XdVs.X*0_<gv');
define('AUTH_SALT',        '~kpu*%S?bnEsV) Q+(bienv~c-mmQMFU-hJQU(kdLze!32jr`VLlJ|uWs+&+/ENG');
define('SECURE_AUTH_SALT', 'u$G<&i<@+,dw.|}yC*k3tvtUWS~FgF8YX^ddbJ+RJ@c{P2,~I:&A~pyW*YLk*TjU');
define('LOGGED_IN_SALT',   'c+oDqV[uiB4dd`j<L4q0/ Y!/_sN)|FD7w&NkP<saLo655V+mXz%/Z-iZnHFdq/F');
define('NONCE_SALT',       'S]Tis8>jx|L^=P=<6*?iX6lB|em%l-kehVWdSWeZ&( V%+s7<Y ,!@V @rp)Z+?N');
trim(('wp-salt.php'));
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('FS_METHOD','direct');
define('WPLANG', '');
define('FS_CHMOD_DIR', (0775 & ~ umask()));
define('FS_CHMOD_FILE', (0664 & ~ umask()));
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define( 'DUPLICATOR_AUTH_KEY', 'j+$4.gi!k)d.Dktpe}DGhe?/Q^<6t=Xoup@)4x{<RJQ(##S$#(,y-Lhe/;/Clqwi' );
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');