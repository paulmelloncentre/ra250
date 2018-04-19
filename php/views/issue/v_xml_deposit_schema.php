<?='<?xml version="1.0" encoding="UTF-8"?>'?>
<doi_batch version="4.3.4" xmlns="http://www.crossref.org/schema/4.3.4" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.crossref.org/schema/4.3.4 
http://www.crossref.org/schema/deposit/crossref4.3.4.xsd">
	<body>
		<journal>
			<journal_issue>
				<publication_date media_type="online">
					<month><?=$issue->month?></month>
					<day><?=$issue->day?></day>
					<year><?=$issue->year?></year>
				</publication_date>
				<issue><?=$issue->issue_number?></issue>
			</journal_issue>
			<? if(!empty($issue->articles)): ?>
			<? foreach($issue->articles as $article): ?>
			<journal_article publication_type="full_text">
				<titles>
					<title><?=htmlspecialchars($article->title)?></title>
				</titles>
				<?if(!empty($article->authors)):?>
				<contributors>
					<? foreach($article->authors as $i => $actor): ?>
					<person_name sequence="<?if($i == 0):?>first<?else:?>additional<?endif?>" contributor_role="author">
						<given_name><![CDATA[<?=$actor->forename?>]]></given_name>
						<surname><![CDATA[<?if(!empty($actor->surname)):?><?=$actor->surname?><?else:?>n/a<?endif?>]]></surname>
					</person_name>
					<? endforeach ?>
					<?if(!empty($article->article_chapter_authors )):?>
					<? foreach($article->article_chapter_authors as $i => $actor): ?>
					<person_name sequence="additional" contributor_role="author">
						<given_name><![CDATA[<?=$actor->forename?>]]></given_name>
						<surname><![CDATA[<?if(!empty($actor->surname)):?><?=$actor->surname?><?else:?>n/a<?endif?>]]></surname>
					</person_name>
					<? endforeach ?>
					<?endif?>
				</contributors>
				<?endif?>
				<publication_date media_type="online">
					<month><?=$article->month?></month>
					<day><?=$article->day?></day>
					<year><?=$article->year?></year>
				</publication_date>
				<publisher_item>
					<identifier id_type="pii"><?=$issue->issn?></identifier>
				</publisher_item>
				<doi_data>
					<doi><?=str_replace("http://dx.doi.org/", "", rtrim(preference('doi_url'), '/'))?>/<?=$issue->doi?>/<?=$article->doi?></doi>
					<timestamp><?=time()?></timestamp>
					<resource><?=base_url()."issues/issue-index/{$issue->reference}/{$article->reference}"?></resource>
				</doi_data>
				<? if(!empty($article->media) || !empty($article->chapters)): ?>
				<component_list>
					<? if(!empty($article->media)): ?>
						<? foreach($article->media as $media): ?>
						<component parent_relation="isPartOf">
							<description><![CDATA[<b><?=$media->component_type?> <?=$media->component_index?>:</b> <?=strip_tags($media->title)?> <?=strip_tags($media->caption)?>]]></description>
							<doi_data>
								<doi><?=str_replace("http://dx.doi.org/", "", rtrim(preference('doi_url'), '/'))?>/<?=$issue->doi?>/<?=$article->doi?>/<?=strtolower($media->component_type)?><?=$media->component_index?></doi>
								<resource><?=$media->url?></resource>
							</doi_data>
						</component>
						<? endforeach ?>
					<? endif ?>
					<? if(!empty($article->chapters)): ?>
						<? foreach($article->chapters as $chapter_index => $chapter): ?>
						<component parent_relation="isPartOf">
							<description><![CDATA[<?=strip_tags($chapter->title)?>]]></description>
							<doi_data>
								<doi><?=str_replace("http://dx.doi.org/", "", rtrim(preference('doi_url'), '/'))?>/<?=$issue->doi?>/<?=$article->doi?>/<?=str_pad($chapter->rank, 3, "0", STR_PAD_LEFT)?></doi>
								<resource><?=base_url()."issues/issue-index/{$issue->reference}/{$article->reference}"?>#<?=str_pad($chapter->rank, 3, '0', STR_PAD_LEFT)?></resource>
							</doi_data>
						</component>
						<? if(!empty($chapter->paragraphs)): ?>
							<?foreach($chapter->paragraphs as $paragraph_index => $paragraph): ?>
							<component parent_relation="isPartOf">
								<description><![CDATA[<?=strip_tags($paragraph->name)?>]]></description>
								<doi_data>
									<doi><?=str_replace("http://dx.doi.org/", "", rtrim(preference('doi_url'), '/'))?>/<?=$issue->doi?>/<?=$article->doi?>/<?=$paragraph->doi?></doi>
									<resource><?=base_url()."issues/issue-index/{$issue->reference}/{$article->reference}"?>#<?=$paragraph->doi?></resource>
								</doi_data>
							</component>
							<?endforeach?>
						<?endif?>
						<? endforeach ?>
					<? endif ?>
				</component_list>
				<? endif ?>
			</journal_article>
			<? endforeach ?>
			<? endif ?>
		</journal>
	</body>
</doi_batch>
