@extends('layouts.app')

@section('title', 'Вход администратора')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Вход в панель администратора</h2>
    
    <form method="POST" action="{{ route('admin.authenticate') }}">
        @csrf
        
        <div class="mb-4">
            <label for="login" class="block text-gray-700 font-medium mb-2">Логин</label>
            <input 
                type="text" 
                id="login" 
                name="login" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Admin"
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
                placeholder="KorokNET"
                required
            >
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
            Войти
        </button>
    </form>
</div>
@endsection