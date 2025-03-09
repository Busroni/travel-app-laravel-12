@extends('layouts.app')

@section('content')

<div class="relative flex flex-col rounded-xl bg-transparent items-center justify-center mt-10 py-20 shadow-xl">
    <h4 class="block text-2xl font-bold text-slate-800">
      Sign In
    </h4>
    <p class="text-slate-500 font-light">
      Nice to meet you! Enter your details to Login.
    </p>

    @if (session('error'))
        <div class="text-red-500 mt-2 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form class="mt-8 mb-2 w-80 max-w-screen-lg sm:w-96" method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-1 flex flex-col gap-6">
            <div class="w-full max-w-sm min-w-[200px]">
                <label class="block mb-2 text-sm text-slate-600">
                    Username
                </label>
                <input type="text" name="username" autocomplete="off" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Your Username" required />
            </div>

            <div class="w-full max-w-sm min-w-[200px] mb-5">
                <label class="block mb-2 text-sm text-slate-600">
                    Password
                </label>
                <div class="relative">
                    <input type="password" autocomplete="off" name="password" class="w-full pl-3 pr-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-600 text-sm border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Your password" required />
                </div>
            </div>
        </div>

        <button class="mt-4 w-full rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">
            Sign In
        </button>

        <p class="flex justify-center mt-6 mb-10 text-sm text-slate-600">
            Don&apos;t have an account?
            <a href="{{ route('register')}}" class="ml-1 text-sm font-semibold text-slate-700 underline">
                Sign Up
            </a>
        </p>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let form = document.querySelector("form");
    
        form.addEventListener("submit", function(event) {
            event.preventDefault();
    
            let formData = new FormData(this);
    
            fetch("{{ url('/login') }}", {
                method: "POST",
                headers: { "Accept": "application/json" },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    localStorage.setItem("auth_token", data.token); // ✅ Simpan token
                    localStorage.setItem("role", data.role);
    
                    // Redirect berdasarkan role
                    window.location.href = data.role === "admin" ? "{{ route('admin.dashboard') }}" : "{{ route('travel') }}";
                } else {
                    alert("Login gagal!");
                }
            })
            .catch(error => {
                console.error("Error saat login:", error);
                alert("Terjadi kesalahan saat login.");
            });
        });
    });
    </script>
    

@endsection
