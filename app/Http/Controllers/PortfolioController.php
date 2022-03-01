<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // with('featuredImage') öne çıkan resimleri de beraberinde getir diyoruz.
        $list = Portfolio::with('featuredImage')->get();
        return view('admin.portfolio_list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolio_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfolioRequest $request)
    {
        $portfolio = Portfolio::create([
            'title' => $request->title,
            'tags' => $request->tags,
            'about' => $request->about,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'website' => $request->website,
            'status' => $request->status ? 1 : 0,
        ]);
        //resim kontrolü. gelen resim null değilse if'e girecek
        if ($request->file('images')) {
            $now = now()->format('YmdHis');
            $sayac = 0;
            foreach ($request->file('images') as $image) {
                //resimlerin uzantılarını alıyoruz.
                $extension = $image->getClientOriginalExtension();
                //resimlerin name'lerini alıyoruz.
                $name = $image->getClientOriginalName();
                $slugName = Str::slug($name, '-') . '_' . $now . '.' . $extension;

                $publicPath = 'public/';
                $path = 'portfolio/';
                Storage::putFileAs($publicPath . $path, $image, $slugName);

                PortfolioImage::create([
                    'portfolio_id' => $portfolio->id,
                    'image' => $slugName,
                    'featured' => $sayac == 0 ? 1 : 0,
                    'status' => 1,
                ]);
                $sayac = 1;
            }
        }

        alert()->success('Başarılı', 'Portfolio eklendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true, false);
        return redirect()->route('portfolio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
