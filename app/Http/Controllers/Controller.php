<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="Blog Laravel 12 API",
 *         version="1.0.0",
 *         description="Documentation de l'API Blog Laravel 12 avec Swagger",
 *         @OA\Contact(
 *             email="contact@exemple.com"
 *         )
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
