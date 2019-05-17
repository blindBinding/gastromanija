<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use DB;
use Illuminate\Support\Facades\Storage;

class RecipesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
        
        // $recipes = Recipe::orderBy('Naziv', 'desc')->get();
        // $recipe = Recipe::where('Naziv', 'Recept 3')->get();
        $recipes = Recipe::all();
        // $recipes = DB::select('SELECT * FROM recipes');

        $recipes = Recipe::orderBy('created_at', 'desc')->paginate(5);

        return view('recipes.index')->with('recipes', $recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'naziv' => 'required',
            'opis' => 'required',
            'cover_image' => 'image|nullable|max:1999'
            
        ]);

            //File upload
            if($request->hasFile('cover_image')){
                //Get file
                $filenameWithExt = $request->file('cover_image')->getCLientOriginalName();
                //ime
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                //store filename
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //upload
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore );
            }else{
                $fileNameToStore = 'noimage.jpg';
            }


        //Kreiraj recept
        $recipe = new Recipe;
        $recipe->naziv = $request->input('naziv');
        $recipe->kratak_opis = $request->input('kratak_opis');
        // $recipe->vreme_spremanja = $request->input('vrema_spremanja');
        $recipe->opis = $request->input('opis');
        $recipe->author = $request->input('author');
        $recipe->kuhinje_id = $request->input('kuhinje_id');

        $myCheckboxes = $request->input('sastojci_id');
        // dd($myCheckboxes);
        $recipe->sastojci_id = json_encode($myCheckboxes);

        // $recipe->obrok = $request->input('obrok');
        $recipe->user_id = auth()->user()->id;
        $recipe->cover_image = $fileNameToStore;

        $recipe->save();

        return redirect('/recipes')->with('success', 'Kreiran recept');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);

        return view('recipes.show')->with('recipe', $recipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);

        //User
        if(auth()->user()->id !== $recipe->user_id){
            return redirect('/recipes')->with('error', 'Nedozvoljena strana');
        }

        return view('recipes.edit')->with('recipe', $recipe);
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
        $this->validate($request, [
            'naziv' => 'required',
            'opis' => 'required',
            // 'obrok' => 'required',

        ]);

        //File upload
        if($request->hasFile('cover_image')){

            //Get file
            $filenameWithExt = $request->file('cover_image')->getCLientOriginalName();
            //ime
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //store filename
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload
            $path = $request->file('cover_image')->storeAs('public/cover_images/', $fileNameToStore );
        }

        //Kreiraj recept
        $recipe = Recipe::find($id);
        $recipe->naziv = $request->input('naziv');
        $recipe->kratak_opis = $request->input('kratak_opis');
        // $recipe->vreme_spremanja = $request->input('vrema_spremanja');
        $recipe->opis = $request->input('opis');
        $recipe->author = $request->input('author');
        $recipe->kuhinje_id = $request->input('kuhinje_id');
        // $recipe->obrok = $request->input('obrok');

        $myCheckboxes = $request->input('sastojci_id');
        // dd($myCheckboxes);
        $recipe->sastojci_id = json_decode($myCheckboxes);

        if($request->hasFile('cover_image')){
            if ($recipe->cover_image != 'noimage.jpg') {
                Storage::delete('public/cover_images/'.$recipe->cover_image);
              }
            $recipe->cover_image = $fileNameToStore;
        }
        $recipe->save();

        return redirect('/recipes')->with('success', 'Recept promenjen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        
        
        if(auth()->user()->id !== $recipe->user_id){
            return redirect('/recipes')->with('error', 'Nedozvoljena strana');
        }

        if($recipe->cover_image != 'noimage.jpg'){
            //Obrisi
            Storage::delete('public/cover_images/'.$recipe->cover_image);
        }

        // return view('recipes.edit')->with('recipe', $recipe);
        
        $recipe->delete();
        return redirect('/recipes')->with('success', 'Recept uklonjen');
    }
}
