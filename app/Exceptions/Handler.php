<?php

namespace App\Exceptions;

use App\Models\TrackIp;
use Carbon\Carbon;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->stopIgnoring(NotFoundHttpException::class);

        $this->renderable(function (NotFoundHttpException $e, Request $req) {

            Log::channel('site')->warning(sprintf(
                'Message: %s; URL: %s',
                $e->getMessage(),
                $req->getRequestUri()
            ));

            $ip = $req->getClientIp();
            $address = TrackIp::firstOrCreate(
                ['remote_addr' => $ip],
                ['ip_status_id' => TrackIp::STATUS_WORKING, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            );

            return response()->view('errors.route', [
                'ip' => $ip,
                'status' => $address->statusname->name,
                'message' => $e->getMessage(),
            ]);
        });


        $this->reportable(function (Throwable $e) {
//            d($e->getCode(), $e->getMessage());die;
//            return false;
        });
    }

    // PROTECTED

    /**
     * Get the default context variables for logging.
     *
     * @return array<string, mixed>
     */
    protected function context(): array
    {
        $req = request();
        return array_merge(parent::context(), [
            'ip' => $req->ip(),
            'clientip' => $req->getClientIp(),
        ]);
    }
}
