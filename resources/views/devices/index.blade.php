<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dispositivos') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 dark:bg-green-900 dark:text-green-200 border border-green-200 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('devices.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Crear nuevo dispositivo
                </a>
            </div>

            {{-- Tabla: Dispositivos propios del usuario --}}
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Mis dispositivos</h3>

                <div class="w-full overflow-x-auto">
                    <div class="shadow border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Batería</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Activo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($userDevices as $device)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $device->id }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $device->devicename }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $device->baterylevel }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $device->is_active ? 'Sí' : 'No' }}</td>
                                        <td class="px-6 py-4 text-sm font-medium flex space-x-3">
                                            {{-- Ver --}}
                                            <a href="{{ route('devices.show', $device->id) }}" title="Ver">
                                                <svg class="h-5 w-5 text-indigo-500 hover:text-indigo-700 dark:text-indigo-300 dark:hover:text-indigo-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            {{-- Editar --}}
                                            <a href="{{ route('devices.edit', $device->id) }}" title="Editar">
                                                <svg class="h-5 w-5 text-green-500 hover:text-green-700 dark:text-green-300 dark:hover:text-green-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a1.875 1.875 0 112.65 2.65L7.5 18.15H4v-3.5L16.862 3.487z" />
                                                </svg>
                                            </a>
                                            {{-- Eliminar --}}
                                            <form action="{{ route('devices.destroy', $device->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminarlo?')" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Eliminar">
                                                    <svg class="h-5 w-5 text-red-500 hover:text-red-700 dark:text-red-300 dark:hover:text-red-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                                            No tienes dispositivos registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tabla: Todos los dispositivos (solo para admin) --}}
            @if(auth()->user()?->isAdmin())
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Todos los dispositivos</h3>

                <div class="w-full overflow-x-auto">
                    <div class="shadow border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Batería</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Activo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($devices as $device)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $device->id }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $device->devicename }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $device->baterylevel }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $device->is_active ? 'Sí' : 'No' }}</td>
                                        <td class="px-6 py-4 text-sm font-medium flex space-x-3">
                                            {{-- Ver --}}
                                            <a href="{{ route('devices.show', $device->id) }}" title="Ver">
                                                <svg class="h-5 w-5 text-indigo-500 hover:text-indigo-700 dark:text-indigo-300 dark:hover:text-indigo-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            {{-- Editar --}}
                                            <a href="{{ route('devices.edit', $device->id) }}" title="Editar">
                                                <svg class="h-5 w-5 text-green-500 hover:text-green-700 dark:text-green-300 dark:hover:text-green-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a1.875 1.875 0 112.65 2.65L7.5 18.15H4v-3.5L16.862 3.487z" />
                                                </svg>
                                            </a>
                                            {{-- Eliminar --}}
                                            <form action="{{ route('devices.destroy', $device->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminarlo?')" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Eliminar">
                                                    <svg class="h-5 w-5 text-red-500 hover:text-red-700 dark:text-red-300 dark:hover:text-red-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
