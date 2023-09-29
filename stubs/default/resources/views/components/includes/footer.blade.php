<div class="flex flex-col items-center px-8 py-12 mx-auto text-gray-600 dark:bg-gray-700 dark:text-gray-100 md:flex-row">
    <div class="flex flex-col md:flex-row">
        <a
           class="relative inline-flex items-center justify-center font-medium text-gray-900 title-font dark:text-gray-100 md:justify-start">
            <div class="relative">
                <span class="text-xl font-black">laravel</span><span
                      class="text-xl font-light dark:text-secondary-500">starterkit</span>
            </div>
        </a>
        <p
           class="mt-4 text-sm text-gray-500 dark:text-gray-300 md:ml-4 md:mt-0 md:border-l-2 md:border-gray-200 md:py-2 md:pl-4">
            &copy;
            {{ date('Y') }} Novagraphix GmbH & Co. KG — By Stephan Jess.
        </p>
    </div>
    <div class="inline-flex justify-center mt-4 text-sm sm:ml-auto sm:mt-0 sm:justify-start">
        {{ Version::get() }}
    </div>
</div>
