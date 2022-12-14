<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get user posts then merge with followings posts otherwise return empty array.
        $myPosts = Auth::user()->posts()->with('user')->orderBy('created_at', 'desc')->get();
        $followingsPosts = Post::whereIn('user_id', Auth::user()->following->pluck('id'))
                                  ->with('user')
                                  ->orderBy('created_at', 'desc')
                                  ->get();
        return $myPosts->merge($followingsPosts) ?? [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create(
            $request->merge(
                [
                  'user_id' => auth()->id(),
                ]
            )->all()
        );
        $post->load('user');
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post->user_id === auth()->id()
        ? $post
        : response()->json(['message' => 'Unauthorized.'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response(null, 204);
    }
}
