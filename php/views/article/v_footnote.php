<!-- START: /skins/ra250/php/views/article/v_footnote -->
<section>
	<div class="context">
		<div class="heading">
			<h2><?= lang('footnotes') ?></h2>
		</div>
		<div class="listing">
			<ol>
				<? foreach ($footnotes as $key => $footnote): ?>
					<li id="footnote-<?= ($key+1) ?>">
						<p><?= $footnote ?></p>
						<a href="#superscript-<?= ($key+1) ?>" data-anchor class="ref-link" title="back-to-reference"><?= ($key+1) ?></a>
					</li>	
				<? endforeach ?>
			</ol>
		</div>
	</div>
</section>
<!-- END: /skins/ra250/php/views/article/v_footnote -->