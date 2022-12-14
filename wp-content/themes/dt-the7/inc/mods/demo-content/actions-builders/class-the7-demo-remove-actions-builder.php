<?php
/**
 * @package The7
 */

defined( 'ABSPATH' ) || exit;

/**
 * @see The7_Demo_Content_Admin::get_actions_builder()
 */
class The7_Demo_Remove_Actions_Builder extends The7_Demo_Actions_Builder_Base {

	protected function init() {
		if ( empty( $this->external_data['demo_id'] ) ) {
			$this->add_nothing_to_remove_error();

			return;
		}

		$demo = $this->setup_demo( $this->external_data['demo_id'] );

		if ( empty( $demo ) ) {
			$this->add_nothing_to_remove_error();

			return;
		}

		$this->setup_starting_text(
			sprintf(
				// translators: %s: demo name
				esc_html( _x( 'Removing %s content ...', 'admin', 'the7mk2' ) ),
				$demo->title
			)
		);
	}

	protected function setup_data() {
		$demo = $this->demo();

		$actions = [ 'remove_content' ];
		$demo_id = $demo->id;

		$this->localize_the7_import_data(
			compact( 'actions', 'demo_id' )
		);
	}

	protected function add_nothing_to_remove_error() {
		$text = esc_html_x( 'Cannot find the demo to remove.', 'admin', 'the7mk2' );
		$text .= sprintf(
			' <a href="%s">%s</a>',
			the7_demo_content()->admin_url(),
			esc_html_x( 'Go back.', 'admin', 'the7mk2' )
		);

		$this->add_error( $text );
	}
}
