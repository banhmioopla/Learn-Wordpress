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
define('DB_NAME', 'learn_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '20X?>qdh uUocy+.SRa.#|!s}9k^{}pB2Vo&^;z+4z(.Bcp/PIuW6x-L.:R %?bw');
define('SECURE_AUTH_KEY',  'Lw8wiIPhaJ*jLr5IX}5LV&lqfs7|^HTg1}).?#n4lRX0+JUX%>G/%8W_=89PWiKP');
define('LOGGED_IN_KEY',    ' PMVbVLtS^)[TUT/($u9)NA{<+;0OI2O/+(Ooh7h0Mk.j%wZc5e1 c>BTp!IucE)');
define('NONCE_KEY',        'bS1;<vEE1opQW1iUTh/}[jwV5YhU+F8#+wPq_(VQqG}8Y{R]*>knFeR[!>[,e27F');
define('AUTH_SALT',        'GH`MLPR+MNrxO0t^*@g*.B#=N;kBLb},-i!P<M>&SZF_ywL.n6&eeXRkFN<zSL@9');
define('SECURE_AUTH_SALT', 'awY<3NaV(a<V|jW}lt}O.mMWb*+C ng;XD}Jen|e=6q]uxY9 z%o7DQNL`S+ZFos');
define('LOGGED_IN_SALT',   'q)4Q~@_q~T^?k-yK5*@foVk$ f;Pi,H<exbn,l79s24otb 7l#FF&^:@^ck9wT1j');
define('NONCE_SALT',       '!DW)j71)D@M(t-;uMBBh@:.kIgx}zkj2HXpLp;CuEdVXdc+6xORG+Rh`qDm=i *}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'learn_';

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
define('AUTOMATIC_UPDATER_DISABLED', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
