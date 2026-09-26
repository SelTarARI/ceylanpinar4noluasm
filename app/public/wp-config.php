<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'bEI%e7.Pi8=BNYnRy)fnEG3Y1][7j?P^)-jEfUHb!=l}ahuk1f?Q.&U3QW;3V3*/' );
define( 'SECURE_AUTH_KEY',   '(!e91Eufao#:%EQSS(D/Yqu)L-Td6J3K@}Uy9ps7UK,(=yc[kHS_FM-B]7n/ZWo7' );
define( 'LOGGED_IN_KEY',     'egU0.NfKh%3N[}!F_@jL!kS]W7|Rt:XR8Q*X+%K1b:RvHUxz$X}*2_{eU6lo Ow6' );
define( 'NONCE_KEY',         'NO]iZPUr:*:9cm:9E]*?BKw<|jD+f2U$[@G@%U;lVHiYNc6SkY3l8Va:#y$Zt~8$' );
define( 'AUTH_SALT',         'sPbZfU,$=S%qiqo0qc(KO7b;ZaL){,Iw_$S:`,^x>r/{B~+12DDsw>|f.o(Yk/-j' );
define( 'SECURE_AUTH_SALT',  'S/z1 @xRoZp<Ddmp|Ti6.^2<wNgJQ!!66nt4NT{MUk* Q>E)f~|JZflQbM<hrau?' );
define( 'LOGGED_IN_SALT',    'lTHP/N]ui{5Th$HS{C{x@zjQ0[Y@802E/3q)1bC/jMXkBVF3;(dfs5qRc+|F W4e' );
define( 'NONCE_SALT',        'X^dw^a .6uNUU8kke=O0UWP2Obga>B@#H^23Z]umq?,v,TAIqv|aG`]RM EF,P7L' );
define( 'WP_CACHE_KEY_SALT', '#J/^KZ&W>_ZVeUTROwqk|}df#VGRQy]R8ET4|@Wgi6=TuAdqyO0eR)|0pciEOf,o' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
