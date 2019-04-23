<?php

namespace Kalaweit\Transverse;
/**
 *
 */
class Set_object_from_request

{

    function set($array){

        foreach ($array as $key => $value) {

            $this->p_set($key,$value);

        };

    }

    function p_set($key,$value){

        return $this->$key = $value ;
    }

}
