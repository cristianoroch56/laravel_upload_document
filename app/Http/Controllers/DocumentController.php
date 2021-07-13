<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function add_document(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $fileName = $request->file->getClientOriginalName();
        $request->file->move(public_path('uploads'), $fileName);
        $filePath = url('/uploads/'.$fileName);
        $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
        // dd($filename);
        $addDocument = new Document();
        $addDocument->name = $filename;
        $addDocument->file = $filePath;
        $addDocument->save();
        return response()->json(['status' => true, 'msg' => "file upload successfully."]);
    }
    public function get_document()
    {
        $getDocument = Document::get();
        return response()->json(['status' => true, 'data' => $getDocument]);
    }
}
