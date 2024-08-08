<?php

namespace App\Http\Controllers;

use App\Mail\StudentApproved;
use App\Mail\StudentRejected;
use App\Models\StudentRequest;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        $studentrequest = StudentRequest::where('approved', False);
        $requests = StudentRequest::where('approved',FALSE)->get();
        return view('student_request.index', compact('requests','studentrequest'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studentrequest = StudentRequest::where('approved', False);
        return view('student_request.create',compact('studentrequest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'requesttext' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $studentRequest = new StudentRequest();
        $studentRequest->requesttext = $request->input('requesttext');
        $studentRequest->user_id = auth()->user()->id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $studentRequest->image = $image_name;

        }
        $studentRequest->save();
        return redirect()->route('posts.index')->with('success', 'Request created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function approve(StudentRequest $studentRequest)
    {
        $studentRequest->update(['approved' => true]);

        $studentRequest->user->update(['is_student' => true]);
        $user = User::where('id' , $studentRequest->user_id )->first();
        Mail::to($user->email)->send(new StudentApproved());
    
        return redirect()->route('requests.index')
            ->with('success', 'Approved successfuly');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentRequest $studentRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentRequest $studentRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentRequest $studentRequest)
    {
        $studentRequest->delete();
        $user = User::where('id' , $studentRequest->user_id )->first();
        Mail::to($user->email)->send(new StudentRejected());
        return redirect()->route('requests.index')
            ->with('success', 'Request Rejected Successfuly');
    }
}
