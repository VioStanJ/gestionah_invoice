<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(Request $reques)
    {
        $articles = [];
        return view('dashboard.product');
    }

}
