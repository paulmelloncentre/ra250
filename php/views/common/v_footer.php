<!-- START: /skins/ra250/php/views/common/v_footer -->
<footer id="footer" role="contentinfo">
	<ul>
		<? if (!empty($footer_sponsors)): ?>	
			<? foreach ($footer_sponsors as $sponsor): ?>
				<li class="logo">
					<div class="gutter">
						<a class="ext-link" href="<?= $sponsor->url ?>" title="<?= esc($sponsor->name) ?>">
							<? if (kt_has_image($sponsor)): ?>
								<img data-src="<?= kt_get_media_path($sponsor->media['image'][0], 'media_path_source') ?>" src="<?= kt_get_media_path($sponsor->media['image'][0], 'media_path_lowres') ?>" alt="<?= kt_get_media_alt($sponsor->media['image'][0]) ?>" />
							<? endif ?>
						</a>
					</div>
				</li>
			<? endforeach ?>
		<? endif ?>
		<? if (!empty($footer_page)): ?>
			<li>
				<nav class="gutter">
					<ul>
						<? foreach ($footer_page as $page): ?>
							<li>
								<a class="<?=$theme_class?>" href="<?= create_url($page->controller, $page->reference) ?>" title="<?= esc($page->name) ?>"><?= esc($page->name) ?></a>
							</li>	
						<? endforeach ?>
					</ul>
				</nav>
			</li>
		<? endif ?>
		<? if (preference('bas_share_facebook') || preference('bas_share_twitter')): ?>
			<li class="social">
				<ul class="gutter">
					<? if (preference('bas_share_twitter')): ?>
						<li>
							<a class="icon-twitter ext-link" href="https://twitter.com/<?= preference('bas_share_twitter') ?>" title="<?= esc(lang('twitter')) ?>"><?= esc(lang('twitter')) ?></a>
						</li>
					<? endif ?>
					<? if (preference('bas_share_facebook')): ?>
						<li>
							<a class="icon-facebook ext-link" href="https://www.facebook.com/<?= preference('bas_share_facebook') ?>" title="<?= esc(lang('facebook')) ?>"><?= esc(lang('facebook')) ?></a>
						</li>
					<? endif ?>
				</ul>
			</li>
		<? endif ?>
		<li>
			<a data-anchor href="#skip-nav" title="<?= lang('go_to_top') ?>">
				<div>
					<div>
						<?= lang('top') ?>
					</div>
					<div class="icon-top"></div>
				</div>
			</a>
		</li>
	</ul>
</footer>
<!-- END: /skins/ra250/php/views/common/v_footer -->