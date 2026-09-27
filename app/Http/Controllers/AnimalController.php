<?php

namespace App\Http\Controllers;

use App\Contracts\AnimalServiceInterface;
use App\Http\Requests\AnimalDataRequest;



class AnimalController extends Controller
{
    public function __construct(
        private AnimalServiceInterface $animalServ
    ){}

     public function index()
    {
        $animales = $this->animalServ->all();
        return view('animales.index', ['animales' => $animales]);
    }

    public function create()
    {
        return view('animales.create');
    }

    public function store(AnimalDataRequest $request)
    {
        $data =$request->validated();
        $this->animalServ->create($data);
        return redirect()->route('animales.index')->with('success', 'Animal creado correctamente');
    }

    public function edit(string $id)
    {
       try {
            $animal = $this->animalServ->find($id);
            return view('animales.edit', ['id' => $id, 'animal' => $animal]);
        } catch (\Exception $e) {
            return redirect()->route('animales.index')->with('error', $e->getMessage());
        }
    }

    public function update(AnimalDataRequest $request, string$id)
    {
        $data=$request->validated();

        try {
            $this->animalServ->update($id, $data);
            return redirect()->route('animales.index')->with('success', 'Animal actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('animales.index')->with('error', $e->getMessage());
        }
    }

  
    public function destroy(string $id)
    {
        try {
            $this->animalServ->delete($id);
            return redirect()->route('animales.index')->with('success', 'Animal eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('animales.index')->with('error', $e->getMessage());
        }
    }

    public function reset()
    {
        $this->animalServ->reset();
        return redirect()->route('animales.index')->with('succes','Todos lo animal se han eliminado.');
    }
}