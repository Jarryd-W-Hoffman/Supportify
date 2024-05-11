<?php

namespace App\Livewire\Dashboard\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UsersTable extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $filterRole = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDirection = 'DESC';

    #[Url()]
    public $itemsPerPage = 10;

    public $deleteModal = false;

    public $id;
    public $name;
    public $email;

    public function updatedSearch() {
        $this->resetPage();
    }

    public function showDeleteModal(User $user) {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;

        $this->deleteModal = true;
    }

    public function closeDeleteModal() {
        $this->deleteModal = false;

        $this->reset(['id', 'name', 'email']);
    }

    public function setSortBy($field) {
        if ($this->sortBy === $field) {
            $this->sortDirection = ($this->sortDirection === 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $field;
        $this->sortDirection = 'DESC';
    }

    public function delete(User $user)
    {
        $user->delete();

        $this->closeDeleteModal();
    }

    public function render()
    {
        return view('livewire.dashboard.users.users-table', [
            'users' => User::search($this->search)
                ->with('roles')
                ->when($this->filterRole, function ($query) {
                    return $query->role($this->filterRole);
                })
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->itemsPerPage)
        ]);
    }
}
