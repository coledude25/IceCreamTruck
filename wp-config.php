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
define('DB_NAME', 'ice_cream_truck');

/** MySQL database username */
define('DB_USER', 'root') ;

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
define('AUTH_KEY',         'aARAQE5qQ*`PzZ $fUtU8Z3.!A0jR|)?FR73M(?B_(w,CvF42Iin0DSx<zE~k`+J');
define('SECURE_AUTH_KEY',  '+r+ZoK%^i1s6u5X#K||EK=7-<+ 3!MlN>n|H)_h,?VQ/I`=8:{+oiG{3L*n]We6*');
define('LOGGED_IN_KEY',    'j57[WNM<S}qQn$:{8$^{k(F{N,S>pJ-VHI*](/<`Z2&hQ>3 Cw={*|m?1v;vlYD~');
define('NONCE_KEY',        '7T$?&-3*r2y^o0#VRH2c})m<^Fe:5)km?!9p7%)%vCgAo|g5Su 5+^ #U/z|vHIq');
define('AUTH_SALT',        ':L&kc5nm.)]g$o-d`)^(>:Z[|Ur1AkJV_9-wVmQx4+7.;5Mo*53rW0L;0`;B+Z}/');
define('SECURE_AUTH_SALT', 'QtBM^o2,VE-o<o}}-P7D[bB%tfD&3+j)#z&#y{:e*zKs.H-pB&eICA)&[b0!cu!E');
define('LOGGED_IN_SALT',   'TgCt@i#F|P1dT$sd*|,e-JUm!yzpb>762+p.pQ/;+;<N+6F4%sy=fyH3G:avYzSq');
define('NONCE_SALT',       'Dt<5?T}*%avwwv>>6A{:B=op.R8itt1}frA;Ohx+Qu|Mj#SbujJ)qAW|~huJH!8b');

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
