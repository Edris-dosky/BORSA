<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="assets/images/R.ico">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                background-color: #e7f1ff; /* Light blue color matching currency.gif */
            }
            .login-card {
                background-color: #ffffff; /* White card for contrast */
                border: none;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>

    <body>
        <div class="container vh-100 d-flex align-items-center justify-content-center">

                <!-- Right Side Content -->
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="card login-card p-4 w-100" style="max-width: 400px;">
                        <h2 class="text-center mb-4">{{ __('Login') }}</h2>

                        <!-- Slot for Content -->
                        {{ $slot }}
                    </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
