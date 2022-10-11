<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>
        <div id="app">           
            <div class="container pt-4">
                <div class="row justify-center w-100">
                    <div class="col-md-3">
                        <form method="POST" action="{{ route('randomize.store') }}">
                            @csrf
                            <div class="form-group py-4">
                                <label>
                                    Generate 
                                    <br>
                                    15 characters random values and 
                                    <br>
                                    5 characters breakdown value
                                </label>
                                <button type="submit"
                                    class="btn btn-primary">
                                    Generate
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9 d-flex">
                        <div class="table-responsive text-gray-500">
                            <table class="table">
                                <thead>
                                    <th>
                                        Random Value
                                    </th>
                                    <th>
                                        Breakdown Value
                                    </th>
                                </thead>
                                <tbody>
                                    @php
                                        $text = '';
                                    @endphp

                                    @forelse($randoms as $random)
                                        @forelse ($random->breakdown as $breakdown)
                                            @php
                                                $text .= $breakdown->values.' ';
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $random->values }}    
                                                </td>
                                                <td>
                                                    {{ $breakdown->values }}    
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td>
                                                {{ $random->values }}    
                                            </td>
                                            <td></td>
                                        </tr>
                                        @endforelse
                                    @empty
                                        <tr>
                                            <td colspan="2"
                                                class="text-center">
                                                {{ __('No Data') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                @isset($randoms)
                                    {{ $randoms->links() }}
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 
                    the 'spread', 'gap' and 'text-font-size'
                    will determine the readability of the spiral 
                    text generated
                    --}}

                <div class="row py-4">
                    <div class="col-md-6">
                        <spiral-component 
                            id="canvasA"
                            :canvas-height="600"
                            :canvas-width="600"
                            text="{{ Str::reverse($text) }}" 
                            :spread="65"
                            :gap="4" 
                            text-font-size="18"
                            :char-rotation="0.25" />
                        }
                    </div>

                    <div class="col-md-6">
                        <spiral-component 
                            id="canvasB"
                            :canvas-height="600"
                            :canvas-width="600"
                            text="{{ $text }}" 
                            :spread="65"
                            :gap="4"
                            text-font-size="18"
                            :char-rotation="-0.25" />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
