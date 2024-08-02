<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogSubCategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class BlogSubCategoryController extends Controller
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
        $data['categories_count'] = BlogSubCategory::count();
        $data['categories'] = BlogSubCategory::paginate(10);
        return view('backend.admin.blogsubcategory.index',$data);
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
        $data['categories'] = BlogCategory::all();
        return view('backend.admin.blogsubcategory.create',$data);
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
            'category_id' => 'required',
        ]);
        $sub_category = new BlogSubCategory();
        $sub_category->title = $request->title;
        $sub_category->blog_category_id = $request->category_id;
        if($request->slug){
            $request->validate([
                'slug' => 'required|alpha_dash|unique:blog_categories,slug'
            ]);
            $sub_category->slug = $request->slug;
        }
        else{
            $sub_category->slug = Str::slug($request->title);
        }
        $sub_category->save();

        \Session::flash('flash_message', 'Blog Sub Category Created Successfully');
        \Session::flash('flash_type', 'success');
        return redirect('admin/sub/category/blog');
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
        $data['sub_category'] = BlogSubCategory::find($id);
        $data['categories'] = BlogCategory::all();
        return view('backend.admin.blogsubcategory.edit',$data);

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
            'category_id' => 'required',
        ]);
        $sub_category = BlogSubCategory::find($id);
        $sub_category->title = $request->title;
        $sub_category->blog_category_id = $request->category_id;
        if($request->slug){
            $request->validate([
                'slug' => 'required|alpha_dash|unique:blog_categories,slug'
            ]);
            $sub_category->slug = $request->slug;
        }
        else{
            $sub_category->slug = Str::slug($request->title);
        }
        $sub_category->update();

        \Session::flash('flash_message', 'Blog Sub category Updated Successfully');
        \Session::flash('flash_type', 'success');
        return redirect('admin/sub/category/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = BlogSubCategory::find($id);
        $category->delete();

        \Session::flash('flash_message', 'Blog Sub   Category deleted Successfully');
        \Session::flash('flash_type', 'danger');
        return redirect('admin/sub/category/blog');
    }
}
