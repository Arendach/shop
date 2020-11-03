<?php

namespace App\Observers;

use Artisan;
use App\Models\Redirect;

class RedirectsObserver
{
    public function created(Redirect $redirect): void
    {
        $this->generateRedirects();
    }

    public function updated(Redirect $redirect): void
    {
        $this->generateRedirects();
    }

    public function deleted(Redirect $redirect): void
    {
        $this->generateRedirects();
    }


    public function creating(Redirect $redirect): Redirect
    {
        return $this->setStatus($redirect);
    }

    public function updating(Redirect $redirect): Redirect
    {
        return $this->setStatus($redirect);
    }


    protected function generateRedirects(): void
    {
        Artisan::call('generate:redirect-routes');
    }

    protected function setStatus(Redirect $redirect): Redirect
    {
        if (!$redirect->status) {
            $redirect->status = 301;
        }

        return $redirect;
    }
}
