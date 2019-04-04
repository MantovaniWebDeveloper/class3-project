<header>
  <div class="menu">
     <div class="container-nav">
       <div class="home_logo">
         <a href="{{route('home')}}">
           <i class="fas fa-home"></i>
         </a>
         <h1>BoolBnb</h1>
       </div>
       <i class="fas fa-bars" id="burgher-menu"></i>
       <!--HAMBURGER MENU -->
       @if (\Route::current()->getName() != 'home' && \Route::current()->getName() != 'ricerca_avanzata')
  
              <div class="primary-menu" id="menu" style="height: auto;" >
                <nav >
                  <ul>
                    @auth
                      <li><a href="{{ route('dashboard') }}">I miei appartamenti</a></li>
                      <li class="log_item">
                        <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <input class="button nav_button" type="submit" value="Logout">
                        </form>
                      </li>
                    @endauth

                    @guest
                      <li><a href="{{route('login')}}">Accedi</a></li>
                      <li><a href="{{route('register')}}">Registrati</a></li>
                      <li><a href="#">Aiuto</a></li>
                    @endguest
                  </ul>
                </nav>
              </div>
        @endif

     </div>
 </div>
</header>
