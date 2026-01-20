@extends('layouts.app')

@section('title', 'Мои заявки')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Мои заявки на курсы</h1>
    
    <a href="{{ route('applications.create') }}" class="inline-block bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-300 mb-6">
        Подать новую заявку
    </a>
    
    @if($applications->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Курс</th>
                        <th class="py-3 px-4 text-left">Дата начала</th>
                        <th class="py-3 px-4 text-left">Способ оплаты</th>
                        <th class="py-3 px-4 text-left">Статус</th>
                        <th class="py-3 px-4 text-left">Отзыв</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($applications as $application)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
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
                                @if($application->review)
                                    <p class="italic">{{ $application->review }}</p>
                                @else
                                    <form method="POST" action="{{ route('applications.review', $application) }}">
                                        @csrf
                                        <textarea 
                                            name="review" 
                                            rows="3" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Оставьте свой отзыв..."
                                            required
                                        ></textarea>
                                        <button type="submit" class="mt-2 bg-blue-600 text-white py-1 px-3 rounded-md hover:bg-blue-700 transition duration-300">
                                            Отправить отзыв
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">У вас пока нет заявок на курсы.</p>
    @endif
</div>
@endsection