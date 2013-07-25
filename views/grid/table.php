<?php
if (Kohana::$profiling === TRUE) {
    $benchmark = Profiler::start('grid','render');
}
if ($form) echo $form;
?>
<div class="btn-toolbar"><?php
foreach($links as $link) {
	$div_class = '';
	if ($link->pull) $div_class="pull-{$link->pull}";
    echo "<div class='btn-group $div_class'>$link</div>";
}
foreach($header as $head) {
	$div_class = '';
	if ($head->pull) $div_class="pull-{$head->pull}";
    echo "<div class='btn-group $div_class'>$head</div>";
}
?>
</div>
<table <?php echo $attrs;?>>
	<thead>
		<tr>
<?php
foreach($columns as $column) {
	$title = $column->render_th();
    echo "<th>$title</th>";
}?>
		</tr>
	</thead>
	<tbody>
<?php
foreach($dataset as $data) {
	$row_attr = '';
	if (is_callable($row_attr_callback)){
		$row_attr = $row_attr_callback((object) $data);
	}
    echo "    <tr $row_attr>";
    foreach($columns as $column) {
        echo '        <td>',$column->render($data),'</td>';
    }
    echo '    </tr>';
}
echo '</tbody>';

echo '</table>';
if ($form) echo '</form>';
if (!empty($pagination)){
	echo $pagination->render();
}


if (isset($benchmark)) {
    Profiler::stop($benchmark);
}
