
<h1>{L_DISALLOW_TITLE}</h1>

<p>{L_DISALLOW_EXPLAIN}</p>

<form method="post" action="{S_FORM_ACTION}"><table width="80%" cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr> 
		<th class="thHead" colspan="2">{L_ADD_DISALLOW}</th>
	</tr>
	<tr> 
		<td class="odd">{L_USERNAME}<br /><small>{L_ADD_EXPLAIN}</span></td>
		<td class="even"><input class="post" type="text" name="disallowed_user" size="30" />&nbsp;<input type="submit" name="add_name" value="{L_ADD}" class="mainoption" /></td>
	</tr>
	<tr> 
		<th class="thHead" colspan="2">{L_DELETE_DISALLOW}</th>
	</tr>
	<tr> 
		<td class="odd">{L_USERNAME}<br /><small>{L_DELETE_EXPLAIN}</span></td>
		<td class="even">{S_DISALLOW_SELECT}&nbsp;<input type="submit" name="delete_name" value="{L_DELETE}" class="liteoption" /></td>
	</tr>
	<tr> 
		<td class="catBottom" colspan="2" align="center">&nbsp;</td>
	</tr>
</table></form>
