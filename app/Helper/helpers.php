<?php

/** Set Sidebar item active */

function setActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

//limit text

function limitText($text, $limit=20){
    return \Str::limit($text, $limit);
}