<!-- START: /views/base/v_toolbar -->
<div class="toolbar" data-toolbar>
	<ul>
		<li data-title="<?= esc(lang('share')) ?>" class="<?=$theme_class?>">
			<a data-modal class="icon-share <?=$theme_class?>" href="<?= base_url() ?>share" title="<?= esc(lang('share')) ?>"><?= esc(lang('share')) ?></a>
		</li>
		<? if (!empty($content->cite)): ?>
			<li data-title="<?= esc(lang('cite')) ?>" class="<?=$theme_class?>">
				<a data-modal class="icon-cite <?=$theme_class?>" href="<?= create_url('citation', $content->id) ?>" title="<?= esc(lang('cite')) ?>"><?= esc(lang('cite')) ?></a>
			</li>
		<? endif ?>
		
		<li data-title="<?= esc(lang('downloads')) ?>" class="<?=$theme_class?>">
			<a data-anchor class="icon-download <?=$theme_class?>" href="#downloads" title="<?= esc(lang('skip_to')) ?> <?= esc(lang('downloads')) ?>"><?= esc(lang('downloads')) ?></a>
		</li>	
		
		<? if (!empty($content->authors) || !empty($content->writters) || !empty($content->speakers) || ( (!empty($content->publish_date) || !empty($content->doi)) && $template != 'issue') || !empty($content->cite)): ?>
			<li data-title="<?= esc(lang('information')) ?>" class="<?=$theme_class?>">
				<a data-anchor class="icon-information <?=$theme_class?>" href="#anchor-information" title="<?= esc(lang('skip_to')) ?> <?= esc(lang('information')) ?>"><?= esc(lang('information')) ?></a>
			</li>	
		<? endif ?>

		<? if(!empty($content->parent_article) || !empty($content->child_articles)):?>
			<li data-title="<?= esc(lang('other_entries')) ?>" class="<?=$theme_class?>">
				<a data-modal class="icon-other-entries <?=$theme_class?>" href="#" title="<?= esc(lang('other_entries')) ?>"><?= esc(lang('other_entries')) ?></a>
			</li>	
		<?endif?>

		<? if (!empty($content->enable_comments) && $content->enable_comments): ?>
			<li data-title="<?= esc(lang('comments')) ?>" class="<?=$theme_class?>">
				<a data-anchor data-disqus-identifier="<?= $content->disqus_identifier .'_'. $content->id ?>" class="icon-comment <?=$theme_class?>" href="#disqus_thread" title="<?= esc(lang('skip_to')) ?> <?= esc(lang('comments')) ?>"><?= esc(lang('comments')) ?></a>
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
</div>

<? if(!empty($content->parent_article) || !empty($content->child_articles)):?>
	<div id="child-essays" style="display:none">
		<section>
			<div class="wrapper parent">
				<h2><a class="breadcrumbs back" href="<?=create_url($controller, $page->reference, "{$content->issue_reference}")?>" title="Page name"><?=ucfirst('Issue '. $content->issue_number.' - '.$content->issue_season)?></a></h2>
				<h1 <?if(empty($content->parent_id)):?>class="active" <?endif?>><a href="<?=create_url($controller, $page->reference, "{$content->issue_reference}/".(empty($content->parent_article) ? $content->reference : $content->parent_article[0]->reference))?>"><?=empty($content->parent_article) ? $content->title : $content->parent_article[0]->title?><?=((!empty($content->authors) || !empty($content->parent_article[0]->authors)) ? ", " : NULL)?><span><?=(empty($content->parent_article) ? (!empty($content->authors)? display_authors($content->authors) : NULL ) : (!empty($content->parent_article[0]->authors)? display_authors($content->parent_article[0]->authors) : NULL ))?></span></a></h1>
					
				<ul>
					<?if(empty($content->parent_id)) $list = $content->child_articles; else $list = $content->sibling_articles ?>

					<?foreach($list as $key => $item):?>
					<li <?if($item->reference == $content->reference):?>class="active"<?endif?>>
						<a href="<?=create_url($controller, $page->reference, "{$content->issue_reference}/{$item->reference}")?>"><?=$key+1?>. <?=$item->title?><?if(!empty($item->authors)):?>, <?=display_authors($item->authors)?><?endif?></a>
						<br>
					</li>
					<?endforeach?>
				</ul>
			</div>
			<button class="close" type="button" title="Close">Close</button>
		</section>
	</div>

<? endif ?>

<!-- END: /views/base/v_toolbar -->
