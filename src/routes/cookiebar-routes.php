<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;



/**
 * Route for serving JavaScript files.
 *
 * @param string $file The name of the JavaScript file to be served.
 * @return \Illuminate\Http\Response The response containing the JavaScript file content.
 */
Route::get('js/{file}', function ($file) {
    $path = __DIR__.'/../assets/js/'.$file;

    if (file_exists($path)) {
        $response = new Response(
            file_get_contents($path),
            200,
            [
                'Content-Type' => 'text/javascript',
            ]
        );
        return cacheResponse($response);
    } else {
        abort(404);
    }
});


/**
 * Route for serving CSS files.
 *
 * @param string $file The name of the CSS file to be served.
 * @return \Illuminate\Http\Response The response containing the CSS file content.
 */
Route::get('css/{file}', function ($file) {
    $path = __DIR__.'/../assets/css/'.$file;

    if (file_exists($path)) {
        $response = new Response(
            file_get_contents($path),
            200,
            [
                'Content-Type' => 'text/css',
            ]
        );
        return cacheResponse($response);
    } else {
        abort(404);
    }
});

/**
 * Route for serving font files.
 *
 * This route handles requests for font files located in the '/css/fonts' directory.
 * It checks if the requested file exists, and if so, it returns the file contents with the appropriate content type.
 * If the file does not exist, it returns a 404 error.
 *
 * @param string $file The name of the font file to be served.
 * @return \Illuminate\Http\Response The response containing the font file contents and appropriate headers.
 */
Route::get('css/fonts/{file}', function ($file) {
    $path = __DIR__.'/../assets/css/fonts/'.$file;

    $extension = pathinfo(public_path($path), PATHINFO_EXTENSION);

    $contentTypeMap = [
        'woff2' => 'font/woff2',
        'woff' => 'application/font-woff',
        'eot' => 'application/vnd.ms-fontobject',
        'ttf' => 'font/ttf',
    ];

    if (file_exists($path)) {
        $response = new Response(
            file_get_contents($path),
            200,
            [
                'Content-Type' => $contentTypeMap[$extension],
            ]
        );
        return cacheResponse($response);
    } else {
        abort(404);
    }
});

/**
 * Caches the response by setting the shared max age, max age, and expires headers.
 *
 * @param Response $response The response object to cache.
 * @return Response The cached response.
 */
function cacheResponse(Response $response)
{
    $response->setSharedMaxAge(31536000);
    $response->setMaxAge(31536000);
    $response->setExpires(new \DateTime('+1 year'));

    return $response;
}

