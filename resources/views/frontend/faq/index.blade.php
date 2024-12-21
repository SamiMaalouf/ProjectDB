<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-wrapper {
            flex: 1 0 auto;
            padding: 40px 0;
        }
        footer {
            flex-shrink: 0;
        }
        .faq-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 15px;
        }
        .faq-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: #007bff;
        }
        .category-card {
            margin-bottom: 2rem;
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .category-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            padding: 15px 20px;
            border: none;
        }
        .category-title {
            font-size: 1.5rem;
            margin: 0;
            color: white;
        }
        .question-card {
            border: none !important;
            background: transparent;
        }
        .question-header {
            background-color: white;
            border: none;
            padding: 0;
        }
        .question-button {
            padding: 15px;
            font-size: 1.1rem;
            background-color: white;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .question-button:hover {
            background-color: #f8f9fa;
            text-decoration: none;
        }
        .question-button:focus {
            box-shadow: none;
        }
        .question-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .answer-text {
            color: #666;
            margin-top: 5px;
        }
        .collapse-content {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 0 0 5px 5px;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container">
            <h1 class="text-center faq-title">Frequently Asked Questions</h1>

            <div class="accordion" id="faqAccordion">
                @foreach($categories as $category)
                    <div class="card category-card">
                        <div class="card-header category-header">
                            <h2 class="category-title">{{ $category->category }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordion{{ $category->id }}">
                                @foreach($category->faqQuestions as $question)
                                    <div class="card question-card mb-3">
                                        <div class="card-header question-header" id="heading{{ $question->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link question-button w-100 text-left" 
                                                        type="button" 
                                                        data-toggle="collapse" 
                                                        data-target="#collapse{{ $question->id }}" 
                                                        aria-expanded="false" 
                                                        aria-controls="collapse{{ $question->id }}">
                                                    <div class="question-title">Q: {{ $question->question }}</div>
                                                    <div class="answer-text">A: {{ $question->answer }}</div>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse{{ $question->id }}" 
                                             class="collapse" 
                                             aria-labelledby="heading{{ $question->id }}" 
                                             data-parent="#accordion{{ $category->id }}">
                                            <div class="collapse-content">
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
