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
define( 'DB_NAME', 'custom-theme' );

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
define( 'AUTH_KEY',         '?IoFQoK6Z&64gmE`^P!ERY*~m5O[0K-:6@M`a;P`L/1Ws>Vd8%1X6.9 1l{g:`zH' );
define( 'SECURE_AUTH_KEY',  '<$d:6,0Y~h~J@f *AcXFUSUTN{xCR;#IkyMlyNV7/jwQ?43=;ga 9q;(3lrLIs!$' );
define( 'LOGGED_IN_KEY',    'EN]*PK{e%W~RQCi5$)1Md*9k6qlRADt(/boItqC/K}v4J:vm2CS;ve5ChCl*P}),' );
define( 'NONCE_KEY',        'h=G tUqt&CzE]Rtdz!nXH5JIU76}/Y47xc2?-qCp`[eH;o,F%nib Qyuq{|E4F=v' );
define( 'AUTH_SALT',        '^/F>zO$Y `]J(Jl6= Vo}/GL&bH^xcZ.Ae5U<!5avRKbH4g4K4;Ww=aUX[Jv9=av' );
define( 'SECURE_AUTH_SALT', '_nlt}G@Lwy7z(&Jgl@79}i/&r/IP`Pjz#<~ 5xw}}Qmo?.;TS&FX}B0.b$Ry},t4' );
define( 'LOGGED_IN_SALT',   'V28^R_4Vw}02nZ?--]kPC9b/X?,]FUAA2ls,u`$]4m/}R,,52+cq/n+}1c6uT`|p' );
define( 'NONCE_SALT',       '%$9m0Kd;KV ycR7+^Kxr7n=gNE07/|Z$au:7EuPgE3_oqRiXYb5bZhQt T+`%zw5' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
