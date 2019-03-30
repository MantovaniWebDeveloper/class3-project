<?php
	
	namespace App\Mail;
	
	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Contracts\Queue\ShouldQueue;
	
	class InfoMail extends Mailable implements ShouldQueue {
		use Queueable, SerializesModels;
		
		private $apartmentTitle;
		

		public function __construct($title) {
			$this->apartmentTitle = $title;
		}
		
		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build() {
			return $this->from('info@boolbnb.it')
			  ->subject('Hai un nuovo messaggio')
			  ->markdown('mail.new_message_mail')
			  ->with(['title'=>$this->apartmentTitle,'url'=>route('dashboard')]);
		}
	}
