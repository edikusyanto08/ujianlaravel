<div class="navbar-fixed">
  <nav class="white">
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo grey-text text-darken-4 hide-on-large-only">Semaya</a>
      <a href="#" data-activates="slide-out" class="button-collapse grey-text text-darken-4"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="btn role indigo">{{ $role->display_name }}</a></li>
        <li><a class="waves-effect grey-text text-darken-4"><img src="{{ url('assets/img/users/'.$user_foto) }}" alt="{{ $user_name }}" class="circle img-profile">{{ strlen($user_name) > 20 ? substr($user_name, 0, 17).'...' : $user_name }}</a></li>
        <li><a href="{{ route('logout') }}" class="waves-effect grey-text text-darken-4"><i class="material-icons left">power_settings_new</i>Keluar</a></li>
      </ul>
    </div>
  </nav>
</div>
