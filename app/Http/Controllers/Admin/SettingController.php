<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Str;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Config::latest()->get();

            return DataTables::of($items)
                ->addColumn('image', function ($item) {
                    return count($item->files) > 0 ? '
                    <img height="200px" src="' . asset("storage/" . $item->files->first()->link) . '">
                      ' : 'Tidak Ada Gambar';
                })
                ->addColumn('status', function ($item) {
                    return $item->delete_status ? '<div class="btn btn-sm btn-success rounded"> Active </div>
                      ' : '<div class="btn btn-sm btn-secondary rounded">Deactive</div>';
                })
                ->addColumn('action', function ($item) {
                    return $item->delete_status ? '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fa fa-trash"></i></span></a> <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fa fa-pencil"></i></span></a>' :
                    ' <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fa fa-pencil"></i></span></a>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
        $data['title'] = "Setting";
        return view('admin.setting.index', $data);
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

        $item = Config::create($request->except(['_token', '_method', 'file']));
        $item->save();
        if ($request->file('file')) {
            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->encode('png', 100);
            $namePath = "setting";
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
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        return Config::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Config::where('id', $id)->first();
        $path = null;
        $item->name = $request->name;
        $item->config_value = $request->config_value;
        $item->config_key = $request->config_key;
        $item->description = $request->description;
        $item->additional = $request->additional;
        $item->priority = $request->priority;
        $item->save();

        if ($request->file('file')) {
            if (count($item->files) > 0) {
                if (Storage::exists("public/" . $item->files->first()->link)) {
                    Storage::delete("public/" . $item->files->first()->link);
                    $item->files->first()->delete();
                }
            }

            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->encode('png', 100);
            $namePath = "setting";
            $path = $namePath . "/" . $name_picture;
            Storage::put("public/" . $path, $picture);
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
    public function destroy($id)
    {

        $item = Config::where('id', $id)->first();

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
