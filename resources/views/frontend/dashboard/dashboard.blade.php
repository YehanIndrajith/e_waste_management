@extends('frontend.dashboard.layouts.master')

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('user.quiz.index')}}">
                    <i class="far fa-address-book"></i>
                    <p>Quiz One</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="dsahboard_download.html">
                    <i class="fal fa-cloud-download"></i>
                    <p>Quiz 3</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="{{ route('user.activities.beginner.quiz') }}">
                    <i class="fas fa-star"></i>
                    <p>Beginner Quiz</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item blue" href="{{ route('user.activities.intermediate.quiz') }}">
                    <i class="far fa-heart"></i>
                    <p>Intermediate Quiz</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item orange" href="{{route('user.profile')}}">
                    <i class="fas fa-user-shield"></i>
                    <p>profile</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item purple" href="{{ route('user.collectionPoints.index') }}">
                    <i class="fal fa-map-marker-alt"></i>
                    <p>address</p>
                  </a>
                </div>
                <div class="dashboard-links">
                  <a href="">Collection Points</a>
                </div>
              
              </div>
              <!-- Quiz Results Section -->
              <div class="row mt-4">
                <div class="col-xl-12">
                    <h3>Your Quiz 1 Results : Attempt wise</h3>
                    @if($quizResults->isEmpty())
                        <p>No quiz results found.</p>
                    @else
                        <table class="table table-bordered mt-3">
                            <thead class="table-dark">
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
                    @endif
                </div>
            </div>

                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection