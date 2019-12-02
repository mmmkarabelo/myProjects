<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        $title = 'Welcome To Acme Bank!';
        
        return view('pages.index')->with('title',$title);
    }

    public function about(){
        $title = 'About Us';
        
        return view('pages.about')->with('title',$title);
    }

    public function allaccounts(){
       
       $jsonString = file_get_contents(base_path('resources/accounts.json'));

       $accounts = json_decode($jsonString, true);

       return view('pages.allaccounts')->with('accounts', $accounts);
       
       //var_dump($accounts);
    }

   
    function withdrawal(Request $request)
    {
        try 
        {
            $this->validate($request, [
                'amount' => 'required'
                
            ]);
               
            return redirect('/allaccounts')->with('success', 'Withdrawal Successful');

        }catch(Exception $e) 
        {
            //return ['error' => true, 'message' => $e->getMessage()];
            return redirect('/allaccounts')->with('error', $e->getMessage());
        }

       
        

        
        

    }
}
