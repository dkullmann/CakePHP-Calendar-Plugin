<div class="recurrenceRules index">
	<h2><?php __('Recurrence Rules');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('event_id');?></th>
			<th><?php echo $this->Paginator->sort('bydaydays');?></th>
			<th><?php echo $this->Paginator->sort('frequency');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($recurrenceRules as $recurrenceRule):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $recurrenceRule['RecurrenceRule']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($recurrenceRule['Event']['id'], array('controller' => 'events', 'action' => 'view', $recurrenceRule['Event']['id'])); ?>
		</td>
		<td><?php echo $recurrenceRule['RecurrenceRule']['bydaydays']; ?>&nbsp;</td>
		<td><?php echo $recurrenceRule['RecurrenceRule']['frequency']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $recurrenceRule['RecurrenceRule']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $recurrenceRule['RecurrenceRule']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $recurrenceRule['RecurrenceRule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $recurrenceRule['RecurrenceRule']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Recurrence Rule', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Events', true), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event', true), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>