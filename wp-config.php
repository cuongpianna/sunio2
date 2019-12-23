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
define( 'DB_NAME', 'su' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'mPa7E66JX)zE966qXhTJ4<4-}*A[,A>7`%ZP&kAco1 04+q}^/4z`Ykk)X:+Q+.N' );
define( 'SECURE_AUTH_KEY',  'MaZ9TaxrgL n%p}Rnv/^(Wr<y05mLjB!?.iti(B.)w*Y$l)?9Sv%F8|2gRA6yBGy' );
define( 'LOGGED_IN_KEY',    '`%Yi5+aNRKHY|Uz0ilab+IQpf(rvDD,mnYPl?-f#yH|1OBPXc43_;k_g6|h/p~Ze' );
define( 'NONCE_KEY',        ';Albj <(ex)Mfiqrh/2IHJ&G1,87=ID83Bu:&$?d=evsCyc8PACUf@Br<+Qna%4g' );
define( 'AUTH_SALT',        'V@R5m?`A]ucq?^afv2qDv>+.Q)!v(f_>iZl.+!bAx6YiGwaLx`{d@kGEUERa7q.&' );
define( 'SECURE_AUTH_SALT', 'qon-etHsXLxR](?_W]yo%e#RdiDwt&xMhu`5efHj>zDXhX^^b-f+3 j PpD_M$vF' );
define( 'LOGGED_IN_SALT',   '.Mve/=)W*|7c*>Amg{[8WqcTJ1>a:{ F,O*FkJP/T8mS&fFINWrRBJ<GQu)&yBu?' );
define( 'NONCE_SALT',       'RyGx>/B_~GHziL2G<]S~vD/xt}0e1yv,}a.1D{,<4RPzS![IZk`BJg(iedw16`{l' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
