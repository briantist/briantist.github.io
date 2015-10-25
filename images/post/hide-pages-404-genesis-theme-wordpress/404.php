<?php
/**
 * Handles display of 404 page.
 *
 * This file is based on a core Genesis file.
 * Modified by Brian Scholer on Nov 21, 2012 - http://www.briantist.com/how-to/hide-pages-404-genesis-theme-wordpress/
 *
 * @category Genesis
 * @package  Templates
 * @author   StudioPress
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.studiopress.com/themes/genesis
 */

/** Remove default loop **/
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.6
 */
function genesis_404() { ?>

	<div class="post hentry">

		<h1 class="entry-title"><?php _e( 'Not Found, Error 404', 'genesis' ); ?></h1>
		<div class="entry-content">
			<p><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ), home_url() ); ?></p>

			<div class="archive-page">

				<h4><?php _e( 'Pages:', 'genesis' ); ?></h4>
				<ul>
					<?php
						$pages = get_pages();
						$exclude = array();
						foreach ( $pages as $page ) {
							$meta = get_post_custom_values( '404' , $page->ID );
							if ( $meta ) {
								foreach ( $meta as $key => $value ) {
									if ( $value == 'hide' ) {
										$exclude[] = $page->ID;
										break;
									}
								}
							}
						}
						wp_list_pages( 'title_li=&exclude=' . implode( ',' , $exclude ) );
					?>
				</ul>

				<h4><?php _e( 'Categories:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
				</ul>

			</div><!-- end .archive-page-->

			<div class="archive-page">

				<h4><?php _e( 'Authors:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_authors( 'exclude_admin=0&optioncount=1' ); ?>
				</ul>

				<h4><?php _e( 'Monthly:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>

				<h4><?php _e( 'Recent Posts:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_get_archives( 'type=postbypost&limit=100' ); ?>
				</ul>

			</div><!-- end .archive-page-->

		</div><!-- end .entry-content -->

	</div><!-- end .postclass -->

<?php
}

genesis();
