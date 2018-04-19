<!-- START: /skins/ra250/php/views/article/v_content_header -->
<header id="title" class="context">
	<div class="hgroup">
		<a class="breadcrumbs" href="<?= create_url($controller, $reference, (!empty($url_params['issue']) && !$is_article_index) ? $url_params['issue'] : null, array_intersect_key($url_params, config('article_url_params'))) ?>" title="<?= (!empty($url_params['issue']) && !$is_article_index) ? esc(lang('issue'). ' ' . $content->issue_number) : esc($node_name) ?>"><?= (!empty($url_params['issue']) && !$is_article_index) ? esc(lang('issue'). ' ' . $content->issue_number) : esc($node_name) ?></a>
		<h1><?= $content->title ?></h1>
		<p><a class="hlink" href="<?= create_url($article_index_page_reference, null, null, array_merge(array_intersect_key($url_params, config('article_url_params')), array('article-category' => $content->category_reference))) ?>" title="<?= esc($content->category) ?>"><?= esc($content->category) ?></a><? if (!empty($content->authors)): ?> <?= display_authors($content->authors, create_url($article_index_page_reference, null, null, array_intersect_key($url_params, config('article_url_params')))) ?><? endif ?></p>
	</div>


	<ul class="mobile-toolbar">
		<li data-title="<?= esc(lang('share')) ?>" class="<?=$theme_class?>">
			<a data-modal class="icon-share <?=$theme_class?>" href="<?= base_url() ?>share" title="<?= esc(lang('share')) ?>"></a>
		</li>
		<? if (!empty($content->cite)): ?>
			<li data-title="<?= esc(lang('cite')) ?>" class="<?=$theme_class?>">
				<a data-modal class="icon-cite <?=$theme_class?>" href="<?= create_url('citation', $content->id) ?>" title="<?= esc(lang('cite')) ?>"></a>
			</li>
		<? endif ?>
		<? if (!empty($files)  ): ?>
			<li data-title="<?= esc(lang('downloads')) ?>" class="<?=$theme_class?>">
				<a data-anchor class="icon-download <?=$theme_class?>" href="#anchor-downloads" title="<?= esc(lang('skip_to')) ?> <?= esc(lang('downloads')) ?>"></a>
			</li>	
		<? endif ?>
		<? if (!empty($content->authors) || !empty($content->writters) || !empty($content->speakers) || ( (!empty($content->publish_date) || !empty($content->doi)) && $template != 'issue') || !empty($content->cite)): ?>
			<li data-title="<?= esc(lang('information')) ?>" class="<?=$theme_class?>">
				<a data-anchor class="icon-information <?=$theme_class?>" href="#anchor-information" title="<?= esc(lang('skip_to')) ?> <?= esc(lang('information')) ?>"></a>
			</li>	
		<? endif ?>

		<? if(!empty($content->parent_article) || !empty($content->child_articles)):?>
			<li data-title="<?= esc(lang('other_entries')) ?>" class="<?=$theme_class?>">
				<a data-modal class="icon-other-entries <?=$theme_class?>" href="#" title="<?= esc(lang('other_entries')) ?>"></a>
			</li>	
		<?endif?>

		<? if (!empty($content->enable_comments) && $content->enable_comments): ?>
			<li data-title="<?= esc(lang('comments')) ?>" class="<?=$theme_class?>">
				<a data-anchor data-disqus-identifier="<?= $content->disqus_identifier .'_'. $content->id ?>" class="icon-comment <?=$theme_class?>" href="#disqus_thread" title="<?= esc(lang('skip_to')) ?> <?= esc(lang('comments')) ?>"></a>
			</li>
		<? endif ?>
		<? if (!empty($content->chapters)): ?>
			<? foreach ($content->chapters as $chapter): ?>
				<li>
					<a data-anchor href="#<?= str_pad($chapter->rank, 3, "0", STR_PAD_LEFT) ?>" title="<?= lang('skip_to') ?> <?= lang('chapter') ?> <?= $chapter->rank ?>"><?= lang('chapter') ?> <?= $chapter->rank ?></a>
				</li>
			<? endforeach ?>
		<? endif ?>
   
    </ul>

</header>
<!-- END: /skins/ra250/php/views/article/v_content_header -->