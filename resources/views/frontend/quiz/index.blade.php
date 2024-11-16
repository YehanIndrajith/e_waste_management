@extends('frontend.dashboard.layouts.master')

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <div class="wsus__dashboard">
                <section id="quiz_section">
                    <div class="container">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3>Quiz 01 | Take the Quiz</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.quiz.checkAnswers') }}" method="POST">
                                    @csrf
                                    @foreach($quizzes as $quiz)
                                        <div class="quiz-question mb-4">
                                            <p><strong>{{ $quiz->question }}</strong></p>
                                            <div>
                                                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="A"> {{ $quiz->option_a }}</label><br>
                                                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="B"> {{ $quiz->option_b }}</label><br>
                                                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="C"> {{ $quiz->option_c }}</label><br>
                                                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="D"> {{ $quiz->option_d }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-primary">Submit Quiz</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection