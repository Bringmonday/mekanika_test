<?php

namespace App\Http\Controllers;

use App\Models\InputPart;
use App\Models\ModelPart;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InputPartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelNames = ModelPart::distinct()->pluck('model_name');
        return view('produksi.part', compact('modelNames'));
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
            'part_name' => 'required|string|max:255',
            'part_code' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'image_illus_fix' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_illus_move' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_illus_core' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qty_in_cart' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);
        
        $imagePathFix = $request->file('image_illus_fix')->store('images', 'public');
        $imagePathMove = $request->file('image_illus_move')->store('images', 'public');
        $imagePathCore = $request->file('image_illus_core')->store('images', 'public');
        $imageBlob = $request->file('image_illus_fix')->getClientOriginalExtension(); 

        InputPart::create([
            'model_name' => $validated['model_name'],
            'part_name' => $validated['part_name'],
            'part_code' => $validated['part_code'],
            'part_number' => $validated['part_number'],
            'image_illus_fix' => $imagePathFix, 
            'image_illus_move' => $imagePathMove, 
            'image_illus_core' => $imagePathCore, 
            'image_blob' => $imageBlob,
            'qty_in_cart' => $validated['qty_in_cart'],
            'is_active' => $validated['is_active'],
        ]);
        
        return response()->json(['success' => 'Model berhasil ditambahkan.']);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(InputPart $InputPart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = InputPart::find($id);
        return response()->json($model);
    }

    public function update(Request $request)
    {
        $request->validate([
            'model_id' => 'required|integer',
            'model_name' => 'required|string|max:255',
            'part_name' => 'required|string|max:255',
            'part_code' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'image_illus_fix' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_illus_move' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_illus_core' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qty_in_cart' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);
    
        $model = InputPart::find($request->model_id);
        $model->model_name = $request->model_name;
        $model->part_name = $request->part_name;
        $model->part_code = $request->part_code;
        $model->part_number = $request->part_number;
    
        if ($request->hasFile('image_illus_fix')) {
            $imagePathFix = $request->file('image_illus_fix')->store('images', 'public');
            $imagePathMove = $request->file('image_illus_move')->store('images', 'public');
            $imagePathCore = $request->file('image_illus_core')->store('images', 'public');
            $imageBlob = $request->file('image_illus_fix')->getClientOriginalExtension();
            $model->image_illus_fix = $imagePathFix;
            $model->image_illus_move = $imagePathMove;
            $model->image_illus_core = $imagePathCore;
            $model->image_blob = $imageBlob; 
        }
    
        $model->qty_in_cart = $request->qty_in_cart;
        $model->is_active = $request->is_active;
        $model->updated_at = now(); 
        $model->save();
        
        return response()->json(['success' => 'Data berhasil diupdate!']);
    }
    
    

    public function destroy($id)
    {
        $model = InputPart::find($id);
        $model->is_active = 0; 
        $model->save();

        return response()->json(['success' => 'Data berhasil dinonaktifkan!']);
    }

    public function anyData()
    {
        return DataTables::of(InputPart::all())->make(true);
    }

    public function getModels(Request $request)
    {
        // Retrieve the fields specified in the InputPart model.
        $spareparts = InputPart::select('id','model_name' ,'part_name', 'part_code', 'part_number', 'qty_in_cart', 'is_active')->get();
    
        return DataTables::of($spareparts)
            ->addColumn('action', function($row) {
                // Define buttons for editing and deleting models with their respective IDs.
                return '<button class="btn btn-sm btn-primary edit-model" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-model" data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i>
                        </button>';
            })
            // Enable raw HTML for action buttons.
            ->rawColumns(['action'])
            // Return the response in JSON format.
            ->make(true);
    }
    
    
       
}
