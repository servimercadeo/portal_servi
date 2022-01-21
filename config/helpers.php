<?php

if (!function_exists('makeFillters')) {
    function makeFillters($filters){
        $fill = [];
        
        foreach ($filters as $key => $value) {
            if(!empty($value)){
                $fill[] = [$key, 'like' , '%'.$value.'%'];
            }
        }
        
        return $fill;
    }
}
