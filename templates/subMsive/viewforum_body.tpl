<div class="header">
	<h1>{FORUM_NAME}</h1>
</div>

<form method="post" action="{S_POST_DAYS_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
	  <td align="left" valign="bottom" colspan="2"><small><b>{L_MODERATOR}: {MODERATORS}<br /><br />{LOGGED_IN_USER_LIST}</b></span></td>
	  <td align="right" valign="bottom" nowrap="nowrap"><small><b>{PAGINATION}</b></span></td>
	</tr>
	<tr>
	  <td align="left" valign="middle" width="50"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
	  <td align="left" valign="middle" class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span></td>
	  <td align="right" valign="bottom" class="nav" nowrap="nowrap"><small><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></span></td>
	</tr>
  </table>

  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr>
	  <th colspan="2" align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
	  <th width="50" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</th>
	  <th width="100" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_AUTHOR}&nbsp;</th>
	  <th width="50" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_VIEWS}&nbsp;</th>
	  <th align="center" class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
	</tr>
	<!-- BEGIN topicrow -->
	<tr>
	  <td class="odd" align="center" valign="middle" width="20"><img src="{topicrow.TOPIC_FOLDER_IMG}" width="19" height="18" alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}" /></td>
	  <td class="odd" width="100%"><span class="topictitle">{topicrow.NEWEST_POST_IMG}{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}" class="topictitle">{topicrow.TOPIC_TITLE}</a></span><small><br />
		{topicrow.GOTO_PAGE}</span></td>
	  <td class="even" align="center" valign="middle"><span class="postdetails">{topicrow.REPLIES}</span></td>
	  <td class="odd" align="center" valign="middle"><span class="name">{topicrow.TOPIC_AUTHOR}</span></td>
	  <td class="even" align="center" valign="middle"><span class="postdetails">{topicrow.VIEWS}</span></td>
	  <td class="odd" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{topicrow.LAST_POST_TIME}<br />{topicrow.LAST_POST_AUTHOR} {topicrow.LAST_POST_IMG}</span></td>
	</tr>
	<!-- END topicrow -->
	<!-- BEGIN switch_no_topics -->
	<tr>
	  <td class="odd" colspan="6" height="30" align="center" valign="middle"><span class="gen">{L_NO_TOPICS}</span></td>
	</tr>
	<!-- END switch_no_topics -->
	<tr>
	  <td class="catBottom" align="center" valign="middle" colspan="6" height="28"><span class="genmed">{L_DISPLAY_TOPICS}:&nbsp;{S_SELECT_TOPIC_DAYS}&nbsp;
		<input type="submit" class="liteoption" value="{L_GO}" name="submit" />
		</span></td>
	</tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr>
	  <td align="left" valign="middle" width="50"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
	  <td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span></td>
	  <td align="right" valign="middle" nowrap="nowrap"><small>{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span>
		</td>
	</tr>
	<tr>
	  <td align="left" colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
	</tr>
  </table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td align="right">{JUMPBOX}</td>
  </tr>
</table>

<table width="100%" cellspacing="0" border="0" align="center" cellpadding="0">
	<tr>
		<td align="left" valign="top"><table cellspacing="3" cellpadding="0" border="0">
			<tr>
				<td width="20" align="left"><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" width="19" height="18" /></td>
				<td><small>{L_NEW_POSTS}</small></td>
				<td>&nbsp;&nbsp;</td>
				<td width="20" align="center"><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" width="19" height="18" /></td>
				<td><small>{L_NO_NEW_POSTS}</small></td>
				<td>&nbsp;&nbsp;</td>
				<td width="20" align="center"><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" width="19" height="18" /></td>
				<td><small>{L_ANNOUNCEMENT}</small></td>
			</tr>
			<tr>
				<td width="20" align="center"><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" width="19" height="18" /></td>
				<td><small>{L_NEW_POSTS_HOT}</small></td>
				<td>&nbsp;&nbsp;</td>
				<td width="20" align="center"><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" width="19" height="18" /></td>
				<td><small>{L_NO_NEW_POSTS_HOT}</small></td>
				<td>&nbsp;&nbsp;</td>
				<td width="20" align="center"><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" width="19" height="18" /></td>
				<td><small>{L_STICKY}</small></td>
			</tr>
			<tr>
				<td class="small"><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" width="19" height="18" /></td>
				<td><small>{L_NEW_POSTS_LOCKED}</small></td>
				<td>&nbsp;&nbsp;</td>
				<td class="small"><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" width="19" height="18" /></td>
				<td><small>{L_NO_NEW_POSTS_LOCKED}</small></td>
			</tr>
		</table></td>
		<td align="right"><small>{S_AUTH_LIST}</span></td>
	</tr>
</table>
