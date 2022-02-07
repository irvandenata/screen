<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Str;
use Yajra\DataTables\Facades\DataTables;

class ScreenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Screen::orderBy('year', 'DESC')->get();

            return DataTables::of($items)
                ->addColumn('image', function ($item) {
                    return count($item->files) > 0 ? '
                    <img height="200px" src="' . asset("storage/" . $item->files->first()->link) . '">
                      ' : 'Tidak Ada Gambar';
                })
                ->addColumn('status', function ($item) {
                    return $item->status ? '<div class="btn btn-sm btn-success rounded"> Active </div>
                      ' : '<div class="btn btn-sm btn-secondary rounded">Deactive</div>';
                })
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fa fa-trash"></i></span></a>
                           <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fa fa-pencil"></i></span></a>
                           ';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
        $data['screen'] = Screen::latest()->get();
        $data['title'] = "Screen";
        return view('admin.screen.index', $data);
    }

    public function activatedScreen(Request $request)
    {

        $old = Screen::where('status', 1)->first();
        $old->status = 0;
        $old->save();
        $now = Screen::where('id', $request->screen)->first();
        $now->status = 1;
        $now->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil diubah',
        ]);
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

        $item = Screen::create($request->except(['_token', '_method', 'file']));
        $item->save();
        if ($request->file('file')) {
            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('png', 100);
            $namePath = "screen";
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
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Screen  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Screen $screen)
    {

        return $screen;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Screen  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $item = Screen::where('id', $request->id)->first();
        $path = null;
        $item->name = $request->name;
        $item->year = $request->year;
        $item->leader = $request->leader;
        $item->theme = $request->theme;
        $item->description = $request->description;
        $item->save();

        if ($request->file('file')) {
            if (count($item->files) > 0) {
                if (Storage::exists("public/" . $item->files->first()->link)) {
                    Storage::delete("public/" . $item->files->first()->link);
                    $item->files->first()->delete();
                }
            }

            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('png', 100);
            $namePath = "screen";
            $path = $namePath . "/" . $name_picture;
            Storage::put("public/" . $path, $picture);
            $item->files()->create(['link' => $path, 'type' => 'image']);
        }

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screen  $screen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Screen $screen)
    {
        if (count($screen->files) > 0) {
            $id = $screen->files->first()->id;
            $img = File::find($id);
            if (Storage::exists("public/" . $img->link)) {
                Storage::delete("public/" . $img->link);
                $img->delete();
            }
        }
        $screen->delete();
        return response()->json(['message', 'deleted success']);
    }
}
