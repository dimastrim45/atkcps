<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->license !== 'staff') {
            $feedbacks = Feedback::paginate(20);
        } else {
            $feedbacks = Feedback::where('user_id', auth()->user()->id)->paginate(20);
        }

        return view('it_admin.feedback-index',[
            "title" => 'feedbacks',
            "feedbacks" => $feedbacks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackRequest $request)
    {
        //
        // dd($request);
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        $latestFeedback = Feedback::orderBy('created_at', 'desc')->first();

        if ($latestFeedback) {
            // Extract the current month and year from the created_at timestamp
            $storedMonth = date('m', strtotime($latestFeedback->created_at));
            $storedYear = date('Y', strtotime($latestFeedback->created_at));

            if ($currentYear != $storedYear || $currentMonth != $storedMonth) {
                // If the current month and year are different, reset DocId to 1
                $nextID = 1;
            } else {
                // Increment the maximum DocId within the current month and year by 1
                $nextID = $latestFeedback->DocId + 1;
            }
        } else {
            // If there are no existing records, start with DocId 1
            $nextID = 1;
        }

        // Format the next ID as a three-digit string (e.g., 001)
        $formattedID = str_pad($nextID, 3, '0', STR_PAD_LEFT);

        $currentDate = Carbon::now()->format('Y-m-d');

        // Calculate the due date by adding 3 days to the current date
        $dueDate = Carbon::parse($currentDate)->addDays(3)->format('Y-m-d');

        $feedback = new Feedback();
        $feedback->user_id = auth()->user()->id; // Use auth()->user()->id to get the user's ID
        $feedback->DocId = $nextID;
        $feedback->feedback_docnum = $currentYear . $currentMonth . $formattedID;
        $feedback->docdate = $currentDate;
        $feedback->duedate = $dueDate;
        $feedback->topic = $request->input('topic');
        $feedback->status = "Open";
        $feedback->is_read = false;
        
        // Save the feedback record to the database
        $feedback->save();

        return redirect()->route('feedbacks')->with('success', 'Feedback created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }

    public function close(Feedback $feedback)
    {
        //
        // $chats = Chat::paginate(20);
        $feedbackDoc = Feedback::where('feedback_docnum', $feedback->feedback_docnum)->update(['status' => 'Closed']);

        return redirect(route("feedbacks"))->with('success', 'Feedback Closed.');
    }
}
