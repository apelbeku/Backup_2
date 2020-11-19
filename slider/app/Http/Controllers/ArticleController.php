<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Article;

class ArticleController extends Controller
{
    public function index()
    {
    	$article = Article::take(3)->get();

    	return view('/article', compact('article'));
    }
}
