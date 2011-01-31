<?php
class CalendarHelper extends AppHelper { 
     
    public $helpers = array('Form'); 

    var $_dayList = array( "sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday" );
    
    public function dayCheckboxes($fieldname, $label = 'Repeat on') {
    	$options = array();
    	
    	foreach($this->_dayList as $day) {
    		$options[$day] = ucfirst(substr($day,0,1));
    	}
    	    	
    	return $this->output($this->Form->input($fieldname, array(
    		'multiple' => 'checkbox',
    		'label' => $label,
    		'options' => $options)));
    } 

}
?>