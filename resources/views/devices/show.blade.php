<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Dispositivo') }}
        </h2>
    </x-slot>
    
    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Información del Dispositivo</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $device->devicename }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Modelo</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $device->device_model }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">User Agent</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $device->user_agent }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Latitud</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $device->latitude }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Longitud</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $device->longitude }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Batería</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $device->baterylevel }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">IP</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">{{ $device->ip }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Tipo</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">
                            {{ $device->type->name ?? 'No especificado' }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Usuario</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">
                            {{ $device->user->name ?? 'No disponible' }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-1/3 text-sm font-medium text-gray-700 dark:text-gray-300">Activo</span>
                        <span class="w-2/3 text-sm text-gray-900 dark:text-gray-100">
                            {{ $device->is_active ? 'Sí' : 'No' }}
                        </span>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-4">
                    <a href="{{ route('devices.edit', $device->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Editar
                    </a>
                    <a href="{{ route('devices.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Volver a la lista
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
