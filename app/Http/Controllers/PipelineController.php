<?php

namespace App\Http\Controllers;

use App\Models\Pipeline;
use Illuminate\Http\Request;

class PipelineController extends Controller {

    public function index() {
        return Pipeline::all();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:pipelines,name',
        ]);

        $lastPipeline = Pipeline::whereNull('next_id')->first();

        $pipeline = new Pipeline;
        $pipeline->name = $request->name;
        $pipeline->previous_id = $lastPipeline ? $lastPipeline->id : null;
        $pipeline->save();

        if ($lastPipeline) {
            $lastPipeline->next_id = $pipeline->id;
            $lastPipeline->save();
        }

        return response()->json($pipeline, 201);
    }

    public function show($id) {
        return Pipeline::find($id);
    }

    public function update(Request $request, Pipeline $pipeline) {
        $request->validate([
            'name' => 'required|unique:pipelines,name,' . $pipeline->id,
            // Você pode validar 'previous_id' e 'next_id' aqui, se eles estiverem sendo enviados na request
        ]);

        $pipeline->name = $request->name;

        if ($request->has('previous_id') || $request->has('next_id')) {
            $currentPrevious = $pipeline->previous_id ? Pipeline::find($pipeline->previous_id) : null;
            $currentNext = $pipeline->next_id ? Pipeline::find($pipeline->next_id) : null;

            if ($currentPrevious) {
                $currentPrevious->next_id = $currentNext ? $currentNext->id : null;
                $currentPrevious->save();
            }

            if ($currentNext) {
                $currentNext->previous_id = $currentPrevious ? $currentPrevious->id : null;
                $currentNext->save();
            }

            $newPrevious = $request->has('previous_id') ? Pipeline::find($request->previous_id) : null;
            $newNext = $request->has('next_id') ? Pipeline::find($request->next_id) : null;

            $pipeline->previous_id = $newPrevious ? $newPrevious->id : null;
            $pipeline->next_id = $newNext ? $newNext->id : null;

            if ($newPrevious) {
                $newPrevious->next_id = $pipeline->id;
                $newPrevious->save();
            }

            if ($newNext) {
                $newNext->previous_id = $pipeline->id;
                $newNext->save();
            }
        }

        $pipeline->save();

        return response()->json($pipeline);
    }


    public function destroy(Pipeline $pipeline) {
        $previousPipeline = Pipeline::find($pipeline->previous_id);
        $nextPipeline = Pipeline::find($pipeline->next_id);

        if ($previousPipeline) {
            $previousPipeline->next_id = $pipeline->next_id;
            $previousPipeline->save();
        }

        if ($nextPipeline) {
            $nextPipeline->previous_id = $pipeline->previous_id;
            $nextPipeline->save();
        }

        $pipeline->delete();
        return response()->json(null, 204);
    }
}
