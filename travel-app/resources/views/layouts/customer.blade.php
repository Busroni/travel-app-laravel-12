<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <header class="">
        <nav class="mx-auto bg-white shadow-lg flex max-w-full fixed top-0 left-0 w-full h-16 z-50 items-center justify-between p-6 lg:px-8" aria-label="Global">
          <div class="flex lg:flex-1">
            <a href="{{ route('home') }}" class="-m-1.5 p-0.5 text-2xl font-mono font-black text-slate-600">Traveler99
            </a>
          </div>
          
          <div class="lg:flex lg:flex-1 lg:justify-end">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm font-semibold hover:bg-red-300 p-2 rounded-lg text-gray-900">
                        Logout <span aria-hidden="true">&rarr;</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900">
                    Log in <span aria-hidden="true">&rarr;</span>
                </a>
            @endauth
        </div>

        </nav>
      </header>

<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class=" inline-flex items-center p-2 mt-20 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-slate-300 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400  dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
       <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
 </button>
 
 <aside id="default-sidebar" class="fixed font-medium top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] transition-transform -translate-x-full sm:translate-x-0 bg-white overflow-y-auto">
   <div class="overflow-y-auto py-5 px-3 h-full bg-white border-gray-200 dark:bg-gray-100">
       <ul class="space-y-2">
           <li>
               <a href="{{ route('customer.dashboard') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-black hover:bg-slate-300 dark:hover:bg-gray-300 group">
                   <svg aria-hidden="true" class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                   <span class="ml-3">Dashboard</span>
               </a>
           </li>
           <li>
               <button type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-slate-300  " aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                   <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                   <span class="flex-1 ml-3 text-left whitespace-nowrap">Travel</span>
                   <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
               </button>
               <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                   <li>
                       <a href="{{ route('customer.travel') }}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-slate-300  ">History Travel</a>
                   </li>
                   <li>
                       <a href="#" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-slate-300  ">Add Scedule Travel</a>
                   </li>
               </ul>
           </li>
           <li>
                         
        </li>
       </ul>
   </div>
 </aside>

 @if(session('success'))
<div id="popup-message" class="fixed top-14  right-5 bg-green-500 text-white px-4 py-1 rounded shadow-lg">
    {{ session('success') }}
</div>

<script>
    setTimeout(() => {
        document.getElementById('popup-message').style.display = 'none';
    }, 3000); // Hilang setelah 3 detik
</script>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let token = localStorage.getItem("auth_token");
        let role = localStorage.getItem("role");

        if (!token || role !== "customer") {
            document.body.innerHTML = ""; 
            document.body.style.backgroundColor = "white";
            setTimeout(() => {
                alert("Akses ditolak! Anda bukan admin.");
                window.location.href = "{{ route('home') }}";
            }, 100);
        }
    });
</script>



    <div class="pl-3 p-3 mt-10 md:pl-64">
        @yield('content')
    </div>
</body>
</html>
