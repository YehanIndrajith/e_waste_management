<!-- second phase pro quiz -->

@extends('frontend.dashboard.layouts.master')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <h2 style="text-align: center; color: #2c3e50; margin-bottom: 30px; font-size: 28px;">
        Second Phase Quiz - Level Wise
    </h2>

    <!-- Alert Message Box -->
    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-left: 4px solid #3498db;">
        <p style="text-align: center; color: #2c3e50; margin-bottom: 15px; font-size: 20px; font-weight: bold;">
            You've completed the first step! 🎉
        </p>
        <p style="text-align: center; color: #576574; margin-bottom: 10px; font-size: 16px;">
            Now, it's time to test your knowledge again.
        </p>
        <p style="text-align: center; color: #576574; margin-bottom: 10px; font-size: 16px;">
            This post-quiz helps you see how much you've learned about e-waste management.
        </p>
        <p style="text-align: center; color: #2c3e50; margin-bottom: 0; font-style: italic; font-size: 16px;">
            Let's see your progress and level up your awareness!
        </p>
    </div>

    <form action="{{ route('user.quiz.second-phase.submit') }}" method="POST">
        @csrf
        @foreach($questions as $index => $question)
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <p style="font-size: 18px; color: #34495e; margin-bottom: 20px;">
                    <strong>{{ $index + 1 }}. {{ $question['question'] }}</strong>
                </p>
                
                <div style="padding-left: 20px;">
                    @foreach($question['options'] as $option)
                        <div style="margin-bottom: 15px; display: flex; align-items: center;">
                            <input type="radio" 
                                   style="width: 20px; 
                                          height: 20px; 
                                          margin-right: 12px;
                                          cursor: pointer;
                                          border: 2px solid #3498db;"
                                   name="answers[{{ $index }}]" 
                                   value="{{ $option }}" 
                                   id="question-{{ $index }}-option-{{ $loop->index }}">
                            <label style="font-size: 16px; 
                                        color: #576574;
                                        cursor: pointer;
                                        font-weight: 500;"
                                   for="question-{{ $index }}-option-{{ $loop->index }}">
                                {{ $option }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div style="text-align: center; margin-top: 30px;">
            <button type="submit" 
                    style="background-color: #2ecc71;
                           color: white;
                           padding: 12px 30px;
                           border: none;
                           border-radius: 5px;
                           font-size: 16px;
                           cursor: pointer;
                           transition: background-color 0.3s;
                           box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                Submit Quiz
            </button>
        </div>
    </form>
</div>

<style>
    input[type="radio"]:checked {
        background-color: #3498db;
        border-color: #3498db;
    }

    button[type="submit"]:hover {
        background-color: #27ae60;
    }
</style>
@endsection