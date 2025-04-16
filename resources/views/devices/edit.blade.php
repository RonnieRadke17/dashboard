<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Dispositivo
        </h2>
    </x-slot>
    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded dark:bg-red-900 dark:text-red-200">
        <strong>Ups... hubo un problema con los datos:</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <form action="{{ route('devices.update', $device->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del dispositivo</label>
                        <input type="text" name="devicename" value="{{ old('devicename', $device->devicename) }}"
                               class="mt-1 block w-full rounded-md dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Modelo</label>
                        <input type="text" name="device_model" value="{{ old('device_model', $device->device_model) }}"
                               class="mt-1 block w-full rounded-md dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">¿Está activo?</label>
                        <select name="is_active" class="mt-1 block w-full rounded-md dark:bg-gray-700 dark:text-white">
                            <option value="1" {{ $device->is_active ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ !$device->is_active ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                     <!-- Campos ocultos (rellenados por JS) -->
                     <input type="hidden" name="device_model" id="device_model">
                     <input type="hidden" name="user_agent" id="user_agent">
                     <input type="hidden" name="latitude" id="latitude">
                     <input type="hidden" name="longitude" id="longitude">
                     <input type="hidden" name="baterylevel" id="baterylevel">

                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Script JS para capturar info del dispositivo -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('user_agent').value = navigator.userAgent;
            document.getElementById('device_model').value = detectDeviceModel(navigator.userAgent);

            // Geolocalización
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                });
            }

            // Batería
            if (navigator.getBattery) {
                navigator.getBattery().then(function (battery) {
                    const level = Math.round(battery.level * 100) + '%';
                    document.getElementById('baterylevel').value = level;
                });
            }
        });

        function detectDeviceModel(userAgent) {
            if (userAgent.includes('iPhone')) return 'iPhone';
            if (userAgent.includes('Android')) {
                let match = userAgent.match(/Android.*; (.+?) Build/);
                return match ? match[1] : 'Android';
            }
            if (userAgent.includes('Windows')) return 'Windows PC';
            if (userAgent.includes('Macintosh')) return 'Mac';
            return 'Desconocido';
        }
    </script>
</x-app-layout>
