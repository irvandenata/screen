<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\File;
use App\Models\Subevent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Str;
use Yajra\DataTables\Facades\DataTables;

class SubeventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event)
    {
        if ($request->ajax()) {
            $event = Event::where('slug', $event)->first();
            $items = $event->subevents;
            return DataTables::of($items)
                ->addColumn('image', function ($item) {
                    return count($item->files) > 0 ? '
                    <img height="200px" src="' . asset("storage/" . $item->files->first()->link) . '">
                      ' : 'Tidak Ada Gambar';
                })
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fa fa-trash"></i></span></a>
                           <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fa fa-pencil"></i></span></a>
                           ';
                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $event = Event::where('slug', $event)->first();
        $data['title'] = "Subevent " . $event->name;
        return view('admin.subevent.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event)
    {
        $path = null;
        $data = Event::where('slug', $event)->first()->id;
        $item = Subevent::create($request->except(['_token', '_method', 'file']) + ['event_id' => $data, 'slug' => Str::of($request->name)->slug('-'),
        ]);
        $item->save();
        if ($request->file('file')) {
            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('png', 100);
            $namePath = "subevent";
            $path = $namePath . "/" . $name_picture;

            Storage::put("public/" . $path, $picture);
        }
        if ($path != null) {
            $item->files()->create(['link' => $path, 'type' => 'image']);
        }
        return $item;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Models\Subvent  $subevent
 * @return \Illuminate\Http\Response
 */

    public function edit($event, $id)
    {
        return Subevent::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event, $id)
    {
        $path = null;
        $item = Subevent::where('id', $id)->first();
        $item->name = $request->name;
        $item->start_regist = $request->start_regist;
        $item->end_regist = $request->end_regist;
        $item->slug = Str::of($request->name)->slug('-');

        $item->save();
        if ($request->file('file')) {
            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('png', 100);
            $namePath = "subevent";
            $path = $namePath . "/" . $name_picture;

            Storage::put("public/" . $path, $picture);
        }
        if ($path != null) {
            $item->files()->create(['link' => $path, 'type' => 'image']);
        }
        return $item;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event, $id)
    {
        $item = Subevent::where('id', $id)->first();
        if (count($item->files) > 0) {
            $id = $item->files->first()->id;
            $img = File::find($id);
            if (Storage::exists("public/" . $img->link)) {
                Storage::delete("public/" . $img->link);
                $img->delete();
            }
        }
        $item->delete();
        return response()->json(['message', 'deleted success']);
    }
}
