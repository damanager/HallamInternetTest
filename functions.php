<?php declare( strict_types=1 );

/**
 * Adds a random image to user upon registration.
 *
 * @param int $user_id
 */
function tt_user_register( int $user_id ): void {

	$photo_id = rand( 1, 10000 );

	$curl = curl_init();
	curl_setopt_array( $curl, [
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL            => 'https://jsonplaceholder.typicode.com/photos/' . $photo_id,
	] );
	$response = curl_exec( $curl );
	curl_close( $curl );

	$data = json_decode( $response );

	update_user_meta( $user_id, 'register_image', $data->url );
}

add_action( 'tt_user_logged_in', 'tt_user_register', 10, 1 );

/**
 * Captures user agent at login.
 *
 * @param int $user_login
 * @param WP_User $user
 */
function tt_user_logged_in( int $user_login, WP_User $user ): void {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	update_user_meta( $user->ID, 'last_user_agent', $user_agent );
}

add_action( 'wp_login', 'tt_user_logged_in', 10, 2 );

/**
 * Enqueues WP default jQuery and jQuery validate.
 */
function tt_enqueue_scripts(): void {

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script(
		'site-main',
		get_template_directory() . '/main.js',
		[ 'jquery' ],
		filemtime( get_template_directory() . '/main.js' )
	);

	wp_localise_script( 'site-main', 'site_data', [
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	] );
}

add_action( 'wp_enqueue_scripts', 'tt_enqueue_scripts' );

/**
 * Returns inspirational quote on AJAX call.
 *
 * Caches each quote for 30 minutes before retrieving another.
 */
function tt_get_quote(): void {

	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
		return;
	}

	$quote = get_transient( 'quot_of_the_day' );

	if ( ! $qotd ) {
		$curl = curl_init();
		curl_setopt_array( $curl, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL            => 'https://api.kanye.rest/',
		] );
		$response = curl_exec( $curl );
		curl_close( $curl );

		$data = json_decode( $response );
		$qotd = $data->quote;

		$cache_timeout = apply_filters( 'hl/quote/cache/timeout', 0 );

		set_transient( 'quote_of_the_day', $qotd, $cache_timeout );
	}

	echo $qotd;
	exit;
}

add_action( 'wp_ajax_get_quote', 'tt_get_quote' );

/**
 * Returns a desired cache timeout.
 *
 * @param int $timeout
 *
 * @return int
 */
function hl_set_cache_timeout( int $timeout ): int {
	return MINUTE_IN_SECONDS * 5;
}

add_filter( 'hl/quote/cache/timeout', 'hl_set_cache_timeout' );
