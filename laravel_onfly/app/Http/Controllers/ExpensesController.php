<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Expenses;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ExpensesController extends Controller
{
    public function save(Request $request)
    {
        $data = $request->all();
        Expenses::create($data);

        if ($data) {

            $this->mail($request);
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
    public function delete(Request $request)
    {
        $delete = Expenses::where('id', '=', $request->id);
        $delete->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Despesa deletada com sucesso!'
        ], 200);
    }
    public function show()
    {
        $user = Auth::user();
        $id = $user->id;

        $expenses = Expenses::where('user_id', auth()->user()->id)->get();
        return $expenses;
    }
    public function mail($request)
    {
        $sendMail = [
            'title' => 'Controle de Despesas',
            'body' => 'This is for testing email using smtp'
        ];
        Mail::to($request->email)->send(new sendMail($request));
    }
}