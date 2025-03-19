<style>
    :root {
        --primary-green: #2ecc71;
        --secondary-green: #27ae60;
        --primary-blue: #3498db;
        --secondary-blue: #2980b9;
        --light-background: #f0f4f8;
    }

    .dashboard-container {
        background-color: var(--light-background);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        background: linear-gradient(to right, var(--primary-green), var(--primary-blue));
        padding: 15px;
        border-radius: 10px;
        color: white;
    }

    .quiz-navigation {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 30px;
    }

    .txt-color{
      color: white;
    }

    .quiz-nav-item {
        flex: 1;
        min-width: 150px;
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        color: rgb(246, 241, 241);
        text-decoration: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-weight: bold;
        
    }

    .quiz-nav-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .quiz-nav-item i {
        font-size: 24px;
        
       
    }

    .quiz-nav-item.red { background: linear-gradient(135deg, #e74c3c, #c0392b); }
    .quiz-nav-item.green { background: linear-gradient(135deg, var(--primary-green), var(--secondary-green)); }
    .quiz-nav-item.sky { background: linear-gradient(135deg, #3498db, #2980b9); }
    .quiz-nav-item.blue { background: linear-gradient(135deg, #2c3e50, #34495e); }
    .quiz-nav-item.purple { background: linear-gradient(135deg, #8e44ad, #9b59b6); }
    .quiz-nav-item.orange { background: linear-gradient(135deg, #f39c12, #d35400); }

    .quiz-results-section {
        background-color: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .section-title {
        color: var(--primary-green);
        border-bottom: 2px solid var(--primary-blue);
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .results-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .results-table th {
        background: linear-gradient(to right, var(--primary-green), var(--primary-blue));
        color: white;
        padding: 12px;
        text-align: left;
    }

    .results-table td {
        padding: 12px;
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
    }

    .results-table tr:hover td {
        background-color: #f0f0f0;
    }

    .improvement-card {
        background: linear-gradient(to right, rgba(46, 204, 113, 0.1), rgba(52, 152, 219, 0.1));
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .improvement-table {
        width: 100%;
    }

    .improvement-table th {
        background-color: #e8f5e9;
        color: var(--primary-green);
        padding: 12px;
        text-align: left;
    }

    .improvement-table td {
        padding: 12px;
        background-color: #f1f8e9;
    }

    .alert-info {
        background-color: #e3f2fd;
        color: #1976d2;
        border: 1px solid #bbdefb;
        border-radius: 5px;
        padding: 15px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .quiz-navigation {
            flex-direction: column;
        }

        .quiz-nav-item {
            width: 100%;
        }

        
    }
</style>


@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid dashboard-container">
        @include('frontend.dashboard.layouts.sidebar')
        
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard-header">
                    <h2>Quiz Dashboard</h2>
                    <div>Welcome, {{ Auth::user()->name }}</div>
                </div>

                <!-- Add this section in your dashboard blade file -->
<div class="instructions-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="instructions-card">
                    <h3 class="instructions-title">
                        <i class="fas fa-info-circle"></i> Learning Pathway Guide
                    </h3>
                    <div class="instructions-content">
                        <div class="instruction-step">
                            <div class="step-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div class="step-content">
                                <h4>📌 Take the Pre-Quiz</h4>
                                <p>This helps assess your current knowledge of e-waste management.</p>
                            </div>
                        </div>

                        <div class="instruction-step">
                            <div class="step-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div class="step-content">
                                <h4>📌 Learn & Explore</h4>
                                <p>Engage with the provided learning materials, play interactive games, and enhance your understanding.</p>
                            </div>
                        </div>

                        <div class="instruction-step">
                            <div class="step-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="step-content">
                                <h4>📌 Take the Post-Quiz</h4>
                                <p>Once you've completed the learning phase, click "Post Quiz" to test your improved knowledge. Your score will show how much you've learned!</p>
                            </div>
                        </div>

                        <div class="instruction-step">
                            <div class="step-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="step-content">
                                <h4>📌 Track Your Progress</h4>
                                <p>Aim for a higher score and become an e-waste awareness champion!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .instructions-section {
        margin-bottom: 30px;
    }

    .instructions-card {
        background: linear-gradient(to right, #e0f2f1, #b2dfdb);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }

    .instructions-title {
        color: #00695c;
        border-bottom: 2px solid #4db6ac;
        padding-bottom: 15px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .instructions-title i {
        margin-right: 15px;
        color: #00897b;
    }

    .instructions-content {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .instruction-step {
        display: flex;
        align-items: start;
        background-color: rgba(255,255,255,0.6);
        border-radius: 10px;
        padding: 15px;
        transition: all 0.3s ease;
    }

    .instruction-step:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .step-icon {
        background: linear-gradient(135deg, #00695c, #4db6ac);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .step-content h4 {
        color: #00695c;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .step-content p {
        color: #37474f;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .instructions-content {
            grid-template-columns: 1fr;
        }
    }
</style>

                <div class="quiz-navigation">
                    <a href="{{route('user.quiz.index')}}" class="quiz-nav-item red">
                        <i class="fas fa-book-reader"></i>
                        <span class="txt-color">Pre Quiz</span>
                    </a>
                    <a href="{{ route('user.quiz.second-phase.show') }}" class="quiz-nav-item green">
                        <i class="fas fa-book-reader"></i>
                        <span class="txt-color">Post Quiz</span>
                    </a>
                    {{-- <a href="{{ route('user.activities.intermediate.second-phase.quiz') }}" class="quiz-nav-item green">
                        <i class="fas fa-book-reader"></i>
                        <span class="txt-color">Post Quiz : Intermediate</span>
                    </a>
                    <a href="{{ route('user.activities.pro.second-phase.quiz') }}" class="quiz-nav-item green">
                        <i class="fas fa-book-reader"></i>
                        <span class="txt-color">Post Quiz : Pro</span>
                    </a> --}}
                    <a href="{{ route('user.activities.beginner.quiz') }}" class="quiz-nav-item sky">
                        <i class="fas fa-unlock-alt"></i>
                        <span class="txt-color">Beginner Level</span>
                    </a>
                    <a href="{{ route('user.activities.intermediate.quiz') }}" class="quiz-nav-item blue">
                        <i class="fas fa-unlock-alt"></i>
                        <span class="txt-color">Intermediate Level</span>
                    </a>
                    <a href="{{ route('user.activities.pro.trivia.index') }}" class="quiz-nav-item purple">
                        <i class="fas fa-unlock-alt"></i>
                        <span class="txt-color">PRO Level</span>
                    </a>
                    <a href="{{route('user.profile')}}" class="quiz-nav-item orange">
                        <i class="fas fa-user-shield"></i>
                        <span class="txt-color">Profile</span>
                    </a>
                    {{-- <a href="{{ route('user.collectionPoints.index') }}" class="quiz-nav-item purple">
                        <i class="fal fa-map-marker-alt"></i>
                        <span class="txt-color">Collection Points</span>
                    </a> --}}
                    {{-- <a href="{{ route('user.activities.beginner.puzzle') }}" class="quiz-nav-item purple">
                        <i class="fal fa-puzzle-piece"></i>
                        <span class="txt-color">PUZZLE</span>
                    </a> --}}
                </div>

                 {{-- <a href="{{ route('user.quiz.second-phase.show') }}">Take the Quiz</a> --}}



                <!-- Pre-Quiz Results Section -->
                <div class="quiz-results-section">
                    <h3 class="section-title">Your Pre-Quiz Results</h3>
                    @if($quizResults->isEmpty())
                        <div class="alert alert-info">No pre-quiz results found.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table results-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quizResults as $index => $result)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $result->username }}</td>
                                            <td>{{ $result->level }}</td>
                                            <td>{{ $result->marks }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Post-Quiz Results Section -->
                <div class="quiz-results-section">
                    <h3 class="section-title">Your Post-Quiz Results</h3>
                    @if($quiz2Results->isEmpty())
                        <div class="alert alert-info">No post-quiz results found.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table results-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quiz2Results as $index => $result)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $result->user->name ?? 'Unknown' }}</td>
                                            <td>{{ $result->level }}</td>
                                            <td>{{ $result->score }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>


                <!-- Awareness Improvement Index Section -->
                <div class="improvement-card">
    <h3 class="section-title">Awareness Improvement Index</h3>
    <div class="table-responsive">
        <table class="table improvement-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Pre-Quiz Score</th>
                    <th>Post-Quiz Score</th>
                    <th>Improvement Index</th>
                </tr>
            </thead>
            <tbody>
              @foreach($quizResults as $result)
              @php
                  $postQuizResult = $quiz2Results->first();
                  
                  if ($postQuizResult && $result->marks > 0) {
                      $improvementIndex = (($postQuizResult->score - $result->marks) / $result->marks) * 100;
                  } else {
                      $improvementIndex = 0;
                  }
              @endphp
              <tr>
                  <td>{{ $result->username }}</td>
                  <td>{{ $result->level }}</td>
                  <td>{{ $result->marks }}</td>
                  <td>{{ $postQuizResult->score ?? 'N/A' }}</td>
                  <td>{{ number_format($improvementIndex, 2) }}%</td>
              </tr>
          @endforeach

            </tbody>
        </table>
    </div>
</div>
            </div>
        </div>
    </div>
</section>
@endsection