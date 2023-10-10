@props(['data'])

<div class="flex justify-start gap-4">
    @foreach ($data as $key => $gp)
        <div class="block rounded-lg shadow">
            <div class="relative w-full p-2 text-center bg-black rounded-t-lg group">
                <h1 class="text-base font-bold text-white uppercase">{{ $key }}</h1>
            </div>
            <div class="bg-white rounded-b-lg">
                <div class="flex flex-col gap-2 px-6 py-6">
                    @foreach ($gp as $item)
                        <x-form.toggle wire:model="permission.{{ str_replace('.', '_', $item->name) }}"
                                       name="{{ $item->name }}"
                                       label="{{ $item->name }}" />
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
