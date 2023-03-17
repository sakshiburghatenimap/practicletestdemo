<?php

namespace App\Http\Controllers;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reminders = Reminder::latest()->paginate(5);
      
        return view('reminders.index',compact('reminders'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reminders.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'datetime' => 'required',

        ]);
      
        Reminder::create($request->all());
       
        return redirect()->route('reminders.index')
                        ->with('success','Reminder created successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reminder $reminder)
    {
        return view('reminders.show',compact('reminder'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reminder $reminder)
    {
        return view('reminders.edit',compact('reminder'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reminder $reminder)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'datetime' => 'required',

        ]);
      
        $reminder->update($request->all());
      
        return redirect()->route('reminders.index')
                        ->with('success','Reminder updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
       
        return redirect()->route('reminders.index')
                        ->with('success','Reminder deleted successfully');

    }
}
