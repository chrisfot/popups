<?php

namespace App;

class ApiResponse
{

    /**
     * ApiResponse constructor.
     * Made private to prevent object initialization.
     */
    private function __construct()
    {
    }

    /**
     * Returns a structured response according to the API specifications.
     *
     * @param bool $success
     * @param array $result
     * @return array
     */
    private static function response(bool $success, array $result) : array
    {
        return [
            'success' => $success,
            'result' => $result,
        ];
    }

    /**
     * Returns a successful response with the given data.
     *
     * @param array $result
     * @return array
     */
    public static function success(array $result = []) : array
    {
        return self::response(true, $result);
    }

    /**
     * Returns a failed response with the given data.
     *
     * @param array $result
     * @return array
     */
    public static function fail(array $result = []) : array
    {
        return self::response(false, $result);
    }

}
