<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination;

    public $ids = '';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone_number = '';
    public $search = '';
    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'set:destroy' => 'destroy',
        'reset:inputs' => 'resetInputs'
    ];

    public function __construct($id = null)
    {
        $this->rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', Rule::unique('students', 'email')],
            'phone_number' => ['required', 'string', Rule::unique('students', 'phone_number')],
        ];
        parent::__construct($id);
    }

    public function resetInputs()
    {
        $this->ids = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->resetErrorBag();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validated = $this->validate();
        Student::create($validated);
        \session()->flash('message', __('message.success.success'));
        $this->reset();
        $this->emit('studentAdded');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $this->ids = $student->id;
        $this->first_name = $student->first_name;
        $this->last_name = $student->last_name;
        $this->email = $student->email;
        $this->phone_number = $student->phone_number;
    }

    public function update()
    {
        $rules = $this->rules;
        $rules['email'][3] = Rule::unique('students', 'email')->ignore($this->ids);
        $rules['phone_number'][2] = Rule::unique('students', 'phone_number')->ignore($this->ids);
        $validated = $this->validate($rules);
        if ($this->ids) {
            $student = Student::find($this->ids);
            $student->update($validated);
            $this->reset();
            session()->flash('message', __('message.success.success'));
            $this->emit('studentUpdated');
        }
    }

    public function destroy($id)
    {
        Student::find($id)->delete();
        session()->flash('message', __('message.success.success'));
    }

    public function render()
    {
        $students = Student::orderBy('id', 'desc');
        if (strlen($this->search)) {
            $search = "%$this->search%";
            $students->where('id', 'like', $search)
                ->orWhere('first_name', 'like', $search)
                ->orWhere('last_name', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orWhere('phone_number', 'like', $search);
        }
        $students = $students->paginate($this->perPage);
        return view('livewire.students', [
            'students' => $students
        ]);
    }
}
