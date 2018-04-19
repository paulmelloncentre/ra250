<!-- START: /skins/ra250/php/views/article/v_chapters -->
<? foreach ($content->chapters as $item): ?>
	<section id="<?= str_pad($item->rank, 3, "0", STR_PAD_LEFT) ?>"<? if (strtotime(date("Y-m-d", strtotime($item->publish_date))) > strtotime(date("Y-m-d")) && !$preview): ?> class="inactive"<? endif ?>>
		<? if (!empty($item->authors)): ?>
			<div class="rich-listing">
				<ul>
					<? foreach ($item->authors as $author): ?>
						<li>
							<? if (kt_has_image($author)): ?>
								<img data-src="<?= kt_get_media_path($author->media['image'][0], 'media_path_avatar') ?>" src="<?= kt_get_media_path($author->media['image'][0], 'media_path_lowres') ?>" width="100" height="100" alt="<?= kt_get_media_alt($author->media['image'][0]) ?>" />
							<? else: ?>
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="85px" height="85px" viewBox="0 0 85 85">
									<path d="M42.5,0C19.065,0,0,19.066,0,42.5C0,65.935,19.065,85,42.5,85C65.935,85,85,65.935,85,42.5C85,19.066,65.935,0,42.5,0
									 M42.5,2.802c21.89,0,39.698,17.809,39.698,39.698c0,7.855-2.304,15.179-6.256,21.348c-0.737-1.629-3.359-2.713-3.359-2.713
									l-20.68-9.985c4.925-3.875,6.591-11.49,6.591-15.758v-8.814c0-8.838-7.163-16.001-16-16.001c-8.835,0-15.999,7.163-15.999,16.001
									v8.814c0,3.881,1.772,11.736,6.743,15.727L12.73,60.804c0,0-3.221,1.438-3.521,3.279C5.163,57.865,2.802,50.455,2.802,42.5
									C2.802,20.611,20.61,2.802,42.5,2.802"/>
								</svg>
							<? endif ?>
							<? if (!empty($author->qualifier)): ?>
								<p><?= $author->qualifier ?></p>
							<? endif ?>
							<p><strong><?= $author->name ?></strong><? if (!empty($author->occupation)): ?>, <?= $author->occupation ?><? endif ?><? if (strtotime(date("Y-m-d", strtotime($item->publish_date))) > strtotime(date("Y-m-d")) && !$preview): ?>, <?= display_chapter_date($item->publish_date) ?><? endif ?></p>
						</li>
					<? endforeach ?>
				</ul>
			</div>
		<? endif ?>
		<? if (strtotime(date("Y-m-d", strtotime($item->publish_date))) <= strtotime(date("Y-m-d")) || $preview): ?>
			<? if (!empty($item->issue_doi) && !empty($item->article_doi)): ?>
				<small class="doi">
					<a data-modal class="ext-link" href="<?= create_url('doi', $content->id, str_pad($item->rank, 3, "0", STR_PAD_LEFT)) ?>" title="<?= esc(lang('doi')) ?>"><?= esc(lang('doi')) ?></a>
					<!-- <a data-modal class="ext-link" href="<?= rtrim(preference('doi_url'), '/') ?>/<?= $item->issue_doi ?>/<?= $item->article_doi ?>/<?= str_pad($item->rank, 3, "0", STR_PAD_LEFT) ?>" title="<?= lang('doi') ?>"><?= lang('doi') ?></a> -->
					<!-- <a data-modal class="ext-link" href="/pmc/citation/10" title="<?= lang('doi') ?>"><?= lang('doi') ?></a> -->
				</small>
			<? endif ?>
			<div class="rich-text context">
				<? if (!empty($item->title)): ?>
					<h1><?= $item->title ?></h1>	
				<? endif ?>
				<?foreach ($item->paragraphs as $paragraph):?>
					<?if(!empty($paragraph->name)): ?>
						<span id="<?=$paragraph->doi?>">
							<?if(!empty($paragraph->doi)): ?>
								<small class="doi paragraph-doi">
									<a data-modal class="ext-link" href="<?= create_url('doi', $content->id, $paragraph->doi) ?>" title="<?= esc(lang('doi')) ?>"><?= esc(lang('doi')) ?></a>
								</small>
							<?endif?>
							<?=$paragraph->name?>
						</span>
					<?endif?>
				<?endforeach?>
			</div>
		<? endif ?>
	</section>
<? endforeach ?>

<!-- END: /skins/ra250/php/views/article/v_chapters -->


