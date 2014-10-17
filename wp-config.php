<?php
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
define('DB_NAME', 'icecream');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         't6t-]*U-z:+`Ph-39*@$z~k?+$TPg3)zpo}u`GG|#oj@>!?.wcnW]<>1TsG]+m1/');
define('SECURE_AUTH_KEY',  '|Wz<D>l$T&>W624VTY<!?[=ul|TE|8dn){M4*@?{QLP;jK[6ob[E@AN} |mIDf&}');
define('LOGGED_IN_KEY',    'uUMn+1YEo]yhY4A4xAI6~WLy)MjB;yHuh3_Ypg#$;-~k|Y?w?4aRYOR-Ox`}^+w-');
define('NONCE_KEY',        'Pt%ZjtSO#8?wxK[0zRe}4V$$G~dF&$1sK[M?iOS??o-==uYW9rn{@M6_mQ[,dJjT');
define('AUTH_SALT',        '{=!1)e)*+&]]6^=[ty-f*zfz-wX*9U~uIY)XtRpIzII3eR[qMNc]0dJ_^,&=4Xs2');
define('SECURE_AUTH_SALT', 'x/A4g=s,K2R=4E6`L+/C`v/E7Y7N)~n80dhl!2`TicZST,@7}n6r^at{oHuh-j!{');
define('LOGGED_IN_SALT',   '$L_j5V]<|TdR+X irq7iWn~GX.UW(nr[&`Q@#WSZ.sxl-jC<pOFh]1a^.S-!NLF}');
define('NONCE_SALT',       '`hd0ML%zNJC{l:-+3)!o7@S$lxXv*Vie#,M-*N#48(2i|L*XZxQ/ w02q/!I!_(D');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
