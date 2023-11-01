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
        $feedbackDoc = Feedback::where('feedback_docnum', $feedback->feedback_docnum)->first();

        // Update all chats where feedback_id matches and set is_read to true
        Chat::where('feedback_id', $feedbackDoc->id)
            ->where('user_id', '!=', auth()->user()->id)
            ->update(['is_read' => true]);

        $chats = Chat::where('feedback_id', $feedbackDoc->id)->get();

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
                'staff_id' => $feedback->user_id,
                'message' => $textMessage,
                'message_type' => 'text',
            ]);
        } elseif ($messageType === 'image') {
            // Handle image message
            $imageFile = $request->file('theimage');
            $nama_file = rand() . $imageFile->getClientOriginalName();
            $imageFile->move('images', $nama_file);
            $imagePath = 'images/' . $nama_file;

            // Save the image message to the 'message' and 'image_path' fields in the database
            Chat::create([
                'feedback_id' => $feedbackId,
                'user_id' => auth()->user()->id,
                'staff_id' => $feedback->user_id,
                'message' => 'image', // You can set a default message or leave it empty
                'message_type' => 'image',
                'image_path' => $imagePath,
                'is_read' => false,
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
