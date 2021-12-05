<?php

namespace App\Http\Livewire\Core;

use App\Mail\ContactMessage;
use App\Models\Email;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactCard extends Component
{
    public $page_module;

    public $header;

    public $contact;

    public function clear()
    {
        $this->contact = [
            'first_name' => '',
            'last_name' => '',
            'company' => '',
            'email' => '',
            'phone_number' => '',
            'message' => ''
        ];
    }

    public function mount()
    {
        $this->clear();

        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0)
        {
            $this->header = $module->examples['header'];
        }
        else
        {
            $this->header = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'header')->first()->value;
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    public function rules()
    {
        return [
            'contact.first_name' => 'required|string',
            'contact.last_name' => 'required|string',
            'contact.company' => 'nullable|string',
            'contact.email' => 'required|email',
            'contact.phone_number' => 'nullable|phone:auto',
            'contact.message' => 'required|string|min:5'
        ];
    }

    public function messages()
    {
        return [
            'contact.first_name.required' => 'first name is required',
            'contact.first_name.string' => 'first name must be a string',
            'contact.last_name.required' => 'last name is required',
            'contact.last_name.string' => 'last name must be a string',
            'contact.company.string' => 'company must be a string',
            'contact.email.required' => 'email is required',
            'contact.email.email' => 'email format is incorrect',
            'contact.phone_number.phone' => 'The phone number is invalid',
            'contact.message.required' => 'message is required',
            'contact.message.string' => 'message must be a string',
            'contact.message.min' => 'message must be at least 5 characters',
        ];
    }

    public function send()
    {
        $this->validate();

        $email = new Email();
        $email->class = 'App\Mail\ContactMessage';
        $email->to = $this->contact['email'];
        $email->message = $this->contact['message'];
        $email->parameters = [
            'first_name' => $this->contact['first_name'],
            'last_name' => $this->contact['last_name'],
            'company' => $this->contact['company'],
            'phone_number' => $this->contact['phone_number'],
        ];
        $email->save();

        Mail::to($this->contact['email'])->send(new ContactMessage($email));

        $this->clear();

        session()->flash('message', 'message sent!');
    }

    public function render()
    {
        return view('livewire.core.contact-card');
    }
}
