<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialityRequest;
use App\Http\Resources\SpecialityResource;
use App\Models\Keyword;
use App\Models\Speciality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SpecialityResource::collection(Speciality::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SpecialityRequest $request
     * @return JsonResponse
     */
    public function store(SpecialityRequest $request): JsonResponse
    {
        $speciality = Speciality::create($requestValidated = $request->validated());
        if (isset($requestValidated['keywords'])) {
            $keywords = new Collection();
            foreach ($requestValidated['keywords'] as $keyword) {
                $keywordEntity = Keyword::firstOrCreate(['name' => $keyword]);
                $keywords->push($keywordEntity);
            }
            $speciality->keywords()->attach($keywords->pluck('id'));
        }
        return response()->json(['message' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Speciality $speciality
     * @return SpecialityResource
     */
    public function show(Speciality $speciality): SpecialityResource
    {
        return SpecialityResource::make($speciality);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SpecialityRequest $request
     * @param Speciality $speciality
     * @return JsonResponse
     */
    public function update(SpecialityRequest $request, Speciality $speciality): JsonResponse
    {
        $speciality->update($requestValidated = $request->validated());
        if (isset($requestValidated['keywords'])) {
            $keywords = new Collection();
            foreach ($requestValidated['keywords'] as $keyword) {
                $keywordEntity = Keyword::firstOrCreate(['name' => $keyword]);
                $keywords->push($keywordEntity);
            }
            $speciality->keywords()->sync($keywords->pluck('id'));
        }
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Speciality $speciality
     * @return JsonResponse
     */
    public function destroy(Speciality $speciality): JsonResponse
    {
        $speciality->delete();
        return response()->json(['message' => 'deleted']);
    }
}
