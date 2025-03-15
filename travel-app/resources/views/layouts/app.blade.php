<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  

    <header class="">
        <nav class="mx-auto bg-white flex max-w-fll shadow-lg fixed top-0 left-0 w-full h-16 z-50 items-center justify-between p-6 lg:px-8" aria-label="Global">
          <div class="flex lg:flex-1">
            <a href="{{ route('home') }}" class="-m-1.5 p-0.5 text-2xl font-mono font-black text-slate-600">Traveler99
            </a>
          </div>

            @auth
                @if(Auth::user()->role === 'admin')
                    <div class="lg:flex lg:gap-x-12">
                        <a href="{{ route('admin.dashboard') }}" class="text-sm/6 font-semibold text-gray-900 hover:bg-blue-300 p-2 rounded-lg">
                            Dashboard Admin
                        </a>
                    </div>
                @else
                    <div class="lg:flex lg:gap-x-12">
                        <a href="{{ route('customer.dashboard') }}" class="text-sm/6 font-semibold text-gray-900 hover:bg-blue-300 p-2 rounded-lg">
                            Dashboard Customer
                        </a>
                    </div>
                @endif
            @endauth


          <div class="lg:flex lg:flex-1 lg:justify-end">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm font-semibold hover:bg-red-300 p-2 rounded-lg text-gray-900">
                    Logout <span aria-hidden="true">&rarr;</span>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold hover:bg-blue-300 p-2 rounded-lg text-gray-900">
                Log in <span aria-hidden="true">&rarr;</span>
            </a>
        @endauth
        
        </div>

        </nav>
      </header>


      @if(session('success'))
      <div id="popup-message" class="fixed top-14 right-5 bg-green-500 text-white px-4 py-1 rounded shadow-lg">
          {{ session('success') }}
      </div>
      
      <script>
          setTimeout(() => {
              document.getElementById('popup-message').style.display = 'none';
          }, 3000); // Hilang setelah 3 detik
      </script>

      @endif
    
    
    
    
<div class="container mx-auto mt-20">
        @yield('content')
    </div>
    
</body>
  
