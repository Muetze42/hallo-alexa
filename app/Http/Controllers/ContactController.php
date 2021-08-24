<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Notifications\Telegram\ErrorReport;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\TrashMail;
use App\Models\ContactRequest;
use Egulias\EmailValidator\EmailValidator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Http\Response as HttpResponse;

class ContactController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $meta = Page::where('route', 'contact')->first();

        return Inertia::render('Contact/Index', [
            'metaTitle' => $meta->title,
            'metaDesc'  => $meta->description,
        ])->withViewData([
            'metaTitle'  => $meta->title,
            'metaDesc'   => $meta->description,
            'metaRobots' => Page::ROBOTS[$meta->robots],
        ]);
    }

    public function store(Request $request)
    {
        // Todo : Create Validator with correct response

        $subject = $request->input('subject');
        $message = $request->input('message');
        $email = $request->input('email');
        $email2 = $request->input('confirm');
        $name = $request->input('name');
        $confirmation = $request->input('confirmation');

        if ($confirmation) {
            return $this->returnError(__('Wer hat denn da am Honigtopf genascht?'));
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->returnError(__('Das ist keine gültige E-Mail-Adresse'));
        }
        if ($email != $email2) {
            return $this->returnError(__('Die 2 Mail-Adressen stimmen nicht überein'));
        }
        $mailValidator = new EmailValidator();
        if (!$mailValidator->isValid($email, new DNSCheckValidation())) {
            return $this->returnError(__('Diese E-Mail ist nicht erreichbar'));
        }
        if (TrashMail::where('provider', explode('@', $email)[1])->first()) {
            return $this->returnError(__('Dieser E-Mail-Anbieter ist nicht zulässig'));
        }

        ContactRequest::create([
            'subject' => $subject,
            'message' => $message,
            'email'   => $email,
            'name'    => $name,
        ]);

        Notification::send(681791255, new ErrorReport('Neue E-Mail'));  // Todo: Mail Notification

        return response('created', ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param string $message
     * @return HttpResponse|Application|ResponseFactory
     */
    protected function returnError(string $message): HttpResponse|Application|ResponseFactory
    {
        return response($message, ResponseAlias::HTTP_MISDIRECTED_REQUEST);
    }
}
