<div class="schools form">
<?php echo $this->Form->create('School');?>
	<fieldset>
		<legend><?php __('Edit School'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('long');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
		echo $this->Form->input('mascot_name');
		//echo $this->Form->input('mascot_image');
		echo $this->element('admin/choose_image',
			array(
				'title'=>'Mascot Image',
				'dir'=>WWW_ROOT . Configure::read('config.image.school.mascot'),//'img' . DS . 'products' . DS,
				'model'=>'School',
				'field'=>'mascot_small'
			)
		);
		//echo $this->Form->input('logo_small');
		echo $this->element('admin/choose_image',
			array(
				'title'=>'Logo Small Image',
				'dir'=>WWW_ROOT . Configure::read('config.image.school.small'),//'img' . DS . 'products' . DS,
				'model'=>'School',
				'field'=>'logo_small'
			)
		);
		//echo $this->Form->input('logo_large');
		echo $this->element('admin/choose_image',
			array(
				'title'=>'Logo Large Image',
				'dir'=>WWW_ROOT . Configure::read('config.image.school.large'),//'img' . DS . 'products' . DS,
				'model'=>'School',
				'field'=>'logo_large'
			)
		);
		
		echo $this->element('admin/directory_list',
			array(
				'title'=>'Shop Background Image',
				'dir'  =>WWW_ROOT . Configure::read('config.image.school.background'),
				'model'=>'School',
				'field'=>'background'
			)
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('School.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('School.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Schools', true), array('action' => 'index'));?></li>
	</ul>
</div>