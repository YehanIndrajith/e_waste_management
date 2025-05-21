<nav class="navbar navbar-expand-lg main-navbar" 
     style="background: linear-gradient(to right, #f0f9f1, #ffffff);
            padding: 15px 25px;
            box-shadow: 0 2px 10px rgba(81, 187, 106, 0.1);
            border-bottom: 1px solid rgba(81, 187, 106, 0.1);">
    
    <!-- Left Side -->
    <form class="form-inline mr-auto" style="display: flex; align-items: center;">
        <ul class="navbar-nav mr-3" style="display: flex; align-items: center; gap: 15px;">
            <li>
                <a href="#" 
                   data-toggle="sidebar" 
                   class="nav-link nav-link-lg"
                   style="color: #218838;
                          padding: 10px;
                          border-radius: 8px;
                          transition: all 0.3s ease;
                          background: rgba(81, 187, 106, 0.1);
                          display: flex;
                          align-items: center;
                          justify-content: center;">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li>
                <a href="#" 
                   data-toggle="search" 
                   class="nav-link nav-link-lg d-sm-none"
                   style="color: #218838;
                          padding: 10px;
                          border-radius: 8px;
                          transition: all 0.3s ease;
                          background: rgba(81, 187, 106, 0.1);">
                    <i class="fas fa-search"></i>
                </a>
            </li>
        </ul>
    </form>

    <!-- Right Side -->
    <ul class="navbar-nav navbar-right" 
        style="display: flex; 
               align-items: center; 
               gap: 15px;">
        
        <!-- Messages -->
        <li class="dropdown dropdown-list-toggle">
            <a href="#" 
               data-toggle="dropdown" 
               class="nav-link nav-link-lg message-toggle beep"
               style="color: #218838;
                      padding: 10px;
                      border-radius: 8px;
                      transition: all 0.3s ease;
                      background: rgba(81, 187, 106, 0.1);
                      position: relative;
                      display: flex;
                      align-items: center;
                      justify-content: center;">
                <i class="far fa-envelope"></i>
                <span style="position: absolute;
                           top: -5px;
                           right: -5px;
                           width: 8px;
                           height: 8px;
                           background: #218838;
                           border-radius: 50%;"></span>
            </a>
        </li>

        <!-- Notifications -->
        <li class="dropdown dropdown-list-toggle">
            <a href="#" 
               data-toggle="dropdown" 
               class="nav-link notification-toggle nav-link-lg beep"
               style="color: #218838;
                      padding: 10px;
                      border-radius: 8px;
                      transition: all 0.3s ease;
                      background: rgba(81, 187, 106, 0.1);
                      position: relative;
                      display: flex;
                      align-items: center;
                      justify-content: center;">
                <i class="far fa-bell"></i>
                <span style="position: absolute;
                           top: -5px;
                           right: -5px;
                           width: 8px;
                           height: 8px;
                           background: #218838;
                           border-radius: 50%;"></span>
            </a>
        </li>

        <!-- User Profile -->
        <li class="dropdown">
            <a href="#" 
               data-toggle="dropdown" 
               class="nav-link dropdown-toggle nav-link-lg nav-link-user"
               style="color: #333;
                      padding: 8px 15px;
                      border-radius: 25px;
                      transition: all 0.3s ease;
                      background: rgba(81, 187, 106, 0.1);
                      display: flex;
                      align-items: center;
                      gap: 10px;">
                <div class="d-sm-none d-lg-inline-block" 
                     style="font-weight: 500;">
                    Hi, Vendor
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right"
                 style="background: white;
                        border-radius: 12px;
                        box-shadow: 0 4px 15px rgba(81, 187, 106, 0.1);
                        border: 1px solid rgba(81, 187, 106, 0.1);
                        min-width: 200px;
                        padding: 15px;
                        margin-top: 10px;">
                <div class="dropdown-title" 
                     style="color: #218838;
                            font-weight: 500;
                            padding: 10px 20px;
                            border-bottom: 1px solid rgba(81, 187, 106, 0.1);">
                    Logged in 5 min ago
                </div>
                
                <a href="{{route('vendor.profile')}}" 
                   class="dropdown-item has-icon"
                   style="color: #333;
                          padding: 10px 20px;
                          display: flex;
                          align-items: center;
                          gap: 10px;
                          transition: all 0.3s ease;
                          border-radius: 8px;">
                    <i class="far fa-user" style="color: #218838;"></i> Profile
                </a>
                
                <a href="#" 
                   class="dropdown-item has-icon"
                   style="color: #333;
                          padding: 10px 20px;
                          display: flex;
                          align-items: center;
                          gap: 10px;
                          transition: all 0.3s ease;
                          border-radius: 8px;">
                    <i class="fas fa-bolt" style="color: #218838;"></i> Activities
                </a>
                
                <a href="#" 
                   class="dropdown-item has-icon"
                   style="color: #333;
                          padding: 10px 20px;
                          display: flex;
                          align-items: center;
                          gap: 10px;
                          transition: all 0.3s ease;
                          border-radius: 8px;">
                    <i class="fas fa-cog" style="color: #218838;"></i> Settings
                </a>
                
                <div class="dropdown-divider" 
                     style="border-color: rgba(81, 187, 106, 0.1);
                            margin: 10px 0;"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();" 
                       class="dropdown-item has-icon text-danger"
                       style="color: #dc3545 !important;
                              padding: 10px 20px;
                              display: flex;
                              align-items: center;
                              gap: 10px;
                              transition: all 0.3s ease;
                              border-radius: 8px;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>

<style>
    /* Hover Effects */
    .nav-link:hover {
        background-color: rgba(81, 187, 106, 0.2) !important;
        transform: translateY(-2px);
    }

    .dropdown-item:hover {
        background-color: rgba(81, 187, 106, 0.1) !important;
        transform: translateX(5px);
    }

    .dropdown-item.text-danger:hover {
        background-color: rgba(220, 53, 69, 0.1) !important;
        color: #dc3545 !important;
    }

    /* Notification Beep Animation */
    .beep::after {
        content: '';
        position: absolute;
        top: -5px;
        right: -5px;
        width: 8px;
        height: 8px;
        background: #218838;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.5);
            opacity: 0.5;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Dropdown Animation */
    .dropdown-menu {
        animation: fadeIn 0.2s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>