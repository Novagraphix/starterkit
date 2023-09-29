@props(['all' => [], 'value' => '', 'name' => 'tags', 'callback' => 'changeTags', 'placeholder' => '', 'search' => false, 'mid' => null, 'suggestion' => null, 'param' => null])

@once
    @push('after-styles')
        <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css"
              rel="stylesheet"
              type="text/css" />
    @endpush
    @push('after-scripts')
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    @endpush
@endonce

<div wire:ignore
     x-data="{
         search: @js($search),
         mid: @js($mid),
         tags: @js($all),
         callback: @js($callback),
         param: @js($param),
         init() {
             let that = this;
             let controller;
             // The DOM element you wish to replace with Tagify
             let input = document.querySelector('input[name={{ $name }}]');
             // initialize Tagify on the above input node reference
             let tagify = new Tagify(input, {
                 addTagOnBlur: false,
                 pasteAsTags: false,
                 dropdown: {
                     enabled: 0,
                     closeOnSelect: false,
                 },
                 whitelist: this.tags,
                 hooks: {
                     suggestionClick(e) {
                         var isAction = e.target.classList.contains('removeBtn'),
                             suggestionElm = e.target.closest('.tagify__dropdown__item'),
                             value = suggestionElm.getAttribute('value');

                         return new Promise(function(resolve, reject) {
                             if (isAction) {
                                 removeWhitelistItem(value);
                                 tagify.dropdown.refilter.call(tagify);
                                 reject();
                             }
                             resolve();
                         });
                     },
                 },
             });

             if (this.search == true) tagify.on('input', onInput)

             input.addEventListener('change', (e) => {
                 @this.call(this.callback, e.target.value, this.param)
             })

             async function onInput(e) {
                 var value = e.detail.value
                 tagify.whitelist = null // reset the whitelist

                 tagify.loading(true).dropdown.hide()

                 await fetch('/filmpflege/get_leadroot_suggestions?value=' + value + '&movie_id=' + that.mid)
                     .then(RES => RES.json())
                     .then(function(newWhitelist) {
                         tagify.whitelist = newWhitelist
                         tagify.loading(false).dropdown.show(value)
                     })
             }

             function removeWhitelistItem(value) {
                 var index = tagify.settings.whitelist.indexOf(value);
                 if (value && index > -1) tagify.settings.whitelist.splice(index, 1);
             }
         }
     }">
    <input name="{{ $name }}"
           value="{{ $value }}"
           placeholder="{{ $placeholder }}"
           {{ $attributes->merge(['class' => 'border-gray-300 focus:border-gray-300 focus:!ring-4 focus:ring-gray-300 rounded-md shadow-sm disabled:bg-slate-50 disabled:text-gray-300 placeholder:text-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:focus:ring-gray-700 dark:placeholder:text-gray-100']) }} />
    @if ($suggestion)
        <div class="mt-1 w-full text-center text-xs font-bold text-red-500">
            Diese Liste wurde auf Basis der Fame automatisch generiert und ist nur ein Vorschlag. Bitte bearbeiten, wenn
            nötig.
        </div>
    @endif
</div>
