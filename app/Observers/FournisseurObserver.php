<?php

namespace App\Observers;

use App\Models\Fournisseur;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
class FournisseurObserver
{
    /**
     * Handle the Fournisseur "created" event.
     */
    public function created(Fournisseur $fournisseur): void
    {
        $this->logAction($fournisseur, 'created');
    }

    /**
     * Handle the Fournisseur "updated" event.
     */
    public function updated(Fournisseur $fournisseur): void
    {
        $this->logAction($fournisseur, 'updated');
    }

    /**
     * Handle the Fournisseur "deleted" event.
     */
    public function deleted(Fournisseur $fournisseur): void
    {
        $this->logAction($fournisseur, 'deleted');

    }

    /**
     * Handle the Fournisseur "restored" event.
     */
    public function restored(Fournisseur $fournisseur): void
    {
        $this->logAction($fournisseur, 'restored');
    }

    /**
     * Handle the Fournisseur "force deleted" event.
     */
    public function forceDeleted(Fournisseur $fournisseur): void
    {
        $this->logAction($fournisseur, 'force_deleted');
    }
 /**
     * Enregistre l'action dans la table d'audit.
     */
    protected function logAction(Fournisseur $fournisseur, string $action): void
    {
        AuditLog::create([
            'model_type' => get_class($fournisseur),
            'model_id' => $fournisseur->id,
            'action' => $action,
            'data' => $fournisseur->toJson(),
            'user_id' => Auth::id(), // ID de l'utilisateur actuel
        ]);
    }
}
