<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Exception;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
//         \Illuminate\Auth\AuthenticationException::class,
//         \Illuminate\Auth\Access\AuthorizationException::class,
//         \Symfony\Component\HttpKernel\Exception\HttpException::class,
//         \Illuminate\Database\Eloquent\ModelNotFoundException::class,
//         \Illuminate\Session\TokenMismatchException::class,
//         \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof ValidationException)            
            return $this->convertValidationExceptionToResponse($exception, $request) ;
        
        return parent::render($request, $exception);
    }
    
    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        
<<<<<<< HEAD
        if($request->email)
=======
        if($request->miEmail)
>>>>>>> origin/master
            return redirect()->back()
                    ->withInput($request->input())->withErrors($errors);
        
       return response()->json($errors,422);        
        
    }    
  
}
