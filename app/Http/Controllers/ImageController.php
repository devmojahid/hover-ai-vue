<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use OpenAI;

class ImageController extends Controller
{
    public function genaretImage(Request $request)
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
        // $response = $client->chat()->create([
        //     'model' => 'gpt-3.5-turbo',
        //     'messages' => [
        //         ['role' => 'user', 'content' => $request->data],
        //     ],
        // ]);

        $response = $client->images()->create([
            'model' => 'dall-e-3',
            'prompt' => 'A cute baby sea otter',
            'n' => 1,
            'size' => '1024x1024',
            'response_format' => 'url',
        ]);
        
        $response->created; // 1589478378
        
        foreach ($response->data as $data) {
            $data->url; // 'https://oaidalleapiprodscus.blob.core.windows.net/private/...'
            $data->b64_json; // null
        }
        

        return response()->json($response);
    }
}