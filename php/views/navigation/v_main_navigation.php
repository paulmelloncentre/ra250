<!-- START: /skins/ra250/php/views/navigation/v_main_navigation -->
<nav role="navigation">
	<? if (!empty($main_navigation['home'])): // Set logo as homepage navigation?>
		<a class="logo" href="<?= base_url() ?>" title="<?= $main_navigation['home']->name ?>">
				<img src="<?= base_url() ?>frontend/assets-src/bas/img/logo.svg" alt="British Art Studies" />
		</a>
		<a data-menu class="icon-menu" href="#" title="<?= lang('menu') ?>"><span><?= lang('menu') ?></span></a>	
	<? endif ?>
	<ul>
		<? $access_key = 1 ?>
		<? foreach ($main_navigation as $main): ?>
			<? if ($main->template == 'home_feature'): continue // dont show home page in main navigation?><? endif ?>
			<? if ($main->template == 'search'): ?>
				<li class="search">
					<a data-modal href="<?= create_url($main->controller) ?>" title="<?= esc($main->name) ?>" accesskey="<?= $access_key ?>">
						<span><?= lang('search') ?></span>
					</a>
				</li>
			<? else: ?>
				<li>
					<a<? if (!empty($main->sub_navigation)): ?> data-nav<? endif ?><? if ($main->controller === $controller): ?> class=" active"<? endif ?><? if (empty($main->sub_navigation)): ?> href="<?= create_url($main->controller) ?>"<? else: ?> href="#"<? endif ?> title="<?= esc($main->name) ?>" accesskey="<?= $access_key ?>"><span><?= esc($main->name) ?></span></a>
					<? if (!empty($main->sub_navigation)): ?>
						<div>
							<ul>
								<? foreach ($main->sub_navigation as $subnav_heading => $subnav_group_items): ?>
									<? foreach ($subnav_group_items as $key => $subnav_items): ?>
										<li>
											<? if (!empty($subnav_heading) && reset(array_keys($subnav_group_items)) === $key): ?>
												<strong><?= $subnav_heading ?></strong>
											<?php elseif (!empty($subnav_heading) && reset(array_keys($subnav_group_items)) !== $key): ?>
												<br />
											<? endif ?>
											<ul>
												<? foreach ($subnav_items as $item): ?>
													<li>
														<a href="<?= create_url($item->controller, $item->reference) ?>" title="<?= esc($item->name) ?>"<? if ($item->reference === $reference): ?> class="active"<? endif ?>><span><?= esc($item->name) ?></span></a>
													</li>
												<? endforeach ?>
											</ul>
										</li>
									<? endforeach ?>
								<? endforeach ?>	
							</ul>
							<? if (!empty($main->feature)): ?>
								<ul>
									<li>
										<a href="<?= create_href($main->feature->link) ?>" title="<?= esc($main->feature->link->name) ?>">
											<ul>
												<? if (kt_has_image($main->feature)): ?>
													<li>
														<p>
															<img src="<?=kt_get_media_path($main->feature->media['image'][0], 'media_path_see_also')?>" alt="<?=kt_get_media_alt($main->feature->media['image'][0])?>" data-pin-nopin="true" />
														</p>
													</li>
												<? endif ?>
												<li>
													<p>
														<strong><?= $main->feature->name ?></strong>
														<? if (!empty($main->feature->caption)): ?>
															<?= $main->feature->caption ?>
														<? endif ?>
													</p>
												</li>
											</ul>
										</a>
									</li>
								</ul>
							<? endif ?>
						</div>
					<? endif ?>
				</li>
			<? endif ?>
			<? $access_key++ ?>
		<? endforeach ?>

		<li class="more">
			<a data-nav href="#" title="Online Journal" accesskey="7"><span><?= preference('bas_organisation_name') ?></span></a>
			<div>
				<strong><?= lang('a_joint_publication_by') ?></strong>
				<ul>
					<li>
						<a class="ext-link" href="<?= get_base_url(1) ?>" title="<?= preference('organisation_name') ?>">
							<img src="<?= base_url() ?>frontend/assets-src/bas/img/PMC-logo.svg" alt="<?= preference('organisation_name') ?>" />
						</a>
					</li>
					<li>
						<a class="ext-link" href="http://britishart.yale.edu/" title="<?= lang('yale_centre_for_british_art') ?>">
							<img src="<?= base_url() ?>frontend/assets-src/bas/img/YCBA-logo.svg" alt="<?= lang('yale_centre_for_british_art') ?>" />
						</a>
					</li>
				</ul>
			</div>
		</li>
	</ul>
</nav>
<!-- END: /skins/ra250/php/views/navigation/v_main_navigation -->