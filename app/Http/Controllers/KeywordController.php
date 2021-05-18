<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeywordRequest;
use App\Http\Resources\KeywordResource;
use App\Models\Keyword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return KeywordResource::collection(Keyword::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param KeywordRequest $request
     * @return JsonResponse
     */
    public function store(KeywordRequest $request): JsonResponse
    {
        Keyword::create($request->validated());
        return response()->json(['message' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Keyword $keyword
     * @return KeywordResource
     */
    public function show(Keyword $keyword): KeywordResource
    {
        return KeywordResource::make($keyword);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KeywordRequest $request
     * @param Keyword $keyword
     * @return JsonResponse
     */
    public function update(KeywordRequest $request, Keyword $keyword): JsonResponse
    {
        $keyword->update($request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Keyword $keyword
     * @return JsonResponse
     */
    public function destroy(Keyword $keyword): JsonResponse
    {
        $keyword->delete();
        return response()->json(['message' => 'deleted']);
    }
}
