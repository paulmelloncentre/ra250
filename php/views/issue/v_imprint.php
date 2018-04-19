<!-- START: /skins/ra250/php/views/issue/v_imprint -->
<section>
	<div class="context">
		<div class="heading" id="imprint">
			<h2><?= lang('imprint') ?></h2>
		</div>
		<div class="listing">
			<? if (preference('bas_organisation_name')): ?>
				<dl>
					<dt><?= lang('title') ?></dt>
					<dd><?= preference('bas_organisation_name') ?></dd>
				</dl>
			<? endif ?>
			<? if (!empty($content->issn)): ?>
				<dl>
					<dt><?= lang('issn') ?></dt>
					<dd><?= $content->issn ?></dd>
				</dl>
			<? endif ?>
			<? if (!empty($content->publisher)): ?>
				<dl>
					<dt><?= lang('publisher') ?></dt>
					<dd><?= $content->publisher ?></dd>
				</dl>	
			<? endif ?>
			<? if (!empty($content->doi)): ?>
				<dl>
					<dt><?= lang('journal_doi') ?></dt>
					<dd><a class="ext-link hlink" href="<?= rtrim(preference('doi_url'), '/') ?>/<?= $content->doi ?>" title="DOI of issue"><?= preference('doi_url') ?><?= $content->doi ?></a></dd>
				</dl>
				<dl>
					<dt id="downloads"><?= lang('journal_downloads') ?></dt>
					<dd><a class="ext-link hlink" title="Download issue as PDF" href="<?= lang('pdf_subdomain') ?>issue-<?= $content->issue_number ?>.pdf"><?= lang('issue_pdf') ?></a>, <a class="ext-link hlink" title="View content in XML format" href="<?= lang('issue_url') ?><?= $content->issue_number ?>/<?= lang('xml_url') ?>"><?= lang('journal_xml') ?></a> </dd>
				</dl>
			<? endif ?>
		</div>
	</div>
</section>
<!-- END: /skins/ra250/php/views/issue/v_imprint -->
