<!-- START: views/base/v_banner -->
<div id="hero" data-src="<?= kt_get_media_path($banner, 'media_path_source') ?>" style="background-image: url('<?= kt_get_media_path($banner, 'media_path_lowres') ?>');">
	<header id="title" class="wrapper">
		<div class="col">
			<div class="hgroup">
				<h1><?= $content->name ?></h1>
			</div>
		</div>
	</header>

	<div class="caption context banner-caption">
		<div class="caption-left">
			<?if($banner->credits && !empty($banner->credits)):?><?= $banner->credits ?>,<? endif ?><em><? if(!empty($banner->title)): ?> <?= $banner->title ?><? endif ?></em>, <? if(!empty($banner->caption)): ?> <?= $banner->caption ?><? endif ?></p>
			<p><? if($banner->copyright): ?>Digital image courtesy of <?= $banner->copyright ?><? endif ?></p>
		</div>
		<a href="#" class="icon-information">Credit</a>
	</div>

</div>
<!-- END: views/base/v_banner -->
