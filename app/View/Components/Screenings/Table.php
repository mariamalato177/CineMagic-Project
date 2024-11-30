<?php   
namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    public object $screenings;
    public array $movies;
    public bool $showView;
    public bool $showEdit;
    public bool $showDelete;

    /**
     * Create a new component instance.
     *
     * @param object $screenings
     * @param array $movies
     * @param bool $showView
     * @param bool $showEdit
     * @param bool $showDelete
     */
    public function __construct(
        object $screenings,
        array $movies = [],
        bool $showView = true,
        bool $showEdit = true,
        bool $showDelete = true
    ) {
        $this->screenings = $screenings;
        $this->movies = $movies;
        $this->showView = $showView;
        $this->showEdit = $showEdit;
        $this->showDelete = $showDelete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.screenings.table');
    }
}
