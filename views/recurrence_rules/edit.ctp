<div class="recurrenceRules form">
<?php echo $this->Form->create('RecurrenceRule');?>
	<fieldset>
 		<legend><?php __('Edit Recurrence Rule'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('event_id');
		echo $this->Form->input('bydaydays');
		echo $this->Form->input('frequency');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('RecurrenceRule.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('RecurrenceRule.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Recurrence Rules', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Events', true), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event', true), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>