<?php

namespace App\Notifications;

use App\Models\FeuilleNote;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NouvelleFeuilleNoteNotification extends Notification
{
    use Queueable;

    public function __construct(public FeuilleNote $feuilleNote)
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'titre' => 'Nouvelle feuille de notes',
            'message' => "Une nouvelle feuille de notes pour le module {$this->feuilleNote->module->nom} a été soumise.",
            'feuille_note_id' => $this->feuilleNote->id,
            'url' => route('validation. show', $this->feuilleNote),
        ];
    }
}