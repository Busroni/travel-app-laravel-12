@extends('layouts.app')

@section('content')


<div class="relative flex flex-col rounded-xl items-center justify-center mt-10 py-5 shadow-xl">
    <h4 class="block text-2xl font-bold text-slate-800">
      Sign Up
    </h4>
    <p class="text-slate-500 font-light">
      Nice to meet you! Enter your details to register.
    </p>

    {{-- FORM REGISTER --}}
    <form data-route="{{ route('register.submit') }} id="registerForm" method="POST" class="mt-8 mb-2 w-80 max-w-screen-lg sm:w-96">
      @csrf

      <div class="mb-1 flex flex-col gap-6">
        {{-- NAME --}}
        <div class="w-full max-w-sm min-w-[200px]">
          <label class="block mb-2 text-sm text-slate-600">Your Name</label>
          <input type="text" id="name" name="name" required class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Your Name" />
          @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- USERNAME --}}
        <div class="w-full max-w-sm min-w-[200px]">
          <label class="block mb-2 text-sm text-slate-600">Username</label>
          <input type="text" id="username" name="username" autocomplete="off" required class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Your Username" />
          @error('username') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- PASSWORD --}}
        <div class="w-full max-w-sm min-w-[200px]">
          <label class="block mb-2 text-sm text-slate-600">Password</label>
          <input type="password" id="password" name="password" autocomplete="off" required class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Your Password" />
          <p id="password-length-message" class="text-sm mt-1"></p>
        </div>

        {{-- PASSWORD CONFIRMATION --}}
        <div class="w-full max-w-sm min-w-[200px]">
          <label class="block mb-2 text-sm text-slate-600">Konfirmasi Password</label>
          <input type="password" id="confirm_password" name="password_confirmation" required class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Confirm Your Password" />
          <p id="password-match-message" class="text-sm mt-1"></p>
        </div>
      </div>

      {{-- SUBMIT BUTTON --}}
      <button type="submit" id="submit-btn" class="mt-4 w-full rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
        Sign Up
      </button>

      <p class="flex justify-center mt-6 text-sm text-slate-600">
        Already have an account?
        <a href="{{ route('login') }}" class="ml-1 text-sm font-semibold text-slate-700 underline">
          Login
        </a>
      </p>
    </form>
  </div>


  <script src="{{ asset('js/password-validation.js') }}"></script>

@endsection
