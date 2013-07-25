<div class="pagination pull-right">
	<ul>
		<?php if ($page > 1){?><li><a href="<?php echo $link();?>">‹‹</a></li><?php }?>
		<?php foreach($range as $value){?>
			<li><a <?php if ($page == $value){ ?>class="active"<?php }?> href="<?php echo $link($value); ?>"><?php echo $value;?></a></li>
		<?php }?>
		<?php if ($page < $last){?><li><a href="<?php echo $link($last);?>">››</a></li><?php }?>
	</ul>
</div>