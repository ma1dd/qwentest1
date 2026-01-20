@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Авторизация</h2>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-4">
            <label for="login" class="block text-gray-700 font-medium mb-2">Логин</label>
            <input 
                type="text" 
                id="login" 
                name="login" 
                value="{{ old('login') }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">Пароль</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
            Войти
        </button>
    </form>
    
    <div class="mt-4 text-center">
        <p>Еще не зарегистрированы? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Регистрация</a></p>
    </div>
</div>
@endsection