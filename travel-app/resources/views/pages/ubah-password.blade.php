@extends('layouts.customer')

@section('content')

<div class=" bg-white ml-5 relative flex flex-col rounded-xl items-center justify-center mt-20 py-5 shadow-xl">
    
    <h4 class="block text-2xl mt-10 font-bold text-slate-800">
        UBAH PASSWORD
    </h4>

    <form action="{{ route('password.update') }}" class="mt-8 mb-2 w-80 max-w-screen-lg sm:w-96" method="POST">
        @csrf

        <div class="w-full max-w-sm min-w-[200px]">
            <label class="block mb-2 text-sm text-slate-600">Password Lama</label>
            <input type="password" name="current_password" autocomplete="off" required class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Your Password" />
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="text-red-500 font-mono">{{ $error }}!!</p>
                @endforeach
            @endif
        </div>

        
        <div class="w-full max-w-sm min-w-[200px] mt-10">
            <label class="block mb-2 text-sm text-slate-600">Password Baru</label>
            <input type="password" id="password" name="new_password" autocomplete="off" required class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Your Password" />
            <p id="password-length-message" class="text-sm mt-1"></p>
        </div>
  
          
        <div class="w-full max-w-sm min-w-[200px]">
            <label class="block mb-2 text-sm text-slate-600">Konfirmasi Password Baru</label>
            <input type="password" id="confirm_password" name="new_password_confirmation" required class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Confirm Your Password" />
            <p id="password-match-message" class="text-sm mt-1"></p>
        </div>
        

        <button type="submit" id="submit-btn" class="mt-4 mb-10 w-full rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
            Ubah Password
        </button>
    </form>

</div>

  <script src="{{ asset('js/password-validation.js') }}"></script>


@endsection