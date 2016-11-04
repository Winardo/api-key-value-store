<?php

namespace Api10\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Api10\Models\ObjectModel;

class ObjectController extends BaseController
{

    /**
     * Get Value from key
     *
     * @param string key
     * @param Request $request
     */
    public function getValue($key, Request $request)
    {
        // Validate timestamp if exist
        $timestamp = trim($request->input('timestamp'));
        if(!empty($timestamp) && (string) (int) $timestamp !== (string) $timestamp)
            return responseJSON(400, null, 'Invalid request. Timestamp must be a valid unix timestamp.');

        // Find value from requested key
        return ObjectModel::findValueByKey($key, $timestamp);
    }

    /**
     * Save Key Value
     *
     * @param Request $request
     */
    public function saveValue(Request $request)
    {
        // Check Json request valid or not
        $jsonParse = json_decode($request->getContent(), true);
        if(!$jsonParse)
            return responseJSON(400, null, 'Invalid Json request.');

        // Check if requested key/value is more than one
        if(count($jsonParse) > 1)
            return responseJSON(400, null, 'Too many requests. Can only store one key and value at a time.');

        // Check if key or value is empty
        foreach($jsonParse as $key => $value)
        {
            if(empty(trim($key)))
                return responseJSON(400, null, 'Invalid Json request. Key cannot be empty.');

            if(!is_array($value)) $value = trim($value);
            if(empty($value))
                return responseJSON(400, null, 'Invalid Json request. Value cannot be empty.');
        }

        // Save Key and Value
        return ObjectModel::saveKeyValue($jsonParse);
    }

}
