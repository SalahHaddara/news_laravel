<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(): JsonResponse
    {
        $news = News::all();
        return response()->json($news);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'age_restriction' => 'nullable|integer',
            'attachment' => 'nullable|file'
        ]);

        $news = new News($request->except('attachment'));

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('news_attachments', 'public');
            $news->attachment = $path;
        }

        $news->save();
        return response()->json($news, 201);
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'age_restriction' => 'nullable|integer',
            'attachment' => 'nullable|file'
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('news_attachments', 'public');
            $news->attachment = $path;
        }

        $news->update($request->except('attachment'));
        return response()->json($news);
    }

    public function destroy(News $news)
    {
        $news->delete();
        return response()->json("deleted_course");
    }
}
