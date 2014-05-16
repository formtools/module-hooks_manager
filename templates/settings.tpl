{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><img src="images/icon.gif" width="34" height="34" /></td>
    <td class="title"><a href="index.php">{$L.module_name|upper}</a> &raquo; {$L.word_settings|upper}</td>
  </tr>
  </table>

  {include file='messages.tpl'}

  <form action="{$same_page}" method="post">

    <div>
      {$L.phrase_num_rules_per_page_c} <input type="text" size="5" name="num_rules_per_page" value="{$num_rules_per_page}" />
    </div>

    <p>
      <input type="submit" name="update" value="{$LANG.word_update}" />
    </p>

  </form>

{include file='modules_footer.tpl'}