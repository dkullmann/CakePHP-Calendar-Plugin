<?php
class CalendarHelper extends AppHelper { 
    
/**
 * Helpers
 *
 * @var array
 */ 
    public $helpers = array('Form'); 

/**
 * Day list - days of the week
 *
 * @var array
 */
    private $_dayList = array( "sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday" );
   
/**
 * Frequency list - frequency choices
 *
 * @var array
 */
    private $_frequencyList = array( "daily", "weekly", "monthly", "yearly" );
 
/**
 * dayCheckboxes creates a group of checkboxes for each day of the week.
 *
 * @param string $fieldname The name of the form element to use with FormHelper
 * @param string $label The text label for this form field
 * @return string Output of rendered form element
 */  
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
    
/**
 * frequencySelect creates drop down of frequency options.
 *
 * @param string $fieldname The name of the form element to use with FormHelper
 * @param string $label The text label for this form field
 * @return string Output of rendered form element
 */     
    public function frequencySelect($fieldname, $label = 'Repeats') {
		$options = array ();
		
		foreach($this->_frequencyList as $frequency) {
			$options[$frequency] = ucfirst($frequency);
		}

    	return $this->output($this->Form->input($fieldname, array(
    		'type' => 'select',
    		'options' => $options,
    	)));
    }

}
?>