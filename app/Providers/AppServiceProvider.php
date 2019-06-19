<?php

namespace DeskFlix\Providers;

use DeskFlix\Exceptions\SubscriptionInvalidException;
use DeskFlix\Models\Video;
use Dingo\Api\Exception\Handler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Video::updated(function ($video){
           if(!$video->completed) {
               if ($video->file != null && $video->thumb != null && $video->duration != null) {
                   $video->completed = 1;
                   $video->save();
               }
           }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->bind(
            'bootstrapper::form',
            function ($app) {
                $form = new Form(
                    $app->make('collective::html'),
                    $app->make('url'),
                    $app->make('view'),
                    $app['session.store']->Token()
                );

                return $form->setSessionStore($app['session.store']);
            },
            true
        );

        $handler = app(Handler::class);
        $handler->register(function (AuthenticationException $exception){
           return response()->json(['error' => 'Falha na Autenticação'], 401);
        });
        $handler->register(function (JWTException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 401);
        });
        $handler->register(function (ValidationException $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
                'validation_errors' => $exception->validator->getMessageBag()->toArray()
            ], 422);
        });
        $handler->register(function (SubscriptionInvalidException $exception) {
            return response()->json([
                'error' => 'subscription_valid_not_found',
                'message' => $exception->getMessage()
            ], 403);
        });
    }
}
