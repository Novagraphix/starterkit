@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}
       {!! $attributes->merge([
           'class' =>
               'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:bg-slate-50 disabled:text-gray-300 placeholder:text-gray-300 dark:bg-gray-900 dark:border-gray-600 dark:placeholder:text-gray-600 dark:disabled:text-gray-600 dark:text-white',
       ]) !!}>
