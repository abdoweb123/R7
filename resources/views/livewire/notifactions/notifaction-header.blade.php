<li class="dropdown notifications-menu">
    <a href="#" class="waves-effect waves-light dropdown-toggle btn-outline no-border btn-info-light text-dark hover-white" data-bs-toggle="dropdown" title="Notifications">
      <i data-feather="bell"></i>
    </a>
    <ul class="dropdown-menu animated bounceIn">

      <li class="header">
        <div class="p-20">
            <div class="flexbox">
                <div>
                    <h4 class="mb-0 mt-0">الاشعارات</h4>
                </div>
                <div>
                    {{-- <a href="#" class="text-danger">Clear All</a> --}}
                </div>
            </div>
        </div>
      </li>

      <li>
        <!-- inner menu: contains the actual data -->
        <ul class="menu sm-scrol">
            @isset($results)
                @foreach($results as $result)
                    <li>
                    <a href="#">
                        <i class="fa fa-users text-info"></i> {{ @$result->notes }}
                    </a>
                    </li>
                @endforeach
            @endisset
          
        </ul>
      </li>
      <li class="footer">
          <a href="#">View all</a> 
      </li>
    </ul>
  </li>	