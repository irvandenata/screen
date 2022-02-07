<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\File;
use App\Models\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Str;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Screen::where('status', 1)->first()->events;

            return DataTables::of($items)
                ->addColumn('image', function ($item) {
                    return count($item->files) > 0 ? '
                    <img height="200px" src="' . asset("storage/" . $item->files->first()->link) . '">
                      ' : 'Tidak Ada Gambar';
                })
                ->addColumn('action', function ($item) {
                    return '<a href="/admin/subevent/' . $item->slug . '" class="btn btn-warning btn-sm my-2">Subevent</a>
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fa fa-trash"></i></span></a>
                           <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fa fa-pencil"></i></span></a>
                           ';
                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $data['title'] = "Event";
        return view('admin.event.index', $data);
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
    public function store(Request $request)
    {
        $path = null;
        $screen = Screen::where('status', 1)->first()->id;
        $item = Event::create($request->except(['_token', '_method', 'file']) + ['screen_id' => $screen, 'slug' => Str::of($request->name)->slug('-'),
        ]);
        $item->save();
        if ($request->file('file')) {
            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('png', 100);
            $namePath = "event";
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
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */

    public function edit(Event $event)
    {
        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Event $event)
    {

        $path = null;
        $event->name = $request->name;
        $event->theme = $request->theme;
        $event->contest_date = $request->contest_date;
        $event->description = $request->description;
        $event->slug = Str::of($request->name)->slug('-');

        $event->save();

        if ($request->file('file')) {
            if (count($event->files) > 0) {
                if (Storage::exists("public/" . $event->files->first()->link)) {
                    Storage::delete("public/" . $event->files->first()->link);
                    $event->files->first()->delete();
                }
            }

            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('png', 100);
            $namePath = "event";
            $path = $namePath . "/" . $name_picture;
            Storage::put("public/" . $path, $picture);
            $event->files()->create(['link' => $path, 'type' => 'image']);
        }

        return $event;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */

    public function destroy(Event $event)
    {
        if (count($event->files) > 0) {
            $id = $event->files->first()->id;
            $img = File::find($id);
            if (Storage::exists("public/" . $img->link)) {
                Storage::delete("public/" . $img->link);
                $img->delete();
            }
        }
        $event->delete();
        return response()->json(['message', 'deleted success']);

    }
}
