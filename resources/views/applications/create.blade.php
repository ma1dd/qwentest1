@extends('layouts.app')

@section('title', 'Новая заявка')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Формирование заявки</h2>
    
    <form method="POST" action="{{ route('applications.store') }}">
        @csrf
        
        <div class="mb-4">
            <label for="course_name" class="block text-gray-700 font-medium mb-2">Наименование курса</label>
            <input 
                type="text" 
                id="course_name" 
                name="course_name" 
                value="{{ old('course_name') }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Введите название курса"
                required
            >
        </div>
        
        <div class="mb-4">
            <label for="start_date" class="block text-gray-700 font-medium mb-2">Желаемая дата начала обучения</label>
            <input 
                type="date" 
                id="start_date" 
                name="start_date" 
                value="{{ old('start_date') }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>
        
        <div class="mb-4">
            <label for="payment_method" class="block text-gray-700 font-medium mb-2">Способ оплаты</label>
            <select 
                id="payment_method" 
                name="payment_method" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
                <option value="">Выберите способ оплаты</option>
                <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Наличными</option>
                <option value="phone" {{ old('payment_method') === 'phone' ? 'selected' : '' }}>Переводом по номеру телефона</option>
            </select>
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
            Отправить
        </button>
    </form>
</div>
@endsection