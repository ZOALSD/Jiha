<?php
namespace App\Http\Middleware;

use Closure;

class ApiLang {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null) {
		
		app()->setlocale(request('lang'));
		// if (request()->has('lang') && in_array(request('lang'), ['en'])) { //['ar', 'en']
		// } else {
		// 	app()->setlocale('ar');
		// }

		return $next($request);

	}
}
