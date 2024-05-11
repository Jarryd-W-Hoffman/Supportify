<?php

namespace App\Livewire\Dashboard\Categories;

use Livewire\Component;
use App\Models\Category;

class CreateCategory extends Component
{
    public $name;
    public $description;
    public $randomColor;

    public $createModal = false;

    public function mount()
    {
        // Generate a random color value
        $this->randomColor = $this->generateRandomColor();
    }

    public function generateRandomColor()
    {
        // Generate a random color in hexadecimal format
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    public function showCreateModal() {
        // Generate a random color value
        $this->randomColor = $this->generateRandomColor();

        $this->createModal = true;
    }

    public function closeCreateModal() {
        $this->createModal = false;

        $this->reset('name', 'description');
    }

    public function save()
    {
        Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'colour' => $this->randomColor,
        ]);

        $this->closeCreateModal();
 
        $this->redirect('/dashboard/categories');
    }

    public function render()
    {
        return view('livewire.dashboard.categories.create-category');
    }
}
