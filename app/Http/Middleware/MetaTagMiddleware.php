<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin\PageSeo;

class MetaTagMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $metaTag = PageSeo::where('url', $request->path() != '/' ? '/' . $request->path() : $request->path())->first();
        if ($metaTag) {
            $metaTag = json_decode($metaTag->metaTags, true);

            seo()->title($metaTag['title']);

            if ($metaTag['description']) {
                seo()->description($metaTag['description']);
            }

            if ($metaTag['image']) {
                seo()->image($metaTag['image']);
            }
        }

        return $next($request);
    }
}
