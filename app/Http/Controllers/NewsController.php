<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index()
    {
        $apiKey = config('services.newsapi.key');
        $url = 'https://newsapi.org/v2/everything';
        $client = new Client();

        try {
            $response = $client->request('GET', $url, [
                'query' => [
                    'q' => 'fitness OR nutrition OR "healthy lifestyle" OR diet OR obesity',
                    'language' => 'id',
                    'sortBy' => 'publishedAt',
                    'pageSize' => 6,
                    'apiKey' => $apiKey,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                $body = json_decode($response->getBody(), true);
                $articles = $body['articles'] ?? [];
            } else {
                Log::error('News API returned status code: ' . $statusCode);
                $articles = [];
            }
        } catch (\Exception $e) {
            Log::error('News API Error: ' . $e->getMessage());
            $articles = [];
        }

        return view('welcome', ['articles' => $articles]);
    }
}
