<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Feedback;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Feedback $feedback)
    {
        //
        // dd($feedback);
        // $chats = Chat::paginate(20);
        $feedbackDoc = Feedback::where('feedback_docnum', $feedback->feedback_docnum)->first();
        $chats = Chat::where('feedback_id', $feedbackDoc->id)->get();
        // dd($feedbackDoc);

        return view('it_admin.feedback-chat',[
            "title" => 'chats',
            "chats" => $chats,
            "feedback" => $feedbackDoc,
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
    public function store(StoreChatRequest $request)
    {
        //
        // dd($request);
        // Validate and save the message based on the message type
        $feedbackId = $request->input('feedback_id');
        $messageType = $request->input('message_type');

        $feedback = Feedback::where('id', $request->input('feedback_id'))->first();

        if ($messageType === 'text') {
            // Handle text message
            $textMessage = $request->input('message');
            
            // Save the text message to the 'message' field in the database
            Chat::create([
                'feedback_id' => $feedbackId,
                'user_id' => auth()->user()->id, // Assuming you have user authentication
                'message' => $textMessage,
                'message_type' => 'text',
            ]);
        } elseif ($messageType === 'image') {
            // Handle image message
            $imagePath = $request->file('image')->store('images'); // Store the image and get the path
            
            // Save the image message to the 'message' and 'image_path' fields in the database
            Chat::create([
                'feedback_id' => $feedbackId,
                'user_id' => auth()->user()->id, // Assuming you have user authentication
                'message' => 'image', // You can set a default message or leave it empty
                'message_type' => 'image',
                'image_path' => $imagePath,
            ]);
        }

        return redirect(route('chat', ['feedback' => $feedback->feedback_docnum]));

        // Additional code to handle redirects or responses
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
