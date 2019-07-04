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
define( 'DB_NAME', 'hallem' );

/** MySQL database username */
define( 'DB_USER', 'damanager' );

/** MySQL database password */
define( 'DB_PASSWORD', 'hallempassword' );

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
define( 'AUTH_KEY',         '5{[i`-AR/>BzNi]q|(D{pr]F!HJ<:w>(2yM%C)<VOc24k9?KN.|5)T l}=!Xo_1J' );
define( 'SECURE_AUTH_KEY',  '#QC-C4hp>FhJ4tB]K.V>dxpf:OvazL` &Gwd;9NGbd[!D+]e-U@oC[.9rulG:>rv' );
define( 'LOGGED_IN_KEY',    '@xpl`{[4{j7$ds:EGx`_?U=M,n[Ee)g8w(V$BrG16y(I4[#UY-NywAM6H`QTgyof' );
define( 'NONCE_KEY',        '[XB^5wDtFnOH/Y]At(U*;+wkLOZ1L5Bh39a;-E(L)|[f!,xzANO+U#tl=^jp7/Hv' );
define( 'AUTH_SALT',        'tavek]L/hS~OcugF.o||^Qlz<1 gr+O$h1DXrHse},S.Pod%CniNPWFUO~?-LuVg' );
define( 'SECURE_AUTH_SALT', 'WQ`O;)1Kxc_SZIIs<b(iNk_,,hGBHieK0 kHPk;PWI3fa0NCzs|8nr18p;wNl*3Q' );
define( 'LOGGED_IN_SALT',   '^7S4Zt{Eky&_2n!6pTM`G5$5?n`{nkOnlaJuDvKG$&3}en>G3@an [~r{qT_-C@!' );
define( 'NONCE_SALT',       '<;DF@cRUE7{XJLy[mh;rl$(xeb8#`BA/B$s5DGph?wq%xT;{k1iaVpRs=068(1ch' );

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
