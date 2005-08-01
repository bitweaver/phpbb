<div class="header">
	<h1>{L_FORUM}</h1>
</div>
<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center">
  <tr> 
	<td align="left" valign="bottom"><small>
	<!-- BEGIN switch_user_logged_in -->
	{LAST_VISIT_DATE}<br />
	<!-- END switch_user_logged_in -->
	{CURRENT_TIME}<br /></span><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	<td align="right" valign="bottom"><small>
		<!-- BEGIN switch_user_logged_in -->
		<a href="{U_SEARCH_NEW}">{L_SEARCH_NEW}</a><br /><a href="{U_SEARCH_SELF}">{L_SEARCH_SELF}</a><br />
		<!-- END switch_user_logged_in -->
		<a href="{U_SEARCH_UNANSWERED}">{L_SEARCH_UNANSWERED}</a></td>
  </tr>
</table>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th colspan="2" class="thCornerL" height="25" nowrap="nowrap">&nbsp;{L_FORUM}&nbsp;</th>
	<th width="50" class="thTop" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
	<th width="50" class="thTop" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
	<th class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
  </tr>
  <!-- BEGIN catrow -->
  <tr> 
	<td class="catLeft" colspan="5" height="28"><h2><a href="{catrow.U_VIEWCAT}" class="cattitle">{catrow.CAT_DESC}</a></h2></td>
  </tr>
  <!-- BEGIN forumrow -->
  <tr> 
	<td class="odd" align="center" valign="middle" height="50"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" width="46" height="25" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
	<td class="odd" width="100%" height="50"><span class="forumlink"> <a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink">{catrow.forumrow.FORUM_NAME}</a><br />
	  </span> <span class="genmed">{catrow.forumrow.FORUM_DESC}<br />
	  </span><small>{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}</span></td>
	<td class="even" align="center" valign="middle" height="50"><small>{catrow.forumrow.TOPICS}</span></td>
	<td class="even" align="center" valign="middle" height="50"><small>{catrow.forumrow.POSTS}</span></td>
	<td class="even" align="center" valign="middle" height="50" nowrap="nowrap"> <small>{catrow.forumrow.LAST_POST}</span></td>
  </tr>
  <!-- END forumrow -->
  <!-- END catrow -->
</table>

<table width="100%" cellspacing="0" border="0" align="center" cellpadding="2">
  <tr> 
	<td align="left"><small><a href="{U_MARK_READ}">{L_MARK_FORUMS_READ}</a></span></td>
	<td align="right"><small>{S_TIMEZONE}</span></td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr> 
	<td class="catHead" colspan="2" height="28"><h2><a href="{U_VIEWONLINE}" class="cattitle">{L_WHO_IS_ONLINE}</a></h2></td>
  </tr>
  <tr> 
	<td class="odd" align="center" valign="middle" rowspan="2"><img src="templates/subMrge/images/whosonline.gif" alt="{L_WHO_IS_ONLINE}" /></td>
	<td class="odd" align="left" width="100%"><small>{TOTAL_POSTS}<br />{TOTAL_USERS}<br />{NEWEST_USER}</span>
	</td>
  </tr>
  <tr> 
	<td class="odd" align="left"><small>{TOTAL_USERS_ONLINE} &nbsp; [ {L_WHOSONLINE_ADMIN} ] &nbsp; [ {L_WHOSONLINE_MOD} ]<br />{RECORD_USERS}<br />{LOGGED_IN_USER_LIST}</span></td>
  </tr>
</table>

<table width="100%" cellpadding="1" cellspacing="1" border="0">
<tr>
	<td align="left" valign="top"><small>{L_ONLINE_EXPLAIN}</span></td>
</tr>
</table>


<table cellspacing="3" border="0" align="center" cellpadding="0">
  <tr> 
	<td width="20" align="center"><img src="templates/subMrge/images/folder_new_big.gif" alt="{L_NEW_POSTS}"/></td>
	<td><small>{L_NEW_POSTS}</span></td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="templates/subMrge/images/folder_big.gif" alt="{L_NO_NEW_POSTS}" /></td>
	<td><small>{L_NO_NEW_POSTS}</span></td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="templates/subMrge/images/folder_locked_big.gif" alt="{L_FORUM_LOCKED}" /></td>
	<td><small>{L_FORUM_LOCKED}</span></td>
  </tr>
</table>
