<?php

namespace Kdion4891\LaravelLivewireForms;

use Illuminate\Support\Arr;
use Kdion4891\LaravelLivewireForms\Traits\FollowsRules;
use Kdion4891\LaravelLivewireForms\Traits\HandlesArrays;
use Kdion4891\LaravelLivewireForms\Traits\UploadsFiles;
use Livewire\Component;

class FormComponent extends Component
{
    use FollowsRules, UploadsFiles, HandlesArrays;

    public $model;
    public $form_data;
    private static $storage_disk;
    private static $storage_path;

    protected $listeners = ['fileUpdate'];

    public function mount($model = null)
    {
        $this->setFormProperties($model);
    }

    public function setFormProperties($model = null)
    {
        $this->model = $model;
        if ($model) $this->form_data = $model->toArray();

        foreach ($this->fields() as $field) {
            if (!isset($this->form_data[$field->name])) {
                $array = in_array($field->type, ['checkbox', 'file']);
                $this->form_data[$field->name] = $field->default ?? ($array ? [] : null);
            }
        }
    }

    public function render()
    {
        return $this->formView();
    }

    public function formView()
    {
        return view('laravel-livewire-forms::form', [
            'fields' => $this->fields(),
        ]);
    }

    public function fields()
    {
        return [
            Field::make('Name')->input()->rules(['required', 'string', 'max:255']),
            Field::make('Email')->input('email')->rules(['required', 'string', 'email', 'max:255', 'unique:users,email']),
            Field::make('Password')->input('password')->rules(['required', 'string', 'min:8', 'confirmed']),
            Field::make('Confirm Password', 'password_confirmation')->input('password'),
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules(true));
    }

    public function submit()
    {
        $this->validate($this->rules());

        $field_names = [];
        foreach ($this->fields() as $field) $field_names[] = $field->name;
        $this->form_data = Arr::only($this->form_data ?? [], $field_names);

        $this->success();
    }

    public function errorMessage($message)
    {
        return str_replace('form data.', '', $message);
    }

    public function success()
    {
        $this->form_data['password'] = bcrypt($this->form_data['password']);

        \App\User::create($this->form_data);
    }

    public function saveAndStay()
    {
        $this->submit();
        $this->saveAndStayResponse();
    }

    public function saveAndStayResponse()
    {
        return redirect()->route('users.create');
    }

    public function saveAndGoBack()
    {
        $this->submit();
        $this->saveAndGoBackResponse();
    }

    public function saveAndGoBackResponse()
    {
        return redirect()->route('users.index');
    }
}
