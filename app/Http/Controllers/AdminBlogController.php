<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'blogs'=>Blog::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.create', [
            'categories'=>Category::all()
        ]);
    }

    public function store()
    {
        $formData = request()->validate([
            "title" => ['required',Rule::unique('blogs', 'title')],
            "slug" => ['required',Rule::unique('blogs', 'slug')],
            "intro" => ['required'],
            "body" => ['required'],
            "category_id" => ['required',Rule::exists('categories', 'id')]
        ]);
        $formData['user_id'] = auth()->id();

        if (request('thumbnail') !== null) {
            $formData['thumbnail'] = request()->file('thumbnail')->store('Thumbnails');
        }

        Blog::create($formData);

        return back()->with('uploded', $formData['title']." is Successfully Uploded");
    }

    public function blogPublishHandler(Blog $blog)
    {
        if ($blog->isShow) {
            DB::table('blogs')->where('slug', $blog->slug)->update([
                'isShow' => false
            ]);
            return back();
        } else {
            DB::table('blogs')->where('slug', $blog->slug)->update([
                'isShow' => true
            ]);
            return back()->with('publish', $blog->title." is Published");
        }
    }

    public function create_category()
    {
        return view("admin.create_category", [
            'categories'=>Category::latest()->get()
        ]);
    }

    public function store_category()
    {
        $formData = request()->validate([
            "name" => ['required',Rule::unique('categories', 'name')],
            "slug" => ['required',Rule::unique('categories', 'slug')],
        ]);

        Category::create($formData);

        return back()->with('addCategory', $formData['name']." is Successfully Added");
    }

    public function destroy_category(Category $category)
    {
        $category->delete();

        return back()->with('delete', $category->name." is Delete Successfully");
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return back()->with('delete', $blog->title." is Delete Successfully");
    }

    public function users_index()
    {
        return view('admin.users_index', [
            'users' => User::latest()->get()
        ]);
    }

    public function destroy_user(User $user)
    {
        $user->delete();
        return back()->with('delete', $user->name." is Delete Successfully");
    }

    public function update(Blog $blog)
    {
        return view('admin.update', [
            'categories' => Category::all(),
            'blog' => $blog
        ]);
    }

    public function post_update(Blog $blog)
    {
        $formData = request()->validate([
            "title" => ['required'],
            "slug" => ['required'],
            "intro" => ['required'],
            "body" => ['required'],
            "category_id" => [Rule::exists('categories', 'id')]
        ]);

        $formData['user_id'] = Auth::user()->id;

        if (request('thumbnail') !== null) {
            $formData['thumbnail'] = request()->file('thumbnail')->store('Thumbnails');
        } else {
            if (!request('useOldThumbnail')) {
                $formData['thumbnail'] = $blog->thumbnail;
            } else {
                $formData['thumbnail'] = null;
            }
        }

        // dd($formData);

        DB::table('blogs')->where('slug', $blog->slug)->update($formData);

        return back()->with('updated', $formData['title'].' is updated Successfully');
    }
}
