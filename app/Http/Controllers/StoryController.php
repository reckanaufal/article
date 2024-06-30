<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Category;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public static $pageTitle = 'Article';
    public static $pageBreadcrumbs = [
        [
            'page' => '/application/storie',
            'title' => 'List Article',
        ]
    ];
    function __construct()
    {
        $this->middleware('permission:article-list', ['only' => ['index']]);
        $this->middleware('permission:article-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:article-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:article-delete', ['only' => ['destroy']]);
        $this->middleware('permission:article-show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $story = Story::all();
        $pageTitle = self::$pageTitle;
        $pageBreadcrumbs = self::$pageBreadcrumbs;
        $category = Story::with('category')->get();

        
        return view('story.index', compact('story', 'category', 'pageTitle', 'pageBreadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $story = new Story();
        $category = Category::all();

        $pageTitle = self::$pageTitle;
        
        return view('story.create', compact('story', 'category', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Menyesuaikan dengan kebutuhan dimensi dan tipe file
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Mengambil file gambar yang diunggah
        $bannerImage = $request->file('banner_image');

        // Menyimpan file gambar dengan nama yang unik
        $imageName = time() . '_' . $bannerImage->getClientOriginalName();
        $bannerImage->move(public_path('images'), $imageName);

        // Membuat artikel baru dan menyimpannya ke dalam database
        $article = new Story();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category;
        $article->image = $imageName; // Simpan nama file gambar ke dalam kolom banner_image

        $article->save();

        // Redirect atau response sesuai kebutuhan aplikasi Anda
        return redirect()->route('story.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story = Story::with('category')->find($id);
        // dd($story);

        $pageTitle = self::$pageTitle;

        return view('story.show', compact('story', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $story = Story::with('category')->find($id);
        $category = Category::all();

        // dd($story);

        $pageTitle = self::$pageTitle;

        return view('story.edit', compact('story', 'category', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        // Validasi data input
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Menyesuaikan dengan kebutuhan dimensi dan tipe file
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        // Ambil artikel yang akan diperbarui
        $article = Story::findOrFail($story->id);
    
        // Cek jika ada file gambar yang diunggah
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $imageName = time() . '_' . $bannerImage->getClientOriginalName();
            $bannerImage->move(public_path('images'), $imageName);
            // Hapus file gambar lama jika ada
            if ($article->image && file_exists(public_path('images/' . $article->image))) {
                unlink(public_path('images/' . $article->image));
            }
            // Simpan nama file gambar baru ke dalam kolom image
            $article->image = $imageName;
        }
    
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category;
    
        $article->save();
    
        return redirect()->route('story.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            Story::find($id)->delete();
            return redirect()->route('story.index')
                ->with('success', 'Story deleted successfully');
        } else {
            return redirect()->route('story.index')
                ->with('failed', 'Story deleted failed because id is empty or null');
        }
    }
}
