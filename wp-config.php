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
define( 'DB_NAME', 'rahul-creations' );

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
define( 'AUTH_KEY',         'QfWD:1qAW>yAkFldei}?iy~3Q&y!AaNRL~t;Bni%@a`rJ[Zn&DWt[+/t6Va,~85W' );
define( 'SECURE_AUTH_KEY',  'o6INR$QqF]Wn TS3OD_~Y#2cuv1)R Q;)?*KdX=6;85_qQ1a8-Hi3_[HBa[M>$vC' );
define( 'LOGGED_IN_KEY',    'iQjus_c.m<ouyExk#fN#v.;xi/#p.{!a,R:|z!X.iZ`jQ[</xrL6S$T}TfGN]IAO' );
define( 'NONCE_KEY',        '3muIc.LY__qbZ/zVVY[w{IV!F,l5lh@ONBlL3qNdv?DV)&Go5uwLA<@Cskj m2q2' );
define( 'AUTH_SALT',        'cP}i##*5x/A92`*mw;ui9F`qC;=|!}[<=^]C{p)9*qn8*^zlj>b.>e:9lf7h0]4=' );
define( 'SECURE_AUTH_SALT', 'Pv+TVbm?R~1}KjlRO=gke4Pl@%3S5#%dPEtd: `eNhiq@[3Pox82a/)~y%8 1ZSZ' );
define( 'LOGGED_IN_SALT',   'qQQ,GbxWLA4?=Mm+qPx+D].dnvjN6JI^jf%z3dYH=@TX5vJX/*ee.E4~z<|ow%_O' );
define( 'NONCE_SALT',       'k2k2uiFBL_VQI&)SVB5IUI-F#pQ?0ZL1CX5YOH2Cr4qnni<(DtVuFSx@U]w%)5 ,' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
