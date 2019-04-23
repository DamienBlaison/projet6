<?php

namespace Kalaweit\htmlElement;

/** $boxcontent = ['<input type="text">input1</input>','<textarea></textarea>'];
*   $box = new \Kalaweit\htmlElement\Box('Box test','box-danger',$boxcontent);
*/
class Form_group_select{


    protected $fontawesome ;
    protected $name;
    protected $option;
    protected $selected;


    public function __construct($p_name,$p_option,$p_selected,$p_fontawesome,$p_return){

        $this->fontawesome = $p_fontawesome;
        $this->name = $p_name;
        $this->selected = $p_selected;
        $this->option = $p_option;
        $this->return = $p_return;
    }

    public function render(){

        $option = "";
        $select_option="";

        if($this->return == 'config'){

            foreach ($this->option as $key => $value) {

                if ( (is_array($value)) && isset($value["id_espece"])){



                        if($value['id_espece'] == $this->selected){ $selected = 'selected';} else {$selected =' ';};

                        $select_option .= '<option value="'.$value['id_espece'].'"'.$selected.'>'.$value['nom_francais'].' ( '.$value['nom_latin'].' ) '.'</option>';

                }

                else {



                    if($key == $this->selected){ $selected = 'selected';} else {$selected =' ';};

                    $select_option .= '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';

                }

            }
        }

        else

        {

            foreach ($this->option as $key => $value) {

            if($value[$this->name] == $this->selected){ $selected = 'selected';} else {$selected =' ';};

            $select_option .= '<option value="'.$value[$this->name].'"'.$selected.'>'.$value[$this->return].'</option>';

            }
        }

    $form_group_select = '';

    $form_group_select .= '<div class="input-group">';
    $form_group_select .= '<span class="input-group-addon"><i class="'.$this->fontawesome.'"></i></span>';
    $form_group_select .= '<select class="form-control select2 " data-placeholder="" name="'.$this->name.'" style="width: 100%;" tabindex="-1" aria-hidden="true">';

    $form_group_select .= $select_option;

    $form_group_select .= '</select>';
    $form_group_select .=    '</div></br>';

    return $form_group_select;

    }


    /**
     * Get the value of Fontawesome
     *
     * @return mixed
     */
    public function getFontawesome()
    {
        return $this->fontawesome;
    }

    /**
     * Set the value of Fontawesome
     *
     * @param mixed fontawesome
     *
     * @return self
     */
    public function setFontawesome($fontawesome)
    {
        $this->fontawesome = $fontawesome;

        return $this;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Option
     *
     * @return mixed
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * Set the value of Option
     *
     * @param mixed option
     *
     * @return self
     */
    public function setOption($option)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * Get the value of Selected
     *
     * @return mixed
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * Set the value of Selected
     *
     * @param mixed selected
     *
     * @return self
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        return $this;
    }

}
