<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Helpers\Slug;


class PostController extends Controller
{
      public $post;

    public function __construct(Post $post){
       $this->post=$post;
      }
    public function index()
    {
        $posts = $this->post::with('user:id,name,profile_photo_path')->approved()->paginate(2);
        $title = "جميع المنشورات ";
        return view ('index', compact('posts','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $this->validate($request , [
         'title' => 'required' ,
         'body'=>'required',
       ]);

       if($request->hasfile('image')){
         $file = $request->file('image');
         $filename = time() . $file->getClientOriginalName();
         $file->storeAs('public/images/', $filename);
       }

      $request->user()->posts()->create($request->all()+ ['image_path'=>$filename ?? 'default.jpg' ]+['slug' => $request->title]);
      return back()->with('success' , 'تم اضافة المنشور بنجاح سيظهر بعد انيوافق عليه المسئول');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post=$this->post::where('slug', $slug)->first();
        $comments=$post->comments->sortByDesc('created_at');
        return view('posts.show' , compact('post' , 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post=$this->post::find($id);
        return view('posts.edit' , compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
            $data = $this->validate($request, [
              'title' => 'required',
              'body' => 'required',
          ]);

          $data['slug'] = Slug::uniqueSlug($request->title,'posts');
          $data['category_id'] = $request->category_id;

          if($request->hasFile('image')) {
              $file = $request->file('image');
              $filename = time() . $file->getClientOriginalName();
              $file->storeAs('public/images/', $filename);
          }

          $request->user()->posts()->where('slug', $slug)->update($data + ['image_path'=> $filename ?? 'default.jpg']);

          return redirect(route('post.show', $data['slug']))->with('success', 'تم تعديل المنشور بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=$this->post::find($id);
        $post->delete();
        return back()->with('success' , 'تم حذف المنشور بنجاح');
    }

    public function search(Request $request){
        $posts = $this->post->where('body','LIKE', '%'.$request->keyword.'%')->with('user')->approved()->paginate(10);
        $title = "نتائج البحث عن :".$request->keyword;
        return view('index', compact('posts', 'title'));

    }

    public function getByCategory($id)
    {
      $posts = $this->post::with('user')->whereCategory_id($id)->approved()->paginate(10);
      $title = ":المنشورات العائدة للتصنيف".Category::find($id)->title;
      return view('index' , compact('posts' , 'title'));
    }
}
