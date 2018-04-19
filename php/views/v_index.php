<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<? if(!is_live()): ?>
			<meta name="robots" content="noindex" />
		<? endif ?>

		<? if (!empty($meta_tags['title'])): ?>
			<?=$meta_tags['title']?>
		<? else: ?>
			<title><?= meta_title($this->data) ?></title>
		<? endif ?>

		<meta name="author" content="<?= preference('bas_organisation_name') ?>" />
		<? if (!empty($meta_tags['description'])): ?>
			<?=$meta_tags['description']?>
		<? else: ?>
			<meta name="description" content="<?= preference('bas_meta_description') ?>" />
		<? endif ?>

		<? if (!empty($meta_tags['keywords'])): ?>
			<?=$meta_tags['keywords']?>
		<? else: ?>
			<meta name="keywords" content="<?= preference('meta_keywords') ?>" />
		<? endif ?>

		<meta name="format-detection" content="telephone=no" />
		<meta name="viewport" content="width=320, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" />
		
		<? if($template == 'article' && !$is_list):?>
			<?$citation_author_ids = array()?>
			<meta name="citation_title" content="<?= htmlentities($this->data->content->title)?>">
			<meta name="citation_journal_title" content="<?= preference('bas_organisation_name') ?>">
			<meta name="citation_publisher" content="<?= preference('bas_publisher') ?>">

			<?if(!empty($this->data->content->authors)):?>
				<?foreach($this->data->content->authors as $actor):?>
					<?$citation_author_ids[] = $actor->id?>
					<meta name="citation_author" content="<?= $actor->forename ?> <?= $actor->surname ?>">
					<?if(!empty($actor->organisation)):?>
						<meta name="citation_author_institution" content="<?= htmlentities($actor->organisation) ?>">
					<?endif?>

					<?if(!empty($actor->orcid_id)):?>
						<meta name="citation_author_orcid" content="<?= $actor->orcid_id ?>">
					<?endif?>
				<?endforeach?>
			<?endif?>

			<?if(!empty($this->data->content->chapters)):?>
				<?foreach($this->data->content->chapters as $chapter):?>
					<?if(!empty($chapter->authors)):?>
						<?foreach($chapter->authors as $actor):?>
							<?if(!in_array($actor->id, $citation_author_ids)):?>
								<?$citation_author_ids[] = $actor->id?>
								<meta name="citation_author" content="<?= $actor->forename ?> <?= $actor->surname ?>">
								<?if(!empty($actor->organisation)):?>
									<meta name="citation_author_institution" content="<?= htmlentities($actor->organisation) ?>">
								<?endif?>

								<?if(!empty($actor->orcid_id)):?>
									<meta name="citation_author_orcid" content="<?= $actor->orcid_id ?>">
								<?endif?>
							<?endif?>
						<?endforeach?>
					<?endif?>
				<?endforeach?>
			<?endif?>

			<?if(!empty($this->data->content->publish_date)):?>
			<meta name="citation_publication_date" content="<?= date('Y/m/d', strtotime($this->data->content->publish_date))?>">
			<meta name="citation_online_date" content="<?= date('Y/m/d', strtotime($this->data->content->publish_date))?>">
			<?endif?>

			<?if(!empty($this->data->content->issue_number)):?>
			<meta name="citation_issue" content="<?= $this->data->content->issue_number ?>">
			<?endif?>
			<?if(!empty($this->data->content->article_doi)):?>
			<meta name="citation_doi" content="<?= str_replace('http://dx.doi.org/', '', $this->data->content->article_doi) ?>">
			<?endif?>
			<?if(!empty($this->data->content->issue_issn)):?>
			<meta name="citation_issn" content="<?= $this->data->content->issue_issn?>">
			<?endif?>
			
			<?if(!empty($this->data->files)):?>
				<?foreach($this->data->files as $file):?>
					<?if($file->extension == 'pdf'):?>
						<meta name="citation_pdf_url" content="<?= base_url().ltrim(config('media_path'), '/').config('media_path_file').'/'.$file->full_path?>">
						<?break;?>
					<?endif?>
				<?endforeach?>
			<?endif?>

			<?if(!empty($this->data->content->tags_text)):?>
				<meta name="citation_keywords" content="<?= htmlentities($this->data->content->tags_text) ?>">
			<?endif?>

			<?if(!empty($this->data->content->article_reference)):?>
				<?$reference = explode('<p>', $this->data->content->article_reference);?>
				<?foreach($reference as $item):?>
					<?if(!empty($item)):?>
						<?$item = strip_tags(trim($item))?>
						<meta name="citation_reference" content="<?= htmlentities($item) ?>">
					<?endif?>
				<?endforeach?>
			<?endif?>

		<? endif?>

		<? if (!empty($social_meta_tags)): ?>
			<? foreach ($social_meta_tags as $type => $tags): ?>
				<? if (is_array($tags)): ?>
					<? foreach ($tags as $tag): ?>
						<?=$tag.PHP_EOL?>
					<? endforeach ?>
				<? endif ?>
			<? endforeach ?>
		<? endif ?>
	
		<link rel="stylesheet" href="<?= base_url() ?>skins/bas/assets/css/normalise.css" media="screen" />
		<? if(!is_live()): ?>
			<link rel="stylesheet" href="<?= base_url() ?>skins/bas/assets/css/style.css" media="screen" />
			<link rel="stylesheet" href="<?= base_url() ?>skins/bas/assets/css/print.css" media="print" />
		<? else: ?>
			<link rel="stylesheet" href="<?= base_url() ?>skins/bas/assets/css/style.min.css" media="screen" />
			<link rel="stylesheet" href="<?= base_url() ?>skins/bas/assets/css/print.min.css" media="print" />
		<? endif ?>

		<link rel="shortcut icon" href="<?= base_url() ?>skins/bas/assets/css/img/BAS-favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url() ?>skins/bas/assets/img/BAS-favicon_114.png" >
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url() ?>skins/bas/assets/img/BAS-favicon_72.png" />
		<link rel="apple-touch-icon-precomposed" href="<?= base_url() ?>skins/bas/assets/img/BAS-favicon_57.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>skins/bas/assets/img/apple-touch-icon-76x76.png"/>
		<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url() ?>skins/bas/assets/img/apple-touch-icon-120x120.png"/>
		<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url() ?>skins/bas/assets/img/apple-touch-icon-152x152.png"/>
		<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>skins/bas/assets/img/apple-touch-icon-180x180.png"/>
		<link href="https://cdn.jsdelivr.net/mediaelement/2.18.2/mediaelementplayer.min.css" rel="stylesheet">
		
		<link href='https://cdn.knightlab.com/libs/soundcite/latest/css/player.css' rel='stylesheet' type='text/css'>
		<script type='text/javascript' src='https://cdn.knightlab.com/libs/soundcite/latest/js/soundcite.min.js'></script>

		<noscript>
			<div id="noscript">
				For full functionality of this site it is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com/" target="_blank">instructions how to enable JavaScript in your web browser</a>.
			</div>
		</noscript>
		<? if(!is_live()): ?>
			<script src="<?= base_url() ?>skins/vendorassets/modernizr/modernizr.js"></script>
			<script src="<?= base_url() ?>frontend/assets-src/pmc/js/viewport-units-buggyfill.js"></script>
		<? else: ?>
			<script src="<?= base_url() ?>frontend/assets/pmc/js/modernizr.min.js"></script>
			<script src="<?= base_url() ?>frontend/assets/pmc/js/viewport-units-buggyfill.min.js"></script>
		<? endif ?>
		<script>window.viewportUnitsBuggyfill.init();</script>

		<script type="text/javascript">
			<? if(is_live()): ?>
				document.domain = "ra.paul-mellon-centre.ac.uk";
			<?else:?>
				document.domain = "th.keepthinking.it";
			<?endif?>
		</script>

		<script type="text/javascript">
			function setCookie(cname,cvalue,exdays) {
			    var d = new Date();
			    d.setTime(d.getTime() + (exdays*24*60*60*1000));
			    var expires = "expires=" + d.toGMTString();
			    document.cookie = cname+"="+cvalue+"; "+expires;
			}
			var screen_width = document.getElementsByTagName("html")[0].getBoundingClientRect().width;
			setCookie('screen_width',screen_width,1); 
		</script>

	</head>
	<body <? if ($template == 'issue'): ?> class="sticky issue"<? endif ?>>

		<!-- Google Tag Manager -->
		<noscript>
			<iframe src="//www.googletagmanager.com/ns.html?id=GTM-MJ8KLM" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<script>
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MJ8KLM');
		</script>
		<!-- End Google Tag Manager -->

		<map id="skip-nav" name="skip-nav" class="hidden" title="skip_navigation">
			<p>
				[<a href="#header" title="<?=lang('skip_to_main_navigation')?>"><?=lang('skip_to_main_navigation')?></a>]
				<? if (!empty($content) || !empty($body)): ?>
					[<a href="#content" title="<?=lang('skip_to_content')?>"><?=lang('skip_to_content')?></a>]
					<? if (!empty($page) || !empty($page_complimentary)): ?>
						[<a href="#page" title="<?=lang('skip_to_secondary_content')?>"><?=lang('skip_to_secondary_content')?></a>]
					<? endif ?>
				<? elseif (!empty($page) || !empty($page_complimentary)): ?>
					[<a href="#page" title="<?=lang('skip_to_content')?>"><?=lang('skip_to_content')?></a>]
				<? endif ?>
				[<a href="#footer" title="<?=lang('skip_to_quick_links')?>"><?=lang('skip_to_quick_links')?></a>]
				<? if (!empty($search_page_reference)): ?>[<a href="<?=create_url($search_page_reference)?>" title="<?=lang('go_to_global_search')?>"><?=lang('go_to_global_search')?></a>]<? endif ?>
				<? if (!empty($contact_page_reference)): ?>[<a href="<?=create_url($contact_page_reference)?>" title="<?=lang('go_to_contacts')?>"><?=lang('go_to_contacts')?></a>]<? endif ?>
				<? if (!empty($accessibility_page)): ?>[<a href="<?= create_url($accessibility_page->controller, $accessibility_page->reference) ?>" title="<?=lang('go_to_accessibility_information')?>" accesskey="A"><?=lang('go_to_accessibility_information')?></a>]<? endif ?>
			</p>
		</map>
		<?if(!empty($preview)):?>
			<div id="preview-mode" class="preview-notice">Preview mode <span><a href="<?=base_url()?>preview/logout" title="Go to live site">Logout</a></span></div>
		<?endif?>
		<header id="header">
			<?= $header ?>
		</header>
		<? if (!empty($hero)): ?>
			<!-- <div class="gap"></div> -->
			<?= $hero ?>
		<? endif ?>
		<article id="main" role="main" class="<?if($controller == 'about' || $controller == 'guidelines' ):?>standard<?endif?>">
			<? if (!empty($content) || !empty($body)): ?>
				<div id="content">
					<? if (!empty($content)): ?>
						<?= $content ?>
					<? endif ?>

					<? if (!empty($body)): ?>
		  				<div id="body" class="wrapper">
		  					<div class="col">
								<?= $body ?>
							</div>
						</div>
					<? endif ?>

					<? if (!empty($content_complementary)): ?>
						<?= $content_complementary ?>
					<? endif ?>
				</div>
			<? endif ?>
			<? if (!empty($page) || !empty($page_complimentary)): ?>
				<div id="page"<? if (!empty($page_complimentary)): ?> class="complementary"<? endif ?>>
					<? if (!empty($page)): ?>
						<?= $page ?>
					<? endif ?>
					<? if (!empty($page_complimentary)): ?>
						<?= $page_complimentary ?>
					<? endif ?>
				</div>
			<? endif ?>
		</article>
		<footer id="footer" role="contentinfo">
			<?= $footer ?>
		</footer>

		<script type="text/javascript">
			var KT = { 
				base_url: "<?=base_url()?>"
			}
		</script>


		<script src="<?= base_url() ?>skins/bas/assets/js/lib/openseadragon/openseadragon.js"></script>
		<? if(!is_live()): ?>
			<script src="<?= base_url() ?>skins/vendorassets/jquery/dist/jquery.min.js"></script>
			<script src="<?= base_url() ?>skins/vendorassets/jQuery-Touch-Events/src/jquery.mobile-events.min.js"></script>
			<script src="<?= base_url() ?>skins/vendorassets/ResponsiveSlides.js/responsiveslides.js"></script>
			<script src="<?= base_url() ?>skins/vendorassets/OwlCarousel/owl-carousel/owl.carousel.min.js"></script>
			<script src="https://cdn.jsdelivr.net/mediaelement/2.18.2/mediaelement-and-player.min.js"></script>
			<script src="<?= base_url() ?>skins/bas/assets/js/script.js"></script>
		<?else:?>
			<script src="<?= base_url() ?>skins/vendorassets/jquery/dist/jquery.min.js"></script>
			<script src="<?= base_url() ?>skins/vendorassets/jQuery-Touch-Events/src/jquery.mobile-events.min.js"></script>
			<script src="<?= base_url() ?>skins/vendorassets/ResponsiveSlides.js/responsiveslides.js"></script>
			<script src="<?= base_url() ?>skins/vendorassets/OwlCarousel/owl-carousel/owl.carousel.min.js"></script>
			<script src="https://cdn.jsdelivr.net/mediaelement/2.18.2/mediaelement-and-player.min.js"></script>
			<script src="<?= base_url() ?>skins/bas/assets/js/script.js"></script>
		<? endif ?>


		<script>
		    /* * * CONFIGURATION VARIABLES * * */
		    var disqus_shortname = '<?=config('disqus_shortname')?>';

		    /* * * DON'T EDIT BELOW THIS LINE * * */
		    (function () {
		        var s = document.createElement('script'); s.async = true;
		        s.type = 'text/javascript';
		        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
		        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
		    }());
		</script>
	</body>
</html>
