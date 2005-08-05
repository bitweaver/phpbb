{strip}
<ul>
<li><a class="item" href="{$smarty.const.PHPBB_PKG_URL}">{tr}Show All{/tr}</a></li>
<li><a class="item" href="{$smarty.const.PHPBB_PKG_URL}index.php?c=1">{tr}Only Headers{/tr}</a></li>
<li><a class="item" href="{$smarty.const.PHPBB_PKG_URL}search.php">{tr}Search Forums{/tr}</a></li>
{if $user}
<li><a class="item" href="{$smarty.const.PHPBB_PKG_URL}search.php?search_id=newposts">{tr}Posts since last visit{/tr}</a></li>
<li><a class="item" href="{$smarty.const.PHPBB_PKG_URL}search.php?search_id=egosearch">{tr}Your posts{/tr}</a></li>
<li><a class="item" href="{$smarty.const.PHPBB_PKG_URL}search.php?search_id=unanswered">{tr}Unanswered posts{/tr}</a></li>
{/if}
</ul>
{/strip}
