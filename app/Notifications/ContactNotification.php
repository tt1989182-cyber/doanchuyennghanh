class ContactNotification extends Notification
{
    use Queueable;

    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Liên hệ mới từ khách hàng',
            'message' => $this->contact->message,
            'name' => $this->contact->name,
            'email' => $this->contact->email,
            'url' => route('admin.contact.index'),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'Liên hệ mới từ khách hàng',
            'message' => $this->contact->message,
            'url' => route('admin.contact.index'),
            'time' => now()->format('F d, Y h:i A')
        ]);
    }
}
