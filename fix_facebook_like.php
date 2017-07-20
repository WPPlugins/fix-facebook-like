<?php
/*
Plugin Name: Fix Facebook Like
Version: 1.2.5
Description: This plugin fixes Facebook Like problems like wrong thumbnail, wrong title, wrong description and adds type of website and admins of your website.
Author: Pritesh Gupta
Author URI: http://www.priteshgupta.com
Plugin URI: http://www.priteshgupta.com/plugins/fix-fblike
License: GPL
*/

/*  Copyright (C) 2011  Pritesh Gupta {http://www.priteshgupta.com/plugins/fix-fblike}

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php
        add_action('activate_fblike_fix.php', 'fblike_fix');
		function fblike_fix(){
			add_option("fblike_fix", 'blog');
			add_option("fblike_fix2", '');
			add_option("fblike_fix3", '');
			add_option("fblike_fix_display", 'no');
		}
	add_action('wp_head', 'fblike_fix_session');
	function fblike_fix_session(){$_SESSION['fblike_fix_nri'] = 0;}
	
    add_action('admin_menu', 'fblike_fix_menu');
    function fblike_fix_menu() {
        if (function_exists('add_options_page')) {
            add_options_page('Fix Facebook Like', 'Fix Facebook Like', 9, 'fblike_fix', 'fblike_fix_display');
        }
    }
    function fblike_fix_display(){
		
        if($_POST['Submit']){
			$fblike_fix = $_POST['fblike_fix'];
			$fblike_fix2 = $_POST['fblike_fix2'];
			$fblike_fix3 = $_POST['fblike_fix3'];
			update_option("fblike_fix", $fblike_fix);
			update_option("fblike_fix2", $fblike_fix2);
			update_option("fblike_fix3", $fblike_fix3);
			update_option("fblike_fix_display", $_POST['fblike_fix_display']);
			
			echo '<div id="message" class="updated fade"><p>Update Successful!</p></div>';
		}
		$output = '<form method="post" action="'.$_SERVER['REQUEST_URI'].'">';
		?>
	<style type="text/css">
	.author{
	text-decoration:none;
	}
		
	table{
	width:60%;
	border-collapse:collapse;
	table-layout:auto;
	vertical-align:top;
	margin-bottom:15px;
	border:1px solid #CCCCCC;
	}

	table thead th{
	color:#FFFFFF;
	background-color:#666666;
	border:1px solid #CCCCCC;
	border-collapse:collapse;
	text-align:center;
	table-layout:auto;
	vertical-align:middle;
	}

	table tbody td{
	vertical-align:top;
	border-collapse:collapse;
	border-left:1px solid #CCCCCC;
	border-right:1px solid #CCCCCC;
	}
	
	table thead th, table tbody td{
	padding:5px;
	border-collapse:collapse;
	}

	table tbody tr.light{
	color:#333333;
	background-color:#F7F7F7;
	}

	table tbody tr.dark{
	color:#333333;
	background-color:#E8E8E8;
	}
	
	input[type=text]{
	background: #cecdcd; /* Fallback */
	background: rgba(206, 205, 205, 0.6);
	border: 2px solid #666;
	padding: 6px 5px;
	line-height: 1em;
	-webkit-box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	-moz-box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	-webkit-border-radius: 8px !important; 
	-moz-border-radius: 8px !important;
	border-radius: 8px !important; 
	margin-bottom: 10px;
	width: 300px;
	}
	
	select{
	background: #cecdcd; /* Fallback */
	background: rgba(206, 205, 205, 0.6);
	border: 2px solid #666;
	padding: 6px 5px;
	height: 2.8em !important;
	-webkit-box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	-moz-box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	-webkit-border-radius: 8px !important; 
	-moz-border-radius: 8px !important;
	border-radius: 8px !important; 
	margin-bottom: 10px;
	width: 300px;
	text-align:center;
	}
	
	</style>
		<?php
		$output .= '<div class="wrap">'."\n";
		$output .= '	<h2>Fix Facebook Like Plugin Options</h2>'."\n";
		$output .= '	by <strong><a href="http://www.priteshgupta.com" target="_blank" class="author">Pritesh Gupta</a></strong> || <a href="http://www.priteshgupta.com/plugins/fix-fblike" target="_blank" class="author"><strong>Visit Release Page</strong></a>'."\n";
		$output .= '	<br /> <br />'."\n";
		$output .= '	<table border="0" cellspacing="0" cellpadding="6">'."\n";
		
		$fblike_fix_display = get_option('fblike_fix_display');
		$output .= '		<tr class="light">'."\n";
		$output .= '			<td width="75%">Use post excerpt for description text?</td>'."\n";
		$output .= '			<td width="25%">';
		$output .= '				<select name="fblike_fix_display">'."\n";
		$output .= '					<option value="no"';if ($fblike_fix_display == 'no') $output .= 'selected="selected"';$output .= '>No</option>'."\n";
		$output .= '					<option value="yes"';if ($fblike_fix_display == 'yes') $output .= 'selected="selected"';$output .= '>Yes</option>'."\n";
		$output .= '				</select>'."\n";
		$output .= '			</td>';
		$output .= '		</tr>'."\n";
		$output .= '		<tr class="dark">'."\n";
		$output .= '			<td width="75%">Enter type of your website, visit <a href="http://developers.facebook.com/docs/opengraph/#types" target="_blank">here</a> for help: </td>'."\n";
		$output .= '			<td width="25%"><input type="text" name="fblike_fix" value="'.get_option('fblike_fix').'" /></td>';
		$output .= '		</tr>'."\n";

		$output .= '		<tr class="light">'."\n";
		$output .= '			<td width="75%">Enter your website\'s logo full URL(Image used if home page is liked) : </td>'."\n";
		$output .= '			<td width="25%"><input type="text" name="fblike_fix2" value="'.get_option('fblike_fix2').'" /></td>';
		$output .= '		</tr>'."\n";

		$output .= '		<tr class="dark">'."\n";
		$output .= '			<td width="50%">Enter comma-separated list of Facebook user IDs who administer this page(Leave blank if you do not wish to display): </td>'."\n";
		$output .= '			<td><input type="text" name="fblike_fix3" value="'.get_option('fblike_fix3').'" /></td>';
		$output .= '		</tr>'."\n";

		$output .= '	</table>'."\n";
		$output .= "\n";
		$output .= '				<input type="submit" name="Submit" class="button-primary" style="float:left" value="Update Options &raquo;" /><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=doubleagentcreative%40gmail%2ecom&lc=US&item_name=Pritesh%20Gupta&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHostedGuest" title="PayPal Donate" style="float:left; margin-left: 7px"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" /></a>&nbsp;&nbsp;'."\n";
		$output .= '</form>';
		$output .= '</div>'."\n";
        echo $output;
    }

function addHeaderCode(){ 
if (!is_preview()) {
$type = get_option("fblike_fix");
$logo = get_option("fblike_fix2");
$facebook_id = get_option("fblike_fix3");
$Excerpt = get_the_excerpt();
$tags = array('<p>', '</p>','<a href="','<span class="meta-nav">','</span></a>','&rarr;', '">', 'Continue reading', get_permalink(), );
$Excerpt = str_replace($tags, "", $Excerpt);
if ( is_home() || is_front_page() ) { ?>
<!-- Begin Fix Facebook Like WordPress Plugin -->
<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>"/>
<?php } else { ?>
<!-- Begin Fix Facebook Like WordPress Plugin -->
<meta property="og:title" content="<?php echo the_title(); ?>"/>
<?php } ?>
<meta property="og:type" content="<?php echo $type ?>"/>
<?php if ( is_home() || is_front_page() ) { ?>
<meta property="og:url" content="<?php echo get_bloginfo('wpurl'); ?>"/>
<?php } else { ?>
<meta property="og:url" content="<?php echo get_permalink(); ?>"/>
<?php } ?>
<?php if ( is_home() || is_front_page() ) { ?>
<meta property="og:image" content="<?php echo $logo ?>"/>
<?php } else { ?>
<meta property="og:image" content="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>"/>
<?php } ?>
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
<meta property="fb:admins" content="<?php echo $facebook_id ?>"/>
<?php if (get_option("fblike_fix_display") == 'yes'){ ?>
<?php if ( is_single() ) { ?>
<meta property="og:description" content=" <?php echo $Excerpt ?> "/>
<?php } elseif ( is_home() || is_front_page() ) { ?>
<meta property="og:description" content=" <?php echo get_bloginfo ( 'description' ); ?> "/> 
<?php } ?>
<?php } ?>
<!-- End Fix Facebook Like WordPress Plugin -->
<?php } ?>
<?php } add_action('wp_head', 'addHeaderCode'); ?>