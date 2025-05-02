<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{


    public function index()
    {
        if(!auth()->user()){
            return redirect()->route('login');
        }
        $user = auth()->user();

        $userDevices = auth()->user()->devices;
        $devices = Device::all();
        return view('devices.index', compact('userDevices','devices'));
    }


    public function create()
    {
        $types = Type::all();
        return view('devices.create', compact('types'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            'devicename'    => 'required|string|max:255',
            'device_model'  => 'nullable|string|max:255',
            'user_agent'    => 'nullable|string',
            'latitude'      => 'nullable|numeric',
            'longitude'     => 'nullable|numeric',
            'baterylevel'   => 'nullable|string|min:0|max:100',
            'types_id'      => 'required|numeric',
        ], [
            'devicename.required'   => 'El nombre del dispositivo es obligatorio.',
            'devicename.max'        => 'El nombre no debe superar los 255 caracteres.',
            'baterylevel.numeric'   => 'La batería debe ser un número.',
            'baterylevel.min'       => 'La batería no puede ser menor a 0.',
            'baterylevel.max'       => 'La batería no puede ser mayor a 100.',
    
            'types_id.required'   => 'Selecciona el tipo de dispositivo.',
            'types_id.numeric'   => 'Número de dispositivo.',
        ]);

        Device::create([
            'devicename' => $request->devicename,
            'device_model' => $request->device_model,
            'user_agent' => $request->user_agent,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'baterylevel' => $request->baterylevel,
            'ip' => $request->ip(), // ip real segun
            'types_id' => $request->types_id,
            'user_id' => auth()->id(),
            'is_active' => true,
        ]);

        return redirect()->route('devices.index')->with('success', 'Dispositivo registrado exitosamente.');
    }

    public function show(Device $device)
    {
        return view('devices.show', compact('device'));
    }

    public function edit(Device $device)
    {
        $types = Type::all();
        return view('devices.edit', compact('device', 'types'));
    }

    public function update(Request $request, Device $device)
{
    $validated = $request->validate([
        'devicename'    => 'required|string|max:255',
        'device_model'  => 'nullable|string|max:255',
        'user_agent'    => 'nullable|string',
        'latitude'      => 'nullable|numeric',
        'longitude'     => 'nullable|numeric',
        'baterylevel'   => 'nullable|string|min:0|max:100',
        'is_active'     => 'required|boolean',
    ], [
        'devicename.required'   => 'El nombre del dispositivo es obligatorio.',
        'devicename.max'        => 'El nombre no debe superar los 255 caracteres.',
        'baterylevel.numeric'   => 'La batería debe ser un número.',
        'baterylevel.min'       => 'La batería no puede ser menor a 0.',
        'baterylevel.max'       => 'La batería no puede ser mayor a 100.',
        'is_active.required'    => 'El campo de estado activo es obligatorio.',
        'is_active.boolean'     => 'El estado activo debe ser verdadero o falso.',
    ]);

    $device->update($validated);

    return redirect()->route('devices.index')->with('success', 'Dispositivo actualizado correctamente.');
}



    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')->with('success', 'Dispositivo eliminado exitosamente.');
    }


}
