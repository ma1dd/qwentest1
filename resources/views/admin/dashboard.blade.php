@extends('layouts.app')

@section('title', 'Панель администратора')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Панель администратора</h1>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition duration-300">
                Выйти
            </button>
        </form>
    </div>
    
    <h2 class="text-2xl font-semibold mb-4">Все заявки</h2>
    
    @if($applications->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Пользователь</th>
                        <th class="py-3 px-4 text-left">Курс</th>
                        <th class="py-3 px-4 text-left">Дата начала</th>
                        <th class="py-3 px-4 text-left">Способ оплаты</th>
                        <th class="py-3 px-4 text-left">Статус</th>
                        <th class="py-3 px-4 text-left">Действия</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($applications as $application)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $application->user->name ?? 'N/A' }}</td>
                            <td class="py-3 px-4">{{ $application->course_name }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($application->start_date)->format('d.m.Y') }}</td>
                            <td class="py-3 px-4">
                                @if($application->payment_method === 'cash')
                                    Наличными
                                @else
                                    Переводом по телефону
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @if($application->status === 'new')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Новая</span>
                                @elseif($application->status === 'in_progress')
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">Идет обучение</span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Обучение завершено</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <form method="POST" action="{{ route('admin.applications.status', $application) }}" class="inline">
                                    @csrf
                                    <select 
                                        name="status" 
                                        onchange="this.form.submit()"
                                        class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >
                                        <option value="new" {{ $application->status === 'new' ? 'selected' : '' }}>Новая</option>
                                        <option value="in_progress" {{ $application->status === 'in_progress' ? 'selected' : '' }}>Идет обучение</option>
                                        <option value="completed" {{ $application->status === 'completed' ? 'selected' : '' }}>Обучение завершено</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">Пока нет заявок от пользователей.</p>
    @endif
</div>
@endsection