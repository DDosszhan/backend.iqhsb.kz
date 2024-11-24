<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VacanciesAppMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $resume;

    public function __construct($data, $resume)
    {
        $this->data = $data;
        $this->resume = $resume;
    }

    public function build()
    {
        return $this->subject('Новая заявка на вакансию')
		    ->markdown('emails.vacancies_application')
                    ->with('data', $this->data)
                    ->attach($this->resume->getRealPath(), [
                        'as' => $this->resume->getClientOriginalName(),
                        'mime' => $this->resume->getClientMimeType(),
                    ]);
    }
}
