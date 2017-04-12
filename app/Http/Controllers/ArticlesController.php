<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Response;

class ArticlesController extends Controller
{
  //list of Articles
  public function index()
  {
    $articles = Article::all();

    return Response::json($articles);
  }
  //Stores our Articles
  public function store(Request $request)
  {
    $article= new Article;
    $article->title= $request->input('title');
    $article->body= $request->input('body');

    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $image->move("storage/", $imageName);
    $article->image = $request->root()."/public/storage".$imageName;
    $article->save();

    return Response:: json(['success'=> "You did it."]);
  }
  //updates articles
  public function update($id, Request $request)
  {
    //Finds a specific article based on id
    $article = Article::find($id);
    //Saves the title
    $article->title = $request->input('title');
    //Saves the body
    $article->body = $request->input('body');
    //
    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $image->move("storage/", $imageName);
    $article->image = $request->root()."/public/storage".$imageName;

    //commits he saves to the database
    $article->save();

    return Response::json(['success'=> "Greetings!"]);
  }
  //show single article
  public function show($id)
  {
    $article = Article::find($id);

    return Response::json($article);
  }
  //deletes a single article
  public function destroy($id)
  {
    $article = Article::find($id);

    $article->delete();

    return Response::json(['success' => 'Article Deleted.']);
  }
}
