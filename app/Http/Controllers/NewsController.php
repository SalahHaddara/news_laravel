<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    function get_news()
    {
        $news = News::latest()->get();

        return response()->json([
            "news" => $news
        ]);
    }

    function get_news_item($id)
    {
        $news = News::find($id);

        return response()->json([
            "news" => $news
        ]);
    }

    function create_news(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'age_restriction' => 'nullable'
        ]);

        $news = News::create($validated);

        return response()->json([
            "new_news" => $news
        ], 201);
    }

    function update_news($id, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'age_restriction' => 'nullable'
        ]);

        $news = News::find($id)->update($validated);

        return response()->json([
            "updated_news" => $news
        ]);
    }

    function delete_news($id)
    {
        $news = News::find($id)->delete();

        return response()->json([
            "deleted_news" => $news
        ]);
    }
}