<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $query = Post::query()->with('category')->with('user');

            $query->when($request->has('search'),function($q) use ($request){
                $searchKey = $request['search'];
                $q->where(function($subquery) use($searchKey){
                    $subquery->where('title','like','%'.$searchKey.'%')
                        ->orWhere('body','like','%'.$searchKey.'%')
                        ->orWhereHas('category',function ($categoryQuery) use($searchKey) {
                            $categoryQuery->where('name', 'like', '%' . $searchKey . '%');
                        })
                        ->orWhereHas('user',function ($userQuery) use($searchKey) {
                            $userQuery->where('name', 'like', '%' . $searchKey . '%');
                        });
                });
            });

            $perPage = $request->get('per_page',10);
            $posts = $query->paginate($perPage);

            if(count($posts) == 0){
                return response()->json([
                    "message"=>"Posts not found"
                ],404);
            }
            return response()->json([
                "message"=>"Posts retrieved successfully",
                "data"=>PostResource::collection($posts),
                "total"=>$posts->total(),
                "per_page"=>$posts->perPage(),
                "current_page"=>$posts->currentPage(),
                "last_page"=>$posts->lastPage() 
            ],200);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try{
            $post = Post::create($request->validated());
            return response()->json([
                "message"=>"Post created successfully",
                "data"=>PostResource::make($post)
            ],201);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $post = Post::find($id);
            if(!$post){
                return response()->json([
                    "message"=>"Post not found"
                ],404);
            }
            return response()->json([
                "message"=>"Post retrieved successfully",
                "data"=>PostResource::make($post)
            ],200);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        try{
            $post = Post::find($id);
            if(!$post){
                return response()->json([
                    "message"=>"Post not found"
                ],404);
            }
            $post->update($request->validated());
            return response()->json([
                "message"=>"Post updated successfully",
                "data"=>PostResource::make($post)
            ],200);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $post = Post::find($id);
            if(!$post){
                return response()->json([
                    "message"=>"Post not found"
                ],404);
            }
            $post->delete();
            return response()->json([
                "message"=>"Post not found"
            ],200);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }
}
