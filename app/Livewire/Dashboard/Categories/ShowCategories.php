<?php

namespace App\Livewire\Dashboard\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class ShowCategories extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url()]
    public $itemsPerPage = 10;

    public $createModal = false;
    public $editModal = false;
    public $deleteModal = false;

    public $id;
    public $name;
    public $description;
    public $colour;

    public function showCreateModal() {
        $this->createModal = true;
    }

    public function closeCreateModal() {
        $this->createModal = false;
    }

    public function showEditModal(Category $category) {
        $this->reset([
            'id',
            'name',
            'description',
            'colour',
        ]);

        $this->id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->colour = $category->colour;

        $this->editModal = true;
    }

    public function updateCategory($id) {
        $category = Category::find($id);

        $this->validate([
            'name' => 'required|string|max:32',
            'description' => 'required|string|max:128',
            'colour' => 'required|string|max:7',
        ]);

        $category->update([
            'name' => $this->name,
            'description' => $this->description,
            'colour' => $this->colour,
        ]);

        $this->editModal = false;
    }

    public function showDeleteModal(Category $category) {
        $this->id = $category->id;
        $this->name = $category->name;

        $this->deleteModal = true;
    }

    public function deleteCategory($id) {
        Category::find($id)->delete();

        $this->deleteModal = false;
    }

    public function updatedSearch() {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.dashboard.categories.show-categories', [
            'categories' => Category::search($this->search)
                ->orderBy('created_at', 'DESC')
                ->paginate($this->itemsPerPage)
        ]);
    }
}
