<style>
  .dashboard_sidebar {
      background: linear-gradient(to bottom right, #2ecc71, #3498db);
      border-radius: 15px;
      padding: 15px 0;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      height: 100%;
      overflow: hidden;
  }

  .close_icon {
      display: flex;
      justify-content: space-between;
      padding: 0 15px;
      margin-bottom: 20px;
  }

  .close_icon i {
      color: white;
      font-size: 24px;
      cursor: pointer;
  }

  .dashboard_link {
      list-style-type: none;
      padding: 0;
      margin: 0;
  }

  .dashboard_link li {
      margin-bottom: 0;
  }

  .dashboard_link a {
      display: flex;
      align-items: center;
      color: white;
      text-decoration: none;
      padding: 15px;
      transition: all 0.3s ease;
      font-weight: 600;
      border-left: 4px solid transparent;
  }

  .dashboard_link a:hover {
      background: rgba(255,255,255,0.1);
      border-left-color: white;
  }

  .dashboard_link a i {
      margin-right: 10px;
      font-size: 20px;
      color: white;
      min-width: 25px;
      text-align: center;
  }

  .dashboard_link a.active {
      background: rgba(255,255,255,0.2);
      border-left-color: white;
  }

  .logout-link {
      margin-top: 20px;
      border-top: 1px solid rgba(255,255,255,0.2);
  }

  .logout-link a {
      color: white !important;
  }

  /* Remove scrollbar while keeping scroll functionality */
  .dashboard_sidebar {
      -ms-overflow-style: none;  /* IE and Edge */
      scrollbar-width: none;  /* Firefox */
  }

  .dashboard_sidebar::-webkit-scrollbar {
      display: none;  /* Chrome, Safari and Opera */
  }
</style>

<div class="dashboard_sidebar">
  <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
  </span>
  
  <ul class="dashboard_link">
      <li>
          <a class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
              <i class="fas fa-tachometer"></i> Dashboard
          </a>
      </li>
      <li>
          <a href="{{ route('user.quiz.index') }}">
              <i class="fas fa-list-ul"></i> Pre Quiz
          </a>
      </li>
      <li>
          <a href="{{ route('user.quiz.second-phase.show') }}">
              <i class="fas fa-book-reader"></i> Post Quiz
          </a>
      </li>
      <li>
          <a href="{{ route('user.activities.beginner.quiz') }}">
              <i class="fas fa-unlock-alt"></i> Beginner Level
          </a>
      </li>
      <li>
          <a href="{{ route('user.activities.intermediate.quiz') }}">
              <i class="fas fa-unlock-alt"></i> Intermediate Level
          </a>
      </li>
      <li>
          <a href="{{ route('user.activities.pro.trivia.index') }}">
              <i class="fas fa-unlock-alt"></i> PRO Level
          </a>
      </li>
      <li>
          {{-- <a href="{{ route('user.collectionPoints.index') }}">
              <i class="fal fa-map-marker-alt"></i> Collection Points
          </a> --}}
      </li>
      <li>
          {{-- <a href="{{ route('user.activities.beginner.puzzle') }}">
              <i class="fal fa-puzzle-piece"></i> Puzzle
          </a> --}}
      </li>
      <li>
          <a href="{{ route('user.profile') }}">
              <i class="far fa-user"></i> My Profile
          </a>
      </li>
      <li class="logout-link">
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a href="{{ route('logout') }}" 
                 onclick="event.preventDefault(); this.closest('form').submit();">
                  <i class="far fa-sign-out-alt"></i> Log out
              </a>
          </form>
      </li>
  </ul>
</div>