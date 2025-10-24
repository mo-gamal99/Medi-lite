<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ExcelImportedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $fileName;
    protected $rowsCount;

    public function __construct($fileName, $rowsCount)
    {
        $this->fileName = $fileName;
        $this->rowsCount = $rowsCount;
    }

    public function via($notifiable)
    {
        return ['database']; // تقدر تضيف 'mail' أو 'broadcast' لو عايز
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'تم استيراد ملف Excel بنجاح ✅',
            'body'  => "تم رفع الملف ({$this->fileName}) بنجاح، وعدد الصفوف: {$this->rowsCount}.",
            'url'   => route('medicals.index'),
        ];
    }
}
