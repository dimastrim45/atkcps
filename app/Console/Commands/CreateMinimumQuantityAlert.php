<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Feedback;
use App\Models\Chat;
use App\Models\Item;
use Carbon\Carbon;

class CreateMinimumQuantityAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:create-minimum-quantity-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        // Create a new feedback with the topic "Minimum Quantity Alert"
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

        $feedback = new Feedback();
        $feedback->user_id = 1; // Replace with the desired user's ID
        $feedback->DocId = $nextID;
        $feedback->feedback_docnum = $currentYear . $currentMonth . $formattedID;
        $feedback->docdate = $currentDate;
        $feedback->duedate = now()->addDays(3)->format('Y-m-d');
        $feedback->topic = 'Minimum Quantity Alert';
        $feedback->status = 'Open';
        $feedback->is_read = false;
        $feedback->save();

        // Count items with qty <= min_qty
        $itemCount = Item::where('qty', '<=', 'min_qty')->count();

        if ($itemCount > 0) {
            // Create a chat entry with the item count and a link
            $chat = new Chat();
            $chat->feedback_id = $nextID;
            $chat->user_id = 1;
            $chat->staff_id = 1;
            // $chat->message = "Low quantity alert for $itemCount items below the minimum threshold. Click this <a href='http://127.0.0.1:8000/reports'>link</a> for more details.";
            // Use the route function to generate the URL for the 'minimumqty-report' route
            $routeUrl = route('minimumqty-report');
            $chat->message = "Low quantity alert for $itemCount items below the minimum threshold. Click this <a href='$routeUrl'>link</a> for more details.";
            $chat->message_type = 'text';
            $chat->save();
        }

        \Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));
        \Log::info("ID Feedback - " . $nextID);
    }
}
