<?php

namespace App\Exceptions;

use Exception;

class Handler extends Exception
{
    //
    public function register()
    {
        $this->renderable(function (\Illuminate\Auth\AuthenticationException $e) {
            return response()->view('errors.401', [], 401);
        });
    
        $this->renderable(function (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        });
    
        $this->reportable(function (\Exception $e) {
            if ($this->shouldReport($e)) {
                \Log::error($e->getMessage(), [
                    'exception' => $e,
                    'url' => request()->fullUrl(),
                    'input' => request()->except('password')
                ]);
            }
        });

        
        $this->renderable(function (ModelNotFoundException $e) {
            return response()->view('errors.404', [], 404);
        });
    
        $this->renderable(function (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        });
        
        $this->reportable(function (PaymentFailedException $e) {
            \Log::channel('payments')->error($e->getMessage());
        });
    }


    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => class_basename($e),
                'message' => $e->getMessage(),
            ], $this->getStatusCode($e));
        }
    
        if ($e instanceof ModelNotFoundException) {
            return response()->view('errors.404', [], 404);
        }
    
        return parent::render($request, $e);
    }
    
    protected function getStatusCode(Throwable $e)
    {
        if (method_exists($e, 'getStatusCode')) {
            return $e->getStatusCode();
        }
    
        return $e instanceof HttpException ? $e->getStatusCode() : 500;
    }
}
