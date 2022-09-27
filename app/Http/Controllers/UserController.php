<?php
/*
  Resource collections must be used, but excuse time :)
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{

    /**
     * Get the current logged-in user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function current(Request $request)
    {
        return [
          'user' => Auth::user(),
        ];
    }

    /**
     * Get the current logged-in user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        return User::all(); // Can't be done like this in real projects.
    }

    /**
     * Posts of a user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function posts(Request $request)
    {
        return Auth::user()->posts;
    }

    /**
     * Follow a user.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $user_id
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request, $user_id)
    {
        User::findOrFail($user_id)->followers()->syncWithoutDetaching([Auth::user()->id]);
        return Auth::user()->following;
    }


    /**
     * Unfollow a user.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $user_id
     * @return \Illuminate\Http\Response
     */
    public function unfollow(Request $request, $user_id)
    {
        User::findOrFail($user_id)->followers()->detach(Auth::user()->id);
        return Auth::user()->following;
    }

    /**
     * Get followers.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function followers(Request $request)
    {
        return Auth::user()->followers;
    }

    /**
     * Get followings.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function followings(Request $request)
    {
        return Auth::user()->following;
    }

    /**
     * Get followings posts.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function followingsPosts(Request $request)
    {
        $myPosts = Auth::user()->posts()->with('user')->orderBy('created_at', 'desc')->get();
        $followingsPosts = Post::whereIn('user_id', Auth::user()->following->pluck('id'))->with('user')->orderBy('created_at', 'desc')->get();
        return $myPosts->merge($followingsPosts) ?? [];
    }
}
