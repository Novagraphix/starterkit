<div class="p-4 bg-white shadow sm:rounded-lg sm:p-8">
    <form wire:submit.prevent="submit"
          class="mt-6 space-y-6">

        <div>
            <x-form.label for="type"
                          value="Typ" />
            <select wire:model="type"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="{{ $model::TYPE_USER }}"
                        {{ $type === $model::TYPE_USER ? 'selected' : '' }}>@lang('User')</option>
                <option value="{{ $model::TYPE_API }}"
                        {{ $type === $model::TYPE_API ? 'selected' : '' }}>@lang('API')</option>
                <option value="{{ $model::TYPE_ADMIN }}"
                        {{ $type === $model::TYPE_ADMIN ? 'selected' : '' }}>@lang('Administrator')
                </option>
            </select>
            <x-form.error :messages="$errors->get('type')"
                          class="mt-2" />
        </div>

        <div>
            <x-form.label for="name"
                          value="Name" />
            <x-form.text-input id="name"
                               name="name"
                               wire:model="name"
                               type="text"
                               class="block w-full mt-1" />
            <x-form.error :messages="$errors->get('name')"
                          class="mt-2" />
        </div>

        <div>
            <x-form.label for="email"
                          value="E-Mail" />
            <x-form.text-input id="email"
                               name="email"
                               wire:model="email"
                               type="text"
                               class="block w-full mt-1" />
            <x-form.error :messages="$errors->get('email')"
                          class="mt-2" />
        </div>

        <div>
            <x-form.label for="password"
                          value="Passwort" />
            <x-form.text-input id="password"
                               name="password"
                               wire:model="password"
                               type="password"
                               class="block w-full mt-1" />
            <x-form.error :messages="$errors->get('password')"
                          class="mt-2" />
        </div>

        <div>
            <x-form.label value="Rollen" />
            <x-form.tags class="bg-grey-lighter"
                         name="roles"
                         :all="$all_roles"
                         callback="changeRoles"
                         class="block w-full mt-1" />
        </div>

        <div>
            <x-ui.permission-table :data="$grouped_permissions" />
        </div>

        <div class="flex items-center gap-2">
            <x-ui.button title="{{ __('save') }}"
                         :submit="true"
                         type="success" />
            <x-ui.button title="{{ __('cancel') }}"
                         type="secondary"
                         tag="a"
                         href="/user" />
        </div>

    </form>
    @push('after-styles')
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css"
              rel="stylesheet"
              type="text/css" />
    @endpush
</div>
