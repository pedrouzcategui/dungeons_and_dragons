<?php

namespace App;

class Response
{
    /**
     * Send a JSON response
     *
     * @param array $data The data to send as JSON
     * @param int $status The HTTP status code (default: 200)
     * @param bool $prettyPrint Whether to format the JSON for readability (default: false)
     */
    public static function json(array $data, int $status = 200, bool $prettyPrint = false)
    {
        // Set the HTTP status code
        http_response_code($status);

        // Set the Content-Type header
        header('Content-Type: application/json');

        // Encode the data to JSON
        $options = $prettyPrint ? JSON_PRETTY_PRINT : 0;
        echo json_encode($data, $options);

        // End script execution
        exit();
    }

    /**
     * Send a JSON error response
     *
     * @param string $message The error message
     * @param int $status The HTTP status code (default: 400)
     * @param array $context Additional context for the error (default: [])
     * @param bool $prettyPrint Whether to format the JSON for readability (default: false)
     */
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
