<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest; // useする

class PostController extends Controller
{
	public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
	{
	    return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);//$postの中身を戻り値にする。
	}
	
	public function show(Post $post)
	{	
		return view('posts.show')->with(['post' => $post]);
 //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
	}
	
	public function create()
	{
		return view('posts.create');
	}
	
	public function store(Post $post, PostRequest $request) // 引数をRequestからPostRequestにする
	{	
	    $input = $request['post'];
	    $post->fill($input)->save();
	    return redirect('/posts/' . $post->id);
	}
	
	public function edit(Post $post)
	{
	    return view('posts.edit')->with(['post' => $post]);
	}
	
	public function update(PostRequest $request, Post $post)
	{
	    $input_post = $request['post'];
	    $post->fill($input_post)->save();
	
	    return redirect('/posts/' . $post->id);
	}
}