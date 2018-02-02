<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\RoomType;
use App\BedType;

class HotelController extends Controller
{
    // Hotel page
    public function index(Request $request)
    {
        $data['title'] = 'Hotel'; 
        return view('hotel/index', $data);
    }

    // Add Hotel
    public function create(Request $request)
    {
        $data['title'] = 'Add Hotel'; 
        return view('hotel/create', $data);
    }

    /**
     * Room Type
     * */
    public function roomType(Request $request)
    {
        $data['title'] = 'Room Type';
        $data['roomType'] = RoomType::when($request->keyword, function ($query) use ($request) {
            $query->where('type', 'like', "%{$request->keyword}%");
        })->paginate(10);

        $data['roomType']->appends($request->only('keyword'));
        return view('hotel/roomType/index', $data);
    }
    // Create
    public function createRoomType(Request $request)
    {
        $data['title'] = 'Add Room Type'; 
        return view('hotel/roomType/create', $data);
    }

    public function doCreateRoomType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('hotel/room-type/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Save to DB
        $rt = new RoomType;
        $rt->type = $request->type;
        $rt->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('hotel/room-type');
    }

    // Update
    public function updateRoomType(Request $request, $id)
    {
        if($id){
            $data['title'] = 'Update Room Type'; 
            $data['roomType'] = RoomType::find($id);

            return view('hotel/roomType/update', $data);
        }
    }

    public function doUpdateRoomType(Request $request, $id)
    {
        if($id){
            $validator = Validator::make($request->all(), [
                'type' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('hotel/room-type/update')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Save to DB
            $rt = RoomType::find($id);
            $rt->type = $request->type;
            $rt->save();

            $request->session()->flash('msg', 'Data berhasil disimpan!');
            return redirect('hotel/room-type');
        }
    }

    // Delete
    public function deleteRoomType(Request $request, $id)
    {
        if($id){
            $rt = RoomType::find($id);
            $rt->delete();

            return response()->json(array('success' => true));
        }
    }


    /**
     * Bed Type
     * */
    public function bedType(Request $request)
    {
        $data['title'] = 'Bed Type';
        $data['bedType'] = BedType::when($request->keyword, function ($query) use ($request) {
            $query->where('type', 'like', "%{$request->keyword}%")
            ->orWhere('capacity', 'like', "%{$request->keyword}%");
        })->paginate(10);

        $data['bedType']->appends($request->only('keyword'));
        return view('hotel/bedType/index', $data);
    }
    // Create
    public function createBedType(Request $request)
    {
        $data['title'] = 'Add Bed Type'; 
        return view('hotel/bedType/create', $data);
    }

    public function doCreateRoomType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('hotel/room-type/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Save to DB
        $rt = new RoomType;
        $rt->type = $request->type;
        $rt->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('hotel/room-type');
    }

    // Update
    public function updateRoomType(Request $request, $id)
    {
        if($id){
            $data['title'] = 'Update Room Type'; 
            $data['roomType'] = RoomType::find($id);

            return view('hotel/roomType/update', $data);
        }
    }

    public function doUpdateRoomType(Request $request, $id)
    {
        if($id){
            $validator = Validator::make($request->all(), [
                'type' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('hotel/room-type/update')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Save to DB
            $rt = RoomType::find($id);
            $rt->type = $request->type;
            $rt->save();

            $request->session()->flash('msg', 'Data berhasil disimpan!');
            return redirect('hotel/room-type');
        }
    }

    // Delete
    public function deleteRoomType(Request $request, $id)
    {
        if($id){
            $rt = RoomType::find($id);
            $rt->delete();

            return response()->json(array('success' => true));
        }
    }
}
