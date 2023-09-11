<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\DocumentUploads;
use DataTables;
use Storage;

class DocumentUploadController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function index()
    {
		
        return view('declarationupload.index');
    }

    public function store(Request $request)
    {
      
        $files = $request->file('attachment');
        $upload_data=[];
        if($request->hasFile('attachment'))
        {
            foreach ($files as $key => $file) {
                $filename = null;
                $fileTime = time().'.'.$key;
                $filename = $fileTime.'.'.$file->extension();
                $file->move(public_path('adharcardupload'), $filename);
                $path ='adharcardupload/'.$filename;
                $upload_data[] = [
                    'file_name' => $fileTime,
                    'file' => $path,
                    'status' => 'draft',
                    'draft_user_id' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
        }
            $data = array_values($upload_data);
			$bulk_uplaod_data = array_chunk($data, 50);
		    foreach($bulk_uplaod_data as $upload){
                $declarationUploads =DocumentUploads::insert($upload);
		    }

           

        $request->session()->flash('message','Uploaded successfully!');
        return redirect('/declaration/upload')->with(['status'=>200]);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
        $declarationUploads = DocumentUploads::with('draftuser', 'prooftuser', 'finalproofuser')->get();
        return DataTables::of($declarationUploads)->toJson();
        }
        return view('declarationupload.show');
    }

    public function destroy(Request $request)
    {
        $Stores = DocumentUploads::where('Id',$request->id)->delete(); 
		// $request->session()->flash('message','Deleted successfully.');
        return Response()->json(['status'=>200]);  
    }

    public function declarationStatusChange(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'id'=>'required', 
            'status'=>'required',
        ]
        );
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } 
        $validate = $validator->valid();
        $update = [
            'status' => $validate['status'],
            'proofed_user_id' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if($validate['status'] =="proofed"){
            $update['proofed_user_id'] = auth()->user()->id;
        }
        if($validate['status'] =="final_proofed"){
            $update['final_proofed_user_id'] = auth()->user()->id;
        }
        DocumentUploads::where('id',$validate['id'])  
		->update( $update);
        // $request->session()->flash('message','Status Updated Successfully!');
        return Response()->json(['status'=>200]);  
    }

    public function declarationTypeChange(Request $request)
    {
        if($request->has('id')){
            DocumentUploads::where('id', $request->id)  
            ->update( [
            'type' => $request->type,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        }
        // $request->session()->flash('message','Type Change Successfully!');
        return Response()->json(['status'=>200]);
    }

    public function renameUpload(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'file_name'=>'required|unique:document_uploads', 
        ]
        );
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } 
        $validate = $validator->valid();

        $oldimage = DocumentUploads::where('Id',$validate['id'])->first(); 
        $explodeimage = explode("/", $oldimage->file);
        $extension = pathinfo($explodeimage[1], PATHINFO_EXTENSION);
        
        $oldPath = public_path().DIRECTORY_SEPARATOR.'adharcardupload'.DIRECTORY_SEPARATOR.$explodeimage[1]; // Path to the old PDF

        $newPath = public_path().DIRECTORY_SEPARATOR."adharcardupload".DIRECTORY_SEPARATOR . $validate['file_name'].".".$extension; // Path to the new PDF
      
        if (file_exists($oldPath)) {
            rename($oldPath, $newPath);
            DocumentUploads::where('id', $validate['id'])  
            ->update( [
            'file_name' => $validate['file_name'],
            'file' => 'adharcardupload/' . $validate['file_name'].'.pdf',
            'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        // $request->session()->flash('message','File Rename Successfully!');
        return Response()->json(['status'=>200]);
    
    }
}