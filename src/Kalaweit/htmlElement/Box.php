<?php

namespace Kalaweit\htmlElement;

/** $boxcontent = ['<input type="text">input1</input>','<textarea></textarea>'];
*   $box = new \Kalaweit\htmlElement\Box('Box test','box-danger',$boxcontent);
*/

class Box
{

    protected $box_title;
    protected $box_statut;
    protected $box_content;


    public function __construct($p_box_title,$p_box_statut,$p_box_content,$col_md){

        $this->box_title = $p_box_title;
        $this->box_statut = $p_box_statut;
        $this->box_content = $p_box_content;
        $this->col_md = $col_md;

    }

    function render(){

        $box            = '';
        $box_content    = '';

        foreach ($this->box_content as $key => $value) {

            $bootstrap = $this->col_md;

            if(isset($bootstrap[0])){

                $class = $bootstrap[$key];
            }

            else

            {
                $class = '' ;
            };

            $box_content.= '<div class="col-md-'.$class.'">'.$value.'</div>';
        }

        $box.='    <div class="box '.$this->box_statut.'">';
        $box.='         <div class="box-header with-border">';
        $box.='             <h3 class="box-title">'.$this->box_title.'</h3>';
        //$box.='         <div class="pull-right box-tools">';
        //$box.='             <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>';
        //$box.='         </div>';
        $box.='         </div><!-- /.box-header -->';

        $box.='         <div class="box-body">';
        $box.='             <div>';
        $box.=                  $box_content;
        $box.='             </div>';
        $box.='         </div><!-- /.box-body -->';
        $box.='    </div>';

        return $box;
    }


    /**
     * Get the value of Box Title
     *
     * @return mixed
     */
    public function getBoxTitle()
    {
        return $this->box_title;
    }

    /**
     * Set the value of Box Title
     *
     * @param mixed box_title
     *
     * @return self
     */
    public function setBoxTitle($box_title)
    {
        $this->box_title = $box_title;

        return $this;
    }


    /**
     * Get the value of Box Statut
     *
     * @return mixed
     */
    public function getBoxStatut()
    {
        return $this->box_statut;
    }

    /**
     * Set the value of Box Statut
     *
     * @param mixed box_statut
     *
     * @return self
     */
    public function setBoxStatut($box_statut)
    {
        $this->box_statut = $box_statut;

        return $this;
    }

    /**
     * Get the value of Box Content
     *
     * @return mixed
     */
    public function getBoxContent()
    {
        return $this->box_content;
    }

    /**
     * Set the value of Box Content
     *
     * @param mixed box_content
     *
     * @return self
     */
    public function setBoxContent($box_content)
    {
        $this->box_content = $box_content;

        return $this;
    }

}
