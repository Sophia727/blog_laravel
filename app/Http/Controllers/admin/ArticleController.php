<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('updated_at', 'asc')->paginate(6);
        return view("admin.article.article_list", ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.article_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',
            'photo' => 'mimes:jpg,svg,png|max:10240'
        ]);
        $article = $data;

        //verification de l'existance du fichier
        if ($request->file("photo")) {
            $file = $request->file("photo");
            $fileName = 'article-'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images',$fileName,'public');
            $article['photo']= $path;
        }
        
        $article['published'] = $request['published']?true:false;
        $article['author_id'] = Auth::user()->id;
        if ($article['published']) {
            $article['publication_date'] = now();
        }
        //dd($article);
        $newArticle = Article::create($article); //create permet de stocker dans la DB
        if ($newArticle) {
           return  redirect()->route('articles.list')->with(["status"=>"Article added successfully"]);
        }else{
            return back()->with("error","Failed to create the Article")->withInput(); //withInput keeps old data
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('admin.article.article_show', ['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view("admin.article.article_edit", ['article'=>$article]);
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
        $data = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',
            'photo' => 'mimes:jpg,svg,png|max:10240'
        ]);
        
        $article = Article::find($id);

        //verification de l'existance du fichier
        if ($request->file("photo")) {
            $file = $request->file("photo");
            $fileName = 'article-'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images',$fileName,'public');
            $article['photo']= $path;
        }
        $article->title = $data['title'];
        $article->description = $data['description'];

        $article->published = $request['published']?true:false;
        $article->author_id = Auth::user()->id;
        $article->publication_date = $article->published? now(): null;

        if($article->update()){
           return  redirect()->route('articles.list')->with(["status"=>"Article updated!"]);
        }else{
            return back()->with("error"," Edit and Update Failed")->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if($article->delete()){
        return back()->with('status', 'Article'.': '.$article->title.' deleted successfully');
            //le code 200: everything went successully
            //201: created successully
            //419: expired / 404: not found
        } else {
            return back()->with('status', "Oops: failed to delete $article->title ");
        }
    }
    public function publish(Request $request, $id){
        $article = Article::find($id);
        $article->published = !$article->published ; 
        
        $message="";

        if($article['published']){
            $article['publication_date'] = now();
            $message= "Yay! Article published successfully!";
        } else{
            $article['publication_date'] = null;
            $message = "Article unpublished successfully!";
        }
        

        if($article->update()){
            return redirect()->route('articles.list')->with(["status"=>$message]);
        }else{
            return back()->with("error"," Edit and Update Failed")->withInput();
        
        }
    }    
    /**
     * search(): method to look up for the article in the search bar
     *
     * @return void
     */
    public function search()
    {
        // $message="";
        
        // $query = $request['query'];
        // $articles = Article::where('title', 'like',"% $query %")->paginate(6);
        // return view('admin.article.article_list', ['articles'=>$articles]);
        if(!($query = null)){
            $query = request()->input('query');
            $articles = Article::where('title', 'like',"%$query%")->paginate(10);
            return view('admin.article.article_list', ['articles'=>$articles]);
        } else {
            $message = "No Article found";
        }
        
    }
}
