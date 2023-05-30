<?php

namespace App\Http\Middleware;

use App\Models\SiteLog;
use App\Models\TrackIp;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DenySpamAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $address = TrackIp::where('remote_addr', $request->getClientIp())->first();

        if ($address && $address->ip_status_id == TrackIp::STATUS_BLOCKED) {
            die(sprintf('Your IP: %s, was blocked', $address->remote_addr));
        }

        if ($address && $address->ip_status_id != TrackIp::STATUS_APPROVED) {
            $count = SiteLog::where('remote_addr', $request->getClientIp())->count();
            if ($count >= 4) {
                $address->ip_status_id = TrackIp::STATUS_BLOCKED;
                $address->save();
            }
        }


        return $next($request);
    }
}
