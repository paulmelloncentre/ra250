<!-- START: /skins/ra250/php/views/base/v_document -->
<section id="anchor-downloads">
	<div class="context">
		<div class="heading">
			<h2><?= esc(lang('downloads')) ?></h2>
		</div>
		<div class="grid">
			<ul>
				<? foreach ($files as $item): ?>
					<li>
						<a class="<?=$theme_class?>" href="<?=config('media_path') . "_file/{$item->full_path}"?>" title="<?= esc($item->title) ?>">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="62px" height="88px" viewBox="0 0 62 88">
								<path fill="#1B1A1A" d="M10,73h41.969v3H10V73z M10,64h41.969v-3H10V64z M10,52h41.969v-3H10V52z M10,40h41.969v-3H10V40z
								 M61.969,86.5c0,0.828-0.645,1.5-1.473,1.5H1.5C0.672,88,0,87.328,0,86.5V1.583c0-0.828,0.672-1.5,1.5-1.5h34.334l26.123,26.465
								L61.969,86.5z M59,28H35.511C34.683,28,34,27.328,34,26.5V3H2.969v82H59V28z"/>
							</svg>
							<p><?= $item->title ?><small><?= format_size($item->filesize) ?> <?= $item->extension ?> <?= lang('file') ?></small></p>
						</a>
					</li>
				<? endforeach ?>
			</ul>
		</div>
	</div>
</section>
<!-- END: /skins/ra250/php/views/base/v_document -->