<!-- START: /skins/ra250/php/views/article/v_dependant_list -->
<section class="module-list">
	<div class="wrapper">
		<ul class="row">
			<? foreach ($result as $item): ?>
				<li class="cell">
					<div class="gutter">
						<div class="img"<? if (kt_has_image($item)): ?> data-src="<?= kt_get_media_path($item->media['image'][0], 'media_path_list') ?>" style="background-image: url('<?= kt_get_media_path($item->media['image'][0], 'media_path_lowres') ?>');"<? endif ?>>
							<img />
						</div>
						<div class="body gutter">
							<h3><?= $item->title ?></h3>
							<p><?= $item->category ?><? if (!empty($item->authors)): ?> &ndash; <?= $item->authors ?><? endif ?></p>
						</div>
					</div>
					<a class="overlay" href="<?= create_url($item->controller, $item->page_reference, $item->issue_reference, array('article' => $item->reference)) ?>" title="<?= esc($item->title) ?>"><?= esc($item->title) ?></a>
				</li>
			<? endforeach ?>
		</ul>	
	</div>
</section>
<!-- START: /skins/ra250/php/views/article/v_dependant_list -->