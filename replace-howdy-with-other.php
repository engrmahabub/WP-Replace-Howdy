<?php 
/*
Plugin Name: SM Replace Howdy
Plugin URI: http://mahabub.me/plugin/replace_howdy
Author: Mahabubur Rahman
Author URI: http://www.mahabub.me
Version: 1.0.0
Description: Wordpress Plugin for replace Howdy with other Word.

*/

if (is_admin()) {
	function wp_replace_howdy() {
	    add_options_page('SM Replace Howdy', 'SM Replace Howdy', 'manage_options',  basename(__FILE__), 'wp_replace_the_howdy_page');
	}
	add_action('admin_menu', 'wp_replace_howdy');
}

function wp_replace_the_howdy_page(){
	if(isset($_POST['thehowdyreplacetext'])){
		$nonce = $_REQUEST['_wpnonce'];
		if (! wp_verify_nonce($nonce, 'php-the-howdy-update' ) ) {
            die('security error');
        }
		$thehowdyreplacetext = $_POST['thehowdyreplacetext'];
		update_option( 'wp_thehowdyreplacetext', $thehowdyreplacetext );

	}

	$wp_thehowdyreplacetext=get_option('wp_thehowdyreplacetext');
	?>	
    <div class="bootstrap-wrapper">
    	<form action="" method="post">
	    	<?php wp_nonce_field('php-the-howdy-update'); ?>
	      	<div class="row" style="margin:0px;margin-top:20px;">
	      		<h2 class="hndle ui-sortable-handle">Replace Howdy with other Word</h2>
		        <div class="form-horizontal" style="margin-top:40px;"> 
		          <div class="form-group">       
		            <label for="replace_howdy_text" class="control-label col-xs-2">Howdy Replace Word</label>
		            <div class="col-xs-8">
		              <input class="form-control" type="text" id="replace_howdy_text" placeholder="Write a word" name ='thehowdyreplacetext' value= '<?php echo $wp_thehowdyreplacetext ; ?>' />
		            </div>
		          </div>
		        </div>
	    	</div>
	    	<div class="form-group">
	    		<div class="col-xs-10">
	    			<input style="float:right;" type="submit" value="Save Changes" class="button-primary control-label col-xs-2" id="submit" name="submit" />
	    		</div>
	    	</div>
    	</form>
    </div>
	<?php
}
function replace_the_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $thehowdyreplacetext = get_option('wp_thehowdyreplacetext') ;
    $newtitle = str_replace( 'Howdy', $thehowdyreplacetext, $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
//add_filter( 'admin_bar_menu', 'replace_the_howdy',25 );

if ( get_option('wp_thehowdyreplacetext')) {
	add_filter( 'admin_bar_menu', 'replace_the_howdy',25 ); 
}