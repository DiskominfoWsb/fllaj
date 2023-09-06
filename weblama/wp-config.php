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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fllaj' );

/** MySQL database username */
define( 'DB_USER', 'fllajwonosobo' );

/** MySQL database password */
define( 'DB_PASSWORD', 'fllajwsb$2021%' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         's&3]uxWM1I$}.Jjz@h!}H!q>n(@R?IV@MKyr;yE_zmB@YZmVrJ$/<[O&m@:4Ikcz' );
define( 'SECURE_AUTH_KEY',  '{tvLTPn(a (ZKyE=S7&3W;+:bO]J]gtN)ejLA[?Cdm:jRnnH0Y*S%8o_L|iyk4Ns' );
define( 'LOGGED_IN_KEY',    '$]x7nD/HUfo>Mq_BWhguM^n@#,VU{x5,Tsnu!!m.D=wD%K>rTI|ED+ <Q5FB>KuQ' );
define( 'NONCE_KEY',        '#!qX=`-~D4WO~2*0eDLJ?>~<-(ZH/jwAHc)^0+.p71q:El!tzM#gIy-~opnE<@Sz' );
define( 'AUTH_SALT',        'InYg%eai] /SUY35pU V4%S Qp@BrWgqb[_aB@Gtj(I6FSl5Sg^a dJ^iN5.jKc]' );
define( 'SECURE_AUTH_SALT', 'F!{YLk8*{mwN&OG(cA,&^$<dNr#0)ZQNy4,:;Kd@o#Xq/[=;C4]s%hRE]S[OEB#`' );
define( 'LOGGED_IN_SALT',   ',~p*lA=Z%;naqG=+OzZ(cb0P&#N_H&duQ+Ct0n$/8C4&{S6Y6~T[9kvy7C0,L,S6' );
define( 'NONCE_SALT',       'mN-tI`G}7o:@ACi22vtzW9Y_9RqkoxRp7ore,2cd;V]G!>=xWPsaYXK/k_7_H+ha' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
