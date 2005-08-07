
<form action="{$smarty.const.PHPBB_PKG_URL}search.php" method="POST">
<input type="hidden" name="search_fields" value="all" />

<input type="text" style="width: 75px" class="post" name="search_keywords" size="30" />		<input class="liteoption" type="submit" value="{tr}Search{/tr}" />

<br />
Match: <input type="radio" name="search_terms" value="any" checked="checked" /> {tr}Any{/tr}
<input type="radio" name="search_terms" value="all" />{tr}All{/tr}</span>
<br/>

</form>
<a href="{$smarty.const.PHPBB_PKG_URL}search.php" style="font-size:smaller">{tr}More options{/tr}</a>

