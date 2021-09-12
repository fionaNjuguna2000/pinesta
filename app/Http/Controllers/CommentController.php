<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $comment =new Comment();
        $comment->user_id=Auth::id();
        $comment->product_id=$request->get('product_id');
        $comment->comment=$request->get('comment');
        $comment->rating=$request->get('rating');
        $comment->save();

        toastSuccess('Comment posted successfully');
        return  back();
    }

    public function moderate()
    {

        $data['title'] = "Moderate Comments";
        $data['comments']=Comment::with(['user','product'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('backend.admin.comments.moderate',['data' => $data]);
    }

    public function active(Comment $comment)
    {
        $comment->update(['status' => 'active']);
        toastInfo('update successful');
        return back();

    }

    public function inactive(Comment $comment)
    {
        $comment->update(['status' => 'inactive']);
        toastInfo('update successful');
        return back();

    }

    public function destroy (Comment $comment)
    {
        $comment->delete();
        toastError('comment deleted');
        return back();
    }

}
