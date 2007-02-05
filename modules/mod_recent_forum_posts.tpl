{* $Header: /cvsroot/bitweaver/_phpbb/modules/mod_recent_forum_posts.tpl,v 1.6 2007/02/05 02:50:15 spiderr Exp $ *}
{if $forumPosts || $showEmpty}
{if !$moduleTitle}
	{assign var="moduleTitle" value="{tr}Recent Forum Posts{/tr}"}
	{if $forumTitle}
		{assign var="moduleTitle" value="`$moduleTitle` {tr}in{/tr} `$forumTitle`"}
	{/if}
{/if}
{strip}
{bitmodule title="$moduleTitle" name="recent_forum_posts"}
	<ol>
		{section name=ix loop=$forumPosts}
			<li>
				<a class="communityTitle" href="{$smarty.const.PHPBB_PKG_URL}viewtopic.php?t={$forumPosts[ix].topic_id}">
					{if $forumPosts[ix].post_subject}
						{$forumPosts[ix].post_subject}
					{else}
						{$forumPosts[ix].topic_title} {** If the poster did not give a title to their post we will display the title of the thread they posted in **}
					{/if}
				</a>
				{if !$forumTitle and $show_forum_name}
					<br /><span class="small">in <a class="communityCreator" href="{$smarty.const.PHPBB_PKG_URL}viewforum.php?f={$forumPosts[ix].forum_id}">{$forumPosts[ix].forum_name}</a></span>
				{/if}
			</li>
		{sectionelse}
			<li></li>
		{/section}
	</ol>
	{if $forumPosts}
		<a href="{$forumUrl|default:$smarty.const.PHPBB_PKG_URL}">{tr}View More{/tr}&raquo;</a>
	{/if}
{/bitmodule}
{/strip}
{/if}
