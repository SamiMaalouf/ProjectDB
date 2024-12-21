<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class CrudTable extends Component
{
    public $items;
    public $columns;
    public $route;
    public $canCreate;
    public $canEdit;
    public $canDelete;

    public function __construct($items, $columns, $route, $canCreate = false, $canEdit = false, $canDelete = false)
    {
        $this->items = $items;
        $this->columns = $columns;
        $this->route = $route;
        $this->canCreate = $canCreate;
        $this->canEdit = $canEdit;
        $this->canDelete = $canDelete;
    }

    public function render()
    {
        return view('components.frontend.crud-table');
    }
} 