<?php

namespace App\Http\Livewire\Core;

use App\Mail\ContactMessage;
use App\Models\Email;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

/**
 * ContactCard is a livewire component that provides
 * a contact form that can be added to any page. Its
 * aim is to allow unauthenticated users to reach out
 * to authorized users within the system.
 */
class ContactCard extends Component
{
    /**
     * the page module model that is passed throughout
     * the application to identify modals and page
     * information
     *
     * @var
     */
    public $page_module;

    /**
     * the value to display on the header of the module.
     *
     * @var
     */
    public $header;

    /**
     * the data provided by the user that will populate
     * the email sent out, and the emails table.
     *
     * @var
     */
    public $contact;

    /**
     * the value to pass through to the card footer
     * as the last time it was modified.
     *
     * @var
     */
    public $updated_at;

    /**
     * the method that clears out all values
     * for the contact form.
     *
     * @return void
     */
    public function clear()
    {
        // clear all values in the contact array.
        $this->contact = [
            'first_name' => '',
            'last_name' => '',
            'company' => '',
            'email' => '',
            'phone_number' => '',
            'message' => '',
        ];
    }

    /**
     * function that is called when the livewire component is
     * initialized.
     *
     * @return void
     */
    public function mount()
    {
        // clear the contact form
        $this->clear();

        // get the module information.
        $module = $this->page_module->module;

        // use examples if no parameters exist
        if ($module->module_parameters->count() == 0) {
            // set the header value based on the modules example
            $this->header = $module->examples['header'];
        } else {
            // get the dynamic value for the header
            $this->header = $module->module_parameters->where('hash', '=', $this->page_module->hash)->where('parameter', '=', 'header')->first()->value;
        }

        // updated at
        $this->updated_at = $module->updated_at;
    }

    /**
     * validation rules that will be checked when the
     * change order modal is saved.
     *
     * @return string[]
     */
    public function rules()
    {
        return [
            'contact.first_name' => 'required|string',
            'contact.last_name' => 'required|string',
            'contact.company' => 'nullable|string',
            'contact.email' => 'required|email',
            'contact.phone_number' => 'nullable|phone:auto',
            'contact.message' => 'required|string|min:5',
        ];
    }

    /**
     * messages to display when validation errors
     * occur.
     *
     * @return string[]
     */
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

    /**
     * method that will save the contact information
     * via email to the configured user, and save the
     * contact to the emails table.
     *
     * @return void
     */
    public function send()
    {
        // validate the request
        $this->validate();

        // save the contact information to the emails table.
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

        // send out the email
        Mail::to($this->contact['email'])->send(new ContactMessage($email));

        // clear the form
        $this->clear();

        // flash message to the user notifying them that it is sent.
        session()->flash('message', 'message sent!');
    }

    /**
     * the method that is automatically called to render
     * the view for the livewire component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.core.contact-card');
    }
}
