<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
?>

@extends('layouts.app')

@section('content')
<style>
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    width: 100%;
  }

  body {
    min-height: 100vh;
    min-width: 100vw;
    overflow: hidden;
  }

  .bg-fullscreen {
    background-image: url('{{ asset('images/farms.png') }}');
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 100vh;
    min-width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .login-panel {
    background: rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(8px);
    border-radius: 18px;
    padding: 2.5rem 2rem;
    box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);
    width: 100%;
    max-width: 420px;
    margin: 0;
  }
</style>

<div class="bg-fullscreen">
  <div class="login-panel">
    <div class="flex justify-center mb-4">
      <img src="{{ asset('images/logo.png') }}" alt="DA Logo" class="h-24" />
    </div>

    {{-- Display validation errors --}}
    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('index.submit') }}">
      @csrf
      <div>
        <label class="text-white block mb-1" for="email">Email Address</label>
        <input 
          id="email" 
          type="email" 
          name="email" 
          value="{{ old('email') }}"
          required 
          placeholder="Enter your email" 
          class="w-full rounded px-3 py-2 bg-white/20 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 border border-transparent"
        />
      </div>
      <div class="mt-4">
        <label class="text-white block mb-1" for="password">Password</label>
        <input 
          id="password" 
          type="password" 
          name="password" 
          required 
          placeholder="Enter your password" 
          class="w-full rounded px-3 py-2 bg-white/20 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 border border-transparent"
        />
      </div>
      <div class="mt-4">
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
          Login
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
