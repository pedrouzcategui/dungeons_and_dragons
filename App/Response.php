<?php

namespace App;

class Response
{

    // Funcion para devolver un JSON.
    public static function json(array $data, int $status = 200, bool $prettyPrint = false)
    {
        //Asigna el estatus de respuesta a ser devuelto, por defecto es 200.
        http_response_code($status);

        // Asigna el tipo de contenido a json.
        header('Content-Type: application/json');

        // La data se cifra a JSON.
        $options = $prettyPrint ? JSON_PRETTY_PRINT : 0;
        echo json_encode($data, $options);

        exit();
    }

    // Funcion para devolver un estado de error.
    public static function error(string $message, int $status = 400, array $context = [], bool $prettyPrint = false)
    {
        $errorResponse = [
            'error' => true,
            'message' => $message,
            'status' => $status,
        ];

        if (!empty($context)) {
            $errorResponse['context'] = $context;
        }

        self::json($errorResponse, $status, $prettyPrint);
    }
}
