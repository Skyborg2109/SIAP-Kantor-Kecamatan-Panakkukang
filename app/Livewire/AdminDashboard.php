<?php

namespace App\Livewire;

use App\Models\Counter;
use App\Models\Information;
use App\Models\Service;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class AdminDashboard extends Component
{
    public $tab = 'services';

    public function render()
    {
        return view('livewire.admin-dashboard', [
            'services' => Service::all(),
            'counters' => Counter::all(),
            'users' => User::all(),
            'information' => Information::all(),
        ]);
    }
}
