<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        // Authorization check: only admin can access create vehicle form
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        // Authorization check: only admin can add vehicles
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:sale,rent',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vehicleData = $request->only(['name', 'model', 'price', 'type', 'description']);
        $vehicleData['owner_id'] = auth()->id();

        if ($request->hasFile('image_url')) {
            $imageName = $request->file('image_url')->getClientOriginalName();
            $request->file('image_url')->move(
                public_path('vehicle_images'), $imageName);
            $vehicleData['image_url'] = $imageName;
        }

        Vehicle::create($vehicleData);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle added successfully');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function getImage($filename)
    {
        $path = storage_path('app/public/vehicles/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        // Authorization check: only owner or admin can update
        if (auth()->id() !== $vehicle->owner_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:sale,rent',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vehicleData = $request->only(['name', 'model', 'price', 'type', 'description']);

        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($vehicle->image_url) {
                $oldImagePath = public_path('vehicle_images/'.$vehicle->image_url);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $imageName = $request->file('image_url')->getClientOriginalName();
            $request->file('image_url')->move(
                public_path('vehicle_images'), $imageName);
            $vehicleData['image_url'] = $imageName;
        }

        $vehicle->update($vehicleData);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle updated successfully');
    }

    public function destroy(Vehicle $vehicle)
    {
        // Authorization check: only owner or admin can delete
        if (auth()->id() !== $vehicle->owner_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if ($vehicle->image_url) {
            $oldImagePath = public_path('vehicle_images/'.$vehicle->image_url);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle deleted successfully');
    }

    public function search(Request $request)
    {
        \Log::info('Search accessed', [
            'auth' => auth()->check(),
            'user' => auth()->user(),
            'search' => $request->all()
        ]);
        $search = trim($request->input('search'));
        
        if(empty($search)) {
            return redirect()->route('vehicles.index');
        }

        $vehicles = Vehicle::where(function($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('model', 'like', "%$search%");
            })
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('vehicles.index', [
            'vehicles' => $vehicles,
            'search' => $search
        ]);
    }
}
