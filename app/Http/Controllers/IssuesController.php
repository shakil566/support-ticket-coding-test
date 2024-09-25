<?php

namespace App\Http\Controllers;

use App\Events\IssueCreated;
use App\Events\IssueUpdated;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class IssuesController extends Controller
{

    public function index(Request $request)
    {
        // Fetch data with search and ordering scope applied
        $dataArr = Issue::orderBy('created_at', 'desc');
        if (auth()->user()->user_group == 2) {
            $dataArr = $dataArr->where('created_by', auth()->user()->id);
        }
        $dataArr = $dataArr->get();

        return view('issues.index', compact('dataArr'));
    }

    public function create()
    {
        // get the latest issue from the database based on the ticket number
        $latestIssue = Issue::orderBy('ticket_number', 'desc')->first();

        // if exists
        if ($latestIssue) {
            // extract the number from the ticket number like "ST-00001" get 1)
            $latestTicketNumber = intval(substr($latestIssue->ticket_number, 3));

            // increment by 1
            $newTicketNumber = $latestTicketNumber + 1;
        } else {
            // if no issues exist, start from 1
            $newTicketNumber = 1;
        }

        // format the new ticket number as "ST-00001"
        $ticketNumber = 'ST-' . str_pad($newTicketNumber, 5, '0', STR_PAD_LEFT);

        return view('issues.create', compact('ticketNumber'));
    }

    public function store(Request $request)
    {
        // validate data
        $request->validate([
            'address' => 'max:255',
            'details' => 'required|string',
        ]);

        //save the support ticket
        $issue = Issue::create([
            'user_id' => auth()->user()->id,
            'ticket_number' => $request->ticket_number,
            'address' => $request->address,
            'details' => $request->details,
            'status' => 'Open',
            'created_by' => auth()->user()->id,
        ]);

        // dispatch the event for issue created
        event(new IssueCreated($issue));

        return redirect()->route('issues')->with('success', 'Ticket created successfully!');
    }


    public function update(Request $request, Issue $issue)
    {

        // define validation rules and messages
        $rules = [
            'remarks' => 'required|string',
            'status' => 'required',
        ];

        $messages = [];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Response::json(array('success' => false, 'heading' => 'Validation Error', 'message' => $validator->errors()), 400);
        }

        $issue->remarks = $request->remarks;
        $issue->status = $request->status;
        $issue->save();

        //dispatch the event for issue updated
        event(new IssueUpdated($issue));

        return response()->json(['success' => true, 'message' => 'Ticket updated successfully.'], 200);
    }
}