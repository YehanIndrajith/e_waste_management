@extends('frontend.dashboard.layouts.master')

@section('content')

<!-- 
<div class="container mb-3">
    <h3 class="mt-3">Beginner Level Quiz </h3>
    <form action="{{ route('user.activities.beginner.quiz.checkAnswers') }}" method="POST">
        @csrf
        @foreach($quizzes as $quiz)
            <div class="quiz-question mb-4">
                <p><strong>{{ $quiz->question }}</strong></p>
                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="A"> {{ $quiz->option_a }}</label><br>
                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="B"> {{ $quiz->option_b }}</label><br>
                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="C"> {{ $quiz->option_c }}</label><br>
                <label><input type="radio" name="answers[{{ $quiz->id }}]" value="D"> {{ $quiz->option_d }}</label>
            </div>
        @endforeach

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('user.activities.beginner.image-matching') }}" class="btn btn-secondary">Next Activity</a>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Go to Dashboard</a>
        </div>
    </form>
</div> -->

<style>
    .container {
        background-color: #f5f9f5;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }

    h3 {
        color: #2c5f2d;
        border-bottom: 2px solid #97bc62;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }

    .article {
        background-color: white;
        padding: 25px;
        border-radius: 12px;
        border-left: 5px solid #97bc62;
        margin-bottom: 25px;
        transition: transform 0.2s;
    }

    .article:hover {
        transform: translateX(10px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .article h5 {
        color: #2c5f2d;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .article p {
        color: #4a4a4a;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .article a {
        color: #558b2f;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    .article a:hover {
        color: #33691e;
        text-decoration: underline;
    }

    .btn-primary {
        background-color: #558b2f;
        border: none;
        padding: 10px 25px;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #33691e;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #78909c;
        border: none;
        padding: 10px 25px;
        transition: all 0.3s;
    }

    .btn-secondary:hover {
        background-color: #546e7a;
        transform: translateY(-2px);
    }

    .resource-links {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }

    .resource-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        background-color: #e8f5e9;
        border-radius: 6px;
        font-size: 0.9em;
    }

    .resource-link i {
        color: #558b2f;
    }

    .study-banner {
        background-color: #e8f5e9;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.1em;
        color: #2c5f2d;
        border-left: 5px solid #97bc62;
    }

    .study-banner span {
        font-weight: 500;
    }
</style>

<div class="container mb-3">
    <h3>Beginner Level Articles on E-Waste Awareness</h3>

    <div class="study-banner">
        <span>🌱 If you refer to this article you can add more knowledge to your knowledge bank. Come let's study. 🌱</span>
    </div>

    <div class="article">
        <h5>1) How to Reduce Your E-Waste Footprint</h5>

        <img src="{{ asset('images/articles/ewaste.png') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;"  class="img-fluid mb-4 rounded shadow">
       
        <p>This practical guide offers five simple actions: repair instead of replacing, donate working devices, recycle responsibly, buy secondhand, and avoid impulse gadget shopping. It also encourages identifying certified recyclers and attending local collection events. Readers walk 
        away with easy actions they can take to cut down on e-waste and help the planet.</p>
        <div class="resource-links">
            <a href="https://earth911.com/category/eco-tech/" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
            <a href="https://www.youtube.com/watch?v=F3xNiWAmOB8" target="_blank" class="resource-link">
                <i class="fas fa-play-circle"></i> Watch Video
            </a>
        </div>
    </div>

    <div class="article">
        <h5><span class="article-number"></span>2) The Journey of Your Smartphone: From Purchase to Disposal</h5>

        <img src="{{ asset('images/articles/hh.png') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">
        <p>Follow the life of a smartphone from raw material mining to manufacturing, consumer use, 
         and disposal. The article highlights the environmental and human impacts of mining 
         materials like cobalt and lithium and explains why recycling is crucial to recover valuable 
         resources and reduce environmental harm. It encourages consumers to keep devices 
         longer and recycle them responsibly. </p>
        <div class="resource-links">
            <a href="https://www.greenpeace.org/international/story/6928/which-country-is-most-likely-to-repair-their-electronic-gadgets/" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More on Greenpeace
            </a>
            <a href="https://www.youtube.com/watch?v=S2lmPIa1iWE" target="_blank" class="resource-link">
                <i class="fas fa-play-circle"></i> Watch Video
            </a>
        </div>
    </div>

    <div class="article">
        <h5><span class="article-number"></span>3) The Hidden Dangers of Throwing Electronics in the Trash</h5>

        <img src="{{ asset('images/articles/ff.png') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">

        <p>The EPA explains how electronics tossed in the garbage release toxic materials into 
           landfills, contaminating soil and water. It shares real-world examples of environmental 
           harm and public health risks and stresses the need for responsible recycling. It also covers 
           the role of manufacturers in creating products designed for easier recycling. </p>
        <div class="resource-links">
            <a href="https://www.epa.gov/recycle/electronics-donation-and-recycling" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More on EPA
            </a>
            <a href="https://www.youtube.com/watch?v=HV2Ir1e513o" target="_blank" class="resource-link">
                <i class="fas fa-play-circle"></i> Watch Video
            </a>
        </div>
    </div>

    <div class="article">
        <h5><span class="article-number"></span>4) Why Refurbished Electronics Are a Smart Choice</h5>

        <img src="{{ asset('images/articles/dd.png') }}" alt="E-waste file"  style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">

        <p>This article promotes refurbished products as a sustainable, cost-effective option. It 
          explains how refurbished devices reduce raw material demand, cut emissions, and lower 
          e-waste. It also provides guidance on choosing reliable refurbished devices and highlights 
          the environmental and financial benefits for consumers. </p>
        <div class="resource-links">
            <a href="https://www.weforum.org/stories/2019/01/how-a-circular-approach-can-turn-e-waste-into-a-golden-opportunity/" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More on WEF
            </a>
            <!-- <a href="#" class="resource-link">
                <i class="fas fa-file-pdf"></i> Download Guide
            </a> -->
        </div>
    </div>


    <div class="d-flex gap-3 mt-4">
        <a href="{{ route('user.activities.beginner.image-matching') }}" class="btn btn-primary">
            <i class="fas fa-arrow-right"></i> Next Activity
        </a>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-home"></i> Go to Dashboard
        </a>
    </div>
</div>

@endsection
