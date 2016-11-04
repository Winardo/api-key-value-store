<?php 

if (! function_exists('responseJSON')) {
    /**
     * Formatting Response Standard Json for App
     *
     * @param  numeric $code
     * @param  array   $data
     * @param  string  $message
     */
    function responseJSON($code, $data = null, $message = null)
    {
        $response = [
            'status'    => in_array($code, [200, 201, 204]),
            'code'      => (int) $code,
            'data'      => empty($data) ? null : $data,
            'message'   => empty($message) ? null : $message,
            'language' => __LANGUAGE__,
        ];

        return $response;
    }
}

if (! function_exists('uriSegment')) {
    /**
     * Get uri segment from specific path url
     *
     * @param  numeric $segment     
     */
    function uriSegment($segment = '')
    {
        $request_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $explode = explode('/', str_replace('index.php/', '', $request_uri));

        if(empty($segment)) return '';

        if(!empty($explode[($segment-1)]))
            return $explode[($segment-1)];
        else 
            return '';
    }
}