<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    function get_articles($newsId)
    {
        $articles = Article::where('news_id', $newsId)->latest()->get();

        return response()->json([
            "articles" => $articles
        ]);
    }

    function get_article($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                "message" => "Article not found"
            ], 404);
        }

        return response()->json([
            "article" => $article
        ]);
    }

    function create_article(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'news_id' => 'required'
        ]);

        $article = Article::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'news_id' => $validatedData['news_id'],
            'user_id' => 1
        ]);

        return response()->json([
            "new_article" => $article
        ], 201);
    }
}