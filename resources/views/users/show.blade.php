<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>
    
    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">User Details</h3>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Nombre -->
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Name</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $user->name }}</span>
                    </div>
                    <!-- Email -->
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Email</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</span>
                    </div>
                    <!-- Rol -->
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Role</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">
                            {{ $user->role ? ucfirst($user->role->name) : 'No Role Assigned' }}
                        </span>
                    </div>
                    <!-- Fecha de creación -->
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Created At</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $user->created_at->format('Y-m-d H:i:s') }}</span>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-4">
                    <a href="{{ route('users.edit', $user->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Edit
                    </a>
                    <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
