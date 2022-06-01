<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\File;
use App\Models\Form;
use App\Models\FormResult;
use App\Models\Subevent;
use App\Models\Subform;
use Illuminate\Database\Eloquent\Collection;
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
                ->addColumn('status', function ($item) {
                    return $item->status ? '<div   onClick="activateRegist(' . $item->id . ')" class="btn btn-sm btn-success rounded"> Active </div>
                      ' : '<div onClick="activateRegist(' . $item->id . ')" class="btn btn-sm  btn-secondary rounded">Deactive</div>';
                })
                ->addColumn('rolebook', function ($item) {
                    return count($item->files->where('type', 'rolebook')) > 0 ? ' <div class="btn btn-sm btn-success rounded">Tersedia</div>
                      ' : '<div class="btn btn-sm  btn-secondary rounded">Tidak Tersedia</div>';
                })
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm m-1"  onclick="deleteItem(' . $item->id . ')"><i class="fa fa-trash"></i></span></a>
                           <a class="btn btn-info btn-sm m-1"  onclick="editItem(' . $item->id . ')"><i class="fa fa-pencil"></i></span></a>
                           <a class="btn btn-warning btn-sm m-1" onclick="addForm(' . $item->id . ')">Buat Form</span></a>
                            <a class="btn btn-primary btn-sm m-1" onclick="detailForm(' . $item->id . ')">Detail Form</span></a>
                               <a class="btn btn-primary btn-sm m-1" onclick="detailResponden(' . $item->id . ')">Responden</span></a>
                           ';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'image', 'status', 'rolebook'])
                ->make(true);
        }
        $event = Event::where('slug', $event)->first();
        $data['title'] = "Subevent " . $event->name;
        return view('admin.subevent.index', $data);
    }

    public function activateSubevent(Request $request)
    {
        $event = Subevent::where('id', $request->subevent)->first();
        $event->status = !$event->status;
        $event->save();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil diubah',
        ]);
    }

    public function saveForm(Request $request)
    {

        $item = new Form();
        $item->name = $request->input;
        $item->value = Str::of($request->input)->slug('-');
        $item->subevent_id = $request->id;
        $item->require = $request->require;
        $item->type = $request->type;
        $item->save();
        if (isset($request->option) > 0) {
            for ($i = 0; $i < count($request->option); $i++) {
                $data = new Subform();
                $data->name = $request->option[$i];
                $data->form_id = $item->id;
                $data->save();
            }
        }
        return response()->json(['message', 'Form Berhasil ditambahkan']);

    }
    public function updateForm(Request $request, $id)
    {

        $item = Form::where('id', $id)->first();
        $item->name = $request->input;
        $item->value = Str::of($request->input)->slug('-');
        $item->require = $request->require;
        $item->type = $request->type;
        $item->save();
        $data = Subform::where('id', $item->id)->get();
        foreach ($data as $value) {
            $value->delete();
        };
        if (isset($request->option) > 0) {
            for ($i = 0; $i < count($request->option); $i++) {
                $data = new Subform();
                $data->name = $request->option[$i];
                $data->form_id = $item->id;
                $data->save();
            }
        }
        return response()->json(['message', 'Form Berhasil ditambahkan']);

    }
    public function editForm($id)
    {
        $item = Form::where('id', $id)->first();
        return $item;

    }

    public function getForm(Request $request)
    {
        if ($request->ajax()) {
            $items = Form::where('subevent_id', $request->id)->get();
            return DataTables::of($items)
                ->addColumn('option', function ($item) {
                    return $item->subforms->map(function ($data) {
                        return $data->name;
                    });
                })
                ->addColumn('require_stat', function ($item) {
                    return $item->require ? 'Wajid' : 'Optional';

                })
                ->addColumn('action', function ($item) {
                    return '
                            <a class="btn btn-warning btn-sm m-1"  onclick="editForm(' . $item->id . ')"><i class="fa fa-pencil"></i></span></a>
                           <a class="btn btn-danger btn-sm m-1"  onclick="deleteForm(' . $item->id . ')"><i class="fa fa-trash"></i></span></a>
                           ';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return response()->json(['message', 'success']);

    }

    public function getComponentForm($id)
    {
        $item = Subevent::where('id', $id)->first()->forms;
        return $item->map(function ($data) {
            return $data->name;
        });

    }

    public function getResponden(Request $request)
    {
        if ($request->ajax()) {
            $form = Form::where('subevent_id', $request->id)->pluck('id');

            $res = FormResult::whereIn('form_id', $form)->get()->groupBy('identity');
            $items = new Collection();
            $rawCol = ['action'];
            foreach ($res as $value) {
                $isi = array();
                $i = 0;
                $isi['identity'] = $value->first()['identity'];
                foreach ($value as $data) {

                    if ($data->form->type == 'file' && $data->value != 'Kosong') {

                        array_push($rawCol, $data->form->name);
                        $isi[$data->form->name] = '
                    <a class="btn btn-sm btn-success" href="' . asset("storage/" . $data->files->first()->link) . '" target="_blank">Lihat</a>
                      ';

                    } else {
                        $isi[$data->form->name] = $data->value;
                    }

                    $i++;
                }
                // $isi['identity'] = "de";
                $items->push($isi);
            }

            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm m-1"  onclick="deleteRespon(`' . $item['identity'] . '`)"><i class="fa fa-trash"></i></span></a>
                           ';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns($rawCol)
                ->make(true);
        }
        return response()->json(['message', 'success']);

    }

    public function deleteForm($id)
    {
        $item = Form::where('id', $id)->first();
        $item->delete();
        return response()->json(['message', 'Success Delete !']);

    }
    public function deleteResponden($identity)
    {
        $item = FormResult::where('identity', $identity)->get();
        foreach ($item as $data) {
            if (count($data->files) > 0) {
                if (count($data->files) > 0) {
                    foreach ($data->files as $value) {
                        $id = $value->id;
                        $img = File::find($id);
                        if (Storage::exists("public/" . $img->link)) {
                            Storage::delete("public/" . $img->link);
                            $img->delete();
                        }

                    }

                }
            }
            $data->delete();
        }
        return response()->json(['message', 'Success Delete !']);
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
        $data = Event::where('slug', $event)->first();
        $item = Subevent::create($request->except(['_token', '_method', 'file', 'rolebook']) + ['event_id' => $data->id, 'slug' => Str::of($request->name)->slug('-') . '-' . $data->name,
        ]);
        $item->save();
        if ($request->file('file')) {
            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->encode('png', 100);
            $namePath = "subevent";
            $path = $namePath . "/" . $name_picture;

            Storage::put("public/" . $path, $picture);
        }
        if ($path != null) {
            $item->files()->create(['link' => $path, 'type' => 'image']);
        }

        if ($request->file('rolebook')) {
            $namePath = "rolebook";
            $path = $namePath . "/" . $item->slug . '.pdf';
            $request->file('rolebook')->storeAs($namePath, $item->slug . '.pdf', 'public');
        }
        if ($path != null) {
            $item->files()->create(['link' => $path, 'type' => 'rolebook']);
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
        $item->description = $request->description;
        $item->end_regist = $request->end_regist;
        $item->slug = Str::of($request->name)->slug('-');
        $item->save();

        if ($request->file('file')) {
            if ($item->files->where('type', 'image')->first() != null) {
                $id = $item->files->where('type', 'image')->first()->id;
                $img = File::where('id', $id)->first();
                if (Storage::exists("public/" . $img->link)) {
                    Storage::delete("public/" . $img->link);
                    $img->delete();
                }

            }
            $name_picture = Str::random(6) . '.png';
            $picture = Image::make($request['file'])->encode('png', 100);
            $namePath = "subevent";
            $path = $namePath . "/" . $name_picture;

            Storage::put("public/" . $path, $picture);
        }
        if ($path != null) {
            $item->files()->create(['link' => $path, 'type' => 'image']);
        }

        if ($request->file('rolebook')) {
            if ($item->files->where('type', 'rolebook')->first() != null) {
                $id = $item->files->where('type', 'rolebook')->first()->id;
                $img = File::where('id', $id)->first();
                if (Storage::exists("public/" . $img->link)) {
                    Storage::delete("public/" . $img->link);
                    $img->delete();
                }
            }

            $namePath = "rolebook";
            $path = $namePath . "/" . $item->slug . '.pdf';
            $request->file('rolebook')->storeAs($namePath, $item->slug . '.pdf', 'public');
        }
        if ($path != null) {
            $item->files()->create(['link' => $path, 'type' => 'rolebook']);
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
            if (count($item->files) > 0) {
                foreach ($item->files as $value) {
                    $id = $value->id;
                    $img = File::find($id);
                    if (Storage::exists("public/" . $img->link)) {
                        Storage::delete("public/" . $img->link);
                        $img->delete();
                    }

                }

            }
        }
        $item->delete();
        return response()->json(['message', 'deleted success']);
    }
}
