<!-- START: /skins/ra250/php/views/article/v_imprint -->
<section id="anchor-information">
	<div class="context">
		<div class="heading">
			<h2><?= lang('imprint') ?></h2>
		</div>
		<div class="listing">
			<? if (!empty($content->authors)): ?>
				<?$content->authors = index_by($content->authors, "name");?>
				<dl>
					<!-- print orcid link below if id exists (and add url) -->
					<dt><?= lang('author') ?></dt>
					<dd><? foreach ($author_groups as $qualifier => $authors): ?><? foreach ($authors as $name => $link): ?><a class="hlink" href="<?= $link ?>" title="<?= esc($name) ?>"><?= esc($name) ?></a><?if(!empty($content->authors[$name]->orcid_id)):?><a href="<?=config('orcid_base_url').$content->authors[$name]->orcid_id?>" class="orcid">ORCID</a><?endif?><? if (end(array_keys($authors)) !== $name): ?>, <? endif ?><? endforeach ?><? if (end(array_keys($author_groups)) !== $qualifier): ?>, <? endif ?><? endforeach ?></dd>
				</dl>
			<? endif ?>
			<dl>
				<dt><?= lang('date') ?></dt>
				<dd><?= date(config('imprint_date_format'), strtotime($content->publish_date)) ?></dd>
			</dl>
			<dl>
				<dt><?= lang('category') ?></dt>
				<dd><a class="hlink" href="<?= create_url($article_index_page_reference, null, null, array('article-category' => $content->category_reference)) ?>"><?= $content->category ?></a></dd>
			</dl>
			<? if (!empty($content->bas_review_status)): ?>
				<dl>
					<dt><?= lang('review_status') ?></dt>
					<dd><?= $content->bas_review_status ?></dd>
				</dl>
			<? endif ?>
			<? if (!empty($content->bas_licence_status)): ?>
				<dl>
					<dt><?= lang('licence') ?></dt>
					<dd><a class="hlink" href="<?= $content->bas_licence_status_url ?>" target="_blank"><?= $content->bas_licence_status ?></a></dd>
				</dl>
			<? endif ?>
				<dl>
					<dt id="downloads"><?= lang('journal_downloads') ?></dt>
					<dd><a class="ext-link hlink prince" title="Download article as PDF" href="<?= lang('pdf_subdomain_article') ?>issue-<?= $content->issue_number ?>-<?= $content->permanent_url ?>.pdf"><?= lang('issue_pdf') ?></a></dd>
				</dl>
			<? if (!empty($content->issue_doi) && !empty($content->doi)): ?>
				<dl>
					<dt><?= lang('article_doi') ?></dt>
					<dd><a class="ext-link hlink" href="<?= rtrim(preference('doi_url'), '/') ?>/<?= $content->issue_doi ?>/<?= $content->doi ?>" title="<?= esc($content->doi) ?>"><?= rtrim(preference('doi_url'), '/') ?>/<?= $content->issue_doi ?>/<?= $content->doi ?></a></dd>
				</dl>
			<? endif ?>
			<? if (!empty($content->cite)): ?>
				<dl id="anchor-cite">
					<dt><?= lang('cite_as') ?></dt>
					<dd><?= $content->cite ?></dd>
				</dl>
			<? endif ?>
		</div>
	</div>
</section>
<!-- END: /skins/ra250/php/views/article/v_imprint -->
