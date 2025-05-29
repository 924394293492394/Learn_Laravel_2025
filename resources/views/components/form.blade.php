<form {{ $attributes->merge(['class' => 'space-y-4']) }}>
    @csrf
    {{ $slot }}
    <button type="submit" class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700">
        {{ $buttonText }}
    </button>
</form>