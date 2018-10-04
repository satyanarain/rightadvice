<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'curedvtv_rightadvice_new');

/** MySQL database username */
define('DB_USER', 'curedvtv_right');

/** MySQL database password */
define('DB_PASSWORD', '59T(I,*M0%)S');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3#hAOSzSUiAODdAR6E]>EK+[|O}n/+QtLl6.[b1zLD0^jUi<MP;yrx1;stZ`~ v+');
define('SECURE_AUTH_KEY',  'yH:^+MWV~]Ga=9:*_(Tg$ykQli3`7#-gSL5#=43]-}FDwb8=Y!tM##dq^b?e@zuf');
define('LOGGED_IN_KEY',    'K]Q/Oy{N>x>AI6]c1=R$JY*#}0<j(y)&Lgxi_I@).,~Xy}+)U&tJ?*T!]i(*I>&i');
define('NONCE_KEY',        '5zH<R7j_mbwjNk=v`nwxR9?28O8A}];sGb$Q0(2Y: OHLe4$E$WsnC[GAJw`Qs<|');
define('AUTH_SALT',        'Z-,hm!?Ul+NQO$w<LlK5$p,wP>5VB^gjSe&cqS}Fz@~(5:Sb&pK)zZC4,&2XRt}b');
define('SECURE_AUTH_SALT', '0BvP4~`n%VNn=y:txB;<N-d+-K?ye!1V[YBdJxl#hq^F]1SM29,/%y{VAR@}`jZJ');
define('LOGGED_IN_SALT',   'BIcS^;KErZ@g@FwxZR|CF9Gu*bwLaoTu/ywg|Ti$d)93#L?Y$,w)NC65 vm;5|dA');
define('NONCE_SALT',       '9Gc*g4La7),qoiZ&n!#}^wV}UJ.#R3=J)E|]cxbRfvY={BfKqBAPdE8k3*N:IfSK');

define( 'WP_ALLOW_MULTISITE', TRUE );
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ra_';
 
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('DISABLE_WP_CRON', true);

