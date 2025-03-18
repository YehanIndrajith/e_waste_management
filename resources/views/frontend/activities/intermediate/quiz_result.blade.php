@extends('frontend.dashboard.layouts.master')

@section('content')
<style>
    .quiz-results-container {
        background-color: #f4f6f9;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .quiz-score-summary {
        background: linear-gradient(to right, #2ecc71, #3498db);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        text-align: center;
    }

    .quiz-results-table {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .additional-resources {
        background-color: #e0f2f1;
        border-radius: 15px;
        padding: 30px;
        margin-top: 30px;
    }

    .resource-link {
        display: flex;
        align-items: center;
        background-color: white;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .resource-link:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .resource-icon {
        background: linear-gradient(to right, #2ecc71, #3498db);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .resource-content {
        flex-grow: 1;
    }

    .resource-link a {
        color: #00695c;
        text-decoration: none;
        font-weight: bold;
    }

    .resource-link p {
        margin: 0;
        color: #37474f;
        font-size: 0.9rem;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .btn-try-again {
        background: linear-gradient(to right, #2ecc71, #3498db);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-try-again:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>

<div class="container">
    <div class="quiz-results-container">
        <div class="quiz-score-summary">
            <h3>Intermediate Level Quiz Results</h3>
            <p>Your Score: {{ $correctAnswers }} / {{ $totalQuestions }}</p>
        </div>

        <div class="quiz-results-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Your Answer</th>
                        <th>Correct Answer</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result['question'] }}</td>
                            <td>{{ $result['user_answer'] }}</td>
                            <td>{{ $result['correct_answer'] }}</td>
                            <td>{{ $result['is_correct'] ? '✔️' : '❌' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="action-buttons">
                <a href="{{ route('user.activities.intermediate.quiz') }}" class="btn-try-again">
                    <i class="fas fa-redo"></i> Try Again
                </a>
            </div>
        </div>

        <div class="additional-resources">
            <h3 class="mb-4">Want to dive deeper into e-waste management?</h3>
            <p class="mb-4">Check out these useful resources, articles, and expert insights to expand your knowledge!</p>

            <div class="resource-link">
                <div class="resource-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="resource-content">
                    <a href="https://www.who.int/news-room/fact-sheets/detail/electronic-waste-%28e-waste%29" target="_blank">
                        World Health Organization (WHO): Electronic Waste
                    </a>
                    <p>Official WHO fact sheet on electronic waste</p>
                </div>
            </div>

            <div class="resource-link">
                <div class="resource-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="resource-content">
                    <a href="https://ieeexplore.ieee.org/document/10717432" target="_blank">
                        E-Waste Management in the Digital Era
                    </a>
                    <p>A sustainable computing approach to e-waste</p>
                </div>
            </div>

            <div class="resource-link">
                <div class="resource-icon">
                    <i class="fas fa-industry"></i>
                </div>
                <div class="resource-content">
                    <a href="https://www.unsustainablemagazine.com/companies-and-e-waste-management/" target="_blank">
                        E-Waste Management: Are Companies Doing Enough?
                    </a>
                    <p>Critical analysis of corporate e-waste practices</p>
                </div>
            </div>

            <div class="resource-link">
                <div class="resource-icon">
                    <i class="fas fa-recycle"></i>
                </div>
                <div class="resource-content">
                    <a href="https://www.wired.com/story/how-to-responsibly-dispose-electronics/" target="_blank">
                        How to Responsibly Dispose of Your Electronics
                    </a>
                    <p>Practical guide to electronic waste disposal</p>
                </div>
            </div>
        </div>