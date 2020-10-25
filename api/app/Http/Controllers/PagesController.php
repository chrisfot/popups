<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{

    /**
     * Creates a new page.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json(ApiResponse::fail($errors));
        }

        $page = Page::create([
            'title' => $request->input('title')
        ]);

        return response()->json(ApiResponse::success($page->toArray()));
    }

    /**
     * Returns a list of all pages with their popups.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $pages = Page::with('popups')->select('id', 'title')->get();

        return response()->json(ApiResponse::success($pages->toArray()));
    }

    /**
     * Returns a single page with its popups.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function single(Request $request, $id)
    {
        $input = ['page_id' => $id];

        $validator = Validator::make($input, [
            'page_id' => 'required|exists:pages,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json(ApiResponse::fail($errors));
        }

        $page = Page::with('popups')->find($id);

        return response()->json(ApiResponse::success($page->toArray()));
    }
}
