@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Регистрация</h2>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">ФИО</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Иванов Иван Иванович"
            >
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="example@domain.com"
            >
        </div>
        
        <div class="mb-4">
            <label for="login" class="block text-gray-700 font-medium mb-2">Логин</label>
            <input 
                type="text" 
                id="login" 
                name="login" 
                value="{{ old('login') }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="my_login123"
            >
        </div>
        
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-medium mb-2">Телефон</label>
            <input 
                type="tel" 
                id="phone" 
                name="phone" 
                value="{{ old('phone') }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="8(XXX)XXX-XX-XX"
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
                minlength="8"
            >
        </div>
        
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Подтверждение пароля</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
                minlength="8"
            >
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
            Создать пользователя
        </button>
    </form>
    
    <div class="mt-4 text-center">
        <p>Уже зарегистрированы? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Войти</a></p>
    </div>
</div>
@endsection