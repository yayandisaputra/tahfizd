<?php
  use App\Model\User\User;
  // get user auth
  $user = Auth::user();
?>

<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left"></ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                   <a href="<?= URL::to('/profile'); ?>">
                      <span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp Profile
                    </a>
                </li>
                @if($user->account_type == User::ACCOUNT_TYPE_CREATOR || $user->account_type == User::ACCOUNT_TYPE_ADMIN)
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <p>
        								Pengaturan
        								<b class="caret"></b>
        							</p>
                      </a>
                      <ul class="dropdown-menu">

                        @if($user->account_type == User::ACCOUNT_TYPE_CREATOR)

                        <li><a href="<?= URL::to('/role'); ?>"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>&nbsp Role</a></li> 

                        @endif

                        <li><a href="<?= URL::to('/alquran'); ?>"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>&nbsp Qur'an </a></li> 
                        
                         <li><a href="<?= URL::to('/action-log'); ?>"><span class="glyphicon glyphicon-record" aria-hidden="true"></span>&nbsp Log Sistem </a></li> 
                      </ul>
                </li>
                @endif

                @if($user->account_type == User::ACCOUNT_TYPE_CREATOR || $user->account_type == User::ACCOUNT_TYPE_ADMIN || $user->account_type == User::ACCOUNT_TYPE_TEACHER)

                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="glyphicon glyphicon-book" aria-hidden="true"></span> &nbsp Laporan 
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="{{route('daily-report')}}"> Laporan Harian </a></li> 
                        <li><a href="{{route('student-report')}}"> Laporan Persiswa </a></li>
                      </ul>
                </li>

                @endif

               

                <li>
                    <a href="<?= URL::to('/'); ?>/auth/logout">
                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> &nbsp Logout
                    </a>
                </li>
				
        <li class="separator hidden-lg"></li>
            </ul>
        </div>
    </div>
</nav>