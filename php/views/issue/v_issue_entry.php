
<!-- START: /skins/ra250/php/views/issue/v_issue_entry -->
<div class="pagination">
	<ul class="row">
		<li class="cell next"<? if (kt_has_image($entry_article)): ?> data-src="<?= kt_get_media_path($entry_article->media['image'][0], 'media_path_prev_next') ?>" style="background-image: url('<?= kt_get_media_path($entry_article->media['image'][0], 'media_path_lowres') ?>');"<? endif ?>>
			<a href="<?= create_url($entry_article->controller, $entry_article->page_reference, null, array($entry_article->issue_reference => $entry_article->reference)) ?>" title="<?= esc($entry_article->title) ?>">
				<p>
					<span><?= $entry_article->category ?></span>
					<strong><?= $entry_article->title ?></strong>
					<? if (!empty($entry_article->author_text)): ?>
						<small><?= $entry_article->author_text ?></small>	
					<? endif ?>
				</p>
			</a>
		</li>
	</ul>
</div>
<!-- END: /skins/ra250/php/views/issue/v_issue_entry -->