<!-- START: /skins/ra250/php/views/article/v_header_authors -->
<? foreach ($author_groups as $qualifier => $authors): ?><?reset($author_groups);?><? if (key($author_groups) !== $qualifier && $qualifier !== 'and'): ?>, <?elseif(key($author_groups) !== $qualifier && $qualifier == 'and'):?> <? endif ?><?= $qualifier ?> <? foreach ($authors as $name => $link): ?><?if(!empty($link)):?><a data-anchor class="hlink" href="#anchor-information" title="<?= esc($name) ?>"><?endif?><?= esc($name) ?><?if(!empty($link)):?></a><?endif?><? if (end(array_keys($authors)) !== $name): ?>, <? endif ?><? endforeach ?><? endforeach ?>
<!-- END: /skins/ra250/php/views/article/v_header_authors --> 