<div id="wpbody">

<div id="wpbody-content">
		
			
		
<div class="wrap">
<h2>Manage Songs</h2>
<?php


global $wpdb;
$table		=	$wpdb->prefix."hmp_playlist"; // add quote marks //

if(isset($_GET['id'])){
	$id		=	strip_tags(urlencode($_GET['id']));
}



$action		=	"add";
if(isset($_GET['action'])){
	$action	=	strip_tags(urlencode($_GET['action']));
}

$mp3Sql = "Select * From wp_hmp_playlist";
$mp3Qry = mysql_query($mp3Sql);
$mp3Obj = mysql_fetch_object($mp3Qry);

$mp3Id = $mp3Obj->id;
echo $mp3Id;

if(($mp3Id == 0) || ($mp3Id == "") || ($mp3Id == NULL)){
	$maxSql = "Select * From wp_hmp_playlist";
}
else{
	$maxSql = "Select Max(id) As maxId From wp_hmp_playlist";
}
$maxQry = mysql_query($maxSql);
$maxObj = mysql_fetch_object($maxQry);

$maxId = $maxObj->maxId;

(($maxId == "") || ($maxId == NULL) ? $maxId = 0 : $maxId);

$secureId = $maxId + 1;

$md5Secure = md5($secureId);


switch($action){
	
	case "add";
		if($_POST['submit']){
	$mp3		=	strip_tags($_POST['mp3']);
	$ogg		=	strip_tags($_POST['ogg']);
	$rating		=	strip_tags($_POST['rating']);
	$title		=	strip_tags($_POST['title']);
	$buy		=	strip_tags($_POST['buy']);
	$price		=	strip_tags($_POST['price']);
	$cover		=	strip_tags($_POST['cover']);
	$duration	=	strip_tags($_POST['duration']);
	$artist		=	strip_tags($_POST['artist']);
	$secure		=	strip_tags($md5Secure);
	
$data	=	array(
				'ogg' 		=> $ogg,
				'mp3' 		=> $mp3,
				'rating' 	=> $rating,
				'title' 	=> $title,
				'buy' 		=> $buy,
				'price' 	=> $price,
				'cover' 	=> $cover,
				'duration' 	=> $duration,
				'artist' 	=> $artist,
				'secure' 	=> $secure

				);
if(!empty($_POST['mp3']) and !empty($_POST['ogg']) and !empty($_POST['title']) and !empty($_POST['cover'])){
	
	$insert		=	$wpdb->insert($table,$data) or die(mysql_error());
	$isuccess	=	"Song added successfully to the playlist";
		
}else{
	$ierror		=	"Please fill all fields marked 'required'";	
}

}


	break;
	
	
	
	case "update";
	
		
		
		if($_POST['update']){
	
	
	
	
	$mp3		=	strip_tags($_POST['mp3']);
	$ogg		=	strip_tags($_POST['ogg']);
	$rating		=	strip_tags($_POST['rating']);
	$title		=	strip_tags($_POST['title']);
	$buy		=	strip_tags($_POST['buy']);
	$price		=	strip_tags($_POST['price']);
	$cover		=	strip_tags($_POST['cover']);
	$duration	=	strip_tags($_POST['duration']);
	$artist		=	strip_tags($_POST['artist']);
	

$data	=	array(
				'ogg' 		=> $ogg,
				'mp3' 		=> $mp3,
				'rating' 	=> $rating,
				'title' 	=> $title,
				'buy' 		=> $buy,
				'price' 	=> $price,
				'cover' 	=> $cover,
				'duration' 	=> $duration,
				'artist' 	=> $artist

				);
				
$ID		=	array(
			'secure'	=>	$id
			
			);
if(!empty($_POST['mp3']) and !empty($_POST['ogg']) and !empty($_POST['title']) and !empty($_POST['cover'])){
	
	$update		=	$wpdb->update($table,$data,$ID);
	$usuccess	=	"Song updated successfully ";
		
}else{
	$uerror		=	"Please fill all fields marked 'required'";	
}

}
	
	break;
	
	
	
	case "delete";
		
		$delete		=	$wpdb->query(
							"DELETE FROM $table WHERE secure='$id'"
						);
	break;	
}




$usql		=	"SELECT * FROM $table WHERE secure='$id'";
$uresults 	= 	$wpdb->get_row( $usql  );


?>

<?php if($action=='update'): ?>

<table class="form-table">
        <tr valign="top">
        <th scope="row"></th>
        <td width="25%"></td>
        <td></td>
        <td rowspan="9" width="25%">
         	<table cellpadding="0" class="widefat donation" style="margin-bottom:10px; border:solid 2px #008001;" width="50%">
            	<thead>
                	<th scope="col"><strong style="color:#008001;">Help Improve This Plugin!</strong></th>
                </thead>
                <tbody>
                	<tr>
                    	<td style="border:0;">Enjoyed this plugin? All donations are used to improve and further develop this plugin. Thanks for your contribution.</td>
                    </tr>
                    <tr>
                    	<td style="border:0;"><!--<img src="<?php //echo plugin_dir_url( __FILE__ )."donate.png" ; ?>"  align="middle" />--><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="A74K2K689DWTY">
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" width="1" height="1">
						</form></td>
                    </tr>
                    <tr>
                    	<td style="border:0;">You can also help by <a href="http://wordpress.org/extend/plugins/html5-jquery-audio-player/" target="_blank">rating this plugin on wordpress.org</a></td>
                    </tr>
                   
                </tbody>
            </table>
			<table cellpadding="0" class="widefat donation" style="margin-bottom:10px;">
            	<thead>
                	<th scope="col">Pro Version Features</th>
                </thead>
                <tbody>
                	<tr>
                    	<td style="border:0;">
							<ul>
								<li>Mulitple Playlists</li>
								<li>Drag n Drop playlist manager so you can reorder tracks</li>
								<li>Fully Responsive</li>
								<li>More customisation options</li>
								<li>On/off option for ratings, artwork, artist field, auto-repeat, and cover art</li>
								<li>Widget support</li>
								<li>3 buy/download buttons (optional)</li>
							</ul>
							<br />		
							<a href="http://enigmaplugins.com/plugins/html5-jquery-audio-pro/" target="_blank">Get Pro</a>
						</td>
                    </tr>
                   
                </tbody>
            </table>
            <table cellpadding="0" class="widefat" border="0">
            	<thead>
                	<th scope="col">Need Support?</th>
                </thead>
                <tbody>
                	<tr>
                    	<td style="border:0;">If you are having problems with this plugin please visit the <a href="http://wordpress.org/support/plugin/html5-jquery-audio-player" target="_blank">Support Forum</a></td>
                    </tr>
                   
                </tbody>
            </table>
         </td>
        </tr><form name="addplaylist" action="" method="post" enctype="multipart/form-data">
        <tr valign="top">
        <th scope="row"><strong>MP3 Link update</strong></th>
        <td width="29%"><input type="text" size="50" name="mp3" value="<?php echo $uresults->mp3 ; ?>" class="upload-url" /><input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" style="background: white;border: solid 1px #CCC;cursor: pointer;"></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"><strong>Required</strong> Full File Path of mp3 file</span></td>
        
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Ogg Link</strong></th>
        <td><input type="text" size="50" name="ogg" value="<?php echo $uresults->ogg ; ?>" class="upload-url" /><input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" style="background: white;border: solid 1px #CCC;cursor: pointer;"></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"><strong>Required</strong> Full File Path of ogg file</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Rating</strong></th>
        <td><input type="text" size="50" name="rating" value="<?php echo $uresults->rating ; ?>" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"> Plz put digit 1 to 5</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Song Title</strong></th>
        <td><input type="text" size="50" name="title" value="<?php echo stripslashes($uresults->title); ?>" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"><strong>Required</strong> Title of the song</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Link Buy Text</strong></th>
        <td><input type="text" size="50" name="buy" value="<?php echo $uresults->buy ; ?>" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"> This will link BUY button</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Song Price</strong></th>
        <td><input type="text" size="50" name="price" value="<?php echo $uresults->price ; ?>" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"> Price of the song </span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Cover Image</strong></th>
        <td><input type="text" size="50" name="cover" value="<?php echo $uresults->cover ; ?>" class="upload-url" /><input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" style="background: white;border: solid 1px #CCC;cursor: pointer;"></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"><strong>Required</strong> Full File Path to cover image ( 125*125 )</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Duration</strong></th>
        <td><input type="text" size="50" name="duration" value="<?php echo $uresults->duration ; ?>" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;">Duration of the song</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Artist</strong></th>
        <td><input type="text" size="50" name="artist" value="<?php echo stripslashes($uresults->artist); ?>" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"> Artist of the song</span></td>
        </tr>
        
         <tr valign="top">
        <th scope="row"><input type="submit" class="button-primary" value="<?php _e('Update Song') ?>" name="update" /></th>
        <td> <a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=hmp_palylist&action=add"><input type="button" class="button-primary" value="<?php _e('Add New Song') ?>" name="update" /></a></td>
        <td></td>
        </tr>
         
        
       	
        
         
    </table>	
</form>





<?php else:?>




<table class="form-table">
        
        <?php if(!empty($isuccess)): ?>
        
        <tr valign="top">
       
        <td width="25%"><span style="color:green;"><?php echo $isuccess; ?></span></td>
       
        </tr>
        <?php elseif(!empty($ierror)): ?>
        
        
        
        <tr valign="top">
       
        <td width="25%"><span style="color:red;"><?php echo $ierror; ?></span></td>
       
        </tr>
        <?php endif ?>
        
        <tr valign="top">
        <th scope="row"></th>
        <td width="25%"></td>
        <td></td>
         <td rowspan="9" width="25%">
         	<table cellpadding="0" class="widefat donation" style="margin-bottom:10px; border:solid 2px #008001;" width="50%">
            	<thead>
                	<th scope="col"><strong style="color:#008001;">Help Improve This Plugin!</strong></th>
                </thead>
                <tbody>
                	<tr>
                    	<td style="border:0;">Enjoyed this plugin? All donations are used to improve and further develop this plugin. Thanks for your contribution.</td>
                    </tr>
                    <tr>
                    	<td style="border:0;"><!--<img src="<?php //echo plugin_dir_url( __FILE__ )."donate.png" ; ?>"  align="middle" />--><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="A74K2K689DWTY">
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" width="1" height="1">
						</form></td>
                    </tr>
                    <tr>
                    	<td style="border:0;">You can also help by <a href="http://wordpress.org/extend/plugins/html5-jquery-audio-player/" target="_blank">rating this plugin on wordpress.org</a></td>
                    </tr>
                   
                </tbody>
            </table>
			<table cellpadding="0" class="widefat donation" style="margin-bottom:10px;">
            	<thead>
                	<th scope="col">Pro Version</th>
                </thead>
                <tbody>
                	<tr>
                    	<td style="border:0;">
							<ul>
								<li>Mulitple Playlists</li>
								<li>Drag n Drop playlist manager so you can reorder tracks</li>
								<li>Fully Responsive</li>
								<li>More customisation options</li>
								<li>On/off option for ratings, artwork, artist field, auto-repeat, and cover art</li>
								<li>Widget support</li>
								<li>3 buy/download buttons (optional)</li>
							</ul>
							<br />		
							<a href="http://enigmaplugins.com/plugins/html5-jquery-audio-pro/" target="_blank">Get Pro</a>
						</td>
                    </tr>
                   
                </tbody>
            </table>
            <table cellpadding="0" class="widefat" border="0">
            	<thead>
                	<th scope="col">Need Support?</th>
                </thead>
                <tbody>
                	<tr>
                    	<td style="border:0;">If you are having problems with this plugin please visit the <a href="http://wordpress.org/support/plugin/html5-jquery-audio-player" target="_blank">Support Forum</a></td>
                    </tr>
                   
                </tbody>
            </table>
         </td>
        </tr>
        <form name="addplaylist" action="" method="post" enctype="multipart/form-data">
        <tr valign="top">
        <th scope="row"><strong>MP3 Link</strong></th>
        <td width="29%"><input type="text" size="50" name="mp3" class="upload-url" /><input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" style="background: white;border: solid 1px #CCC;cursor: pointer;"></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"><strong>Required</strong> Full File Path of mp3 file</span></td>
         
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Ogg Link</strong></th>
        <td><input type="text" size="50" name="ogg" class="upload-url" /><input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" style="background: white;border: solid 1px #CCC;cursor: pointer;"></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"><strong>Required</strong> Full File Path of ogg file</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Rating</strong></th>
        <td><input type="text" size="50" name="rating" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"> Please put digit 1 to 5</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Song Title</strong></th>
        <td><input type="text" size="50" name="title" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"><strong>Required</strong> Title of the song</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Link Buy Text</strong></th>
        <td><input type="text" size="50" name="buy" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"> This will link BUY button</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Song Price</strong></th>
        <td><input type="text" size="50" name="price" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"> Price of the song </span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Cover Image</strong></th>
        <td><input type="text" size="50" name="cover" class="upload-url" /><input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" style="background: white;border: solid 1px #CCC;cursor: pointer;"></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"><strong>Required</strong> Full File Path to cover image ( 125*125 )</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Duration</strong></th>
        <td><input type="text" size="50" name="duration" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"><strong>Format: 10:00</strong> Duration of the song</span></td>
        </tr>
        <tr valign="top">
        <th scope="row"><strong>Artist</strong></th>
        <td><input type="text" size="50" name="artist" /></td>
        <td><span style="font-size:11px; color:#b2b2b2; font-style:italic;"> Artist of the song</span></td>
        </tr>
        
         <tr valign="top">
        <th scope="row"><input type="submit" class="button-primary" value="<?php _e('Add Song') ?>" name="submit" /></th>
        <td></td>
        <td></td>
        </tr>
         </form>
        
       	
        
         
    </table>	

<?php endif ?>

<table class="wp-list-table widefat fixed" cellspacing="0" style=" margin-top:20px;">
	<thead>
	<tr>
		
        <th scope="col"><a href="javascrip:;">Title</a></th>
        <th scope="col" width="25%" ><a href="javascrip:;">Artist</a></th>
        <th scope="col" width="10%"><a href="javascrip:;">Price</a></th>
        <th scope="col" width="10%"><a href="javascrip:;">Rating</a></th>
        <th scope="col" width="10%"><a href="javascrip:;">Duration</a></th>
        <th scope="col" width="10%"><a href="javascrip:;">Edit</a></th>	
        <th scope="col" width="10%"><a href="javascrip:;">Delete</a></th>	
     </tr>
	</thead>

	<tfoot>
	<tr>
	    <th scope="col"><a href="javascrip:;">Title</a></th>
        <th scope="col" width="25%" ><a href="javascrip:;">Artist</a></th>
        <th scope="col" width="10%"><a href="javascrip:;">Price</a></th>
        <th scope="col" width="10%"><a href="javascrip:;">Rating</a></th>
        <th scope="col" width="10%"><a href="javascrip:;">Duration</a></th>
        <th scope="col" width="10%"><a href="javascrip:;">Edit</a></th>	
        <th scope="col" width="10%"><a href="javascrip:;">Delete</a></th>		
     </tr>
	</tfoot>

	<tbody id="the-list">
    
    <?php
		$sql		=	"SELECT * FROM $table";

		$results 	= 	$wpdb->get_results( $sql );
	?>
	<?php if( !empty( $results ) ) : ?>
    <?php foreach( $results as $result ): ?>
    <tr>
        <td><?php echo stripslashes($result->title); ?></td>
        <td width="25%"><?php echo stripslashes($result->artist); ?></td>
        <td width="10%"><?php echo $result->price; ?></td>
        <td width="10%"><?php echo $result->rating; ?></td>
        <td width="10%"><?php echo $result->duration; ?></td>
        <td width="10%"><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=hmp_palylist&action=update&id=<?php echo $result->secure; ?>">Update</a></td>
        <td width="10%"><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=hmp_palylist&action=delete&id=<?php echo $result->secure; ?>">Delete</a></td>
	</tr>
	<?php endforeach; ?>
	
	<?php else: ?>
    
    <td class="posts column-posts num" colspan="7">Please Add Songs No Songs Listed Yet</td>
    
	<?php endif; ?>
  	
  </tbody>
</table>
</div>

<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div>