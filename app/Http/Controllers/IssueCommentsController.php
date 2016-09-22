<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\IssueComment;

use Auth;

class IssueCommentsController extends Controller {

    public function store(Request $request, IssueComment $issue_comment) {
		$params = $request->all();
		$params['user_id'] = Auth::user()->id;
		$issue_comment->create($params);
		return back();
    }

}
