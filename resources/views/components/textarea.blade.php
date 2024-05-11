@props([
    'disabled' => false,
    'rows' => 3,
])

<textarea {{ $disabled ? 'disabled' : '' }} rows={{ $rows }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 resize-none dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}></textarea>
