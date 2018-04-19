<!-- START: /skins/ra250/php/views/home/v_banner -->
<? if (kt_has_image($banner)): ?>
	<div id="hero" class="home">
		<div class="slider">
			<ul data-slider>
				<? foreach ($banner as $item): ?>
					<li data-src="<?= kt_get_media_path($item->media['image'][0], 'media_path_source') ?>" class="<?=$theme_class?>" style="background-image: url('<?= kt_get_media_path($item->media['image'][0], 'media_path_lowres') ?>');">
						<div class="row">
							<div class="cell">
								<div class="gutter">
									<p><?= $item->title ?></p>
									<? if (!empty($item->link)): ?>
										<a class="button<? if (is_external_link($item->link->target_table)): ?> ext-link<? endif ?>" href="<?= create_href($item->link) ?>" title="<?= esc($item->link->name) ?>"><?= esc($item->link->name) ?></a>
									<? endif ?>
								</div>
							</div>
						</div>

						<?php $banner = $item->media['image'][0]; ?>
						<div class="caption context banner-caption">
							<div class="caption-left home">

								<p><?if($banner->credits && !empty($banner->credits)):?><?= $banner->credits ?>,<? endif ?><em><? if(!empty($banner->title)): ?> <?= $banner->title ?><? endif ?></em>, <? if(!empty($banner->caption)): ?> <?= $banner->caption ?><? endif ?></p>

								<p><? if($banner->copyright): ?>Digital image courtesy of <?= $banner->copyright ?><? endif ?></p>
							</div>
							<div class="caption-right home">
								<!-- <?if(!empty($banner->credits)):?>
								<h3>
									<?=$banner->credits?>
								</h3>
								<?endif?>

								<?if(!empty($banner->copyright)):?>
								<h3>
									Digital image © <?=$banner->copyright?>
								</h3>
								<?endif?> -->
							</div>
							<a href="#" class="icon-information">Credit</a>
						</div>
					</li>
				<? endforeach ?>
			</ul>
		</div>
	</div>
<? endif ?>
<!-- END: /skins/ra250/php/views/home/v_banner -->
