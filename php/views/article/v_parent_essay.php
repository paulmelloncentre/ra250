<!-- START: /skins/ra250/php/views/article/v_parent_essay -->
<div id="child-essays" style="display:none">
	<section>
		<div class="wrapper parent">
			<h2><a class="breadcrumbs back" href="<?= create_url($controller, $page->reference, null, !empty($url_params['page']) ? array('page' => $url_params['page']) : null) ?>" title="<?= esc($page->name) ?>">Issue 3 - British Sculpture Abroad</a></h2>
			<?foreach($content->parent_essay as $essay):?>
				<h1><a href="<?=create_url($controller, $page->reference, $essay->reference, null, null)?>"><?=$essay->name?></a></h1>
			<?endforeach?>
			<ul>
			<?foreach($content->sibling_essays as $essay):?>
				<li class="<?if($essay->id == $content->id):?>active<?endif?>">
					<a href="<?=create_url($controller, $page->reference, $essay->reference, null, null)?>"><?=$essay->name?></a>
					<br>
				</li>
			<?endforeach?>
			</ul>
		</div>
		<button class="close" type="button" title="Close">Close</button>
	</section>
</div>

<!-- END: /skins/ra250/php/views/article/v_parent_essay -->