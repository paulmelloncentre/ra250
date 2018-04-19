<!-- START: /skins/ra250/php/views/issue/v_banner -->
<div id="hero" data-src="<?= kt_get_media_path($banner, 'media_path_source') ?>" style="background-image: url('<?= kt_get_media_path($banner, 'media_path_lowres') ?>');" class="full-height">
	<a data-anchor class="icon-skip" href="#content" title="<?= esc(lang('skip_to_content')) ?>"><span><?= esc(lang('skip_to_content')) ?></span></a>
	<header id="title" class="wrapper">
		<div class="col">
			<div class="hgroup">
				<?if($content->special_issue_):?><h3>Special issue</h3><?endif?>
				<h1><?= lang('issue') ?> <?= $content->issue_number ?> &ndash; <?= $content->season ?></h1>
				<h2><?= $content->title ?></h2>

				<? if (!empty($content->authors)): ?> 
				<p><?=display_authors($content->authors, null)?></p>
				<?endif?>

			</div> 
		</div>
	</header>

	<div class="caption context banner-caption">
		<div class="caption-left">
			<p><?if($banner->credits && !empty($banner->credits)):?><?= $banner->credits ?>,<? endif ?><em><? if(!empty($banner->title)): ?> <?= $banner->title ?><? endif ?></em>, <? if(!empty($banner->caption)): ?> <?= $banner->caption ?><? endif ?></p>

			<p><? if($banner->copyright): ?>Digital image courtesy of <?= $banner->copyright ?><? endif ?></p>
		</div>
		<div class="caption-right">
			
		</div>
		<a href="#" class="icon-information">Credit</a>
	</div>
</div>
<!-- END: /skins/ra250/php/views/issue/v_banner -->
