<?php

namespace App\Http;

use App\Http\Middleware\CheckAGCAndPI;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsEncrypted;
use App\Http\Middleware\IsHanpass;
use App\Http\Middleware\SignatureForCancel;
use App\Http\Middleware\SignatureForCheckTransaction;
use App\Http\Middleware\SignatureForCommit;
use App\Http\Middleware\SignatureForGetEnums;
use App\Http\Middleware\SignatureForModify;
use App\Http\Middleware\SignatureForRate;
use App\Http\Middleware\SignatureForStoreTransaction;
use App\Http\Middleware\SignatureForUpdatePw;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'isAdmin' => IsAdmin::class,
        'isHanpass' => IsHanpass::class,
        'isEncrypted' => IsEncrypted::class,
        'signatureForRate' => SignatureForRate::class,
        'signatureForGetEnums' => SignatureForGetEnums::class,
        'signatureForStoreTransaction' => SignatureForStoreTransaction::class,
        'signatureForCommit' => SignatureForCommit::class,
        'signatureForModify' => SignatureForModify::class,
        'signatureForCancel' => SignatureForCancel::class,
        'signatureForCheckTransaction' => SignatureForCheckTransaction::class,
        'signatureForUpdatePw' => SignatureForUpdatePw::class,
        'checkAGCAndPI' => CheckAGCAndPI::class
    ];
}
