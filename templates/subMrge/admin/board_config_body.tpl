
<h1>{L_CONFIGURATION_TITLE}</h1>

<p>{L_CONFIGURATION_EXPLAIN}</p>

<form action="{S_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_GENERAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="odd">{L_SERVER_NAME}</td>
		<td class="even"><input class="post" type="text" maxlength="255" size="40" name="server_name" value="{SERVER_NAME}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_SERVER_PORT}<br /><small>{L_SERVER_PORT_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" maxlength="5" size="5" name="server_port" value="{SERVER_PORT}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_SCRIPT_PATH}<br /><small>{L_SCRIPT_PATH_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" maxlength="255" name="script_path" value="{SCRIPT_PATH}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_SITE_NAME}<br /><small>{L_SITE_NAME_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" size="25" maxlength="100" name="sitename" value="{SITENAME}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_SITE_DESCRIPTION}</td>
		<td class="even"><input class="post" type="text" size="40" maxlength="255" name="site_desc" value="{SITE_DESCRIPTION}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_DISABLE_BOARD}<br /><small>{L_DISABLE_BOARD_EXPLAIN}</span></td>
		<td class="even"><input type="radio" name="board_disable" value="1" {S_DISABLE_BOARD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="board_disable" value="0" {S_DISABLE_BOARD_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_ACCT_ACTIVATION}</td>
		<td class="even"><input type="radio" name="require_activation" value="{ACTIVATION_NONE}" {ACTIVATION_NONE_CHECKED} />{L_NONE}&nbsp; &nbsp;<input type="radio" name="require_activation" value="{ACTIVATION_USER}" {ACTIVATION_USER_CHECKED} />{L_USER}&nbsp; &nbsp;<input type="radio" name="require_activation" value="{ACTIVATION_ADMIN}" {ACTIVATION_ADMIN_CHECKED} />{L_ADMIN}</td>
	</tr>
	<tr>
		<td class="odd">{L_VISUAL_CONFIRM}<br /><small>{L_VISUAL_CONFIRM_EXPLAIN}</span></td>
		<td class="even"><input type="radio" name="enable_confirm" value="1" {CONFIRM_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="enable_confirm" value="0" {CONFIRM_DISABLE} />{L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_BOARD_EMAIL_FORM}<br /><small>{L_BOARD_EMAIL_FORM_EXPLAIN}</span></td>
		<td class="even"><input type="radio" name="board_email_form" value="1" {BOARD_EMAIL_FORM_ENABLE} /> {L_ENABLED}&nbsp;&nbsp;<input type="radio" name="board_email_form" value="0" {BOARD_EMAIL_FORM_DISABLE} /> {L_DISABLED}</td>
	</tr>
	<tr>
		<td class="odd">{L_FLOOD_INTERVAL} <br /><small>{L_FLOOD_INTERVAL_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" size="3" maxlength="4" name="flood_interval" value="{FLOOD_INTERVAL}" /></td>
		<td class="odd">{L_SEARCH_FLOOD_INTERVAL} <br /><span class="gensmall">{L_SEARCH_FLOOD_INTERVAL_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" size="3" maxlength="4" name="search_flood_interval" value="{SEARCH_FLOOD_INTERVAL}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_TOPICS_PER_PAGE}</td>
		<td class="even"><input class="post" type="text" name="topics_per_page" size="3" maxlength="4" value="{TOPICS_PER_PAGE}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_POSTS_PER_PAGE}</td>
		<td class="even"><input class="post" type="text" name="posts_per_page" size="3" maxlength="4" value="{POSTS_PER_PAGE}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_HOT_THRESHOLD}</td>
		<td class="even"><input class="post" type="text" name="hot_threshold" size="3" maxlength="4" value="{HOT_TOPIC}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_DEFAULT_STYLE}</td>
		<td class="even">{STYLE_SELECT}</td>
	</tr>
	<tr>
		<td class="odd">{L_OVERRIDE_STYLE}<br /><small>{L_OVERRIDE_STYLE_EXPLAIN}</span></td>
		<td class="even"><input type="radio" name="override_user_style" value="1" {OVERRIDE_STYLE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="override_user_style" value="0" {OVERRIDE_STYLE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_DEFAULT_LANGUAGE}</td>
		<td class="even">{LANG_SELECT}</td>
	</tr>
	<tr>
		<td class="odd">{L_DATE_FORMAT}<br /><small>{L_DATE_FORMAT_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" name="default_dateformat" value="{DEFAULT_DATEFORMAT}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_SYSTEM_TIMEZONE}</td>
		<td class="even">{TIMEZONE_SELECT}</td>
	</tr>
	<tr>
		<td class="odd">{L_ENABLE_GZIP}</td>
		<td class="even"><input type="radio" name="gzip_compress" value="1" {GZIP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="gzip_compress" value="0" {GZIP_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_ENABLE_PRUNE}</td>
		<td class="even"><input type="radio" name="prune_enable" value="1" {PRUNE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="prune_enable" value="0" {PRUNE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<th class="thHead" colspan="2">{L_COOKIE_SETTINGS}</th>
	</tr>
	<tr>
		<td class="even" colspan="2"><small>{L_COOKIE_SETTINGS_EXPLAIN}</span></td>
	</tr>
	<tr>
		<td class="odd">{L_COOKIE_DOMAIN}</td>
		<td class="even"><input class="post" type="text" maxlength="255" name="cookie_domain" value="{COOKIE_DOMAIN}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_COOKIE_NAME}</td>
		<td class="even"><input class="post" type="text" maxlength="16" name="cookie_name" value="{COOKIE_NAME}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_COOKIE_PATH}</td>
		<td class="even"><input class="post" type="text" maxlength="255" name="cookie_path" value="{COOKIE_PATH}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_COOKIE_SECURE}<br /><small>{L_COOKIE_SECURE_EXPLAIN}</span></td>
		<td class="even"><input type="radio" name="cookie_secure" value="0" {S_COOKIE_SECURE_DISABLED} />{L_DISABLED}&nbsp; &nbsp;<input type="radio" name="cookie_secure" value="1" {S_COOKIE_SECURE_ENABLED} />{L_ENABLED}</td>
	</tr>
	<tr>
		<td class="odd">{L_SESSION_LENGTH}</td>
		<td class="even"><input class="post" type="text" maxlength="5" size="5" name="session_length" value="{SESSION_LENGTH}" /></td>
	</tr>
	<tr>
		<th class="thHead" colspan="2">{L_PRIVATE_MESSAGING}</th>
	</tr>
	<tr>
		<td class="odd">{L_DISABLE_PRIVATE_MESSAGING}</td>
		<td class="even"><input type="radio" name="privmsg_disable" value="0" {S_PRIVMSG_ENABLED} />{L_ENABLED}&nbsp; &nbsp;<input type="radio" name="privmsg_disable" value="1" {S_PRIVMSG_DISABLED} />{L_DISABLED}</td>
	</tr>
	<tr>
		<td class="odd">{L_INBOX_LIMIT}</td>
		<td class="even"><input class="post" type="text" maxlength="4" size="4" name="max_inbox_privmsgs" value="{INBOX_LIMIT}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_SENTBOX_LIMIT}</td>
		<td class="even"><input class="post" type="text" maxlength="4" size="4" name="max_sentbox_privmsgs" value="{SENTBOX_LIMIT}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_SAVEBOX_LIMIT}</td>
		<td class="even"><input class="post" type="text" maxlength="4" size="4" name="max_savebox_privmsgs" value="{SAVEBOX_LIMIT}" /></td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_ABILITIES_SETTINGS}</th>
	</tr>
	<tr>
		<td class="odd">{L_MAX_POLL_OPTIONS}</td>
		<td class="even"><input class="post" type="text" name="max_poll_options" size="4" maxlength="4" value="{MAX_POLL_OPTIONS}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_ALLOW_HTML}</td>
		<td class="even"><input type="radio" name="allow_html" value="1" {HTML_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_html" value="0" {HTML_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_ALLOWED_TAGS}<br /><small>{L_ALLOWED_TAGS_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" size="30" maxlength="255" name="allow_html_tags" value="{HTML_TAGS}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_ALLOW_BBCODE}</td>
		<td class="even"><input type="radio" name="allow_bbcode" value="1" {BBCODE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_bbcode" value="0" {BBCODE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_ALLOW_SMILIES}</td>
		<td class="even"><input type="radio" name="allow_smilies" value="1" {SMILE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_smilies" value="0" {SMILE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_SMILIES_PATH} <br /><small>{L_SMILIES_PATH_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" size="20" maxlength="255" name="smilies_path" value="{SMILIES_PATH}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_ALLOW_SIG}</td>
		<td class="even"><input type="radio" name="allow_sig" value="1" {SIG_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_sig" value="0" {SIG_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_MAX_SIG_LENGTH}<br /><small>{L_MAX_SIG_LENGTH_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" size="5" maxlength="4" name="max_sig_chars" value="{SIG_SIZE}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_ALLOW_NAME_CHANGE}</td>
		<td class="even"><input type="radio" name="allow_namechange" value="1" {NAMECHANGE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_namechange" value="0" {NAMECHANGE_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_AVATAR_SETTINGS}</th>
	</tr>
	<tr>
		<td class="odd">{L_ALLOW_LOCAL}</td>
		<td class="even"><input type="radio" name="allow_avatar_local" value="1" {AVATARS_LOCAL_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_local" value="0" {AVATARS_LOCAL_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_ALLOW_REMOTE} <br /><small>{L_ALLOW_REMOTE_EXPLAIN}</span></td>
		<td class="even"><input type="radio" name="allow_avatar_remote" value="1" {AVATARS_REMOTE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_remote" value="0" {AVATARS_REMOTE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_ALLOW_UPLOAD}</td>
		<td class="even"><input type="radio" name="allow_avatar_upload" value="1" {AVATARS_UPLOAD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_upload" value="0" {AVATARS_UPLOAD_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_MAX_FILESIZE}<br /><small>{L_MAX_FILESIZE_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" size="4" maxlength="10" name="avatar_filesize" value="{AVATAR_FILESIZE}" /> Bytes</td>
	</tr>
	<tr>
		<td class="odd">{L_MAX_AVATAR_SIZE} <br />
			<small>{L_MAX_AVATAR_SIZE_EXPLAIN}</span>
		</td>
		<td class="even"><input class="post" type="text" size="3" maxlength="4" name="avatar_max_height" value="{AVATAR_MAX_HEIGHT}" /> x <input class="post" type="text" size="3" maxlength="4" name="avatar_max_width" value="{AVATAR_MAX_WIDTH}"></td>
	</tr>
	<tr>
		<td class="odd">{L_AVATAR_STORAGE_PATH} <br /><small>{L_AVATAR_STORAGE_PATH_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" size="20" maxlength="255" name="avatar_path" value="{AVATAR_PATH}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_AVATAR_GALLERY_PATH} <br /><small>{L_AVATAR_GALLERY_PATH_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" size="20" maxlength="255" name="avatar_gallery_path" value="{AVATAR_GALLERY_PATH}" /></td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_COPPA_SETTINGS}</th>
	</tr>
	<tr>
		<td class="odd">{L_COPPA_FAX}</td>
		<td class="even"><input class="post" type="text" size="25" maxlength="100" name="coppa_fax" value="{COPPA_FAX}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_COPPA_MAIL}<br /><small>{L_COPPA_MAIL_EXPLAIN}</span></td>
		<td class="even"><textarea name="coppa_mail" rows="5" cols="30">{COPPA_MAIL}</textarea></td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_EMAIL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="odd">{L_ADMIN_EMAIL}</td>
		<td class="even"><input class="post" type="text" size="25" maxlength="100" name="board_email" value="{EMAIL_FROM}" /></td>
	</tr>
	<tr>
		<td class="odd">{L_EMAIL_SIG}<br /><small>{L_EMAIL_SIG_EXPLAIN}</span></td>
		<td class="even"><textarea name="board_email_sig" rows="5" cols="30">{EMAIL_SIG}</textarea></td>
	</tr>
	<tr>
		<td class="odd">{L_USE_SMTP}<br /><small>{L_USE_SMTP_EXPLAIN}</span></td>
		<td class="even"><input type="radio" name="smtp_delivery" value="1" {SMTP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="smtp_delivery" value="0" {SMTP_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="odd">{L_SMTP_SERVER}</td>
		<td class="even"><input class="post" type="text" name="smtp_host" value="{SMTP_HOST}" size="25" maxlength="50" /></td>
	</tr>
	<tr>
		<td class="odd">{L_SMTP_USERNAME}<br /><small>{L_SMTP_USERNAME_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" name="smtp_username" value="{SMTP_USERNAME}" size="25" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="odd">{L_SMTP_PASSWORD}<br /><small>{L_SMTP_PASSWORD_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="password" name="smtp_password" value="{SMTP_PASSWORD}" size="25" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>

<br clear="all" />
