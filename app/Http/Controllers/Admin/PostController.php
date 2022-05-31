<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
use Psy\Util\Str;

class PostController extends Controller
{
    use \App\Traits\searchFilters;
    private function getValidators($model) {
        return [
            // 'user_id'   => 'required|exists:App\User,id',
            'title'     => 'required|max:100',
            'slug'      => [
                'required',
                Rule::unique('posts')->ignore($model),
                'max:100'
            ],
            // 'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:App\Category,id',
            'content'     => 'required',
            'tags'        => 'array|exists:App\Tag,id',
        ];
    }

    public function index(Request $request)
    {
        $posts = $this->composeQuery($request);

        $posts = $posts->paginate(20);

        $queries = $request->query();
        unset($queries['page']);
        $posts->withPath('?' . http_build_query($queries, '', '&'));



        $categories = Category::all();
        $users = User::all();

        return view('admin.posts.index', [
            'posts'      => $posts,
            'categories' => $categories,
            'users'      => $users,
            'request'    => $request
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create',  compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate($this->getValidators(null));

        $data = $request->all();

        $img_path = Storage::put('uploads', $data['image']);

        $formData = [
            'user_id' => Auth::user()->id,
            'image' => $img_path
        ] + $data;



        preg_match_all('/\#(\S*)\b/', $formData['content'], $tags_from_content);

        foreach ($tags_from_content[1] as $tag) {
            $newTags = Tag::create([
                'name' => ucfirst(strtolower($tag)),
                'slug' => strtolower($tag)
            ]);
            $tagIds[] = $newTags->id;

        }

        if(isset($tagIds)) {
            $formData['tags'] = $tagIds;

            Tag::create(array_map(function($tag) {
                return ['name' => $tag];
            }, $tags_from_content[1]));
        }

        $post = Post::create($formData);
        $post->tags()->attach($formData['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->getValidators($post));

        $formData = $request->all();

        if(array_key_exists('image', $formData)) {
            Storage::delete($post->image);
            $img_path = Storage::put('uploads', $formData['image']);
            $formData = [
                'image' => $img_path
            ] + $formData;
        }

        $post->update($formData);
        if( array_key_exists('tags', $formData)) {
            $post->tags()->sync($formData['tags']);
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
