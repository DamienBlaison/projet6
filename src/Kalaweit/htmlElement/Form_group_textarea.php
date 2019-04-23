<?php

namespace Kalaweit\htmlElement;

/** $boxcontent = ['<input type="text">input1</input>','<textarea></textarea>'];
*   $box = new \Kalaweit\htmlElement\Box('Box test','box-danger',$boxcontent);
*/
class Form_group_textarea{

    protected $name;

    public function __construct($p_name,$p_value){


        $this->name = $p_name;
        $this->value = $p_value;

    }

    public function render(){

    $form_group_textarea = '';
    $form_group_textarea.= '<div class="input-group col-md-12">';
    $form_group_textarea.=     '<textarea class="mytextarea" name="'.$this->name.'">' . $this->value. '</textarea>';
    $form_group_textarea.= '</div></br>';

    return $form_group_textarea;

    }


}
