<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddVehicleRequest;
use App\Http\Requests\EditVehicleRequest;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return response()->json(['stauts' => 200, 'data' => $vehicles, 'message' => 'The Vehicles']);
    }

    public function addVehicle(AddVehicleRequest $request)
    {
        $photoName = $this->saveImage($request->image, 'images/vehicles');
        $vehicle = Vehicle::create([
            'name' => $request->name,
            'image' => $photoName,
            'max_passengers' => $request->max_passengers,
            'min_price' => $request->min_price,
            'kilometer_price' => $request->kilometer_price,
            'instructions' => $request->instructions,
        ]);
        return response()->json(['status' => 200, 'data' => $vehicle, 'message' => 'Vehicle added successfully']);
    }

    public function editVehicle(EditVehicleRequest $request, $vehicleId)
    {
        $vehicleInfo = Vehicle::find($vehicleId);
        if (!$vehicleInfo)
            return response()->json([404, array(), 'Vehicle Not Found']);
        try {
            if ($request->image) {
                $oldImage = $vehicleInfo->image;
                $imageName = $this->saveImage($request->image, 'images/vehicles');
            }
            $vehicleInfo->update([
                'name' => ($request->name) ?? $vehicleInfo->name,
                'image' => ($imageName) ?? $vehicleInfo->image,
                'max_passengers' => ($request->max_passengers) ?? $vehicleInfo->max_passengers,
                'min_price' => ($request->min_price) ?? $vehicleInfo->min_price,
                'kilometer_price' => ($request->kilometer_price) ?? $vehicleInfo->kilometer_price,
                'instructions' => ($request->instructions) ?? $vehicleInfo->instructions,
            ]);
            if ($request->image)
                unlink("images/vehicles/" . $oldImage);
        } catch (\Error $e) {
            return response()->json([500, array(), 'Server Error']);
        }
        $vehicleInfo = Vehicle::find($vehicleId);
        return response()->json(['status' => 200, 'data' => $vehicleInfo, 'message' => 'Vehicle information has been updated']);
    }

    public function getVehicle(Request $request)
    {
        $type = $request->type;
        $idintity = $request->idintity;
        if (!$type || !$idintity)
            return response()->json([404, array(), 'Vehicle Not Found']);
        switch ($type) {
            case 'id':
                $vehicleInfo = Vehicle::find(intval($idintity));
                if (!$vehicleInfo)
                    return response()->json([404, array(), 'Vehicle Not Found']);
                return response()->json([200, $vehicleInfo, '']);
            case 'name':
                $vehicleInfo = Vehicle::where('name', $idintity)->first();
                if (!$vehicleInfo)
                    return response()->json([404, array(), 'Vehicle Not Found']);
                return response()->json([200, $vehicleInfo, '']);
        }
    }

    public function getAllData()
    {
        $userInfo = User::select('map_token', 'whatsapp_number', 'sms_number', 'whatsapp_message', 'sms_message', 'instructions')->where('id', 2)->get();
        $vehiclesInfo = Vehicle::all();
        return response()->json(['stauts' => 200, 'data' => array(
            'userInfo' => $userInfo,
            'vehiclesInfo' => $vehiclesInfo,
        ), 'message' => 'All Data']);
    }

    public function deleteVehicle($vehicleId)
    {
        $vehicleInfo = Vehicle::find($vehicleId);
        if (!$vehicleInfo)
            return response()->json([404, array(), 'Vehicle Not Found']);
        Vehicle::where('id', $vehicleId)->delete();
        unlink("images/vehicles/" . $vehicleInfo->image);
        return response()->json(['stauts' => 200, 'data' => array(), 'message' => 'Vehicle information has been deleted']);
    }

    public function getScript()
    {
        $script = "window.document.getElementsByClassName(\"ARDqOb\")[0].children[1].children[0].children[0].children[2].children[0].textContent";
        return response()->json(['status' => 200, 'data' => array($script), 'message' => '']);
    }
}
