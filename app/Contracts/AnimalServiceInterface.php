<?php
namespace App\Contracts;

interface AnimalServiceInterface{
    public function all(): array;
    public function find(int|string $id):?array; 
    public function create(array $dato):array;
    public function update(string $id,array $data):bool;
    public function delete(int|string $id): bool; 
    public function reset(): void;

}