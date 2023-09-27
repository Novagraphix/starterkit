<div class="py-6">
    <div class="mx-auto space-y-6 sm:px-6 lg:px-8">
        <div {{ $attributes->merge(['class' => 'rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-8']) }}>
            {{ $slot }}
        </div>
    </div>
</div>
