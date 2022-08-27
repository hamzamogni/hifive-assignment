<?php

namespace App\Exceptions;

use Exception;

class UserAlreadyExistsException extends Exception
{
    public function render($request)
    {
        return response(
            [
                "message" => "Email already exists"
            ],
            400
        );
    }
}
