<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAGCAndPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->agentCode && $request->processIdentifier) {

            $currentUserAgentCode = auth('api')->user()->agentCode;
            $currentUserProcessIdentifier = auth('api')->user()->processIdentifier;

            if ($currentUserAgentCode == $request->agentCode && $currentUserProcessIdentifier == $request->processIdentifier) {
                return $next($request);
            } else {
                return response()->json([
                    "code" => "109",
                    "message" => "AgentCode or ProcessIdentifier are something wrong!"
                ]);
            }
        } else {
            return response()->json([
                "code" => "110",
                "message" => "AgentCode or ProcessIdentifier are invalid!"
            ]);
        }
    }
}
