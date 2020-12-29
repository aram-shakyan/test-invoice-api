<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data) {
            return new JsonResponse([
                'success' => true,
                'data' => $data,
            ]);
        });

        Response::macro('successMessage', function ($message) {
            return new JsonResponse([
                'success' => true,
                'message' => $message
            ]);
        });

        Response::macro('error', function ($message, $status = 400) {
            return new JsonResponse([
                'success' => false,
                'message' => $message,
            ], $status);
        });


        Response::macro('unauthenticated', function () {
            return new JsonResponse([
                'success' => false,
                'message' => "You are not authorized to do this action.",
            ], 403);
        });

        Response::macro('errorValidation', function ($data, $status = 422) {
            return new JsonResponse([
                'success' => false,
                'errors' => $data,
            ], $status);
        });
    }
}


