<div class="calendars form">
<?php echo $this->Form->create('Calendar');?>
	<fieldset>
 		<legend><?php __('Edit Calendar'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('notes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Calendar.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Calendar.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Calendars', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Events', true), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event', true), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>