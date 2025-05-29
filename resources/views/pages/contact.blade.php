@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Контакты</h1>
        <x-form action="/contact" method="POST" buttonText="Отправить сообщение">
            <input type="text" name="name" placeholder="Ваше имя" class="w-full px-4 py-2 border rounded-md" required>
            <input type="email" name="email" placeholder="Ваш Email" class="w-full px-4 py-2 border rounded-md" required>
            <textarea name="message" placeholder="Сообщение" class="w-full px-4 py-2 border rounded-md" required></textarea>
        </x-form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const email = document.querySelector('input[type="email"]');

        if (form) {
            form.addEventListener('submit', function (e) {
                if (!email.value.includes('@')) {
                    e.preventDefault();
                    alert('Введите корректный email!');
                }
            });
        }
    });
</script>
@endpush