<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
use PhpParser\Node;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $notes = Note::orderBy('id', 'DESC')->paginate(8);
        return view('backend.notes.list',compact('notes'));
    }

    public function Favourite(Request $request){
       if($request->id ==true){
           $note = Note::find($request->id);
           $favourite = $note->favourite;
           if($favourite == 1){
               $data = [
                   'favourite' => 0
               ];
               $note->fill($data);
               $note->save();
           }
           else{
               $data = [
                   'favourite' => 1
               ];
               $note->fill($data);
               $note->save();
           }
           $notes = Note::orderBy('id', 'DESC')->get();
           echo json_encode($notes);
       }
       else if($request->favourite == true){
           $notes = Note::where('favourite',1)->orderBy('id', 'DESC')->get();
           echo json_encode($notes);
       }
       else if($request->favouriteAll == 0){
           $notes = Note::orderBy('id', 'DESC')->get();
           echo json_encode($notes);
       }

    }
    public function tags(Request $request){
        if($request->personn == true){
            $notes = Note::where('status',$request->personn)->orderBy('id', 'DESC')->get();
            echo json_encode($notes);
        }
    }

    public function status(Request $request){
        if($request->status == true && $request->id ==true){
            $note = Note::find($request->id);
            $data=[
                'status' => $request->status
            ];
            $note->fill($data);
            $note->save();
            $notes = Note::orderBy('id', 'DESC')->get();
            echo json_encode($notes);
        }
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
        if($request->title == true){
            $note = new Note();
            $datetime = Carbon::now('Asia/Ho_Chi_Minh');
            $data = [
                'title'=>$request->title,
                'short'=>$request->short,
                'status'=>0,
                'favourite'=>0,
                'created_at' =>$datetime
            ];
            $note->fill($data);
            $note->save();
            echo json_encode($note);
//            return response()->json(['data'=>$note]);
//
        }
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

//        echo json_encode($notes);
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
    public function destroy(Request $request)
    {
        //
        $note = Note::find($request->id)->delete();
        $notes = Note::orderBy('id', 'DESC')->get();
        echo json_encode($notes);
    }
}
