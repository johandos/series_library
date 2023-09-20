<?php

class StringHelper {
    public static function dateFormat($date) {
        // Generar el HTML del input personalizado
        return date("d-m-Y", strtotime($date));
    }
}