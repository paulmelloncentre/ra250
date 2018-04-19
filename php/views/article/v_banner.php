<!-- START: /skins/ra250/php/views/article/v_banner -->
<? if(empty($content->zoom_banner)):?>
	<div id="hero" class="article-standard-hero" data-src="<?= kt_get_media_path($banner, 'media_path_source') ?>" style="background-image: url('<?= kt_get_media_path($banner, 'media_path_lowres') ?>');">
		<header id="title" class="wrapper">
			<div class="col">
				<div class="hgroup">
					<a class="breadcrumbs" href="<?= create_url($controller, $reference, (!empty($url_params['issue']) && !$is_article_index) ? $url_params['issue'] : null, array_intersect_key($url_params, config('article_url_params'))) ?>" title="<?= (!empty($url_params['issue']) && !$is_article_index) ? esc(lang('issue'). ' ' . $content->issue_number) : esc($node_name) ?>"><?= (!empty($url_params['issue']) && !$is_article_index) ? esc(lang('issue'). ' ' . $content->issue_number) : esc($node_name) ?></a>
					<h1><?= $content->title ?></h1>
			<p><a class="hlink" href="<?= create_url($article_index_page_reference, null, null, array_merge(array_intersect_key($url_params, config('article_url_params')), array('article-category' => $content->category_reference))) ?>" title="<?= esc($content->category) ?>"><?= esc($content->category) ?></a><? if (!empty($content->authors)): ?> <?= display_authors($content->authors, create_url($article_index_page_reference, null, null, null)) ?><? endif ?></p>
				</div>
			</div>
		</header>

		<div class="caption context banner-caption">
			<div class="caption-left">

				<?if($banner->credits && !empty($banner->credits)):?><?= $banner->credits ?>, <? endif ?><em><? if(!empty($banner->title)): ?><?= $banner->title ?><? endif ?></em>, <? if(!empty($banner->caption)): ?> <?= $banner->caption ?><? endif ?></p>
				<p><? if($banner->copyright): ?>Digital image courtesy of <?= $banner->copyright ?><? endif ?></p>	

			</div>
			<div class="caption-right">

			</div>
			<a href="#" class="icon-information"></a>
		</div>
	</div>
<?else:?>
	<div class="zoom-hero">
		<iframe src="<?= $content->zoom_banner->name?>" height="100%;" width="100%"></iframe> 
	</div>

	<div class="zoom-header">
		<header id="title" class="wrapper">
			<div class="col">
				<div class="hgroup">
					<a class="breadcrumbs" href="<?= create_url($controller, $reference, (!empty($url_params['issue']) && !$is_article_index) ? $url_params['issue'] : null, array_intersect_key($url_params, config('article_url_params'))) ?>" title="<?= (!empty($url_params['issue']) && !$is_article_index) ? esc(lang('issue'). ' ' . $content->issue_number) : esc($node_name) ?>"><?= (!empty($url_params['issue']) && !$is_article_index) ? esc(lang('issue'). ' ' . $content->issue_number) : esc($node_name) ?></a>
					<h1><?= $content->title ?></h1>
			<p><a class="hlink" href="<?= create_url($article_index_page_reference, null, null, array_merge(array_intersect_key($url_params, config('article_url_params')), array('article-category' => $content->category_reference))) ?>" title="<?= esc($content->category) ?>"><?= esc($content->category) ?></a><? if (!empty($content->authors)): ?> <?= display_authors($content->authors, create_url($article_index_page_reference, null, null, null)) ?><? endif ?></p>
				</div>
			</div>
		</header>
	</div>
<?endif?>
<!-- END: /skins/ra250/php/views/article/v_banner -->
