<?php
namespace PHPMaker2020\project1;
?>
<?php if ($areas->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_areasmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($areas->idareas->Visible) { // idareas ?>
		<tr id="r_idareas">
			<td class="<?php echo $areas->TableLeftColumnClass ?>"><?php echo $areas->idareas->caption() ?></td>
			<td <?php echo $areas->idareas->cellAttributes() ?>>
<span id="el_areas_idareas">
<span<?php echo $areas->idareas->viewAttributes() ?>><?php echo $areas->idareas->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($areas->areadescricao->Visible) { // areadescricao ?>
		<tr id="r_areadescricao">
			<td class="<?php echo $areas->TableLeftColumnClass ?>"><?php echo $areas->areadescricao->caption() ?></td>
			<td <?php echo $areas->areadescricao->cellAttributes() ?>>
<span id="el_areas_areadescricao">
<span<?php echo $areas->areadescricao->viewAttributes() ?>><?php echo $areas->areadescricao->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>