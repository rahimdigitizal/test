<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class BlogCategoryController extends Controller
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
        $data['categories_count'] = BlogCategory::count();
        $data['categories'] = BlogCategory::paginate(10);
        return view('backend.admin.blogcategory.index',$data);
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
        return view('backend.admin.blogcategory.create');
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
        ]);
        $category = new BlogCategory();
        $category->title = $request->title;
        if($request->slug){
            $request->validate([
                'slug' => 'required|alpha_dash|unique:blog_categories,slug'
            ]);
            $category->slug = $request->slug;
        }
        else{
            $category->slug = Str::slug($request->title);
        }
        $category->save();

        \Session::flash('flash_message', 'Blog Category Created Successfully');
        \Session::flash('flash_type', 'success');
        return redirect('admin/category/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $data['category'] = BlogCategory::find($id);
        return view('backend.admin.blogcategory.edit',$data);

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
        ]);
        $category = BlogCategory::find($id);
        $category->title = $request->title;
        if($request->slug){
            $request->validate([
                'slug' => 'required|alpha_dash|unique:blog_categories,slug'
            ]);
            $category->slug = $request->slug;
        }
        else{
            $category->slug = Str::slug($request->title);
        }
        $category->update();

        \Session::flash('flash_message', 'Blog Updated Created Successfully');
        \Session::flash('flash_type', 'success');
        return redirect('admin/category/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = BlogCategory::find($id);
        $category->delete();

        \Session::flash('flash_message', 'Blog Category deleted Successfully');
        \Session::flash('flash_type', 'danger');
        return redirect('admin/category/blog');
    }
}
