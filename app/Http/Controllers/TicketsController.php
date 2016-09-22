<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\User;

class TicketsController extends Controller
{

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Ticket $ticket)
    {
        $tickets = $ticket->orderBy('updated_at', 'desc')->paginate(12);
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Ticket $ticket)
    {

		$users = User::orderBy('name', 'asc')->lists('name','id');
        return view('tickets.create', compact('ticket', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, Ticket $ticket)
    {

		$new = $ticket->create($request->all());
		return redirect()->route('tickets.show', ['ticket' => $new->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Ticket $ticket)
    {
		return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Ticket $ticket)
    {
		$users = User::orderBy('name', 'asc')->lists('name','id');
		return view('tickets.edit', compact('ticket', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Ticket $ticket)
    {
		$ticket->fill($request->input())->save();
		return redirect()->route('tickets.show', $ticket->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
		$ticket->delete();
		return redirect()->route('tickets.index');
    }
}
