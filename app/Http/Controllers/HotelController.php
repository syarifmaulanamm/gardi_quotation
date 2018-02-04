<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Hotel;
use App\HotelRoom;
use App\RoomType;
use App\BedType;
use App\Currency;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    // Hotel page
    public function index(Request $request)
    {
        $data['title'] = 'Hotel';
        $data['hotel'] = Hotel::when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%")
            ->orWhere('address', 'like', "%{$request->keyword}%");
        })->paginate(10);
        
        return view('hotel/index', $data);
    }

    // Add Hotel
    public function create(Request $request)
    {
        $data['title'] = 'Add Hotel'; 
        $data['bedType'] = BedType::orderBy('type', 'asc')->get();
        $data['roomType'] = RoomType::orderBy('type', 'asc')->get();
        $data['currency'] = Currency::orderBy('code', 'asc')->get();
        return view('hotel/create', $data);
    }
    public function doCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('hotel/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // $image = time().'.'.$request->image->getClientOriginalExtension();
        // $request->image->move(public_path('storage/images/hotel'), $image);

        // Save to DB
        $hotel = new Hotel;
        $hotel->name = $request->name;
        $hotel->stars = $request->stars;
        $hotel->email = $request->email;
        $hotel->phone = $request->phone;
        $hotel->address = $request->address;
        $hotel->feature = $request->feature;
        $hotel->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('hotel');
    } 
    // Manage
    public function get(Request $request, $id)
    {
        if(!$id){
            return redirect('hotel');
        }
        
        $data['hotel'] = Hotel::find($id);
        $data['rooms'] = HotelRoom::where('hotel_id', $id)->paginate(10);
        $data['title'] = ucwords($data['hotel']->name);

        if(!$data['hotel']){
            return redirect('hotel');
        }

        return view('hotel/manage', $data);

    }

    // Add Images
    public function addImages(Request $request, $id)
    {
        if(!$id){
            return redirect('hotel');
        }
        
        $data['hotel'] = Hotel::find($id);
        $data['title'] = 'Add Images - '.ucwords($data['hotel']->name);

        if(!$data['hotel']){
            return redirect('hotel/manage/'.$id);
        }

        return view('hotel/add_images', $data);
    }

    public function doAddImages(Request $request, $id)
    {
        if(!$id){
            return redirect('hotel');
        }
        
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('hotel/manage/'.$id.'/images')
                        ->withErrors($validator)
                        ->withInput();
        }

        $hotel = Hotel::find($id);

        if(!$hotel){
            return redirect('hotel');
        }
        
        $image = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('storage/images/hotel'), $image);

        if($hotel->images != null){
            $images = json_decode(json_encode($hotel->images, true), true);
            array_push($images, $image);
            $hotel->images = $images;
        }else{
            $hotel->images = array($image);            
        }
        
        $hotel->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('hotel/manage/'.$id);
    }

    /**
     * Room
     */
    public function createRoom(Request $request, $id)
    {
        if(!$id){
            return redirect('hotel');
        }

        $data['title'] = 'Add Room'; 
        $data['bedType'] = BedType::orderBy('type', 'asc')->get();
        $data['roomType'] = RoomType::orderBy('type', 'asc')->get();
        $data['currency'] = Currency::orderBy('code', 'asc')->get();
        return view('hotel/room/create', $data);
    }

    public function doCreateRoom(Request $request, $id)
    {
        if(!$id){
            return redirect('hotel');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'room_type' => 'required',
            'bed_type' => 'required',
            'capacity' => 'required|numeric',
            'currency' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'validity' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('hotel/manage/'.$id.'/room/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $image = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('storage/images/hotel'), $image);

        $room = new HotelRoom;
        $room->hotel_id = $id;
        $room->name = $request->name;
        $room->room_type = $request->room_type;
        $room->bed_type = $request->bed_type;
        $room->capacity = $request->capacity;
        $room->currency = $request->currency;
        $room->capacity = $request->capacity;
        $room->price = str_replace(',','', $request->price);
        $room->remarks = $request->remarks;
        $room->images = array($image);
        $room->validity = date('Y-m-d', strtotime($request->validity));
        $room->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('hotel/manage/'.$id);
    }

    public function updateRoom(Request $request, $id)
    {
        if(!$id){
            return redirect('hotel');
        }

        $data['bedType'] = BedType::orderBy('type', 'asc')->get();
        $data['roomType'] = RoomType::orderBy('type', 'asc')->get();
        $data['currency'] = Currency::orderBy('code', 'asc')->get();
        $data['room'] = HotelRoom::find($id);
        $data['title'] = 'Update Room - '.ucwords($data['room']->name); 

        return view('hotel/room/update', $data);
    }


    public function doUpdateRoom(Request $request, $id)
    {
        if(!$id){
            return redirect('hotel');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'room_type' => 'required',
            'bed_type' => 'required',
            'capacity' => 'required|numeric',
            'currency' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'validity' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('hotel/room/update'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $room = HotelRoom::find($id);
        $room->name = $request->name;
        $room->room_type = $request->room_type;
        $room->bed_type = $request->bed_type;
        $room->capacity = $request->capacity;
        $room->currency = $request->currency;
        $room->capacity = $request->capacity;
        $room->price = str_replace(',','', $request->price);
        $room->validity = date('Y-m-d', strtotime($request->validity));
        $room->remarks = $request->remarks;
        
        if($request->image){
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/images/hotel'), $image);
            $room->images = array($image);
        }

        $room->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('hotel/manage/'.$room->hotel_id);
    }
    // Delete
    public function deleteRoom(Request $request, $id)
    {
        if($id){
            $rt = HotelRoom::find($id);
            Storage::delete(public_path('storage/images/hotel/'.$rt->image[0]));
            $rt->delete();

            return response()->json(array('success' => true));
        }
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

    public function doCreateBedType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'capacity' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('hotel/bed-type/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Save to DB
        $bt = new BedType;
        $bt->type = $request->type;
        $bt->capacity = $request->capacity;
        $bt->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('hotel/bed-type');
    }

    // Update
    public function updateBedType(Request $request, $id)
    {
        if($id){
            $data['title'] = 'Update Bed Type'; 
            $data['bedType'] = BedType::find($id);

            return view('hotel/bedType/update', $data);
        }
    }

    public function doUpdateBedType(Request $request, $id)
    {
        if($id){
            $validator = Validator::make($request->all(), [
                'type' => 'required',
                'capacity' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('hotel/bed-type/update')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Save to DB
            $bt = BedType::find($id);
            $bt->type = $request->type;
            $bt->capacity = $request->capacity;
            $bt->save();

            $request->session()->flash('msg', 'Data berhasil disimpan!');
            return redirect('hotel/bed-type');
        }
    }

    // Delete
    public function deleteBedType(Request $request, $id)
    {
        if($id){
            $bt = BedType::find($id);
            $bt->delete();

            return response()->json(array('success' => true));
        }
    }
}
