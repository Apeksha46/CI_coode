<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 {{ Auth::user()->theme_mode == 1 ? 'sidebar-dark-teal' : 'sidebar-light-teal' }}">
  <!-- Brand Logo -->
   <a href="" class="brand-link {{ Auth::user()->theme_mode == 1 ? 'bg-dark' : '' }}">
        <img src="{{ asset('public/dist/img/logo.png') }}" alt="Tech Reviewers" class="brand-image" style="opacity: 1.8" 
            style="opacity: 1.8">
        <span class="brand-text font-weight-light"><b><strong>Tech Reviewers</strong></b></span>
    </a>

  <!-- Sidebar -->
  <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
              data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->


              <li class="nav-item">
                  <a href="{{ route('dashboard') }}"
                      class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Dashboard
                      </p>
                  </a>
              </li>

              <!-- <li class="nav-item">
                <a href="{{ route('categories_trees.index') }}" class="nav-link {{ (Request::segment(1) == 'categories_trees') ? 'active' : '' }}">
                    <i class="nav-icon fa fa-th-list" aria-hidden="true"></i>
                  <p>
                    Categories Trees
                  </p>
                </a>
            </li> -->

            <li
                  class="nav-item {{ Request::segment(1) == 'categories_trees' || Request::segment(1) == 'domain' || Request::segment(1) == 'programming_language' || Request::segment(1) == 'framework' || Request::segment(1) == 'cms_solution' ? 'menu-is-opening menu-open' : '' }}">
                  <a href="#"
                      class="nav-link {{ Request::segment(1) == 'categories_trees' ? 'active' : '' }}">
                      <i class="nav-ico fa fa-list" aria-hidden="true"></i>
                      <p>
                      Categories Trees
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('categories_trees.index') }}" class="nav-link {{ (Request::segment(1) == 'categories_trees') ? 'active' : '' }}">
                            <i class="fa fa-th-list nav-icon"></i>
                              <p>Service Lines</p>
                          </a>
                       </li>

                       <li class="nav-item">
                        <a href="{{ route('domain.index') }}" class="nav-link {{ (Request::segment(1) == 'domain') ? 'active' : '' }}">
                            <i class="fa fa-th-list nav-icon"></i>
                              <p>Domain Focus</p>
                          </a>
                       </li>

                       <li class="nav-item">
                        <a href="{{ route('programming_language.index') }}" class="nav-link {{ (Request::segment(1) == 'programming_language') ? 'active' : '' }}">
                            <i class="fa fa-th-list nav-icon"></i>
                              <p>Programming Language</p>
                          </a>
                       </li>


                       <li class="nav-item">
                        <a href="{{ route('framework.index') }}" class="nav-link {{ (Request::segment(1) == 'framework') ? 'active' : '' }}">
                            <i class="fa fa-th-list nav-icon"></i>
                              <p>Framework</p>
                          </a>
                       </li>

                       <li class="nav-item">
                        <a href="{{ route('cms_solution.index') }}" class="nav-link {{ (Request::segment(1) == 'cms_solution') ? 'active' : '' }}">
                            <i class="fa fa-th-list nav-icon"></i>
                              <p>CMS Solution</p>
                          </a>
                       </li>
                      
                  </ul>
              </li>

              <li
                  class="nav-item {{ Request::segment(1) == 'listings' || Request::segment(1) == 'listing-category' || Request::segment(1) == 'view-listing-subcategory' || Request::segment(1) == 'add-listing-subcategory' ? 'menu-is-opening menu-open' : '' }}">
                  <a href="#"
                      class="nav-link {{ Request::segment(1) == 'listings' || Request::segment(1) == 'listing-category'|| Request::segment(1) == 'view-listing-subcategory' || Request::segment(1) == 'add-listing-subcategory' ? 'active' : '' }}">
                      <i class="nav-ico fa fa-list" aria-hidden="true"></i>
                      <p>
                          Listings Management
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route('listing-category.index') }}"
                              class="nav-link {{ Request::segment(1) == 'listing-category' || Request::segment(1) == 'view-listing-subcategory' || Request::segment(1) == 'add-listing-subcategory' ? 'active' : '' }}">
                              <i class="fa fa-th-list nav-icon"></i>
                              <p>Listing Category</p>
                          </a>
                       </li>
                       <!-- <li class="nav-item">
                          <a href="{{ route('listing-subcategory.index') }}"
                              class="nav-link {{ Request::segment(1) == 'listing-subcategory' ? 'active' : '' }}">
                              <i class="fa fa-th-list nav-icon"></i>
                              <p>Listing Subcategory</p>
                          </a>
                       </li> -->
                      <li class="nav-item">
                          <a href="{{ route('listings.index') }}"
                              class="nav-link {{ Request::segment(1) == 'listings'  ? 'active' : '' }}">
                              <i class="fa fa-th-list nav-icon"></i>
                              <p>Listings</p>
                          </a>
                      </li>
                      

                  </ul>
              </li>
              {{-- <li class="nav-item">
                  <a href="{{ route('featured-sections.index') }}"
                      class="nav-link {{ Request::segment(1) == 'featured-sections' ? 'active' : '' }}">
                      <i class="nav-ico fa fa-list" aria-hidden="true"></i>
                      <p>
                          Featured sections
                      </p>
                  </a>
              </li> --}}
              <li class="nav-item">
                  <a href="{{ route('tracked-email.index') }}"
                      class="nav-link {{ Request::segment(1) == 'tracked-email' ? 'active' : '' }}">
                      <i class="nav-icon far fa-user" aria-hidden="true"></i>
                      <p>
                          Emails
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('companies.index') }}"
                      class="nav-link {{ Request::segment(1) == 'companies' ? 'active' : '' }}">
                      <i class="nav-icon fa fa-building-o" aria-hidden="true"></i>
                      <p>
                          Companies
                      </p>
                  </a>
              </li>
               <li class="nav-item">
                    <a href="{{ route('case_studies.index') }}"
                        class="nav-link {{ Request::segment(1) == 'case_studies' ? 'active' : '' }}">
                        <i class="nav-ico fa fa-list" aria-hidden="true"></i>
                        <p>
                            Case studies
                        </p>
                    </a>
                </li>
              <li class="nav-item">
                  <a href="{{ route('setting') }}"
                      class="nav-link {{ Request::segment(1) == 'setting' ? 'active' : '' }}">
                      <i class="nav-icon fas fa-cogs" aria-hidden="true"></i>
                      <p>
                          Settings
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                    <a href="{{ route('blogs.index') }}"
                        class="nav-link {{ Request::segment(1) == 'blogs' ? 'active' : '' }}">
                        <i class="av-ico fas fa-blog" aria-hidden="true"></i>
                        <p>
                            Blogs
                        </p>
                    </a>
                </li>
              <li
                  class="nav-item {{ (Request::segment(1) == 'about_us' || Request::segment(1) == 'privacy_policy' || Request::segment(1) == 'terms_condition' || Request::segment(1) == 'contact_information') ? 'menu-is-opening menu-open' : '' }}">
                  <a href="#"
                      class="nav-link {{ (Request::segment(1) == 'about_us' || Request::segment(1) == 'privacy_policy' || Request::segment(1) == 'terms_condition' || Request::segment(1) == 'contact_information') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-list" aria-hidden="true"></i>
                      <p>
                          CMS
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route('about_us') }}"
                              class="nav-link {{ (Request::segment(1) == 'about_us') ? 'active' : '' }}">
                              <i class="fa fa-th-list nav-icon"></i>
                              <p>About Us</p>
                          </a>
                       </li>
                      <li class="nav-item">
                          <a href="{{ route('privacy_policy') }}"
                              class="nav-link {{ (Request::segment(1) == 'privacy_policy') ? 'active' : '' }}">
                              <i class="fa fa-th-list nav-icon"></i>
                              <p>Privacy Policy</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('terms_condition') }}"
                              class="nav-link {{ (Request::segment(1) == 'terms_condition') ? 'active' : '' }}">
                              <i class="fa fa-th-list nav-icon"></i>
                              <p>Terms and Conditions</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('contact_information') }}"
                              class="nav-link {{ (Request::segment(1) == 'contact_information') ? 'active' : '' }}">
                              <i class="fa fa-th-list nav-icon"></i>
                              <p>Contact Information</p>
                          </a>
                      </li>
                  </ul>
              </li>
        
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
