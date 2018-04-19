<!-- START: /skins/ra250/php/views/base/v_authors -->
<? if (kt_array_has_key($content->authors, 'short_description')): ?>
	<section id="anchor-information">
		<div class="context">
			<div class="heading">
				<h2><?= pluralize(count($content->authors), 'about_the_author') ?></h2>
			</div>
			<div class="listing">
				<ul>
					<? foreach ($content->authors as $author): ?>
						<li class="<?=$theme_class?>">
							<? if (kt_has_image($author)): ?>
								<img data-src="<?= kt_get_media_path($author->media['image'][0], 'media_path_avatar') ?>" src="<?= kt_get_media_path($author->media['image'][0], 'media_path_lowres') ?>" width="<?= $author->media['image'][0]->width ?>" height="<?= $author->media['image'][0]->height ?>" alt="<?= kt_get_media_alt($author->media['image'][0]) ?>" />
							<? else: ?>
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="85px" height="85px" viewBox="0 0 85 85">
									<path d="M42.5,0C19.065,0,0,19.066,0,42.5C0,65.935,19.065,85,42.5,85C65.935,85,85,65.935,85,42.5C85,19.066,65.935,0,42.5,0
									 M42.5,2.802c21.89,0,39.698,17.809,39.698,39.698c0,7.855-2.304,15.179-6.256,21.348c-0.737-1.629-3.359-2.713-3.359-2.713
									l-20.68-9.985c4.925-3.875,6.591-11.49,6.591-15.758v-8.814c0-8.838-7.163-16.001-16-16.001c-8.835,0-15.999,7.163-15.999,16.001
									v8.814c0,3.881,1.772,11.736,6.743,15.727L12.73,60.804c0,0-3.221,1.438-3.521,3.279C5.163,57.865,2.802,50.455,2.802,42.5
									C2.802,20.611,20.61,2.802,42.5,2.802"/>
								</svg>
							<? endif ?>
							<p><?= $author->short_description ?></p>
						</li>
					<? endforeach ?>
				</ul>
			</div>
		</div>
	</section>
<? endif ?>
<!-- START: /skins/ra250/php/views/base/v_authors -->