<?php

namespace App\Http\Controllers;

use App\Complain;
use App\Customer;
use App\Product;
use App\Comment;
use App\User;
use App\Log;
use Gate;

class ComplainController extends Controller
{
    public function index()
    {
        $complains=Complain::where('status','<','4')->orderBy('id','desc')->paginate(5);
        $count_all=Complain::all()->count();
        $count_new=Complain::where('status','0')->count();

        return view('complains.index',[
            'complains'=>$complains,
            'count_all'=>$count_all, 
            'count_new'=>$count_new,
            'status'=>'all'
        ]);

    }

    public function filter($status)
    {
        $complains=Complain::where('status',$status)->orderBy('id','desc')->paginate(5);
        $count_all=Complain::all()->count();
        $count_new=Complain::where('status','0')->count();

        return view('complains.index',[
            'complains'=>$complains,
            'count_all'=>$count_all, 
            'count_new'=>$count_new, 
            'status'=>$status
        ]);
    }

    public function status($id,$status)
    {
        if(Gate::allows('change-status')){
            $complain=Complain::find($id);
            $complain->status=$status;
            $complain->save();

            $log=new Log();
            $log->complain_id=$id;
            $log->user_id=auth()->user()->id;
            $log->action='changed status to '.
            config('crm.status')[$status];
            $log->save();


            return back();
        }
        
        return back()->with('info','Unauthorized to change-status');
    }

    public function assign($id,$user)
    {
        if(Gate::allows('change-assign')){
            $complain=Complain::find($id);
            $complain->user_id=$user;
            $complain->save();

            $log=new Log();
            $log->complain_id=$id;
            $log->user_id=auth()->user()->id;
            $log->action='changed assign to '.
            User::find($user)->name;
            $log->save();

            return back();
        }
        
        return back()->with('info','Unauthorized to assign');
    }

    public function add()
    {
        return view('complains.add',[
            'customers'=> Customer::all(),
            'products'=> Product::all()
        ]);
    }

    public function create()
    {
        $validator=validator(request()->all(),[
            'subject'=>'required',
            'detail'=>'required',
            'customer_id'=>'required',
            'product_id'=>'required'
        ]);

        if($validator->fails())
        {
            return redirect('/complains/add')->withErrors($validator);
        }

        $complain=new Complain();
        $complain->subject=request()->subject;
        $complain->detail=request()->detail;
        $complain->customer_id=request()->customer_id;
        $complain->product_id=request()->product_id;
        $complain->status=0;

        $complain->save();

        return redirect('/complains')->with('info','A new complain added.');
    }

    public function view($id)
    {
        $complain=Complain::find($id);
        $count_all=Complain::all()->count();
        $count_new=Complain::where('status','0')->count();
        $users=User::all();

        return view('complains.view',[
            'complain'=>$complain,
            'count_all'=>$count_all,
            'count_new'=>$count_new,
            'status'=>'status',
            'users'=>$users,

        ]);

    }



    public function edit($id)
    {
        $complain=Complain::find($id);
        return view('complains.edit',['complain'=>$complain]);
    }

    public function update($id)
    {
        $validator=validator(request()->all(),[
            'subject'=>'required',
            'detail'=>'required'
        ]);

        if($validator->fails()){
            return redirect('/complains/edit/'.$id)->withErrors($validator);
        }

        $complain=Complain::find($id);
        $complain->subject=request()->subject;
        $complain->detail=request()->detail;
        $complain->save();

        return redirect('/complains')->with('info','A Complain updated');
    }

    public function delete($id)
    {
        $complain=Complain::find($id);

        if(Gate::allows('delete-complain',$complain))
        {
            $complain->delete();
            return redirect('/complains')->with('info','A complain deleted');            
        }

        return back()->with('info', 'Unauthorized to Delete');        
    }

    public function addcomment()
    {
        $comment=new Comment();
        $comment->comment = request()->comment;
        $comment->complain_id=request()->complain_id;
        $comment->save();

        return redirect('/complains')->with('info','A comment added');

    }


}

