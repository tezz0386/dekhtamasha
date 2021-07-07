<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Redirect,Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function getCategories()
    {
        $categories = Category::select('id', 'title')->orderByDesc('created_at')->get();
        $playlists = Playlist::select('id', 'title')->orderByDesc('created_at')->get();
        $languages = Language::select('id', 'title')->orderByDesc('created_at')->get();
        $categoryOutput = '';
        $playlistOutput= '';
        $languageOutput='';
        $total_row_category = $categories->count();
        if($total_row_category > 0){
           foreach ($categories as $category) {
               $categoryOutput .= '<option value="'.$category->id.'">'.$category->title. '</option>';
           }
        }
        $total_row_playlist = $playlists->count();
        if($total_row_playlist >0){
            foreach ($playlists as $playlist) {
               $playlistOutput .= '<option value="'.$playlist->id.'">'.$playlist->title. '</option>';
           }
        }

        $total_row_language = $languages->count();
        if($total_row_language >0){
            foreach ($languages as $language) {
               $languageOutput .= '<option value="'.$language->id.'">'.$language->title. '</option>';
           }
        }

        $data = array(
                'category_data'    => $categoryOutput,
                'playlist_data'    => $playlistOutput,
                'language_data'    =>$languageOutput,
            );
        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
