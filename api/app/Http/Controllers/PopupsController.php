<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PopupsController extends Controller
{

    /**
     * Creates a new popup with the given settings after they are validated.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request, $id)
    {
        $input = $request->all();
        $input['page_id'] = $id;

        $validator = Validator::make($input, [
            'page_id' => 'required|exists:pages,id',
            'title' => 'required',
            'timer' => 'nullable|numeric|min:0',
            'scroll' => 'nullable|integer|min:0|max:100',
            'exit_intent' => 'required|boolean',
            'trigger_every' => 'required|integer',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json(ApiResponse::fail($errors));
        }

        $popup = Popup::create([
            'page_id' => $id,
            'title' => $request->input('title'),
            'timer' =>  $request->input('timer'),
            'scroll' => $request->input('scroll'),
            'exit_intent' => $request->input('exit_intent'),
            'trigger_every' => $request->input('trigger_every'),
            'content' => $request->input('content'),
        ]);

        return response()->json(ApiResponse::success($popup->toArray()));
    }

    /**
     * Returns a list of all saved popups that belong to the specified page.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $input = ['page_id' => $id];

        $validator = Validator::make($input, [
            'page_id' => 'required|exists:pages,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json(ApiResponse::fail($errors));
        }

        $popups = Popup::select('title', 'timer', 'scroll', 'exit_intent', 'trigger_every', 'content')
            ->where('page_id', $id)
            ->get();

        return response()->json(ApiResponse::success($popups->toArray()));
    }

}
