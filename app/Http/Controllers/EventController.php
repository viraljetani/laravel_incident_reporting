<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session;
use App\Event;
use Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $rules = array(
            'title'       => 'required'            
        );

        $validator = Validator::make($request->all(), $rules);


        // proceed to create
        if ($validator->fails()) {
            return Redirect::to('events/create')
                ->withErrors($validator);
        } else {
            // store
            $event = new Event;
            $event->title       = $request->title;
            $event->description      = $request->description;
            //$nerd->nerd_level = Input::get('nerd_level');
            $event->save();

            // redirect
            $request->session()->flash('message', 'Event was created!');
            return redirect()->to('events');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        // validate
        $rules = array(
            'title' => 'required'            
        );

        $validator = Validator::make($request->all(), $rules);


        // proceed to create
        if ($validator->fails()) {
            return Redirect::to('events/' . $event . '/edit')
                ->withErrors($validator);
        } else {
            // store
            //$event = new Event;
            $event->title       = $request->title;
            $event->description      = $request->description;
            //$nerd->nerd_level = Input::get('nerd_level');
            $event->save();

            // redirect
            $request->session()->flash('message', 'Event was updated!');
            return redirect()->to('events');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        $event->delete();
        // redirect
        $request->session()->flash('message', 'Event was deleted!');
        return redirect()->to('events');
    }
}
