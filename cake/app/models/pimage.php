<?php
class Pimage extends AppModel {
	var $name = 'Pimage';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Actor' => array(
			'className' => 'Actor',
			'foreignKey' => 'actor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
