<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Dispositivo') }}
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

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('devices.store') }}" id="device-form">
                    @csrf

                    <!-- Nombre del dispositivo -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Nombre del dispositivo
                        </label>
                        <input name="devicename" type="text" class="w-full rounded-md dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <!-- Tipo de dispositivo -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Tipo de dispositivo
                        </label>
                        <select name="types_id" class="w-full rounded-md dark:bg-gray-700 dark:text-white" required>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->typename }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campos ocultos (rellenados por JS) -->
                    <input type="hidden" name="device_model" id="device_model">
                    <input type="hidden" name="user_agent" id="user_agent">
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="baterylevel" id="baterylevel">

                    <!-- Botón -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Registrar
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
