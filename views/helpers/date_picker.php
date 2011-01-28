<?php  

class DatePickerHelper extends FormHelper { 
    
    var $helpers = array('Html','Javascript');  
    var $format = '%Y-%m-%d'; 
    
    function _setup(){ 
        $format = Configure::read('DatePicker.format'); 
        if($format != null){ 
            $this->format = $format; 
        } 
    } 

    function picker($fieldName, $options = array()) { 
        $this->_setup(); 
        $this->setEntity($fieldName); 
        $htmlAttributes = $this->domId($options);
        $divOptions['class'] = 'date'; 
        $options['type'] = 'date'; 
        $options['div']['class'] = 'date'; 
        $options['dateFormat'] = 'YMD'; 
        $options['minYear'] = isset($options['minYear']) ? $options['minYear'] : (date('Y') - 20); 
        $options['maxYear'] = isset($options['maxYear']) ? $options['maxYear'] : (date('Y') + 20); 

        $options['after'] = $this->Html->image('/calendar/img/datepicker/calendar.png', array('id'=> $htmlAttributes['id'],'style'=>'cursor:pointer')); 


    if (isset($options['empty'])) { 
        $options['after'] .= $this->Html->image('/calendar/img/datepicker/b_drop.png', array('id'=> $htmlAttributes['id']."_drop",'style'=>'cursor:pointer')); 
    } 
        $output = $this->input($fieldName, $options); 
        $output .= $this->Javascript->codeBlock("datepick('" . $htmlAttributes['id'] . "','01/01/" . $options['minYear'] . "','31/12/" . $options['maxYear'] . "');");
        return $output; 
    } 
    
} 

?>