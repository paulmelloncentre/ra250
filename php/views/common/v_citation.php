<!-- START: /skins/ra250/php/views/common/v_citation -->
<section>
	<table class="wrapper">
		<tr>
			<td>
				<div class="form locked">
					<form novalidate>
						<fieldset>
							<legend hidden><?= $content === 'citation' ? lang('citation') : lang('doi')?></legend>
							<label for="citation_field">
								<span><?=lang('copy_to_clipboard')?></span>
								<textarea data-autoselect id="citation_field" name="citation" onfocus="this.select();" readonly autofocus><?= ($content === 'citation' ? $article->cite : $article->article_doi . $append )?></textarea>
							</label>
						</fieldset>
					</form>
					<button class="close" type="button" title="<?= esc(lang('close')) ?>"><?= esc(lang('close')) ?></button>
				</div>
			</td>
		</tr>
	</table>
</section>
<!-- END: /skins/ra250/php/views/common/v_citation -->