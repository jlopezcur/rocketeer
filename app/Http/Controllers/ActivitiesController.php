<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Activity;

class ActivitiesController extends Controller
{

    public function index(Request $request)
    {
        $activities = Activity::with(['user', 'subject'])
            ->filterProject($request->get('project_id'))
            ->filterUser($request->get('user_id'))
            ->latest()
            ->paginate(50);
        //if ($request->isAjax()) return $activities;
        return view('activities.index', compact('activities'));
    }

}
