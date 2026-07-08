<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuth extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        $user = $request->user();
        if ($user && !in_array($user->role, ['admin', 'staff'])) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Akses ditolak. Anda bukan admin/staff.'], 403);
            }
            abort(403, 'Akses ditolak. Anda bukan admin/staff.');
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin.login.form');
        }
    }
}