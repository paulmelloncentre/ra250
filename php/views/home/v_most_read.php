<!-- START: /skins/ra250/php/views/home/v_most_read -->
<section class="subsidiary">
	<div class="wrapper">
		<div class="col">
			<h2><?= lang('most_read') ?></h2>
			<div class="carousel" data-carousel>
				<? foreach ($articles as $item): ?>
					<div class="clip gutter">
						<div class="img"<? if (kt_has_image($item)): ?> data-src="<?= kt_get_media_path($item->media['image'][0], 'media_path_list') ?>" style="background-image: url('<?= kt_get_media_path($item->media['image'][0], 'media_path_lowres') ?>');"<? endif ?>>
							<img />
						</div>
						<div class="body gutter">
							<h3><?= $item->title ?></h3>
							<p><?= $item->category ?><? if (!empty($item->authors)): ?> &ndash; <?= $item->authors ?><? endif ?></p>
						</div>
						<a class="overlay" href="<?= create_url($item->controller, $item->page_reference, $item->reference) ?>" title="<?= esc($item->title) ?>"><?= esc($item->title) ?></a>
					</div>
				<? endforeach ?>
			</div>
		</div>
	</div>
</section>
<!-- END: /skins/ra250/php/views/home/v_most_read -->