{* $Header: /cvsroot/bitweaver/_phpbb/modules/mod_recent_forum_topics.tpl,v 1.1.1.1.2.3 2006/04/17 20:21:14 southpawz Exp $ *}
{if $forumTopics || $showEmpty}
{assign var="moduleTitle" value="{tr}Recent Forum Topics{/tr}"}
{if $forumTitle}
	{assign var="moduleTitle" value="`$moduleTitle` {tr}in{/tr} `$forumTitle`"}
{/if}
{strip}
{bitmodule title="$moduleTitle" name="recent_forum_topics"}
	<ol>
		{section name=ix loop=$forumTopics}
			<li>
				<a href="{$smarty.const.PHPBB_PKG_URL}viewtopic.php?t={$forumTopics[ix].topic_id}">{$forumTopics[ix].topic_title}</a>
				{if !$forumTitle}
					<br/><span class="small">in <a class="communityCreator" href="{$smarty.const.PHPBB_PKG_URL}viewforum.php?f={$forumTopics[ix].forum_id}">{$forumTopics[ix].forum_name}</a></span>
				{/if}
			</li>
		{sectionelse}
			<li></li>
		{/section}
	</ol>
	{if $forumTopics}
		<a href="{$forumUrl}">{tr}View More{/tr}&raquo;</a>
	{/if}
{/bitmodule}
{/strip}
{/if}
