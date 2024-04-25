<?php

namespace App\Http\Controllers;

use App\Models\Event as ModelsEvent;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Event;
use PhpParser\Node\Stmt\TryCatch;

class EventoController extends Controller
{
    public function index()
    {
        $events = ModelsEvent::all();
        $eventos = [];

        foreach ($events as $event) {
            $eventos[] = [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'color' => $event->color,
                'start' => $event->start,
                'end' => $event->end,
            ];
        }

        return view('index', compact('eventos'));
    }


    public function create(Request $request)
    {

        $eventos = new ModelsEvent();
        $dataInicio = Carbon::createFromFormat('Y-m-d\TH:i', $request->inputDataInicio);
        $dataTermino = Carbon::createFromFormat('Y-m-d\TH:i', $request->inputDataTermino);


        $eventos->title = $request->inputTitulo;
        $eventos->description = $request->inputDescricao;
        $eventos->color = $request->inputColor;
        $eventos->start = $dataInicio;
        $eventos->end = $dataTermino;

        try {
            $eventos->save();
            return redirect()->route('eventos')->with('success', 'Evento registado com sucesso!');
        } catch (\Exception $th) {
            return back()->with('error', 'Erro: não foi possível registar evento.' . $th->getMessage());
        }
    }

    public function edit(Request $request)
    {
        if ($request->idEvento) {
            $events = ModelsEvent::find($request->idEvento);

            $eventos = [
                'id' => $events->id,
                'title' => $events->title,
                'description' => $events->description,
                'color' => $events->color,
                'start' => $events->start,
                'end' => $events->end,
            ];
            return view('editar', ['eventos' => $eventos]);
        } else {
            return back()->with('warning', 'Por favor, primeiro selecione o evento que pretende editar!');
        }
    }

    public function submeterFormuarioEditar(Request $request, $id)
    {
        $eventos = ModelsEvent::find($id);

        $eventos->title = $request->inputTitulo;
        $eventos->description = $request->inputDescricao;
        $eventos->color = $request->inputColor;
        $eventos->start = $request->inputDataInicio;
        $eventos->end = $request->inputDataTermino;

        try {
            $eventos->save();
            return redirect()->route('eventos')->with('success', 'Edição efetuada com sucesso!');
        } catch (\Exception $th) {
            return back()->with('error', 'Erro: não foi possível editar o evento.' . $th->getMessage());
        }
    }

    public function destroy(Request $request)
    {


        if ($request->idEvento) {
            ModelsEvent::destroy($request->idEvento);
            return back()->with('success', 'Evento apagado com sucesso!');
        } else {
            return back()->with('warning', 'Por favor, primeiro selecione o evento que pretende apagar!');
        }
    }
}
