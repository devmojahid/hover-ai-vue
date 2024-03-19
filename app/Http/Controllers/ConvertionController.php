<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use OpenAI;

class ConvertionController extends Controller
{
    public function convertion()
    {
        return Inertia::render('Convertion');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'data' => 'required|string|max:255|min:3',
        ]);
        
        $client = OpenAI::client(config('openai.open_ai_key'));

        // $response = $client->completions()->create([
        //     'model' => 'gpt-3.5-turbo-instruct',
        //     'prompt' => $request->data,
        //     'max_tokens' => 60,
        //     'temperature' => 0
        // ]);
        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $request->data],
            ],
        ]);
        
        foreach ($response->choices as $choice) {
            $response = $choice->message->content;
        }
        

        return response()->json($response);
    }
}