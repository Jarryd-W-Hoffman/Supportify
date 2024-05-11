<?php

namespace App\Livewire\Dashboard\Category;

use Livewire\Component;
use App\Models\Category;

class Categories extends Component
{
    public string $name;
    public string $description;
    public string $colour;

    public bool $isModalOpen = false;

    public function showModal()
    {
        $this->reset([
            'name',
            'description',
            'colour',
        ]);

        $this->colour = $this->generateRandomColor();

        $this->isModalOpen = true;
    }

    public function generateRandomColor()
    {
        // Generate a random color in hexadecimal format
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    public function createCategory() {
        $this->validate([
            'name' => 'required|string|max:32',
            'description' => 'string|max:255',
        ]);

        Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'colour' => $this->colour,
        ]);

        $this->isModalOpen = false;
    }

    public function render()
    {
        return view('livewire.dashboard.category.categories', [
            'categories' => Category::all(),
        ]);
    }
}
