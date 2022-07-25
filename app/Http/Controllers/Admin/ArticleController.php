<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserArticle;

class ArticleController extends Controller
{
    //function for admin add member article
    public function submitMemberArticle(Request $request, $id){
        //validation rule
        $validated = request()->validate([ 
            'name' => 'required',
        ]); 

        //Chck if request is in video
        $fileName = "default_image.png"; 
        if($request->hasFile('image')){
            foreach($request->file('image') as $file){
                $fileName = 'article_'.time().'.'.$file->getClientOriginalExtension();
                $upload = $file->move(public_path('/upload/user_article'), $fileName);
                
            } 
        }

        //Add New Article  
        $insert_article = UserArticle::create([
                'user_id' => $id,    
                'name' => $request->name,    
                'desc' => $request->desc,    
                'image' => $fileName, 
                'status' => $request->status, 
            ]);
 
        //retrun responce
        if($insert_article){ 
            return back()->with('success','Member Article Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        } 
    }
}
