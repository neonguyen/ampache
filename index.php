<?php
/*

 Copyright (c) 2001 - 2006 Ampache.org
 All rights reserved.

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License v2
 as published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

*/

/*!
	@header Index of Ampache
	@discussion Do most of the dirty work of displaying the mp3 catalog

*/

require_once('lib/init.php');

show_template('header');

$action = scrub_in($_REQUEST['action']);

/**
 * Check for the refresh mojo, if it's there then require the
 * refresh_javascript include. Must be greater then 5, I'm not
 * going to let them break their servers
 */
if (conf('refresh_limit') > 5) { 
	$ajax_url = conf('ajax_url') . '?action=reloadnp' . conf('ajax_info');
	require_once(conf('prefix') . '/templates/javascript_refresh.inc.php');
}
?>
<div id="np_data">
	<?php show_now_playing(); ?>
</div> <!-- Close Now Playing Div -->

<!-- Big Daddy Table -->
<?php show_box_top(); ?>
<table id="bigdaddy">
<tr>
	<td valign="top">
		<table border="0"><!-- Left table -->
		<tr>
			<td valign="top"> 
				<?php show_local_catalog_info(); ?>
			</td>
			<td valign="top">
			<?php 
				if ($items = get_global_popular('album')) { 
					show_info_box(_('Most Popular Albums'), 'album',$items);
				}
			?>
			</td>	
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td valign="top">
			<?php
				if ($items = get_global_popular('artist')) {
					show_info_box(_('Most Popular Artists'), 'artist', $items);
				}
			?>
			</td>
			<td valign="top">
			<?php
				if ($items = get_global_popular('song')) {
					show_info_box(_('Most Popular Songs'), 'song', $items);
				}
			?>
			</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td valign="top">
			<?php
				if ($items = get_newest('artist')) {
					show_info_box(_('Newest Artist Additions'), '', $items);
				}
			?>
			</td>
			<td valign="top">
			<?php
				if ($items = get_newest('album')) {
					show_info_box(_('Newest Album Additions'), '', $items);
				}
			?>
			</td>
		</tr>
		</table><!-- End Left table -->
	</td>
</tr>
</table>
<?php show_box_bottom(); ?>
<!-- End Big Daddy Table -->
<?php show_footer(); ?>
