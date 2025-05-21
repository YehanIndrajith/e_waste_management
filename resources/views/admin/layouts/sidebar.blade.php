<div class="main-sidebar sidebar-style-2" style="background: linear-gradient(180deg, #f0f9f1 0%, #ffffff 100%); 
                                                border-right: 1px solid rgba(81, 187, 106, 0.1); 
                                                width: 250px; 
                                                position: fixed; 
                                                height: 100%; 
                                                overflow-y: auto;">
    <aside id="sidebar-wrapper" style="padding: 20px 0;">
        <!-- Logo Section -->
        <div class="sidebar-brand" style="padding: 20px; 
                                        text-align: center; 
                                        background: rgba(81, 187, 106, 0.1); 
                                        margin-bottom: 10px;">
            <a href="index.html" style="color: #218838; 
                                      font-size: 24px; 
                                      font-weight: 600; 
                                      text-decoration: none; 
                                      display: flex; 
                                      align-items: center; 
                                      justify-content: center;">
                <i class="fas fa-leaf" style="margin-right: 10px;"></i>
                ECO-GREEN
            </a>
        </div>

        <!-- Small Brand -->
        <div class="sidebar-brand sidebar-brand-sm" style="display: none;">
            <a href="index.html" style="color: #218838; font-weight: 600;">St</a>
        </div>

        <!-- Menu Section -->
        <ul class="sidebar-menu" style="list-style: none; padding: 0; margin: 0;">
            <!-- Dashboard Header -->
            <li class="menu-header" style="color: #218838; 
                                         font-weight: 600; 
                                         padding: 15px 20px; 
                                         font-size: 14px; 
                                         text-transform: uppercase; 
                                         letter-spacing: 1px;
                                         border-bottom: 1px solid rgba(81, 187, 106, 0.1);">
                Dashboard
            </li>

            <!-- Dashboard Link -->
            <li class="dropdown active" style="margin: 5px 0;">
                <a href="{{route('admin.dashboard')}}" 
                   class="nav-link" 
                   style="color: #218838; 
                          padding: 12px 20px; 
                          display: flex; 
                          align-items: center; 
                          text-decoration: none; 
                          transition: all 0.3s ease; 
                          border-radius: 8px; 
                          margin: 0 10px;
                          background: rgba(81, 187, 106, 0.1);">
                    <i class="fas fa-fire" style="width: 20px; margin-right: 10px;"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Starter Header -->
            <li class="menu-header" style="color: #218838; 
                                         font-weight: 600; 
                                         padding: 15px 20px; 
                                         font-size: 14px; 
                                         text-transform: uppercase; 
                                         letter-spacing: 1px;
                                         border-bottom: 1px solid rgba(81, 187, 106, 0.1);">
                Starter
            </li>

            <!-- Categories Management -->
            <li class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*'])}}"
                style="margin: 5px 0;">
                <a href="#" 
                   class="nav-link has-dropdown" 
                   data-toggle="dropdown" 
                   style="color: #333; 
                          padding: 12px 20px; 
                          display: flex; 
                          align-items: center; 
                          text-decoration: none; 
                          transition: all 0.3s ease; 
                          border-radius: 8px; 
                          margin: 0 10px;">
                    <i class="fas fa-columns" style="width: 20px; margin-right: 10px; color: #218838;"></i>
                    <span style="flex-grow: 1;">Manage Categories</span>
                    <i class="fas fa-chevron-down" style="font-size: 12px; color: #218838;"></i>
                </a>
                <ul class="dropdown-menu" 
                    style="list-style: none; 
                           padding: 5px 0; 
                           margin: 0 0 0 45px; 
                           background: rgba(255, 255, 255, 0.95); 
                           border-radius: 8px; 
                           box-shadow: 0 4px 15px rgba(81, 187, 106, 0.1);">
                    <li class="{{setActive(['admin.category.*'])}}" style="margin: 5px 0;">
                        <a class="nav-link" 
                           href="{{route('admin.category.index')}}" 
                           style="color: #333; 
                                  padding: 8px 15px; 
                                  display: block; 
                                  text-decoration: none; 
                                  transition: all 0.3s ease; 
                                  border-radius: 6px; 
                                  font-size: 14px;">
                            Category
                        </a>
                    </li>
                    <li class="{{setActive(['admin.sub-category.*'])}}" style="margin: 5px 0;">
                        <a class="nav-link" 
                           href="{{route('admin.sub-category.index')}}" 
                           style="color: #333; 
                                  padding: 8px 15px; 
                                  display: block; 
                                  text-decoration: none; 
                                  transition: all 0.3s ease; 
                                  border-radius: 6px; 
                                  font-size: 14px;">
                            Sub Category
                        </a>
                    </li>
                    <li class="{{setActive(['admin.child-category.*'])}}" style="margin: 5px 0;">
                        <a class="nav-link" 
                           href="{{route('admin.child-category.index')}}" 
                           style="color: #333; 
                                  padding: 8px 15px; 
                                  display: block; 
                                  text-decoration: none; 
                                  transition: all 0.3s ease; 
                                  border-radius: 6px; 
                                  font-size: 14px;">
                            Child Category
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Admin Management -->
            <li class="dropdown {{ setActive(['admin.vendor-profile.*'])}}" style="margin: 5px 0;">
                <a href="#" 
                   class="nav-link has-dropdown" 
                   data-toggle="dropdown" 
                   style="color: #333; 
                          padding: 12px 20px; 
                          display: flex; 
                          align-items: center; 
                          text-decoration: none; 
                          transition: all 0.3s ease; 
                          border-radius: 8px; 
                          margin: 0 10px;">
                    <i class="fas fa-user-shield" style="width: 20px; margin-right: 10px; color: #218838;"></i>
                    <span style="flex-grow: 1;">Manage Admin</span>
                    <i class="fas fa-chevron-down" style="font-size: 12px; color: #218838;"></i>
                </a>
                <ul class="dropdown-menu" 
                    style="list-style: none; 
                           padding: 5px 0; 
                           margin: 0 0 0 45px; 
                           background: rgba(255, 255, 255, 0.95); 
                           border-radius: 8px; 
                           box-shadow: 0 4px 15px rgba(81, 187, 106, 0.1);">
                    <li class="{{setActive(['admin.vendor-profile.*'])}}" style="margin: 5px 0;">
                        <a class="nav-link" 
                           href="{{route('admin.vendor-profile.index')}}" 
                           style="color: #333; 
                                  padding: 8px 15px; 
                                  display: block; 
                                  text-decoration: none; 
                                  transition: all 0.3s ease; 
                                  border-radius: 6px; 
                                  font-size: 14px;">
                            Admin Profile
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Website Management -->
            <li class="dropdown {{ setActive(['admin.slider.*'])}}" style="margin: 5px 0;">
                <a href="#" 
                   class="nav-link has-dropdown" 
                   data-toggle="dropdown" 
                   style="color: #333; 
                          padding: 12px 20px; 
                          display: flex; 
                          align-items: center; 
                          text-decoration: none; 
                          transition: all 0.3s ease; 
                          border-radius: 8px; 
                          margin: 0 10px;">
                    <i class="fas fa-globe" style="width: 20px; margin-right: 10px; color: #218838;"></i>
                    <span style="flex-grow: 1;">Manage Website</span>
                    <i class="fas fa-chevron-down" style="font-size: 12px; color: #218838;"></i>
                </a>
                <ul class="dropdown-menu" 
                    style="list-style: none; 
                           padding: 5px 0; 
                           margin: 0 0 0 45px; 
                           background: rgba(255, 255, 255, 0.95); 
                           border-radius: 8px; 
                           box-shadow: 0 4px 15px rgba(81, 187, 106, 0.1);">
                    <li class="{{setActive(['admin.slider.*'])}}" style="margin: 5px 0;">
                        <a class="nav-link" 
                           href="{{route('admin.slider.index')}}" 
                           style="color: #333; 
                                  padding: 8px 15px; 
                                  display: block; 
                                  text-decoration: none; 
                                  transition: all 0.3s ease; 
                                  border-radius: 6px; 
                                  font-size: 14px;">
                            Slider
                        </a>
                    </li>
                    <li class="{{setActive(['admin.slider.*'])}}" style="margin: 5px 0;">
                        <a class="nav-link" 
                           href="{{route('admin.home-page-setting')}}" 
                           style="color: #333; 
                                  padding: 8px 15px; 
                                  display: block; 
                                  text-decoration: none; 
                                  transition: all 0.3s ease; 
                                  border-radius: 6px; 
                                  font-size: 14px;">
                            Home Page Settings
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Products Management -->
            <li class="dropdown {{ setActive(['admin.products.*', 'admin.seller-products.*', 'admin.seller-pending-products.*'])}}" 
                style="margin: 5px 0;">
                <a href="#" 
                   class="nav-link has-dropdown" 
                   data-toggle="dropdown" 
                   style="color: #333; 
                          padding: 12px 20px; 
                          display: flex; 
                          align-items: center; 
                          text-decoration: none; 
                          transition: all 0.3s ease; 
                          border-radius: 8px; 
                          margin: 0 10px;">
                    <i class="fas fa-box" style="width: 20px; margin-right: 10px; color: #218838;"></i>
                    <span style="flex-grow: 1;">Manage Products</span>
                    <i class="fas fa-chevron-down" style="font-size: 12px; color: #218838;"></i>
                </a>
                <ul class="dropdown-menu" 
                    style="list-style: none; 
                           padding: 5px 0; 
                           margin: 0 0 0 45px; 
                           background: rgba(255, 255, 255, 0.95); 
                           border-radius: 8px; 
                           box-shadow: 0 4px 15px rgba(81, 187, 106, 0.1);">
                    <li class="{{setActive(['admin.products.*'])}}" style="margin: 5px 0;">
                        <a class="nav-link" 
                           href="{{route('admin.products.index')}}" 
                           style="color: #333; 
                                  padding: 8px 15px; 
                                  display: block; 
                                  text-decoration: none; 
                                  transition: all 0.3s ease; 
                                  border-radius: 6px; 
                                  font-size: 14px;">
                            Products
                        </a>
                    </li>
                    <li class="{{setActive(['admin.seller-products.*'])}}" style="margin: 5px 0;">
                        <a class="nav-link" 
                           href="{{route('admin.seller-products.index')}}" 
                           style="color: #333; 
                                  padding: 8px 15px; 
                                  display: block; 
                                  text-decoration: none; 
                                  transition: all 0.3s ease; 
                                  border-radius: 6px; 
                                  font-size: 14px;">
                            Seller Products
                        </a>
                    </li>
                    <li class="{{setActive(['admin.seller-pending-products.*'])}}" style="margin: 5px 0;">
                        <a class="nav-link" 
                           href="{{route('admin.seller-pending-products.index')}}" 
                           style="color: #333; 
                                  padding: 8px 15px; 
                                  display: block; 
                                  text-decoration: none; 
                                  transition: all 0.3s ease; 
                                  border-radius: 6px; 
                                  font-size: 14px;">
                            Seller Pending Products
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Settings Link -->
        <div style="padding: 10px 20px; margin-top: 20px;">
            <a class="nav-link" 
               href="{{route('admin.settings.index')}}" 
               style="color: #333; 
                      padding: 12px 20px; 
                      display: flex; 
                      align-items: center; 
                      text-decoration: none; 
                      transition: all 0.3s ease; 
                      border-radius: 8px; 
                      background: rgba(81, 187, 106, 0.1);">
                <i class="fas fa-cog" style="width: 20px; margin-right: 10px; color: #218838;"></i>
                <span>Settings</span>
            </a>
        </div>
    </aside>
</div>

<style>
    /* Hover Effects */
    .nav-link:hover {
        background-color: rgba(81, 187, 106, 0.1) !important;
        color: #218838 !important;
        transform: translateX(5px);
    }

    /* Active State */
    .dropdown.active > a {
        background-color: rgba(81, 187, 106, 0.15) !important;
        color: #218838 !important;
        font-weight: 500;
    }

    /* Dropdown Toggle */
    .has-dropdown[aria-expanded="true"] .fa-chevron-down {
        transform: rotate(180deg);
    }

    /* Scrollbar Styling */
    .main-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .main-sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .main-sidebar::-webkit-scrollbar-thumb {
        background: rgba(81, 187, 106, 0.3);
        border-radius: 3px;
    }

    /* Dropdown Menu Display */
    .dropdown-menu.show {
        display: block !important;
    }
</style>