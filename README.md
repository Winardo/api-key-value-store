# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

# Version Controlled Key Value Store - API Guideline

This is a guideline for Version Controlled Key Value Store API.

Run `composer update` to update vendors.

## Database

This API is running with MySQL database.

Database configuration can be found in folder config. Copy and paste or rename database.php.bak into database.php.

Sql file can be found in database/KeyValueStore.sql.

## API Request

- Request Token

To run this API, you need to request token based on user. Default username is `admin` with password `admin`.

Method: `POST`

Url: `http://yoururl.com/1.0/auth/get-token`

Request: `{"username": "admin", "password": "admin"}`

- Save Key and Value

API will store key and value into database. Value can be either json / string.

Method: `POST`

Url: `http://yoururl.com/1.0/object`

Headers: `Token => [yourtoken]`

Request: `{"mykey": "value1"} or {"mykey": {"subkey": "value1"}}`

- Get Value

Get value depends on the key. Will return null is such key is not found.

When given timestamp, will return the value of the given timestamp.

Method: `GET`

Url: `http://yoururl.com/1.0/object/[yourkey]?timestamp=[yourtimestamp]`

Headers: `Token => [yourtoken]`

## Edge Cases

1. Key can accept string & Value can accept json / string.
2. Empty String Key or Value will be rejected.
3. Only one key and value can be saved at a time per request.
4. Timestamp must be valid when getting value.
5. Timestamp will be parsed into `yyyy-mm-dd hh:mm AM/PM` DateTime Format. Seconds in the timestamp will be ignored. Example: `1478368751` and `1478368762` will be considered as the same DateTime(2016-11-05 05:59 PM) and will return the same value.