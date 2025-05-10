@extends('frontend.dashboard.layouts.master')

@section('content')

<!-- <div class="container mb-3">
    <h3 class="mt-3">Intermediate Level Quiz</h3>
    <form action="{{ route('user.activities.intermediate.quiz.checkAnswers') }}" method="POST">
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
            <a href="{{ route('user.activities.intermediate.image-matching') }}" class="btn btn-secondary">Next Activity</a>
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
    <h3>Intermediate Level Articles on E-Waste Awareness</h3>

    <div class="study-banner">
        <span>🌱 If you refer to this article you can add more knowledge to your knowledge bank. Come let's study. 🌱</span>
    </div>

    <!-- Article 1 -->
    <div class="article">
        <h5><span class="article-number"></span>1) Global E-Waste Monitor 2024: Key Findings</h5>

        <img src="{{ asset('images/articles/jj.png') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">

        <p>This comprehensive UN report reveals that global e-waste reached record levels, with only ~20% formally recycled. It explains the gap between growing e-waste and weak recycling systems, especially in developing countries. The article calls for better regulations, public-private partnerships, and global awareness to build a circular economy. It's a must-read for understanding the scale of the challenge and international policy efforts.</p>
        <div class="resource-links">
            <a href="https://np-mag.ru/wp-content/uploads/2020/08/The-Global-E-waste-Monitor-2020-Quantities-flows-and-the-circular-economy-potential_compressed.pdf" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
        </div>
    </div>

    <!-- Article 2 -->
    <div class="article">
        <h5><span class="article-number"></span>2) Tech Companies and E-Waste: Who's Leading the Way?</h5>

        <img src="{{ asset('images/articles/E_Waste_Recycling.jpeg') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">
        
        <p>This piece compares major tech brands on their environmental commitments, recycling programs, and product sustainability. It names companies like Apple, Dell, and Fairphone that are pushing greener practices and transparency. It encourages consumers to reward eco-conscious companies and hold laggards accountable.</p>
        <div class="resource-links">
            <a href="https://globalelectronicscouncil.org/" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
            <a href="https://www.youtube.com/watch?v=Ma6Z54G5-zo" target="_blank" class="resource-link">
                <i class="fas fa-play-circle"></i> Watch Video
            </a>
        </div>
    </div>

        <!-- Article 3 -->
    <div class="article">
        <h5><span class="article-number"></span>3) The Circular Economy Solution to E-Waste</h5>

        <img src="{{ asset('images/articles/ewaste-aspect.jpg') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">

        <p>This article explores how the circular economy — where products are designed for reuse, repair, and recycling — can tackle the e-waste crisis. It explains how companies can innovate with modular designs, how governments can incentivize recycling, and how consumers can play a role. It's a forward-thinking look at redesigning systems to prevent waste before it's created.</p>
        <div class="resource-links">
            <a href="https://ellenmacarthurfoundation.org/topics/circular-economy-introduction/overview" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
            <a href="https://www.youtube.com/watch?v=_Y2ePj3wr8M" target="_blank" class="resource-link">
                <i class="fas fa-play-circle"></i> Watch Video
            </a>
        </div>
    </div>

    <!-- Article 4 -->
    <div class="article">
        <h5><span class="article-number"></span>4) How Developing Countries Can Tackle the E-Waste Challenge</h5>
 
        <img src="{{ asset('images/articles/Guiyu_e-waste.jpeg') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">
        
        <p>Focusing on low- and middle-income countries, this article discusses the environmental and health costs of informal e-waste recycling. It highlights the need for better infrastructure, fair labor conditions, and international cooperation to help developing nations handle rising e-waste responsibly.</p>
        <div class="resource-links">
            <a href="https://www.ban.org/e-stewardship" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
        </div>
    </div>

    <!-- Article 5 -->
    <div class="article">
        <h5><span class="article-number"></span>5) Responsible Consumerism: How Your Choices Matter</h5>

        <img src="{{ asset('images/articles/Removal_Impact.jpeg') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">

        <p>This article empowers readers to understand the impact of their purchasing and disposal habits. It offers guidance on choosing eco-labeled products, extending device lifespans, participating in take-back programs, and supporting right-to-repair policies. It frames consumers as crucial players in the fight against e-waste.</p>
        <div class="resource-links">
            <a href="https://www.ethicalconsumer.org/technology" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
            <a href="https://www.youtube.com/watch?v=w0ikFMTuS9c" target="_blank" class="resource-link">
                <i class="fas fa-play-circle"></i> Watch Video
            </a>
        </div>
    </div>

    <div class="d-flex gap-3 mt-4">
        <a href="{{ route('user.activities.intermediate.image-matching') }}" class="btn btn-primary">
            <i class="fas fa-arrow-right"></i> Next Activity
        </a>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-home"></i> Go to Dashboard
        </a>
    </div>
</div>

@endsection
