<?php
/**
 * adminSettings.php
 * 
 * Shows the setting page at the admin panel.
 * 
 * PHP versions 5
 * 
 * @category  UserAccessManager
 * @package   UserAccessManager
 * @author    Alexander Schneider <alexanderschneider85@googlemail.com>
 * @copyright 2008-2010 Alexander Schneider
 * @license   http://www.gnu.org/licenses/gpl-2.0.html  GNU General Public License, version 2
 * @version   SVN: $Id$
 * @link      http://wordpress.org/extend/plugins/user-access-manager/
 */
global $userAccessManager;
$uamOptions = $userAccessManager->getAdminOptions();

if (isset($_POST['update_uam_settings'])) {
    if ($_POST['uam_full_access_level'] > 10
        || !is_numeric($_POST['uam_full_access_level'])
    ) {
        $_POST['uam_full_access_level'] = 10;
    }
    
    foreach ($uamOptions as $option => $value) {
        if (isset($_POST['uam_' . $option])) {
            $uamOptions[$option] = $_POST['uam_' . $option];
        }
    }
    
    update_option($this->adminOptionsName, $uamOptions);
    
    if ($_POST['uam_lock_file'] == 'false') {
        $userAccessManager->deleteHtaccessFiles();
    } else {
        $userAccessManager->createHtaccess();
        $userAccessManager->createHtpasswd(true);
    }
    ?>
    <div class="updated">
    	<p><strong><?php echo TXT_UPDATE_SETTINGS; ?></strong></p>
    </div>
    <?php
}
?>

<div class="wrap">
    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
        <h2><?php echo TXT_SETTINGS; ?></h2>
        <h3><?php echo TXT_POST_SETTING; ?></h3>
        <p><?php echo TXT_POST_SETTING_DESC; ?></p>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row"><?php echo TXT_HIDE_POST; ?></th>
			<td>
				<label for="uam_hide_post_yes">
					<input type="radio" id="uam_hide_post_yes" class="uam_hide_post" name="uam_hide_post" value="true" <?php 
if ($uamOptions['hide_post'] == "true") { 
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_hide_post_no">
					<input type="radio" id="uam_hide_post_no" class="uam_hide_post" name="uam_hide_post" value="false" <?php
if ($uamOptions['hide_post'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?>
				</label> <br />
				<?php echo TXT_HIDE_POST_DESC; ?>
			</td>
		</tr>
	</tbody>
</table>
<table class="form-table" id="uam_post_settings">
	<tbody>
		<tr valign="top">
			<th scope="row"><?php echo TXT_DISPLAY_POST_TITLE; ?></th>
			<td>
				<label for="uam_hide_post_title_yes"> 
					<input type="radio" id="uam_hide_post_title_yes" name="uam_hide_post_title" value="true" <?php
if ($uamOptions['hide_post_title'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_hide_post_title_no"> 
					<input type="radio" id="uam_hide_post_title_no" name="uam_hide_post_title" value="false" <?php
if ($uamOptions['hide_post_title'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_DISPLAY_POST_TITLE_DESC; ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php
echo TXT_POST_TITLE; ?></th>
			<td>
				<input name="uam_post_title" value="<?php echo $uamOptions['post_title']; ?>" /> <br />
				<?php echo TXT_POST_TITLE_DESC; ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php echo TXT_SHOW_POST_CONTENT_BEFORE_MORE; ?></th>
			<td>
				<label for="uam_show_post_content_before_more_yes"> 
					<input type="radio" id="uam_show_post_content_before_more_yes" name="uam_show_post_content_before_more" value="true" <?php
if ($uamOptions['show_post_content_before_more'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_show_post_content_before_more_no"> 
					<input type="radio" id="uam_show_post_content_before_more_no" name="uam_show_post_content_before_more" value="false" <?php
if ($uamOptions['show_post_content_before_more'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_SHOW_POST_CONTENT_BEFORE_MORE_DESC; ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php echo TXT_POST_CONTENT; ?></th>
			<td>
				<textarea name="uam_post_content" style="width: 80%; height: 100px;" cols="40" rows="10"><?php 
				    echo apply_filters('format_to_edit', $uamOptions['post_content']); 
				?></textarea> <br />
			    <?php echo TXT_POST_CONTENT_DESC; ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php echo TXT_DISPLAY_POST_COMMENT; ?></th>
			<td>
				<label for="uam_hide_post_comment_yes"> 
					<input id="uam_hide_post_comment_yes" type="radio" name="uam_hide_post_comment" value="true" <?php
if ($uamOptions['hide_post_comment'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_hide_post_comment_no"> 
					<input id="uam_hide_post_comment_no" type="radio" name="uam_hide_post_comment" value="false" <?php
if ($uamOptions['hide_post_comment'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_DISPLAY_POST_COMMENT_DESC; ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php echo TXT_POST_COMMENT_CONTENT; ?></th>
			<td>
				<input name="uam_post_comment_content" value="<?php echo $uamOptions['post_comment_content']; ?>" /> <br />
				<?php echo TXT_POST_COMMENT_CONTENT_DESC; ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php echo TXT_POST_COMMENTS_LOCKED; ?></th>
			<td>
				<label for="uam_post_comments_locked_yes"> 
					<input id="uam_post_comments_locked_yes" type="radio" name="uam_post_comments_locked" value="true" <?php
if ($uamOptions['post_comments_locked'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_post_comments_locked_no"> 
					<input id="uam_post_comments_locked_no" type="radio" name="uam_post_comments_locked" value="false" <?php
if ($uamOptions['post_comments_locked'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_POST_COMMENTS_LOCKED_DESC; ?>
			</td>
		</tr>
	</tbody>
</table>
<h3><?php echo TXT_PAGE_SETTING; ?></h3>
<p><?php echo TXT_PAGE_SETTING_DESC; ?></p>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php echo TXT_HIDE_PAGE; ?></th>
			<td>
				<label for="uam_hide_page_yes"> 
				<input type="radio" id="uam_hide_page_yes" class="uam_hide_page" name="uam_hide_page" value="true" <?php
if ($uamOptions['hide_page'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_hide_page_no"> 
					<input type="radio" id="uam_hide_page_no" class="uam_hide_page" name="uam_hide_page" value="false" <?php
if ($uamOptions['hide_page'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_HIDE_PAGE_DESC; ?>
			</td>
		</tr>
	</tbody>
</table>
<table class="form-table" id="uam_page_settings">
	<tbody>
		<tr valign="top">
			<th scope="row"><?php echo TXT_DISPLAY_PAGE_TITLE; ?></th>
			<td>
				<label for="uam_hide_page_title_yes"> 
					<input type="radio" id="uam_hide_page_title_yes" name="uam_hide_page_title" value="true" <?php
if ($uamOptions['hide_page_title'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_hide_page_title_no"> 
					<input type="radio" id="uam_hide_page_title_no" name="uam_hide_page_title" value="false" <?php
if ($uamOptions['hide_page_title'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_DISPLAY_PAGE_TITLE_DESC; ?>
			</td>
		</tr>
		<tr>
			<th><?php echo TXT_PAGE_TITLE; ?></th>
			<td>
				<input name="uam_page_title" value="<?php echo $uamOptions['page_title']; ?>" /> <br />
				<?php echo TXT_PAGE_TITLE_DESC; ?>
			</td>
		</tr>
		<tr>
			<th><?php echo TXT_PAGE_CONTENT; ?></th>
			<td>
				<textarea name="uam_page_content" style="width: 80%; height: 100px;" cols="40" rows="10" ><?php 
				    echo apply_filters('format_to_edit', $uamOptions['page_content']); 
				?></textarea>
				<br />
			    <?php echo TXT_PAGE_CONTENT_DESC; ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php echo TXT_DISPLAY_PAGE_COMMENT; ?></th>
			<td>
				<label for="uam_hide_page_comment_yes"> 
					<input id="uam_hide_page_comment_yes" type="radio" name="uam_hide_page_comment" value="true" <?php
if ($uamOptions['hide_page_comment'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_hide_page_comment_no"> 
					<input id="uam_hide_page_comment_no" type="radio" name="uam_hide_page_comment" value="false" <?php
if ($uamOptions['hide_page_comment'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_DISPLAY_PAGE_COMMENT_DESC; ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php echo TXT_PAGE_COMMENT_CONTENT; ?></th>
			<td>
				<input name="uam_page_comment_content" value="<?php echo $uamOptions['page_comment_content']; ?>" /> <br />
				<?php echo TXT_PAGE_COMMENT_CONTENT_DESC; ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php echo TXT_PAGE_COMMENTS_LOCKED; ?></th>
			<td>
				<label for="uam_page_comments_locked_yes"> 
					<input id="uam_page_comments_locked_yes" type="radio" name="uam_page_comments_locked" value="true" <?php
if ($uamOptions['page_comments_locked'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_page_comments_locked_no"> 
					<input id="uam_page_comments_locked_no" type="radio" name="uam_page_comments_locked" value="false" <?php
if ($uamOptions['page_comments_locked'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_PAGE_COMMENTS_LOCKED_DESC; ?>
			</td>
		</tr>
	</tbody>
</table>
<h3><?php echo TXT_FILE_SETTING; ?></h3>
<p><?php echo TXT_FILE_SETTING_DESC; ?></p>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php echo TXT_LOCK_FILE; ?></th>
			<td>
				<label for="uam_lock_file_yes"> 
					<input type="radio" id="uam_lock_file_yes" class="uam_lock_file" name="uam_lock_file" value="true" <?php
if ($uamOptions['lock_file'] == "true") {
    echo 'checked="checked"';
}                   
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_lock_file_no"> 
					<input type="radio" id="uam_lock_file_no" class="uam_lock_file" name="uam_lock_file" value="false" <?php
if ($uamOptions['lock_file'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_LOCK_FILE_DESC; ?>
			</td>
		</tr>
	</tbody>
</table>
<table class="form-table" id="uam_file_settings">
	<tbody>
<?php 
$permaStruc = get_option('permalink_structure');
            
if (empty($permaStruc)) {
    ?>
		<tr>
			<th><?php
    echo TXT_DOWNLOAD_FILE_TYPE; ?></th>
			<td>
				<label for="uam_lock_file_types_all"> 
					<input type="radio" id="uam_lock_file_types_all" name="uam_lock_file_types" value="all" <?php
    if ($uamOptions['lock_file_types'] == "all") {
        echo 'checked="checked"';
    }                   ?> />
				    <?php echo TXT_ALL; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_lock_file_types_selected"> 
					<input type="radio" id="uam_lock_file_types_selected" name="uam_lock_file_types" value="selected" <?php
    if ($uamOptions['lock_file_types'] == "selected") {
        echo 'checked="checked"';
    } 
                    ?> />
				    <?php echo TXT_SELECTED_FILE_TYPES; ?> 
				</label>
				<input name="uam_locked_file_types" value="<?php echo $uamOptions['locked_file_types']; ?>" /> 
				<label for="uam_lock_file_types_not_selected"> 
					<input type="radio" id="uam_lock_file_types_not_selected" name="uam_lock_file_types" value="not_selected" <?php
    if ($uamOptions['lock_file_types'] == "not_selected") {
        echo 'checked="checked"';
    } 
                    ?> />
				    <?php echo TXT_NOT_SELECTED_FILE_TYPES; ?> 
				</label>
				<input name="uam_not_locked_file_types" value="<?php echo $uamOptions['not_locked_file_types']; ?>" /> <br />
				<?php echo TXT_DOWNLOAD_FILE_TYPE_DESC; ?>
			</td>
		</tr>
		<tr>
			<th><?php echo TXT_FILE_PASS_TYPE; ?></th>
			<td>
				<label for="uam_file_pass_type_admin"> 
					<input type="radio" id="uam_file_pass_type_admin" name="uam_file_pass_type"	value="admin" <?php
    if ($uamOptions['file_pass_type'] == "admin") {
        echo 'checked="checked"';
    } 
                    ?> />
    				<?php echo TXT_CURRENT_LOGGEDIN_ADMIN_PASS; ?> 
    			</label>&nbsp;&nbsp;&nbsp;&nbsp;
    			<label for="uam_file_pass_type_random"> 
					<input type="radio" id="uam_file_pass_type_random" name="uam_file_pass_type" value="random" <?php
    if ($uamOptions['file_pass_type'] == "random") {
        echo 'checked="checked"';
    } 
                    ?> />
				    <?php echo TXT_RANDOM_PASS; ?> 
				</label> <br />
				<?php echo TXT_FILE_PASS_TYPE_DESC; ?>
			</td>
		</tr>
    <?php 
}
?>
		<tr>
			<th><?php echo TXT_DOWNLOAD_TYPE; ?></th>
			<td>
				<label for="uam_download_type_normal"> 
					<input type="radio" id="uam_download_type_normal" name="uam_download_type" value="normal" <?php
if ($uamOptions['download_type'] == "normal") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NORMAL; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_download_type_fopen"> 
					<input type="radio" id="uam_download_type_fopen" name="uam_download_type" value="fopen" <?php
if ($uamOptions['download_type'] == "fopen") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_FOPEN; ?> 
				</label> <br />
				<?php echo TXT_DOWNLOAD_TYPE_DESC; ?>
			</td>
		</tr>
	</tbody>
</table>
<h3><?php echo TXT_AUTHOR_SETTING; ?></h3>
<p><?php echo TXT_AUTHOR_SETTING_DESC; ?></p>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php echo TXT_AUTHORS_HAS_ACCESS_TO_OWN; ?></th>
			<td>
				<label for="uam_authors_has_access_to_own_yes"> 
					<input type="radio" id="uam_authors_has_access_to_own_yes" name="uam_authors_has_access_to_own" value="true" <?php
if ($uamOptions['authors_has_access_to_own'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_authors_has_access_to_own_no">
					<input type="radio" id="uam_authors_has_access_to_own_no" name="uam_authors_has_access_to_own" value="false" <?php
if ($uamOptions['authors_has_access_to_own'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_AUTHORS_HAS_ACCESS_TO_OWN_DESC; ?></td>
		</tr>
		<tr>
			<th><?php echo TXT_FULL_ACCESS_LEVEL; ?></th>
			<td>
				<input name="uam_full_access_level" value="<?php echo $uamOptions['full_access_level']; ?>" /> <br />
				<?php echo TXT_FULL_ACCESS_LEVEL_DESC; ?>
			</td>
		</tr>
	</tbody>
</table>
<h3><?php echo TXT_OTHER_SETTING; ?></h3>
<p><?php echo TXT_OTHER_SETTING_DESC; ?></p>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php echo TXT_PROTECT_FEED; ?></th>
			<td>
				<label for="uam_protect_feed_yes"> 
					<input type="radio" id="uam_protect_feed_yes" name="uam_protect_feed" value="true" <?php
if ($uamOptions['protect_feed'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
    				<?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_protect_feed_no"> 
					<input type="radio" id="uam_protect_feed_no" name="uam_protect_feed" value="false" <?php 
if ($uamOptions['protect_feed'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				<?php echo TXT_NO; ?> 
				</label> <br />
			    <?php echo TXT_PROTECT_FEED_DESC; ?>
			</td>
		</tr>
		<tr>
			<th><?php echo TXT_HIDE_EMPTY_CATEGORIES; ?></th>
			<td>
				<label for="uam_hide_empty_categories_yes"> 
					<input type="radio" id="uam_hide_empty_categories_yes" name="uam_hide_empty_categories" value="true" <?php
if ($uamOptions['hide_empty_categories'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_hide_empty_categories_no"> 
					<input type="radio" id="uam_hide_empty_categories_no" name="uam_hide_empty_categories" value="false" <?php
if ($uamOptions['hide_empty_categories'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_HIDE_EMPTY_CATEGORIES_DESC; ?>
			</td>
		</tr>
		<tr>
			<th><?php echo TXT_REDIRECT; ?></th>
			<td>
				<label for="uam_redirect_no"> 
					<input type="radio" id="uam_redirect_no" name="uam_redirect" value="false" <?php
if ($uamOptions['redirect'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_redirect_blog"> 
					<input type="radio" id="uam_redirect_blog" name="uam_redirect" value="blog" <?php
if ($uamOptions['redirect'] == "blog") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_REDIRECT_TO_BOLG; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="uam_redirect_custom_page"> 
					<input type="radio" id="uam_redirect_custom_page" name="uam_redirect" value="custom_page" <?php
if ($uamOptions['redirect'] == "custom_page") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_REDIRECT_TO_PAGE; ?>    
				</label>
				<select name="uam_redirect_custom_page">
<?php
$pages = get_pages('sort_column=menu_order');
if (isset($pages)) {
    foreach ($pages as $page) {
        echo '<option value="' . $page->ID.'"';
        if ($uamOptions['redirect_custom_page'] == $page->ID) {
            echo ' selected="selected"';
        }
        echo '>' . $page->post_title . '</option>';
    }
}
?>
				</select>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_redirect_custom_url"> 
					<input type="radio" id="uam_redirect_custom_url" name="uam_redirect" value="custom_url" <?php
if ($uamOptions['redirect'] == "custom_url") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_REDIRECT_TO_URL; ?> 
				</label>
				<input name="uam_redirect_custom_url" value="<?php echo $uamOptions['redirect_custom_url']; ?>" /> <br />
				<?php echo TXT_REDIRECT_DESC; ?>
			</td>
		</tr>
		<tr>
			<th><?php echo TXT_LOCK_RECURSIVE; ?></th>
			<td>
				<label for="uam_lock_recursive_yes"> 
					<input type="radio" id="uam_lock_recursive_yes" name="uam_lock_recursive" value="true" <?php
if ($uamOptions['lock_recursive'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_lock_recursive_no">
					<input type="radio" id="uam_lock_recursive_no" name="uam_lock_recursive" value="false" <?php
if ($uamOptions['lock_recursive'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_LOCK_RECURSIVE_DESC; ?></td>
		</tr>
		<tr>
			<th><?php echo TXT_BLOG_ADMIN_HINT; ?></th>
			<td>
				<label for="uam_blog_admin_hint_yes"> 
					<input type="radio" id="uam_blog_admin_hint_yes" name="uam_blog_admin_hint" value="true" <?php
if ($uamOptions['blog_admin_hint'] == "true") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_YES; ?> 
				</label>&nbsp;&nbsp;&nbsp;&nbsp; 
				<label for="uam_blog_admin_hint_no">
					<input type="radio" id="uam_blog_admin_hint_no" name="uam_blog_admin_hint" value="false" <?php
if ($uamOptions['blog_admin_hint'] == "false") {
    echo 'checked="checked"';
} 
                    ?> />
				    <?php echo TXT_NO; ?> 
				</label> <br />
				<?php echo TXT_BLOG_ADMIN_HINT_DESC; ?>
			</td>
		</tr>
		<tr>
			<th><?php echo TXT_BLOG_ADMIN_HINT_TEXT; ?></th>
			<td>
				<input name="uam_blog_admin_hint_text" value="<?php echo $uamOptions['blog_admin_hint_text']; ?>" /> <br />
				<?php echo TXT_BLOG_ADMIN_HINT_TEXT_DESC; ?>
			</td>
		</tr>
	</tbody>
</table>
<div class="submit">
	<input type="submit" name="update_uam_settings" value="<?php echo TXT_UPDATE_SETTING; ?>" />
</div>
</form>
</div>