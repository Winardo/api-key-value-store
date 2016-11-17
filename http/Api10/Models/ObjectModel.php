<?php 

namespace Api10\Models;

use App\Http\Models\BaseModel;
use App\Http\Models\Mysql\KeyValue;

class ObjectModel extends BaseModel
{

	public static function findValueByKey($key, $timestamp = '')
	{
		$key = rawurldecode(trim($key));
		$keyValue = KeyValue::where('key', $key);

		if(!empty($timestamp))
		{
			$datetime = date('Y-m-d H:i:s', $timestamp);
			$keyValue = $keyValue->where('createdAt',  $datetime);
		}	

		$keyValue = $keyValue->orderBy('createdAt', 'DESC')->orderBy('keyValueId', 'DESC')->first();

		if(!empty($keyValue))
		{
			$keyValue->datetime = date('Y-m-d h:i:s A', strtotime($keyValue->createdAt));
			$keyValue->timestamp = strtotime($keyValue->createdAt);
			$keyValue->value = !empty(json_decode($keyValue->value, true)) ? json_decode($keyValue->value, true) : $keyValue->value;

			return responseJSON(200, $keyValue->toArray(), 'Get value by key successful.');
		}	
		else
		{
			return responseJSON(404, null, 'Value not found.');
		}
	}

	public static function saveKeyValue($keyValueArray)
	{
		if(empty($keyValueArray))
			return responseJSON(500, null, 'Failed to save data. Data is empty.');

		foreach($keyValueArray as $key => $value)
		{
			$datetime = date('Y-m-d H:i:s');
			$key = trim($key);
			$value = is_array($value)? json_encode($value) : trim($value);

			$model = new KeyValue();
			$model->key = $key;
			$model->value = $value;
			$model->createdAt = $datetime;
			if($model->save())
			{
				$data = [
					'key' => $key,
					'value' => $value,
					'datetime' => date('Y-m-d h:i:s A', strtotime($datetime)),
					'timestamp' => strtotime($datetime)
				];
				return responseJSON(200, $data, 'Data saved successfully.');
			}
			else
			{
				return responseJSON(500, null, 'Something went wrong when saving data.');
			}
		}
	}

}