<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\AnimalServiceInterface;
use App\Http\Requests\AnimalDataRequest;

class AnimalController extends Controller
{
    public function __construct(
        private AnimalServiceInterface $animalService
    ){}

    public function index()
    {
        return view('animales.index', ['animales' => $this->animalService->all()]);
    }

    public function create()
    {
        return view('animales.create');
    }

    public function store(AnimalDataRequest $request)
    {
        $validatedData = $request->validated();
        $this->animalService->create($validatedData);
        return redirect()->route('index');
    }

    public function edit(string $id)
    {
        $animal = $this->animalService->find($id);
        if (!$animal) {
            return redirect()->route('index');
        }
        return view('animales.edit', compact('animal', 'id'));
    }

    public function update(AnimalDataRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $this->animalService->update($id, $validatedData);
        return redirect()->route('index');
    }

    public function destroy(string $id)
    {
        $this->animalService->delete($id);
        return redirect()->route('index');
    }

    public function reset()
    {
        $this->animalService->reset();
        return redirect()->route('index');
    }

}
