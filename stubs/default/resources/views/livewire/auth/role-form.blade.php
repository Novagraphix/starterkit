<div class="p-4 bg-white shadow sm:rounded-lg sm:p-8">
    <form wire:submit.prevent="submit"
          class="mt-6 space-y-6">

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
            <x-form.label for="guard_name"
                          value="Guardname" />
            <x-form.text-input id="guard_name"
                               name="guard_name"
                               wire:model="guard_name"
                               type="text"
                               class="block w-full mt-1" />
            <x-form.error :messages="$errors->get('guard_name')"
                          class="mt-2" />
        </div>

        <div class="flex items-center gap-2">
            <x-ui.button title="{{ __('save') }}"
                         :submit="true"
                         type="success" />
            <x-ui.button title="{{ __('cancel') }}"
                         type="secondary"
                         tag="a"
                         href="/user/role" />
        </div>

    </form>

</div>
