<div class="recurrenceRules view">
<h2><?php  __('Recurrence Rule');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $recurrenceRule['RecurrenceRule']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Event'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($recurrenceRule['Event']['id'], array('controller' => 'events', 'action' => 'view', $recurrenceRule['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bydaydays'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $recurrenceRule['RecurrenceRule']['bydaydays']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Frequency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $recurrenceRule['RecurrenceRule']['frequency']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Recurrence Rule', true), array('action' => 'edit', $recurrenceRule['RecurrenceRule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Recurrence Rule', true), array('action' => 'delete', $recurrenceRule['RecurrenceRule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $recurrenceRule['RecurrenceRule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Recurrence Rules', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recurrence Rule', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events', true), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event', true), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
