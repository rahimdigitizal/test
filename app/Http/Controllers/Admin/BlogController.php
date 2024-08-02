<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogSubCategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = app('site_global_settings');

        /**
         * Start SEO
         */
        SEOMeta::setTitle(__('seo.backend.admin.category.categories', ['site_name' => empty($settings->setting_site_name) ? config('app.name', 'Laravel') : $settings->setting_site_name]));
        SEOMeta::setDescription('');
        SEOMeta::setCanonical(URL::current());
        SEOMeta::addKeyword($settings->setting_site_seo_home_keywords);
        $data['blogs_count'] = Blog::count();
        $data['sub_categories'] = BlogCategory::all();
        $data['categories'] = BlogSubCategory::all();
        $data['blogs'] = Blog::latest()->paginate(10);
        return view('backend.admin.blogs.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = app('site_global_settings');

        /**
         * Start SEO
         */
        SEOMeta::setTitle(__('seo.backend.admin.category.categories', ['site_name' => empty($settings->setting_site_name) ? config('app.name', 'Laravel') : $settings->setting_site_name]));
        SEOMeta::setDescription('');
        SEOMeta::setCanonical(URL::current());
        SEOMeta::addKeyword($settings->setting_site_seo_home_keywords);
        $data['sub_categories'] = BlogSubCategory::all();
        $data['categories'] = BlogCategory::all();
        return view('backend.admin.blogs.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'status' => 'required',
            'image' => 'required | image',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->short_description = $request->short_description;
        $blog->content = $request->content;
        $blog->blog_category_id = $request->category_id;
        $blog->blog_sub_category_id = $request->sub_category_id;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->status = $request->status;
        if($request->image){
            $img = $request->file('image');
            $ext = rand().".".$img->getClientOriginalName();
            $img->move(public_path("blogs/"),$ext);
            $blog->image = $ext;
        }
        $blog->save();

        \Session::flash('flash_message', 'Blog Created Successfully');
        \Session::flash('flash_type', 'success');
        return redirect('admin/blogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $settings = app('site_global_settings');

        /**
         * Start SEO
         */
        SEOMeta::setTitle(__('seo.backend.admin.category.categories', ['site_name' => empty($settings->setting_site_name) ? config('app.name', 'Laravel') : $settings->setting_site_name]));
        SEOMeta::setDescription('');
        SEOMeta::setCanonical(URL::current());
        SEOMeta::addKeyword($settings->setting_site_seo_home_keywords);
        $data['blog'] = blog::find($id);
        $data['sub_categories'] = BlogSubCategory::all();
        $data['categories'] = BlogCategory::all();
        return view('backend.admin.blogs.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'status' => 'required',
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->short_description = $request->short_description;
        $blog->content = $request->content;
        $blog->blog_category_id = $request->category_id;
        $blog->blog_sub_category_id = $request->sub_category_id;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->status = $request->status;
        if($request->image){

            $old_file = public_path('blogs').$blog->image;
            if(file_exists($old_file)){
                unlink($old_file);
            }
            $img = $request->file('image');
            $ext = rand().".".$img->getClientOriginalName();
            $img->move(public_path("blogs/"),$ext);
            $blog->image = $ext;
        }
        $blog->update();

        \Session::flash('flash_message', 'Blog Updated Successfully');
        \Session::flash('flash_type', 'success');
        return redirect('admin/blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $old_file = public_path('blogs').$blog->image;
        if(file_exists($old_file)){
            unlink($old_file);
        }
        $blog->delete();
        \Session::flash('flash_message', 'Blog Deleted Successfully');
        \Session::flash('flash_type', 'danger');
        return redirect('admin/blogs');
    }

    public function get_subcategory(Request $request)
    {
        $subcategories = BlogSubCategory::where('blog_category_id',$request->id)->get();
        $html = '';
        foreach($subcategories as $subcategory)
        {
            $html .= '<option value="'.$subcategory->id.'">'.$subcategory->title.'</option>';
        }
        return response()->json($html);
    }
}
