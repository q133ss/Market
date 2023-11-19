<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function update($id, Request $request)
    {
        $q = Question::findOrFail($id);
        $q->update(['answer' => $request->answer]);
        return back()->withSuccess('Вопрос успешно обновлен');
    }
}
