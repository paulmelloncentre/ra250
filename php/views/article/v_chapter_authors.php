<!-- START: /skins/ra250/php/views/article/v_chapter_authors -->
<section>
	<div class="context">
		<? if (!empty($content->category_description)): ?>
			<div class="heading">
				<h2><?=nl2br($content->category_description)?></h2>
			</div>
		<? endif ?>
		<div class="grid">
			<ul<? if (count($content->article_chapter_authors) > 4): ?> class="minor"<? endif ?>>
				<? foreach ($content->article_chapter_authors as $item): ?>
					<li<? if (strtotime($item->chapter_publish_date) > strtotime(date("d.m.Y"))): ?> class="inactive"<? endif ?>>
						<a data-anchor href="#<?= str_pad($item->chapter_rank, 3, "0", STR_PAD_LEFT) ?>" title="<?= esc($item->name) ?>">
							<? if (kt_has_image($item)): ?>
								<img data-src="<?= kt_get_media_path($item->media['image'][0], 'media_path_avatar') ?>" src="<?= kt_get_media_path($item->media['image'][0], 'media_path_lowres') ?>" width="100" height="100" alt="<?= kt_get_media_alt($item->media['image'][0]) ?>" />
							<? else: ?>
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="85px" height="85px" viewBox="0 0 85 85">
									<path d="M42.5,0C19.065,0,0,19.066,0,42.5C0,65.935,19.065,85,42.5,85C65.935,85,85,65.935,85,42.5C85,19.066,65.935,0,42.5,0
									 M42.5,2.802c21.89,0,39.698,17.809,39.698,39.698c0,7.855-2.304,15.179-6.256,21.348c-0.737-1.629-3.359-2.713-3.359-2.713
									l-20.68-9.985c4.925-3.875,6.591-11.49,6.591-15.758v-8.814c0-8.838-7.163-16.001-16-16.001c-8.835,0-15.999,7.163-15.999,16.001
									v8.814c0,3.881,1.772,11.736,6.743,15.727L12.73,60.804c0,0-3.221,1.438-3.521,3.279C5.163,57.865,2.802,50.455,2.802,42.5
									C2.802,20.611,20.61,2.802,42.5,2.802"/>
								</svg>
							<? endif ?>
							<p><?= $item->name ?>
								<? if (count($content->article_chapter_authors) > 4 && !empty($item->chapter_publish_date)): ?>
									<small><?= display_chapter_date($item->chapter_publish_date) ?></small>
								<? endif ?>
							</p>
						</a>
					</li>				
				<? endforeach ?>
			</ul>
		</div>
	</div>
</section>
<!-- END: /skins/ra250/php/views/article/v_chapter_authors -->