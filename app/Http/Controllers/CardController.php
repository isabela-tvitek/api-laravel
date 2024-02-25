<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Pipeline;
use Illuminate\Http\Request;

class CardController extends Controller {
    public function index() {
        return Card::all();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $firstPipeline = Pipeline::orderBy('created_at')->first();

        if (!$firstPipeline) {
            return response()->json(['error' => 'No pipeline available'], 404);
        }

        $card = new Card;
        $card->name = $request->name;
        $card->description = $request->description;
        $card->pipeline_id = $firstPipeline->id;
        $card->save();

        return response()->json($card, 201);
    }

    public function show($id) {
        return Card::find($id);
    }

    public function update(Request $request, Card $card) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $card->name = $request->name;
        $card->description = $request->description;
        $card->save();

        return response()->json($card);
    }

    public function destroy(Card $card) {
        $card->delete();
        return response()->json(null, 204);
    }

    public function move(Card $card) {
        $nextPipeline = Pipeline::where('id', '>', $card->pipeline_id)->orderBy('id')->first();

        if (!$nextPipeline) {
            return response()->json(['error' => 'No next pipeline to move to'], 400);
        }

        if ($nextPipeline->id <= $card->pipeline_id) {
            return response()->json(['error' => 'You cannot move the card to the same or a previous pipeline'], 400);
        }

        $card->pipeline_id = $nextPipeline->id;
        $card->save();

        return response()->json($card);
    }
}
