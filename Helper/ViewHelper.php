<?php

class ViewHelper {

    public static function input($id, $type = 'text', $placeholder = '', $value = null) {
        // Generar el HTML del input personalizado
        return "<input class='form-control' value='$value' type='$type' id='$id' name='$id' placeholder='$placeholder' />";
    }
}