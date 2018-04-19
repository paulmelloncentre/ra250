<!-- START: /skins/ra250/php/views/article/v_tags -->
<section>
	<div class="context">
		<div class="heading">
			<h2><?= lang('tags') ?></h2>
		</div>
		<div class="tags">
			<ul>
				<? foreach ($content->tags as $tag): ?>
					<li>
						<a href="<?= create_url($article_index_page_reference, 'search', "tags:{$tag->reference}") ?>" title="<?= esc($tag->name) ?>"><?= esc($tag->name) ?></a>
					</li>
				<? endforeach ?>
			</ul>
		</div>
	</div>
</section>
<!-- END: /skins/ra250/php/views/article/v_tags -->