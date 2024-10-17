<?php

namespace App\Http\Controllers;

use App\Models\ModelPart;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ModelPartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('produksi.model');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'model_name' => 'required|string|max:255',
            'model_description' => 'required|string',
            'is_active' => 'required|boolean',
        ]);
    
        ModelPart::create($validated);
    
        return response()->json(['success' => 'Model berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelPart $modelPart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = ModelPart::find($id);
        return response()->json($model);
    }

    public function update(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string|max:255',
            'model_description' => 'required|string|max:255',
        ]);

        $model = ModelPart::find($request->model_id);
        $model->model_name = $request->model_name;
        $model->model_description = $request->model_description;
        $model->updated_at = now(); 
        $model->save();

        return response()->json(['success' => 'Data berhasil diupdate!']);
    }

    public function destroy($id)
    {
        $model = ModelPart::find($id);
        $model->is_active = 0; 
        $model->save();

        return response()->json(['success' => 'Data berhasil dinonaktifkan!']);
    }

    public function anyData()
    {
        return DataTables::of(ModelPart::all())->make(true);
    }

    public function getModels(Request $request)
    {
        $spareparts = ModelPart::select('id', 'model_name', 'model_description', 'is_active')->get();
    
        return DataTables::of($spareparts)
            ->addColumn('action', function($row) {
                return '<button class="btn btn-sm btn-primary edit-model" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger delete-model" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
       
}
