<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_articleController extends Controller
{
    public function index(){
        $articles = Article::orderBy('title', 'asc')->paginate(6);
        return view("user.user_articles_list", ['articles' => $articles]);
        // return "hello";
    }
    public function create(){
        return view('user.user_articleForm');
        
    } 
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
        $newArticle = Article::create($article);
        if ($newArticle) {
           return  redirect()->route('userArticlesList')->with(["status"=>"Article added successfully"]);
        }else{
            return back()->with("error","Failed to create the Article")->withInput();
        }

    }
    
    public function show($id)
    {
        $article = Article::find($id);
        return view('user.user_article_show', ['article'=>$article]);
    }
   
    public function like($id){
        // $article = Article::find($id);

    }    

    public function search(){
        if(!($query = null)){
            $query = request()->input('query');
            $articles = Article::where('title', 'like',"%$query%")->paginate(10);
            return view('user.user_articles_list', ['articles'=>$articles]);
        } else {
            $message = "No Article found";
        }
        
    }
    
}

