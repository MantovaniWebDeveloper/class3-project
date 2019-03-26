<header>
  <div class="menu">
     <div class="container">
       <div class="home_logo">
         <i class="fas fa-home"></i>
         <h1>BoolBnb</h1>
       </div>
       <i class="fas fa-bars" id="burgher-menu"></i>

       <div class="primary-menu" id="menu" >
         <nav >
           <ul>
           @auth
            <li><a href="#">I miei appartamenti</a></li>
            <li><a href="#">Logout</a></li>
           @endauth

           @guest
            <li><a href="{{route('login')}}">Accedi</a></li>
            <li><a href="{{route('register')}}">Registrati</a></li>
            <li><a href="#">Aiuto</a></li>
          @endguest
           </ul>
         </nav>
       </div>
     </div>
 </div>
</header>
