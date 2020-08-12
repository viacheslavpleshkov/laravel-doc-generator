<?php

function trim_characters($item_main, $data) {
    foreach ($data as $item_data)
        if($item_main->key == $item_data->document->key){
            return $item_data->user_input;
    }
    return "";
}