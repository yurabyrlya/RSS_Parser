<?php

namespace App\Helpers;
use App\Controllers\ParseRssController;

class Route
{
    /**
     * @return void
     */
    public static function handle(){
        self::handleController();
    }

    /**
     * @return void
     */
    private static function handleController()
    {
        $request = $_SERVER['REQUEST_URI'];
        $request = explode('?',$request)[0];
        switch ($request) {
            case '':
            case '/' :
                $controller = new ParseRssController();
                $controller->index();
                return;
            case '/rss-feed' :
                $controller = new ParseRssController();
                $controller->rss();
                return;
            default:
                // Page not found
                http_response_code(404);
                Response::view('404', [
                    'title' => 'Page not found',
                    'message' => 'Page not found, please go to home page to play'
                    ]);

        }

    }

}