<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'qdm114751465_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456');

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
define('AUTH_KEY',         'MP;6d>d|uU)|]O..Ko]b-j~d6S8#>.NCb/NKa1XWv4|nU>+$MHmu]u<O`k53-~jH');
define('SECURE_AUTH_KEY',  '^uCBNNXeO6(Iz WEfF1fx9C;#|H2?x-/5UOL7(/|(D0GM:Mm.1;b;R]/k*VzC@V`');
define('LOGGED_IN_KEY',    '(7AUJLGcZw3YdGg^woPPZ,ZLAE4eg6)Jk;j_u*jvI6biQTC%6XRsN3jPuK[tLf@N');
define('NONCE_KEY',        '}Gqkb==K[Q=^D-7V5:s{AXYH71AaW,d$AIRVXf&YF1|:W$|+kodRLCY`SBH{((Y{');
define('AUTH_SALT',        'xf4+ a_(X!H.T /Eyb-.4k#F98V6+rhvcy(p= @eKRo-SaIu7vrY`6t|gmu!B}h`');
define('SECURE_AUTH_SALT', 'Z-81$+e6axq<|6Ri6m<K?v`(] bxS?.O=%]Z]^h`.n.=/,fqP)/Sb4csE.S)R`+ ');
define('LOGGED_IN_SALT',   'b&qbP&,.NYjqBlM8cNi{oGo={/b#jJIl~a,KJP+Bv^5hv}d|:B5TRQYY`ma] p*Y');
define('NONCE_SALT',       'fFm5uNxpm99t z#5hY8.}e:L|dA/% en]$G 5Z2N$,F&x~@b>nacjJd%RRl~-{L,');

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
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', false);

//define('WPLANG', 'en_US');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
