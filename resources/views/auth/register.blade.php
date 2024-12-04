{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-center">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 mb-2">Name</label>
                <input type="text" name="name" id="name" 
                    class="w-full px-3 py-2 border rounded-lg @error('name') border-red-500 @enderror" 
                    value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" 
                    class="w-full px-3 py-2 border rounded-lg @error('email') border-red-500 @enderror" 
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password" 
                    class="w-full px-3 py-2 border rounded-lg @error('password') border-red-500 @enderror" 
                    required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="w-full px-3 py-2 border rounded-lg" 
                    required>
            </div>
            
            <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600">
                Register
            </button>
        </form>
    </div>
</div>
@endsection
