<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Expenses;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ExpensesController extends Controller
{
    public function save(Request $request){
        $data = $request->all();
        Expenses::create($data);

        if($data){
            return response()->json([
                'status' => 'success',
                'message' => 'Despesa cadastrada com sucesso!'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Houve erros ao processar sua solicitação'
        ], 400);
    }
    
    public function show(){
        $user = Auth::user();
        $id = $user->id;

        $expenses = Expenses::where('id_user',  auth()->user()->id)->get();
        return $expenses;
    }
}
