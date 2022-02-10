<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subevent;
use Illuminate\Http\Request;

class ResultFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Subevent::where('status', 1)->first()->events;

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
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
