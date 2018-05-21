<?='<?xml version="1.0" encoding="UTF-8"?>'?>
<? foreach($publications as $publication): ?>
	<publication>
		<?if(!empty($publication->name)):?>
			<title><?=htmlspecialchars($publication->name)?></title>
		<?endif?>
		<?if(!empty($publication->subtitle)):?>
			<subtitle><?=htmlspecialchars($publication->subtitle)?></subtitle>
		<?endif?>
		<?if(!empty($publication->typename)):?>
			<type><?=htmlspecialchars($publication->typename)?></type>
		<?endif?>
		<?if(!empty($publication->actorname)):?>
			<publisher><?=htmlspecialchars($publication->actorname)?></publisher>
		<?endif?>
		<?if(!empty($publication->isbn_number)):?>
			<identifier><?=$publication->isbn_number?></identifier>
		<?endif?>
		<?if(!empty($publication->publish_date)):?>
			<date><?=$publication->publish_date?></date>
		<?endif?>
		<?if(!empty($publication->url)):?>
			<url><?=$publication->url?></url>
		<?endif?>
		<doi><?=str_replace("http://dx.doi.org/", "", rtrim(preference('ra_doi_prefix'), '/'))?></doi>
		<?if(!empty($publication->short_description)):?>
			<description><?=htmlspecialchars($publication->short_description)?></description>
		<?endif?>
		<?if(!empty($publication->pages)):?>
			<pages>
				<? foreach ($publication->pages as $page) { ?>
					<page>
						<rank><?=htmlspecialchars($page->rank)?></rank>
						<name><?=htmlspecialchars($page->name)?></name>
						<description><?=htmlspecialchars($page->description)?></description>
					</page>
				<? } ?>
			</pages>
		<?endif?>
		<? foreach($publication->articles as $article): ?>
			<article>
				<?if(!empty($article->rank)):?>
					<rank><?=$article->rank?></rank>
				<?endif?>
				<?if(!empty($article->title)):?>
					<title><?=htmlspecialchars($article->title)?></title>
				<?endif?>
				<?if(!empty($article->short_title)):?>
					<short-title><?=htmlspecialchars($article->short_title)?></short-title>
				<?endif?>
				<author>
					<?if(!empty($article->author_forename)):?>
						<forename><?=htmlspecialchars($article->author_forename)?></forename>
					<?endif?>
					<?if(!empty($article->author_surname)):?>
						<surname><?=htmlspecialchars($article->author_surname)?></surname>
					<?endif?>
					<?if(!empty($article->author_occupation)):?>
						<occupation><?=htmlspecialchars($article->author_occupation)?></occupation>
					<?endif?>
					<?if(!empty($article->author_organisation)):?>
						<affiliation><?=htmlspecialchars($article->author_organisation)?></affiliation>
					<?endif?>
					<?if(!empty($article->author_short_description)):?>
						<bio><?=htmlspecialchars($article->author_short_description)?></bio>
					<?endif?>
					<?if(!empty($article->author_orcid_id)):?>
						<orcid-id><?=htmlspecialchars($article->author_orcid_id)?></orcid-id>
					<?endif?>
					<?if(!empty($article->author_email)):?>
						<email><?=htmlspecialchars($article->author_email)?></email>
					<?endif?>
				</author>
				<?if(!empty($article->article_category_name)):?>
					<type><?=htmlspecialchars($article->article_category_name)?></type>
				<?endif?>
				<?if(!empty($article->bas_review_status_name)):?>
					<review-status><?=htmlspecialchars($article->bas_review_status_name)?></review-status>
				<?endif?>
				<?if(!empty($article->bas_licence_status_name)):?>
					<licence><?=htmlspecialchars($article->bas_licence_status_name)?></licence>
				<?endif?>
				<?if(!empty($article->bas_licence_status_url)):?>
					<licence-url><?=htmlspecialchars($article->bas_licence_status_url)?></licence-url>
				<?endif?>
				<?if(!empty($article->doi)):?>
					<doi><?=str_replace("http://dx.doi.org/", "", rtrim(preference('ra_doi_prefix'), '/'))?>/<?=$article->doi?></doi>
				<?endif?>
				<?if(!empty($article->article_reference)):?>
					<bibliography><?=htmlspecialchars($article->article_reference)?></bibliography>
				<?endif?>
				<supplementary_text>
					<type>
						<?if(!empty($article->article_category_id)):?>
							<?=htmlspecialchars($article->article_category_id)?>
						<?endif?>
					</type>
					<text>
						<?if(!empty($article->text)):?>
							<?=htmlspecialchars($article->text)?>
						<?endif?>
					</text>
				</supplementary_text>
				<tags>
					<? foreach ($article->tags as $tag) { ?>
						<tag>
							<name>
								<?if(!empty($tag->name)):?>
									<?=htmlspecialchars($tag->name)?>
								<?endif?>
							</name>
							<aat_id>
								<?if(!empty($tag->aat_search)):?>
								<aat_id>
									<?=htmlspecialchars($tag->aat_search)?>
									</aat_id>
								<?endif?>
							</aat_id>
							<ulan_id>
								<?if(!empty($tag->ulan_search)):?>
									<?=htmlspecialchars($tag->ulan_search)?>	
								<?endif?>
							</ulan_id>
						</tag>
					<? } ?>
				</tags>
				<?foreach($article->chapters as $chapter):?>
					<chapter>
						<?if(!empty(trim($chapter->rank)) || $chapter->rank=='0'):?>
							<rank><?=$chapter->rank?></rank>
						<?endif?>
						<?if(!empty(trim($chapter->title))):?>
							<title><?=htmlspecialchars($chapter->title)?></title>
						<?endif?>
						<?if(!empty(trim($chapter->description))):?>
							<text><?=htmlspecialchars($chapter->description)?></text>
						<?endif?>
						<?if($chapter->chart_links || $chapter->zoom_links):?>
							<figures>
								<?foreach($chapter->chart_links as $link):?>
									<external>
										<?if(!empty(trim($link->name))):?>
											<url><?=$link->name?></url>
										<?endif?>
										<?if(!empty(trim($link->title))):?>
											<title><?=htmlspecialchars($link->title)?></title>
										<?endif?>
										<?if(!empty(trim($link->caption))):?>
											<caption><?=htmlspecialchars($link->caption)?></caption>
										<?endif?>
										<?if(!empty(trim($link->credits))):?>
											<credits><?=htmlspecialchars($link->credits)?></credits>
										<?endif?>
										<?if(!empty(trim($link->copyright))):?>
											<copyright><?=htmlspecialchars($link->copyright)?></copyright>
										<?endif?>
									</external>
								<?endforeach?>
								<?foreach($chapter->zoom_links as $link):?>
									<images>
										<?if(!empty(trim($link->name))):?>
											<url><?=$link->name?></url>
										<?endif?>
										<?if(!empty(trim($link->title))):?>
											<title><?=htmlspecialchars($link->title)?></title>
										<?endif?>
										<?if(!empty(trim($link->caption))):?>
											<caption><?=htmlspecialchars($link->caption)?></caption>
										<?endif?>
										<?if(!empty(trim($link->credits))):?>
											<credits><?=htmlspecialchars($link->credits)?></credits>
										<?endif?>
										<?if(!empty(trim($link->copyright))):?>
											<copyright><?=htmlspecialchars($link->copyright)?></copyright>
										<?endif?>
									</images>
								<?endforeach?>
							</figures>
						<?endif?>
					</chapter>
				<?endforeach?>
			</article>
		<? endforeach ?>
	</publication>
<? endforeach ?>
