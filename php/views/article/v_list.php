<!-- START: /skins/ra250/php/views/article/v_list -->
<section class="module-list">
	<div class="wrapper">
	<? if (!empty($group_sub_title) || !empty($group_title)): ?>
		<div class="hgroup">
			<? if (!empty($group_sub_title)): ?>
				<h1><?= ucwords($group_sub_title) ?></h1>	
			<? endif ?>
			<? if (!empty($group_title)): ?>
				<p><?= $group_title ?></p>
			<? endif ?>
		</div>
	<? endif ?>
		<ul class="row">
			<? foreach ($result as $item): ?>
				<?if(empty($item->parent_id) && !empty($item->child_articles)):?>
					<li class="cell parent">
						<div class="gutter">
							<div class="img"<? if (kt_has_image($item)): ?> data-src="<?= kt_get_media_path($item->media['image'][0], 'media_path_list') ?>" style="background-image: url('<?= kt_get_media_path($item->media['image'][0], 'media_path_lowres') ?>');"<? endif ?>>
								<div class="text-wrap">
									<p>Section</p>
									<h3><?= $item->title ?></h3>
									<p><?= $item->category ?><? if (!empty($item->author_text)): ?> &ndash; <?= $item->author_text ?><? endif ?></p>
								</div>
							</div>
						</div>
						<a class="overlay" href="<?= create_url($item->controller, $item->page_reference, null, array($item->issue_reference => $item->reference)) ?>" title="<?= esc($item->title) ?>">
						<?= esc($item->title) ?></a>
					</li>

					<?foreach($item->child_articles as $child):?>
						<li class="cell">
							<div class="gutter">
								<div class="img"<? if (kt_has_image($child)): ?> data-src="<?= kt_get_media_path($child->media['image'][0], 'media_path_list') ?>" style="background-image: url('<?= kt_get_media_path($child->media['image'][0], 'media_path_lowres') ?>');"<? endif ?>>
									<img />
								</div>
								<div class="body gutter">
									<h3><?= @pick($item->short_title, $item->title) ?></h3>
									<h3 class="sub"><?= $child->title ?></h3>
									<p><?= $child->category ?><? if (!empty($child->author_text)): ?> &ndash; <?= $child->author_text ?><? endif ?></p>
								</div>
							</div>
							<a class="overlay" href="<?= create_url($child->controller, $child->page_reference, null, array($child->issue_reference => $child->reference)) ?>" title="<?= esc($child->title) ?>"><?= esc($child->title) ?></a>
						</li>
					<?endforeach?>
				<?else:?>
					<!-- else if child article -->
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
						<a class="overlay" href="<?= create_url($item->controller, $item->page_reference, null, array($item->issue_reference => $item->reference)) ?>" title="<?= esc($item->title) ?>"><?= esc($item->title) ?></a>
					</li>

				<?endif?>
			<? endforeach ?>
		</ul>	
	</div>
</section>
<!-- END: /skins/ra250/php/views/article/v_list -->