@extends('frontend.dashboard.layouts.master')

@section('content')

<!-- <div class="container mb-3">
    <h2 class="text-center mt-4">Pro Level Trivia Quiz</h2>
    <form action="{{ route('user.activities.pro.trivia.submit') }}" method="POST">
        @csrf
        @foreach($questions as $question)
            <div class="mb-4">
                <p><strong>{{ $loop->iteration }}. {{ $question->question }}</strong></p>
                @foreach(['a', 'b', 'c', 'd'] as $option)
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $question['option_'.$option] }}">
                        {{ $question['option_'.$option] }}
                    </label><br>
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="btn btn-success">Submit Answers</button>
        <a href="{{ route('user.activities.pro.image-matching') }}" class="btn btn-secondary">Next Activity</a>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Go to Dashboard</a>
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
    <h3>Pro Level Articles on E-Waste Awareness</h3>

    <div class="study-banner">
        <span>🌱 If you refer to this article you can add more knowledge to your knowledge bank. Come let's study. 🌱</span>
    </div>

    <!-- Article 1 -->
   
    <div class="article">
        <h5><span class="article-number"></span>1) Urban Mining: Turning E-Waste into Valuable Resources</h5>

        <img src="{{ asset('images/articles/kkk.png') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">

        <p>This article dives into urban mining — the process of extracting valuable metals like gold, silver, and rare earths from electronic waste instead of mining virgin materials. It explains cutting-edge recycling technologies, the economic and environmental benefits, and how urban mining can reduce dependency on traditional mining, which often causes deforestation, pollution, and human rights abuses.</p>
        <div class="resource-links">
            <a href="https://www.weforum.org/stories/2024/04/e-waste-recycling-electronics-appliances/" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
        </div>
    </div>

    <!-- Article 2 -->
    <div class="article">
        <h5><span class="article-number"></span>2) E-Waste Legislation: A Global Overview</h5>

        <img src="{{ asset('images/articles/Electronic_waste.jpeg') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">

        <p>This article provides a deep dive into the different e-waste regulations worldwide, comparing laws in the EU, US, China, and Africa. It discusses Extended Producer Responsibility (EPR), take-back schemes, right-to-repair laws, and the challenges of enforcement. It's ideal for readers interested in policy solutions and governance.</p>
        <div class="resource-links">
            <a href="https://www.itu.int/en/itu-d/environment/pages/spotlight/global-ewaste-monitor-2020.aspx" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
            <a href="https://www.youtube.com/watch?v=-uyIzKIw0xY" target="_blank" class="resource-link">
                <i class="fas fa-play-circle"></i> Watch Video
            </a>
        </div>
    </div>

    <!-- Article 3 -->
    <div class="article">
        <h5><span class="article-number"></span>3) Cutting-Edge Recycling Technologies Transforming E-Waste</h5>

        <img src="{{ asset('images/articles/pp.png') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">

        <p>This piece profiles the most innovative recycling technologies, such as hydrometallurgical recovery, robotic sorting systems, and biotechnological solutions that use microbes to extract metals. It explains how these technologies can improve recovery rates, reduce environmental impact, and scale circular systems globally.</p>
        <div class="resource-links">
            <a href="https://www.isri.org/" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
        </div>
    </div>

    <!-- Article 4 -->
    <div class="article">
        <h5><span class="article-number"></span>4) Community-Led E-Waste Solutions: Grassroots Innovations</h5>

        <img src="{{ asset('images/articles/nature.png') }}" alt="E-waste file"   style="width: 50vw; height: 50vh; object-fit: cover;" class="img-fluid mb-4 rounded shadow">

        <p>This inspiring article showcases local and community-driven initiatives tackling e-waste, from youth-led collection drives to repair cafés and e-waste art projects. It highlights the importance of grassroots action alongside policy and technology, showing how everyday people can drive change.</p>
        <div class="resource-links">
            <a href="https://globalewaste.org/" target="_blank" class="resource-link">
                <i class="fas fa-book-reader"></i> Read More
            </a>
            <a href="https://youtu.be/4GtWGHvX-rk?si=e461YGs9aQLFZjbg" target="_blank" class="resource-link">
                <i class="fas fa-play-circle"></i> Watch Video
            </a>
        </div>
    </div>

    <div class="d-flex gap-3 mt-4">
        <a href="{{ route('user.activities.pro.image-matching') }}" class="btn btn-primary">
            <i class="fas fa-arrow-right"></i> Next Activity
        </a>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-home"></i> Go to Dashboard
        </a>
    </div>
</div>


@endsection
