<?php
namespace App\Validations;

class Validations{
    // Method to return the failure or success of a petition
    public static function responseGen($success, $type, $data, $status_code){
        $messages = [
            200 => "Exito en ",
            400 => "Datos inválidos en ",
            401 => "No autorizado: ",
            500 => "Error en "
        ];
        $new_message = $messages[$status_code].$type;
        $res = [
            "success" => $success,
            "message" => $new_message,
            "data" => $data
        ];
        return response()->json($res, $status_code);
    }
}
?>