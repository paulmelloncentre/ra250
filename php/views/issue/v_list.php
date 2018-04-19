<!-- START: /skins/ra250/php/views/issue/v_list -->
<section class="banner-list">
	<div class="wrapper">
		<ul>
			<? foreach ($result as $item): ?>
				<li>
					<div class="gutter">
						<?php $pic_no = rand(0, count($item->media["image"]) -1);?>
						<div class="body"<? if (kt_has_image($item)): ?> data-src="<?= kt_get_media_path($item->media['image'][$pic_no], 'media_path_source') ?>" style="background-image: url('<?= kt_get_media_path($item->media['image'][$pic_no], 'media_path_lowres') ?>');"<? endif ?>>
							<div class="hgroup">
								<h2><?= lang('issue') ?> <?= $item->issue_number ?> &ndash; <?= $item->season ?></h2>
								<? if (!empty($item->title)): ?>
									<p><?= $item->title ?></p>
								<? endif ?>
							</div>

							<?php $banner = $item->media['image'][$pic_no]; ?>
							<div class="caption context banner-caption">
								<div class="caption-left">

									<p><?if($banner->credits && !empty($banner->credits)):?><?= $banner->credits ?>,<? endif ?><em><? if(!empty($banner->title)): ?> <?= $banner->title ?><? endif ?></em>, <? if(!empty($banner->caption)): ?> <?= $banner->caption ?><? endif ?></p>

									<p><? if($banner->copyright): ?>Digital image courtesy of <?= $banner->copyright ?><? endif ?></p>

								</div>
								
								<a href="#" class="icon-information">Credit</a>
							</div>
						</div>
					</div>
					<a class="overlay" href="<?= create_url($controller, $reference, $item->reference) ?>" title="<?= esc($item->title) ?>"><?= esc($item->title) ?></a>
				</li>
			<? endforeach ?>
		</ul>
	</div>
</section>
<!-- END: /skins/ra250/php/views/issue/v_list -->
