<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloWorldController extends Controller
{
    public function show(){
        return <<<HTML
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Hello World</title>
        <style>
            body {
                background-color: #0a1a2f; /* ciemny granat */
                color: #ccc; /* szary tekst */
                font-size: 48px; /* duży tekst */
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                font-family: Arial, sans-serif;
            }
        </style>
    </head>
    <body>
        Hello World!
    </body>
    </html>
    HTML;
        //return "Hello World!";
    }
}