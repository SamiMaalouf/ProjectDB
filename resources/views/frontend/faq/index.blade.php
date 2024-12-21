<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-wrapper {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container my-5">
            <h1 class="text-center mb-4">Frequently Asked Questions</h1>

            <div class="accordion" id="faqAccordion">
                @foreach($categories as $category)
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="mb-0">{{ $category->category }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordion{{ $category->id }}">
                                @foreach($category->faqQuestions as $question)
                                    <div class="card mb-2">
                                        <div class="card-header" id="heading{{ $question->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link text-dark text-decoration-none w-100 text-left" 
                                                        type="button" 
                                                        data-toggle="collapse" 
                                                        data-target="#collapse{{ $question->id }}" 
                                                        aria-expanded="false" 
                                                        aria-controls="collapse{{ $question->id }}">
                                                    {{ $question->question }}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse{{ $question->id }}" 
                                             class="collapse" 
                                             aria-labelledby="heading{{ $question->id }}" 
                                             data-parent="#accordion{{ $category->id }}">
                                            <div class="card-body">
                                                {{ $question->answer }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
