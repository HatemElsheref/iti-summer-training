<?php

namespace App\Http\Controllers;

class PostController extends Controller
{

    private $posts=[];

    public function __construct()
    {
        $this->posts=[
            [
                'id'        =>1,
                'title'     =>'Post One',
                'content'   =>'Post One Content'
            ],
            [
                'id'        =>2,
                'title'     =>'Post Two',
                'content'   =>'Post Two Content'
            ],
            [
                'id'        =>3,
                'title'     =>'Post Three',
                'content'   =>'Post Three Content'
            ],
            [
                'id'        =>4,
                'title'     =>'Post Four',
                'content'   =>'Post Four Content'
            ],
            [
                'id'        =>5,
                'title'     =>'Post Five',
                'content'   =>'Post Five Content'
            ],
            [
                'id'        =>6,
                'title'     =>'Post Six',
                'content'   =>'Post Six Content'
            ],
            [
                'id'        =>7,
                'title'     =>'Post Seven',
                'content'   =>'Post Seven Content'
            ],
            [
                'id'        =>8,
                'title'     =>'Post Eight',
                'content'   =>'Post Eight Content'
            ],
            [
                'id'        =>9,
                'title'     =>'Post Nine',
                'content'   =>'Post Nine Content'
            ],
            [
                'id'        =>10,
                'title'     =>'Post Ten',
                'content'   =>'Post Ten Content'
            ],
        ];

    }

    public function index(){
        return view('session2.index',['posts'=>$this->posts]);
    }

    public function show($post){
        if (in_array($post,array_column($this->posts,'id'))){
            $post=collect($this->posts)->where('id',$post)->first();
        }else{
            abort(404);
        }
        return view('session2.show',['post'=>$post]);
    }
}
