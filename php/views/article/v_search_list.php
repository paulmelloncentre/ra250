<!-- START: /skins/ra250/php/views/article/v_search_list -->
<section class="module-list">
	<div class="wrapper">
		<h2>
			<div class="gutter">
				<span><?= count($result) ?> <em><?= lang('results') ?></em></span>
			</div>
		</h2>
		<ul class="row">
			<? foreach ($result as $item): ?>
				<li class="cell">
					<div class="gutter">
						<div class="img"<? if (kt_has_image($item)): ?> data-src="<?= kt_get_media_path($item->media['image'][0], 'media_path_list') ?>" style="background-image: url('<?= kt_get_media_path($item->media['image'][0], 'media_path_lowres') ?>');"<? endif ?>>
							<img />
						</div>
						<div class="body gutter">
							<h3><?= $item->title ?></h3>
							<p><?= $item->category ?><? if (!empty($item->author_text)): ?> &ndash; <?= $item->author_text ?><? endif ?></p>
						</div>
					</div>
					<a class="overlay" href="<?= create_url($controller, $reference, $item->reference, $url_params) ?>" title="<?= esc($item->title) ?>"><?= esc($item->title) ?></a>
				</li>
			<? endforeach ?>
		</ul>	
	</div>
</section>
<!-- END: /skins/ra250/php/views/article/v_search_list -->