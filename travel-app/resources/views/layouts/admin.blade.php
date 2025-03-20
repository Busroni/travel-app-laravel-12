<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  

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
                    <button type="submit" id="logout-btn" class="text-sm font-semibold hover:bg-red-300 p-2 rounded-lg text-gray-900">
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
 
 <aside id="default-sidebar" class="fixed shadow-xl font-medium top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] transition-transform -translate-x-full sm:translate-x-0 bg-white overflow-y-auto">
   <div class="overflow-y-auto py-5 px-3 h-full bg-white border-gray-200 dark:bg-gray-100">
       <ul class="space-y-2">
           <li>
               <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-black hover:bg-slate-300 dark:hover:bg-gray-300 group">
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
                       <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-slate-300  ">Travel List</a>
                   </li>
                   <li>
                       <a href="{{ route('admin.travel.create') }}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-slate-300  ">Add Scedule Travel</a>
                   </li>
               </ul>
           </li>
           <li>
               <button type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-slate-300  " aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                   <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                   <span class="flex-1 ml-3 text-left whitespace-nowrap">Laporan Travel</span>
                   <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
               </button>
               <ul id="dropdown-sales" class="hidden py-2 space-y-2">
                       <li>
                           <a href="{{ route('admin.history') }}" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-slate-300  ">History Travel</a>
                       </li>
               </ul>
           </li>
           <li class="mt-20">
                <a href="{{ route("admin.add") }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-black hover:bg-slate-300 dark:hover:bg-gray-300 group">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                      </svg>
                    <span class="ml-3">Add Account Admin</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.password.edit') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-black hover:bg-slate-300 dark:hover:bg-gray-300 group">
                 <svg class="w-6 h-6 text-gray-800 dark:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                   </svg>                  
                    <span class="ml-3">Ubah Password</span>
                </a>
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
    }, 3000); 
</script>
@endif

<script src="{{ asset('js/logout.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let token = localStorage.getItem("auth_token");
        let role = localStorage.getItem("role");

        if (!token || role !== "admin") {
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
