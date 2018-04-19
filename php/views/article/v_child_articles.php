<!-- START: /skins/ra250/php/views/article/v_child_essays -->
<div id="child-essays" style="display:none">
	<section>
		<div class="wrapper parent">
			<h2><a class="breadcrumbs back" href="<?= create_url($controller, $page->reference, null, !empty($url_params['page']) ? array('page' => $url_params['page']) : null) ?>" title="<?= esc($page->name) ?>">Contents</a></h2>
			<h1 class="active"><?=$content->title?></h1>
			<ul>
			<?foreach($content->child_essays as $child):?>
				<li>
					<a href="<?=create_url($controller, $page->reference, $child->reference, null, null)?>"><?=$child->name?></a>
					<br>
				</li>
			<?endforeach?>
			</ul>
		</div>
		<button class="close" type="button" title="Close">Close</button>
	</section>
</div>
<!-- END: /skins/ra250/php/views/article/v_child_essays -->