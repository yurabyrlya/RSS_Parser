<?php


namespace App\Helpers;


class Response
{
    /**
     * @param string $view
     * @param array $data
     * @return void
     */
    public static function view(string $view, array $data){
        $viewPath = __DIR__ . '/../Views/'.$view.'.php';
        if (!file_exists($viewPath)) {
            var_dump('View ['. $view .'] not found');
            return;
        }
        // isset template variables
        $title = $data['title'] ?? '';
        $message = $data['message'] ?? '';
        $view = $viewPath;
        $data = $data['data'] ?? [];

        require __DIR__ . '/../Views/layout.php';
    }

    /**
     * @param string $url
     */
    public static function redirect(string $url){
        header("Location: $url");
        die();
    }



}