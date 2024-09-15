<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '?zmBLd%de)k=rouiJ$7TVZYbg4e9YE?[&;Xg3a~~)p<8?(5vVqwyX?86^E!?%-=I' );
define( 'SECURE_AUTH_KEY',  '~5tu3p0.0N_h/i_QR c`k(%rlVx=UNx(Dt!;7SU/v1bL~ua(C-LyoVD.KUP{P!Vn' );
define( 'LOGGED_IN_KEY',    'V>BQ%ed`zHK2f-4[%N.7y?Esu+HC=&-l])8ssm|l>KBi~&$+lrC>9fT3DDPB/|Zc' );
define( 'NONCE_KEY',        'Ws&i>vMFHndOuaM0G8Iw@nh>)8g!Ea)yLq {ctv1(Av4Ck``P0kp1Ftxo&B;i4v,' );
define( 'AUTH_SALT',        'qSZm,&nhQ8P[nf,vs6{e u@bHgda9JSe8_{Y!8G,p@G.?>t|*W>HZy)VZ`R,_pu[' );
define( 'SECURE_AUTH_SALT', 'S5Unto}{KfJW[6E}!&$ dldN() yTkvltjKSP ^WqN[U)fWEOv+5*U0[S8Jh{k5Z' );
define( 'LOGGED_IN_SALT',   '|#xK5A(]AG.m},#T[b)L`A{xcCR{<C2F4o>O+6RYg5XB2sD94m@X ARPBtxDR5JA' );
define( 'NONCE_SALT',       'yd9tcW!`N#8y^{y|!/8f~fR2+Wli+yU@.CIJ-9#Ix}X&d=j]B`x`DI!C#[CX7MUc' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
