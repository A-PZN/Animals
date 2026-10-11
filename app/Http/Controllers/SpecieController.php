<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\SpeciesServiceInterface;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SpesiesDataRequests;



class SpecieController extends Controller
{
    public function __construct(
 protected SpeciesServiceInterface $speciesService
 ) {}

    public function index(): View {

    $species = $this->speciesService->all();

    return view('species.index', compact('species'));
    }

    public function create(): View {
        return view('species.create');
    }

    public function store(SpesiesDataRequests $request) {

        $validated = $request->validated();
        $this->speciesService->create($validated);
        return redirect()->route('species.index')->with('success', 'Especie creada con éxito.');
    }

    public function show(string $id): View {

        $species = $this->speciesService->find($id);
        //recive na vaiable boolana y el error + el texto 
        abort_if(! $species, 404, 'Especie no encontrada.');

         return view('species.show', compact('id', 'species'));

    }

    public function edit(string $id): View {

        $species = $this->speciesService->find($id);
        abort_if(! $species, 404, 'Especie no encontrada.');

        return view('species.edit', compact('id', 'species'));

    }
    
    public function update(SpesiesDataRequests $request, string $id):RedirectResponse {

        $validated = $request->validated();

        $updated = $this->speciesService->update($id, $validated);

        abort_if(! $updated, 404, 'Especie no encontrada.');

        return redirect()->route('species.index')->with('success', 'Especie actualizada con éxito.');
    }
    public function destroy(string $id): RedirectResponse {
        
        $deleted = $this->speciesService->delete($id);
        abort_if(! $deleted, 404, 'Especie no encontrada.');

        return redirect()->route('species.index')->with('success', 'Especie eliminada con éxito.');
    }

    public function reset(): RedirectResponse
    {
        $this->speciesService->reset();
        return redirect()->route('species.index')->with('success', 'Especies restablecidas a los valores predeterminados.');
    }


}   
