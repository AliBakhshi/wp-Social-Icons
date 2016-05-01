<?php
/*
Plugin Name: Social Icons Bakhshi
Plugin URI: http://www.ali-bakhshi.ir
Description: Add Social Icons to site
Version: 0.1
Author: Bakhshi
Author URI: http://www.ali-bakhshi.ir
*/
// create custom plugin settings menu

add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('Social Networks','Social Networks Setting', 'administrator', 'social_bakhshi' , 'social_setting_page' , plugins_url('/img/32.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_social_setting' );
}


function register_social_setting() {
	//register our settings
	register_setting( 'bakhshi_social_settings', 'active' );
	register_setting( 'bakhshi_social_settings', 'fb' );
	register_setting( 'bakhshi_social_settings', 'tt' );
	register_setting( 'bakhshi_social_settings', 'feed' );
	register_setting( 'bakhshi_social_settings', 'ig' );
	register_setting( 'bakhshi_social_settings', 'shortcode' );
	register_setting( 'bakhshi_social_settings', 'title' );
}

function social_setting_page() {
?>
<div class="wrap">
<h2>wp Social Icons</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'bakhshi_social_settings' ); ?>
    <?php do_settings_sections( 'bakhshi_social_settings' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Active PLugin</th>
        <td>
		<?php $active = get_option('active',"active"); ?>
		<select name="active">
		<option value="active" <?php if($active == "active") { echo "selected='selected'"; } ?>>Active</option>
		<option value="deactive" <?php if($active == "deactive") { echo "selected='selected'"; } ?>>Deactive</option>
		</select>
		</td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Active Short Code</th>
        <td>
		<?php $shortcode = get_option('shortcode',"active"); ?>
		<select name="shortcode">
		<option value="active" <?php if($shortcode == "active") { echo "selected='selected'"; } ?>>Active</option>
		<option value="deactive" <?php if($shortcode == "deactive") { echo "selected='selected'"; } ?>>Deactive</option>
		</select>
		</td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Title Of PLugin</th>
        <td><input type="text" name="title" value="<?php echo get_option('title',"Share It"); ?>" /></td>
        </tr>
		
		<tr valign="top">
        <th scope="row">Choose Social Networks</th>
        <td>
		<?php
		$fb = get_option('fb',"fb");
		$ig = get_option('ig',"ig");
		$feed = get_option('feed',"feed");
		$tt = get_option('tt',"tt");
		?>
		<input type="checkbox" name="fb" value="fb" <?php if($fb == "fb") { echo "checked"; } ?>>FaceBokk<br>
		<input type="checkbox" name="ig" value="ig" <?php if($ig == "ig") { echo "checked"; } ?>>Instagram<br>
		<input type="checkbox" name="feed" value="feed" <?php if($feed == "feed") { echo "checked"; } ?>>RSS Fedd<br>
		<input type="checkbox" name="tt" value="tt" <?php if($tt == "tt") { echo "checked"; } ?>>Twitter<br>
		</td>
        </tr>
		
		
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } 
$fb2 = get_option('fb',"fb");
$ig2 = get_option('ig',"ig");
$feed2 = get_option('feed',"feed");
$tt2 = get_option('tt',"tt");
$pluginactive = get_option('active',"active");
$shortcodeactive = get_option('shortcode',"active"); 
$dir = plugin_dir_url( __FILE__ );
if($pluginactive == "active"){
	
function social_icons() { 
	global $fb2;
	global $ig2;
	global $feed2;
	global $tt2;
	global $dir;
	echo "<h2>" . get_option('title',"Share It") . "</h2>";
	$url = "http://" . $_SERVER['SERVER_NAME'] . "/" . $_SERVER['REQUEST_URI'];
	
	if($fb2 == "fb"){
		
		echo "<a href='http://www.facebook.com/sharer/sharer.php?u=".$url."'><img src='";
		echo $dir . "/facebook.png";
		echo "'></a>";
		
	}
	
	if($ig2 == "ig"){
		
		echo "<a href='http://www.instagram.com'><img src='";
		echo $dir . "/Instagram.png";
		echo "'></a>";
		
	}
	
	if($feed2 == "feed"){
		
		echo "<a href='"."http://" . $_SERVER['SERVER_NAME']."/feed/'><img src='";
		echo $dir . "/RSS.png";
		echo "'></a>";
		
	}
	
	if($tt2 == "tt"){
		
		echo "<a href='http://www.twitter.com/share?url=".$url."'><img src='";
		echo $dir . "/Twitter.png";
		echo "'></a>";
		
	}
	
}


if($shortcodeactive == "active"){
add_shortcode( 'social', 'social_icons' );
}

}	
?>
